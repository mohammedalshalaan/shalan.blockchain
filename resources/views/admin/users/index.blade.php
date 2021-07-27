@extends('layouts.app')

@section('content')

  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                            <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Users Authorisations</h2></div>
                        <div class="card-body">
                                  <table class="table">
                                                <thead>
                                                  <tr>
                                                      <th scope="col">#</th>
                                                      <th scope="col">Name:</th>
                                                      <th scope="col">Email:</th>
                                                      <th scope="col">Roles:</th>
                                                      <th scope="col">Actions:</th>
                                                  </tr>
                                                </thead>
                                          <tbody>
                                              @foreach($users as $user)
                                              <tr>
                                                    <th scope="row">{{$user->id}}</th>
                                                      <td>{{$user->name}}</td>
                                                      <td>{{$user->email}}</td>
                                                    <div> <td>{{implode(',', $user->roles()->get()->pluck('name')->toArray())}}</td></div>
                                                  <td>
                                                  @can('edit-users')
                                                  <a href="{{route('admin.users.edit',$user->id)}}"><button type="button" class="btn btn-primary float-left">Setting</button></a>
                                                  @endcan
                                  
                                                  @can('delete-users') 
                                                              <form action = "{{route('admin.users.destroy', $user)}}" method="POST" class="float-left"></a>
                                                                @csrf
                                  
                                                                {{ method_field('DELETE')}}
                                                                <button type="submit" class="btn btn-danger">Delete</button></td></a>
                                                  
                                                              </form>         
                                              <tr>
                                          </tbody>
                                            @endcan
                                            @endforeach
                                        </table>
              
                          </div>
                      </div>  
                      <div class="parent">{{$users->links()}} </div> 
             </div>
        </div>
   </div>  

  @include('sweetalert::alert')
@endsection
