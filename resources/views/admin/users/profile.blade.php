@extends('layouts.app')

@section('content')

  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                            <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">User Profile</h2></div>
                        <div class="card-body">
                                  <table class="table">
                                                <thead>
                                                  <tr>
                                                      <th scope="col">Blockchain Account Address</th>
                                                      <th scope="col">Name:</th>
                                                      <th scope="col">Email:</th>
                                                     
                                                  </tr>
                                                </thead>
                                          <tbody>
                                             
                                              <tr>
                                                    <th scope="row">{{$user->blockchain_address}}</th>
                                                      <td>{{$user->name}}</td>
                                                      <td>{{$user->email}}</td>
                                                  <td>
                                                 
                                                 
             
                                                             
                                                               
   
                                              <tr>
                                          </tbody>
                                         
                                           
                                        </table>
                                        <form action = "{{route('areas.index')}}"></a>
                                                              
                                  
                                                               
                                                              <button type="submit" class="btn btn-primary">Back To the Main Page</button></td></a>
                                                
                          </div>
                      </div>  
             </div>
        </div>
   </div>  

  @include('sweetalert::alert')
@endsection
