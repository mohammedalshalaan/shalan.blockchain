@extends('layouts.app')

@section('title', 'Users')

@section('content')


<form action="{{route('users.store')}}" method="post">
@csrf
<p>Name: <input type="text" name = "name" value="{{old('name')}}"></p>

<p>email: <input type="text" name = "email" value="{{old('email')}}"></p>

<p>password: <input type="text" name = "password" value="{{old('password')}}"></p>


<input type= "submit" value="Submit">

<a href="{{ route ('users.index')}}">Cancel</a>

</form>


@endsection

