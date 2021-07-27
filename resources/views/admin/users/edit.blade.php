@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                            <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Users Authorisations</h2></div>
                            <div class="card-header">Edit User {{$user->name}}</div>

                    <div class="card-body">
                            <form action = " {{route ('admin.users.update', $user)}}" method="POST">
                                 @csrf
                                        {{ method_field('PUT')}}

                                        @foreach ($roles as $role)
                                        
                                        <div class = "form-check ">
                                                <input type ="checkbox" name="roles[]" value="{{$role->id}}"
                                                @if($user->roles->pluck('id')->contains($role->id))checked @endif>
                                                <lable> {{ $role->name }}</lable>
                                        </div>
                                        
                                        @endforeach
                                        
                                            
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>

                                   
                            </form>
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection
