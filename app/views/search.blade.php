@extends('layouts.master')
@section('body')

<div class="jumbotron" style="margin-top:65px;">
  <div class="container">
    <h3>Group search results for <span class="text-primary">{{ $searchterm }}</span></h3>
  </div>
</div>

<div class="container-fluid" style="margin-top:35px;">
  <div class="row-fluid">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">

      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title">We found the following groups related to your search.</div>
        </div>
        <div class="panel-body">
          <table class="table table-condensed">
            @forelse($results as $result)
              @if($result->private)
                <tr><td><a href="{{ URL::to('g/' . $result->uid) }}">{{ $result->uid }}: {{ $result->name }}</a></td><td class="text-right"><i class="fa fa-lock"></i> Private Group</td></tr>
              @else
                <tr><td><a href="{{ URL::to('g/' . $result->uid) }}">{{ $result->uid }}: {{ $result->name }}</a></td><td class="text-right"><i class="fa fa-unlock"></i> Public Group - <a href="{{ URL::to('join/' . $result->uid) }}">Join Group</a></td></tr>
              @endif
            @empty
              <tr><td><i>We couldn't find any groups that matched your keywords. Please refine your search by removing some words or try again.</i></td></tr>
            @endforelse
          </table>
        </div>
      </div>

    </div>
    <div class="col-lg-3"></div>
  </div>
</div>

@stop