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
                        <div class="p-3 mb-3 bg-primary text-white"><h2><p class="text-center"> Area's Title : {{$area->title}}</h2></div>
                            <div class="card-body">
                                <div class="d-inline p-2 bg-success text-white">The total of offers: {{$area->offers()->count()}}</div>
                                    <br/><br />
                                    <form action="{{route('offers.addblog',$area)}}" method="post">
                                        @csrf   
                                        
                                        
                                                <div class="mb-3">
                                                <p class="lh-lg"><h5><b>{{$area->description}}</b><h5></p>
                                                </div>
                                            
                                            <input name = "blog_id" value= "{{ $area->id }} " type="hidden"checked></input>
                                            <button type="submit" class="btn btn-primary">Create Offer</button>       
                                    </form> 
                            </div>
                        </div>
                    </div>                  
                    <div class="col-11">
                    <div class="card"><br/>
                        <div class="p-1 mb-1 bg-light text-dark"><h2><p class="text-center">Offers</h2></div>
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
                                        @foreach($offers as $offer)
                                                <tr>          
                                                        <th scope="row">{{$offer->id}}</th>
                                                        <td>{{$offer->title}}</td>
                                                        <td>{{$offer->user->name}}</td>
                                                        <td>{{$offer->comments->count()}}</td>
                                                        <td><img src="{{asset('/storage/images/'.$offer->image)}}" width="100" alt="avatar"/></td>
                                                        <td>
                                                        <a href="{{route('offers.show',$offer)}}"><button type="button" class="btn btn-primary float-left">show</button></a>
                                                    
                                                        </td>
                                                </tr>
                                        </tbody>
                                        @endforeach 
                                                    
                                </table>
                            <a href="{{route('areas.index')}}"class="btn btn-primary">Back to Areas Page</a>                            </div>
                        </div>
                        <div class="parent">{{$offers->links()}} </div>  
                </div>                  
            </div> 
        </div>                            
    </div>

@include('sweetalert::alert')
@endsection