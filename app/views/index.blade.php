@extends('layouts.master')
@section('body')
  @if(Auth::check())
    @include('account.userindex')
  @else
    @include('sections.main')
  @endif
@stop