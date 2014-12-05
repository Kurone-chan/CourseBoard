<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;

class DBFile extends Eloquent implements UserInterface {

  use UserTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'files';

  public $timestamps = true;

  public function userIsOwner(){
    if(Auth::user()->id == $this->uploader){
      return true;
    }else{
      return false;
    }
  }

  public function deleteFile(){
    $this->delete();
    return Redirect::to('');
  }

}
