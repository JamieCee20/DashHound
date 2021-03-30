<?php

namespace App\Http\Controllers\Admin;

use App\Discussion;
use App\Http\Controllers\Controller;
use App\User;
use Gate;
use App\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * |-----------------------------------------------------
     * | General index list of users, limit to 10 per page
     * |-----------------------------------------------------
     * |
     * |
     */
    public function index()
    {
        // Paginate function takes items per page (10), number of cols ([*]) and name of pagination (users) to prevent changing all item paginations on same page.
        $users = User::where('id', '>', 0)->paginate(10, ['*'], 'users');
        $pinned = Discussion::where('pinned', 1)->paginate(20, ['*'], 'pinned');
        $forums = Discussion::where('pinned', 0)->paginate(20, ['*'], 'forums');
        return view('admin.users.index', compact('users', 'forums', 'pinned'));
        // return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        if(Gate::denies('edit-users')) {
            return redirect()->route('admin.users.index');
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * |----------------------------------------
     * | Update users details as administrator
     * |----------------------------------------
     * |
     * |
     */
    public function update(Request $request, User $user)
    {
        //
        if(Gate::denies('manage-users')) {
            return redirect()->route('admin.users.index');
        }

        $user->roles()->sync($request->roles);

        $user->username = $request->name;
        $user->email = $request->email;

        if($user->save()) {
            $request->session()->flash('success', $user->username . ' has updated successfully');
        } else {
            $request->session()->flash('error', 'Error updating details');
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if(Gate::denies('delete-users')) {
            return redirect()->route('admin.users.index');
        }
        //
        $user->roles()->detach();
        // $user->delete(); Old method of deleting, improved with alert checking.

        if($user->delete()) {
            $request->session()->flash('success', $user->username . ' has been deleted');
        } else {
            $request->session()->flash('error', 'Unable to delete user at this time');
        }

        return redirect()->route('admin.users.index');
    }

    public function suspendUser(User $user) {
        if(Gate::denies('manage-users')) {
            return redirect()->route('admin.users.index');
        }

        if($user->banned_until == null) {
            $suspension = now()->addDays(30);
            $user->banned_until = $suspension;
            $user->save();

            return redirect()->route('admin.users.index')->with('warning', $user->username .' has been suspended for 30 days');
        } else {
            return redirect()->route('admin.users.index')->with('error', $user->username .' is already suspended');
        }
    }
}
