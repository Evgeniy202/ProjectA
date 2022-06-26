@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
@extends('admin.layouts.base')
@section('tittle')
Characteristic of {{ $category->tittle }}
@endsection
@section('content')

@endsection
@endif