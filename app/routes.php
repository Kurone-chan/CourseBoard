<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*=== Main Website =============================================================================================================*/
Route::get('/', array('as' => 'home', function(){ return View::make('index'); }));
Route::get('account', array('before' => 'auth', 'as' => 'accountsettings', function(){ return View::make('account.settings'); }));


/*=== Password Management Controller ==============*/
Route::controller('password', 'RemindersController');


/*=== Account Authentication Routes ==============================================*/
Route::get('login', array('uses' => 'AuthController@showLogin'));
Route::post('login', array('before' => 'csrf', 'uses' => 'AuthController@doLogin'));
Route::get('auth', function(){ return View::make('auth.login'); });
Route::get('logout', array('uses' => 'AuthController@doLogout'));


/*=== Account Registration Route ========================================*/
Route::post('register', array('uses' => 'AuthController@registerAccount'));


/*=== Course Routing ==================================================================================*/
Route::group(array('prefix' => 'c', 'before' => 'auth'), function()
{
  Route::get('/', function(){ Redirect::route('home'); });

  Route::get('{courseid}', function($courseid)
  {
    $course = Course::where('uid', '=', $courseid)->firstOrFail();
    $ownerinfo = User::find($course->ownerid);
    return View::make('workgroups.courses.index', array('course' => $course, 'ownerinfo' => $ownerinfo));
  });
});


/*=== Group Routing ==================================================================================*/
Route::group(array('prefix' => 'g', 'before' => 'auth'), function()
{

  Route::get('/', function(){ return Redirect::route('home'); });

  Route::get('{groupid}', function($groupid)
  {
    $wg = Group::where('uid', '=', $groupid)->firstOrFail();
    return View::make('workgroups.groups.index', array('group' => $wg));
  });

  Route::get('{groupid}/edit/{fileid}', function($groupid, $fileid)
  {
    $finfo = DBFile::find($fileid);
    return View::make('workgroups.groups.edit')->with('fdata', $finfo);
  });

  Route::get('{groupid}/settings', function($groupid)
  {
    $wg = Group::where('uid', '=', $groupid)->firstOrFail();
    if(!Auth::check() || Auth::user()->id != $wg->ownerid)
    {
      return Redirect::to('error/not-owner');
    }else
    {
      return View::make('workgroups.groups.settings')->with('groupinfo', $wg);
    }
  });

  Route::get('{groupid}/view/{fileid}', function($groupid, $fileid)
  {
    $file = DBFile::find($fileid);
    $wg = Group::where('uid', '=', $groupid)->firstOrFail();
    return View::make('workgroups.groups.viewfile', array('fdata' => $file, 'group' => $wg));
  });

  Route::get('{groupid}/removeuser/{userid}', function($groupid, $userid)
  {
    $group = Group::where('uid', '=', $groupid)->firstOrFail();
    $members = unserialize($group->members);
    for ($i=0; $i < count($members); $i++) {
      if($members[$i] == $userid){
        unset($members[$i]);
      }
    }
    $members = array_values($members);
    $group->members = serialize($members);
    $group->save();
    return Redirect::to('g/' . $groupid);
  });

  Route::get('{guid}/delgroup', function($guid)
  {
    $group = Group::where('uid', '=', $guid)->firstOrFail();
    $group->delete();
    return View::make('workgroups.groups.deletesuccess');
  });

  Route::post('createfile', array('before' => 'csrf', 'uses' => 'GroupController@createFile'));
  Route::post('updatebasicinfo', array('before' => 'csrf', 'uses' => 'GroupController@updateBasicInfo'));
  Route::post('updateownership', array('before' => 'csrf', 'uses' => 'GroupController@transferOwnership'));
});
Route::post('creategroup', array('uses' => 'GroupController@createGroup'));
Route::post('invitemember', array('uses' => 'GroupController@inviteMember'));


/*=== Error Routing ==================================*/
Route::get('error/{errorid}', function($errorid)
{
  return View::make('error')->with('errorid', $errorid);
});


/*=== Search Function Routes ===============================================================*/
Route::post('search', array('before' => 'csrf', 'uses' => 'SearchController@search'));
Route::post('pagesearch', array('before' => 'csrf', 'uses' => 'SearchController@pagesearch'));
Route::get('join/{groupid}', function($groupid)
{
  $group = Group::where('uid', '=', $groupid)->firstOrFail();
  $group->joinGroup(Auth::user()->id);
});


/*=== File Management Resource ==================================*/
Route::post('file/{id}', array('uses' => 'FileController@update'));
Route::resource('file', 'FileController');
