<?php

use App\User;
use App\Category;
use App\Discussion;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Auth::routes(['verify' => true]);

// Test Routes
Route::get('testing',function(){
    $post = App\Post::where('id', 4)->with('comments')->first();
    dd($post->comments->first()->name);
  });
  
  Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

/**
 * |--------------------------------------------------------------------------
 * | Home Functionality
 * |--------------------------------------------------------------------------
 * | Search functions take parameter in search bar and find details relating
 * | to that query and display accordinly. Other functions are basic routing
 */
Route::get('/', function () { return view('welcome'); })->name('landing');
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
        $pinned = Discussion::where('pinned', 1)->paginate(20);
        $forums = Discussion::where('pinned', 0)->paginate(20);
        return view('admin.users.index', ['users' => $users, 'forums' => $forums, 'pinned' => $pinned])->withDetails($user)->withQuery($q);
    } else {
         return redirect()->route('admin.users.index')->with('error', 'No Details found. Try to search again !');
    }     
});

/**
 * |--------------------------------------------------------------------------
 * | Regular User Post Section
 * |--------------------------------------------------------------------------
 * | Basic post routing using the resource controller methods, no custom
 * | functions were used.
 * |
 */
Route::get('/posts', 'PostsController@index')->name('post.index');
Route::get('/p/create', 'PostsController@create')->middleware('auth');
Route::post('/p', 'PostsController@store')->name('post.store')->middleware('auth');
Route::get('/p/{post}', 'PostsController@show')->name('post.show');
Route::get('/p/{post}/edit', 'PostsController@edit')->name('post.edit')->middleware('auth');
Route::patch('/p/{post}', 'PostsController@update')->name('post.update')->middleware('auth');
Route::delete('/p/{post}', 'PostsController@destroy')->name('post.delete')->middleware('auth');

/**
 * |--------------------------------------------------------------------------
 * | Regular User Post Comments
 * |--------------------------------------------------------------------------
 * | Comments have fewer methods due to the main display of comments are
 * | on the user posts meaning I can combine into post controller functions
 */
Route::post('/comment/{post}', 'CommentsController@store')->name('comments.store')->middleware('auth');
Route::get('/comment/{comment}/edit', 'CommentsController@edit')->middleware('auth');
Route::patch('/comment/{comment}', 'CommentsController@update')->name('comments.update')->middleware('auth');
Route::delete('/comment/{comment}', 'CommentsController@destroy')->name('comments.delete')->middleware('auth');

/**
 * |---------------------------------------
 * | Verified User Post Section
 * |---------------------------------------
 * |
 * |
 */
Route::get('/v/posts', 'VerifiedController@index')->name('vpost.index');
Route::get('/v/create', 'VerifiedController@create')->middleware('can:post-verified-create');
Route::post('/v', 'VerifiedController@store')->name('verifieds.store')->middleware('can:post-verified-create');
Route::get('/v/{verified}', 'VerifiedController@show')->name('verifieds.show');
Route::get('/v/{verified}/edit', 'VerifiedController@edit')->name('verifieds.edit')->middleware('can:post-verified-create');
Route::patch('/v/{verified}', 'VerifiedController@update')->name('verifieds.update')->middleware('can:post-verified-create');
Route::delete('/v/{verified}', 'VerifiedController@destroy')->name('verifieds.delete')->middleware('can:post-verified-create');
Route::get('/v/toggleLike/{verified}', 'LikesController@toggleLike')->name('toggleLike')->middleware('auth');

/**
 * |---------------------------------------
 * | Profiles route management
 * |---------------------------------------
 * |
 * |
 */
Route::get('/profile/{user}', 'ProfilesController@index')->name('profiles.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit')->middleware('auth');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update')->middleware('auth');

/**
 * |---------------------------------------
 * | Administration Section
 * |---------------------------------------
 * |
 * |
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});


/**
 * |---------------------------------------
 * | Forum Section
 * |---------------------------------------
 * |
 * |
 */
Route::get('/forums', 'DiscussionController@index')->name('forum.index');
Route::get('/forums/admin', 'DiscussionController@admin')->name('forum.admin')->middleware('can:forum-admin'); // Admin control panel for forums (custom function)
Route::get('/forums/create', 'DiscussionController@create')->name('forum.create')->middleware('auth');
Route::post('/forums', 'DiscussionController@store')->name('forum.store')->middleware('auth');
Route::get('/forums/{discussion}', 'DiscussionController@show')->name('forum.show');
Route::get('/forums/{discussion}/edit', 'DiscussionController@edit')->name('forum.edit')->middleware('auth');
Route::patch('/forums/{discussion}', 'DiscussionController@update')->name('forum.update')->middleware('auth');
Route::delete('/forums/{discussion}', 'DiscussionController@destroy')->name('forum.delete')->middleware('auth');


/**
 * |--------------------------------------------------------------------------
 * | Reply section for forums
 * |--------------------------------------------------------------------------
 * | 
 * | 
 */
Route::post('/reply/{reply}', 'ReplyController@store')->name('reply.store')->middleware('auth');
Route::get('/reply/{reply}/edit', 'ReplyController@edit')->middleware('auth');
Route::patch('/reply/{reply}', 'ReplyController@update')->name('reply.update')->middleware('auth');
Route::delete('/reply/{reply}', 'ReplyController@destroy')->name('reply.delete')->middleware('auth');

