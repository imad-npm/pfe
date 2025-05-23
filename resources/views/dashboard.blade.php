@extends('layouts.app')

@section('content')

<x-navbar />
    logged in
@endsection

<x-errors :errors="$errors" />