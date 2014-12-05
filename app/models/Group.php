<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;

class Group extends Eloquent implements UserInterface {

  use UserTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'groups';

  public $timestamps = true;

  public function hasMember($memberid){
    $members = unserialize($this->members);
    foreach($members as $user){
      if($user == $memberid){
        return true;
      }else{
        return false;
      }
    }
  }

  public function userIsMember(){
    $members = unserialize($this->members);
    foreach($members as $user){
      if(Auth::user()->id == $user){
        return true;
      }else{
        return false;
      }
    }
  }

  public function userIsOwner(){
    if(Auth::user()->id == $this->ownerid){
      return true;
    }else{
      return false;
    }
  }

  public function joinGroup($userid)
  {
    if($this->private)
    {
      Redirect::to('error/private');
    }else
    {
      $members = unserialize($this->members);
      if($this->hasMember($userid))
      {
        Redirect::to('error/no-access');
      }else
      {
        array_push($members, $userid);
        $this->members = serialize($members);
        $this->save();
        Redirect::to('');
      }
    }
  }

}
