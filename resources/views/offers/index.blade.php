@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Your Offers</h2></div>
                        <div class="card-body">
                                <table class="table">
                                    <thead> 
                                            <tr>
                                            
                                                <th scope="col">Title:</th>
                                                <th scope="col">Area ID:</th>
                                                <th scope="col">Total of Comments</th>
                                               
                                                <th scope="col">Actions:</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                            <div class="container">   
                                                @foreach($offers as $offer)
                                
                                                
                                                        <tr >          
                                                       
 
                                                            <th scope="row" @if($offer->state = true)>{{$offer->title}}</th>
                                                            <td>{{$offer->area->id}}</td>
                                                            <td>{{$offer->comments->count()}}</td>
                                                            @endif
                                                            <td>
                                                            <a href="{{route('offers.edit',$offer)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                                            <form action = "{{route('offers.destroy', $offer)}}" method="POST"class=" float-left" ></a>
                                                            @csrf
                                                                {{ method_field('DELETE')}}
                                                                <button type="submit" class="btn btn-danger">Delete</button></td></a>
                                                            </form>
                                                        </tr>
                                                @endforeach
                                            </div>
                                            
                                        </tbody>
                                            
                                </table>
                            <div>
                            
                    </div>
                </div>
                <div class="parent">{{$offers->links()}} </div>
            </div>
        </div>
    </div>
    

@include('sweetalert::alert')
@endsection

