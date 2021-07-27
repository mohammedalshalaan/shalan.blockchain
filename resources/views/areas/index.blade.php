@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">The Areas</h2></div>
                    <div class="card-body">
                        <table class="table">
                                <thead> 
                                        <tr >
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Number Of Offers</th>
                                        <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                  
                                            @foreach($areas as $area)
                                                <tr>          
                                                        <th scope="row">{{$area->id}}</th>
                                                        <td>{{$area->title}}</td>
                                                        <td>2</td>
                                                        <td>
                                                        <a href="{{route('areas.show',$area)}}"><button type="button" class="btn btn-primary float-left">show</button></a>                                              
                                                        
                                                        @can('delete-users') 
                                                    <form action = "{{route('areas.destroy', $area)}}" method="POST" class="float-left"></a>
                                                        @csrf
                                                        {{ method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-danger">Delete</button>@endcan</td></a>
                                                    </form>
                                                </tr>
                                            
                                            @endforeach
                                            
                                    </tbody>
                                    
                            </table>
                           
                                            <div> @can('delete-users') 
                                                <a href="{{route('areas.create')}}"class="btn btn-primary">Create Area</a>
                                                @endcan
                                            </div>  
                        <div>
                             
                </div>
                
            </div>
            <div class="parent">{{$areas->links()}} </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@endsection

