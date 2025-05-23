
@extends('layouts.app')


@section('content')
    
<div class="w-[70%] mx-auto m-8">
<x-team.card :team="$team" />
</div>
  @endsection