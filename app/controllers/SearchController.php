<?php

class SearchController extends BaseController {

  public function search()
  {
    $searchitems = Group::where('name', 'LIKE', '%' . Input::get('search') . '%')->get();
    return View::make('search', array('searchterm' => Input::get('search'), 'results' => $searchitems));
  }
  
  public function pagesearch()
  {
    $searchitem = Group::where('name', '=', Input::get('search'))->first();
    return Redirect::route('g/' . $searchitem->uid, array('groupid' => $searchitem->uid));
  }

}
