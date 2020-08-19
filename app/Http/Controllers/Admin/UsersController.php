<?php

namespace App\Http\Controllers\Admin;

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
        //
        $users = User::where('id', '>', 0)->paginate(10);
        return view('admin.users.index')->with('users', $users);
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

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()) {
            $request->session()->flash('success', $user->name . ' has updated successfully');
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
            $request->session()->flash('success', $user->name . ' has been deleted');
        } else {
            $request->session()->flash('error', 'Unable to delete user at this time');
        }

        return redirect()->route('admin.users.index');
    }
}
