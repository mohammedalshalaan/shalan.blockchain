@extends('layouts.app')


@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="card">
                        <div class="p-3 mb-3 bg-primary text-white"><h2><p class="text-center"> The Address Title: {{$address->title}}</h2></div>
                            <div class="card-body">
                                <div class="d-inline p-2 bg-warning text-dark">The total of addresses: {{$address->addresses()->count()}}</div>
                                    <br/><br />
                                    <form action="{{route('addresses.create',$address)}}" method="address">
                                        @csrf   
                                        
                                        
                                                <div class="mb-3">
                                                <p class="lh-lg"><h5><b>{{$address->description}}</b><h5></p>
                                                </div>
                                            
                                            <input name = "blog_id" value= "{{ $address->id }} " type="hidden"checked></input>
                                            <button type="submit" class="btn btn-primary">Create Post</button>       
                                    </form> 
                            </div>
                        </div>
                    </div>                  
                    <div class="col-11">
                    <div class="card">
                        <div class="p-0 mb-0 bg-primary text-white"><h2><p class="text-center">The addresses</h2></div>
                                    <div class="card-body">
                                    <table class="table">
                                    <table class="table">
                                    <thead> 
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title:</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Total Of Comments</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Actions:</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($addresses as $address)
                                                <tr>          
                                                        <th scope="row">{{$address->id}}</th>
                                                        <td>{{$address->title}}</td>
                                                        <td>{{$address->user->name}}</td>
                                                        <td>{{$address->comments->count()}}</td>
                                                        <td><img src="{{asset('/storage/images/'.$address->avatar)}}" width="100" alt="avatar"/></td>
                                                        <td>
                                                        <a href="{{route('addresses.show',$address)}}"><button type="button" class="btn btn-primary float-left">show</button></a>
                                                    
                                                        </td>
                                                </tr>
                                        </tbody>
                                        @endforeach 
                                                    
                                </table> 
                            </div>
                        </div>
                    <div class="parent">{{$addresses->links()}} </div>  
                </div>                  
            </div> 
        </div>                            
    </div>

@include('sweetalert::alert')
@endsection
