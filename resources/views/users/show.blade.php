@extends('layouts.app')

@section('title', 'User details')

@section('content')

<p> the User details are :</p>

<ul>
<li>ID: {{$user->id ?? 'Unknown'}}<li>
<li>The name: {{$user->name ?? 'Unknown'}}<li>
<li>Email: {{$user->email ?? 'Unknown'}}<li>


</ul>

<form action = "{{ route ('users.destroy', ['id'=> $user->id])}}" method="post">
@csrf
@method('DELETE')
<button type="submit">Delete</button>
</form>

@endsection
