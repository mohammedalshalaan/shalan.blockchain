@extends('layouts.app')

@section('title')

Users

@section('content')

<p> the Users are :</p>

<p> the users of the system are :</p>

<ul>

@foreach ($users as $user)

<li><a href="{{ route('users.show', ['user'=> $user->id])}}">{{$user->name}}</a></li>

@endforeach
</ul>

<a href="{{route('users.create')}}">Create User</a>

@endsection
