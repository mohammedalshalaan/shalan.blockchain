@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">The Properties</h2></div>
                    <div class="card-body">
                        <table class="table">
                                <thead> 
                                        <tr >
                                        <th scope="col">#</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Certificate Id</th>
                                        <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                  
                                            @foreach($properties as $property)
                                                <tr>          
                                                        <th scope="row">{{$property->id}}</th>
                                                        <td>{{$property->owner}}</td>
                                                        <td>{{$property->certificate_id}}</td>
                                                        <td>
                                                        
                                                        
                                                        @can('delete-users') 
                                                    <form action = "{{route('properties.destroy', $property)}}" method="POST" class="float-left"></a>
                                                        @csrf
                                                        {{ method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-danger">Delete</button>@endcan</td></a>
                                                    </form>
                                                </tr>
                                            
                                            @endforeach
                                            
                                    </tbody>
                                    
                            </table>
                           
                                            <div> @can('delete-users') 
                                                <a href="{{route('properties.create')}}"class="btn btn-primary">Create a New Property</a>
                                                @endcan
                                            </div>  
                        <div>
                             
                </div>
                
            </div>
            <div class="parent">{{$properties->links()}} </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@endsection

