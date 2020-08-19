<?php

use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Test Routes
Route::get('testing',function(){
    $post = App\Post::where('id', 4)->with('comments')->first();
    dd($post->comments->first()->name);
  });

/**
 * |---------------------------------------
 * | Home Functionality
 * |---------------------------------------
 * |
 * |
 */
Route::get('/', function () { return view('welcome'); });
Route::get('/contact', function() { return view('contact'); });
Route::get('/home', 'HomeController@index')->name('home');
Route::any('/search',function(Request $request){
    $q = $request->get( 'q' );
    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('home')->withDetails($user)->withQuery ( $q );
    else return view ('home')->with('error', 'No Details found. Try to search again !');
});
Route::any('/usersearch',function(Request $request){
    $q = $request->get( 'qUser' );
    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0) {
        $users = User::where('id', '>', 0)->paginate(10);
        return view('admin.users.index', ['users' => $users])->withDetails($user)->withQuery($q);
    } else {
         return redirect()->route('admin.users.index')->with('error', 'No Details found. Try to search again !');
    }     
});

/**
 * |---------------------------------------
 * | Regular User Post Section
 * |---------------------------------------
 * |
 * |
 */
Route::get('/p/create', 'PostsController@create')->middleware('auth');
Route::post('/p', 'PostsController@store')->name('post.store')->middleware('auth');
Route::get('/p/{post}', 'PostsController@show')->name('post.show');
Route::get('/posts', 'PostsController@index')->name('posts');
Route::get('/p/{post}/edit', 'PostsController@edit')->name('post.edit')->middleware('auth');
Route::patch('/p/{post}', 'PostsController@update')->name('post.update')->middleware('auth');
Route::delete('/p/{post}', 'PostsController@destroy')->name('post.delete')->middleware('auth');

/**
 * |---------------------------------------
 * | Regular User Post Comments
 * |---------------------------------------
 * |
 * |
 */
Route::post('/comment/{post}', 'CommentsController@store')->name('comments.store')->middleware('auth');
Route::get('/comment/{comment}/edit', 'CommentsController@edit')->middleware('auth');
Route::patch('/comment/{comment}', 'CommentsController@update')->name('comments.update')->middleware('auth');
Route::delete('/comment/{comment}', 'CommentsController@destroy')->name('comments.delete')->middleware('auth');

/**
 * |----------------------------
 * | Verified User Post Section
 * |----------------------------
 * |
 * |
 */
Route::get('/v/create', 'VerifiedController@create')->middleware('can:post-verified-create');
Route::post('/v', 'VerifiedController@store')->name('verifieds.store')->middleware('can:post-verified-create');
Route::get('/v/posts', 'VerifiedController@index');
Route::get('/v/{verified}', 'VerifiedController@show')->name('verifieds.show');
Route::get('/v/{verified}/edit', 'VerifiedController@edit')->name('verifieds.edit')->middleware('can:post-verified-create');
Route::patch('/v/{verified}', 'VerifiedController@update')->name('verifieds.update')->middleware('can:post-verified-create');
Route::delete('/v/{verified}', 'VerifiedController@destroy')->name('verifieds.delete')->middleware('can:post-verified-create');
Route::get('/v/toggleLike/{verified}', 'LikesController@toggleLike')->name('toggleLike')->middleware('auth');

/**
 * |----------------------------
 * | Profiles route management
 * |----------------------------
 * |
 * |
 */
Route::get('/profile/{user}', 'ProfilesController@index')->name('profiles.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit')->middleware('auth');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update')->middleware('auth');

Auth::routes(['verify' => true]);
/**
 * |----------------------------
 * | Administration Section
 * |----------------------------
 * |
 * |
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
