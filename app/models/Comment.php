<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;

class Comment extends Eloquent implements UserInterface {

  use UserTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'comments';

  public $timestamps = true;

}
