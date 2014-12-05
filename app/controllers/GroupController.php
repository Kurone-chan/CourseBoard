<?php

class GroupController extends BaseController {

  public function createGroup()
  {
    $group = new Group;

    $group->uid = Input::get('uid');
    $group->name = Input::get('name');
    $group->about = Input::get('about');
    $group->ownerid = Auth::user()->id;
    $group->private = Input::get('private');
    $group->members = serialize(array(Auth::user()->id));
    $group->boards = serialize(array());
    $group->files = serialize(array());

    $group->save();

    return Redirect::to('/');
  }

  public function updateBasicInfo()
  {
    $group = Group::find(Input::get('id'));
    $group->name = Input::get('name');
    $group->about = Input::get('about');
    $group->private = Input::get('private');
    $group->headercolor = Input::get('headercolor');
    $group->headingcolor = Input::get('headingcolor');
    $group->desccolor = Input::get('desccolor');
    $groupuid = $group->uid;
    $group->save();
    return Redirect::intended('g/' . $groupuid);
  }

  public function transferOwnership()
  {
    $newowner = User::where('email', '=', Input::get('email'))->firstOrFail();
    $group = Group::find(Input::get('gid'));
    $oldowner = User::find($group->ownerid);
    $group->ownerid = $newowner->id;
    $gmembers = unserialize($group->members);
    $gmembers[0] = $newowner->id;
    $group->members = serialize($gmembers);
    $group->save();

    $gmembers = unserialize($group->members);
    if(!$group->hasMember($oldowner->id))
    {
      array_push($gmembers, $oldowner->id);
    }
    $group->members = serialize($gmembers);
    $group->save();
    return Redirect::to('g/' . $group->uid);
  }

  public function createFile()
  {

    $dbFile = new DBFile;
    $dbFile->name = Input::get('filename');
    $dbFile->path = "";
    $dbFile->uploader = Auth::user()->id;
    $dbFile->size = "Unknown";
    $dbFile->content = "";
    $dbFile->filetype = Input::get('filetype');
    $uploaded = $dbFile->save();

    $allowEditing = Input::get('allowediting');

    $post = new Post;
    $grp = Group::where('uid', '=', Input::get('uid'))->first();

    $filelist = unserialize($grp->files);
    array_push($filelist, $dbFile->id);
    $grp->files = serialize($filelist);
    $grp->save();

    $post->parent = $grp->id;
    $post->title = Auth::user()->firstname . ' ' . Auth::user()->lastname . ' has created a new file.';
    if($allowEditing)
    {
      $post->content = 'A new file named \'' . $dbFile->name . '\' has been created. Click <a href="' . URL::to('g/' . $grp->uid . '/edit/' . $dbFile->id) . '">here</a> to edit it.';
    }else
    {
      $post->content = 'A new file named \'' . $dbFile->name . '\' has been created. Click <a href="' . URL::to('g/' . $grp->uid . '/view/' . $dbFile->id) . '">here</a> to view it.';
    }
    $post->creator = Auth::user()->id;
    $post->save();

    if($uploaded){ return Redirect::to('g/' . Input::get('uid') . '/edit/' . $dbFile->id); }else{ return Response::jscon('error', 400); }
  }

  public function inviteMember()
  {
    $email = Input::get('email');
    $newmember = User::where('email', '=', $email)->firstOrFail();
    $group = Group::find(Input::get('groupid'));
    $gmembers = unserialize($group->members);
    array_push($gmembers, $newmember->id);
    $group->members = serialize($gmembers);
    $group->save();
    return Redirect::to('g/' . $group->uid);
  }

}
