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
                                                <th scope="col">ID:</th>
                                                <th scope="col">Title:</th>
                                                <th scope="col">Certificate ID:</th>
                                                <th scope="col">Valid:</th>
                                                <th scope="col">Availability:</th>
                                                <th scope="col">Total of Comments</th>
                                                <th scope="col">Value</th>
                                               

                                               
                                                <th scope="col">Actions:</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                            <div class="container">   
                                                @foreach($offers as $offer)
                                
                                                
                                                        <tr >          
                                                       
 
                                                        <td>{{$offer->id}}</td>
                                                            <td>{{$offer->title}}</td>
                                                            <td>{{$offer->certificate_id}}</td>
                                                            <td>{{$offer->valid}}</td>
                                                            <td>{{$offer->state}}</td>
                                                            <td>{{$offer->comments->count()}}</td>
                                                            <td>{{$offer->value}}</td>
                                                            
                                                            
                                                            <td>
                                                        <div>
                                                            <a href="{{route('offers.showMyOffer',$offer)}}"><button type="button" class="btn btn-primary float-left">Show</button></a>
                                                        
                                                            <form action = "{{route('offers.cancel', $offer)}}" class=" float-left" ></a>
                                                            
                                                       

                                                       
                                                                {{ method_field('DELETE')}}
                                                        
                                                                <button type="submit" class="btn btn-danger">Cancel</button></td></a>
                                                            </div>
                                                            </form>
                                                        </tr>
                                                @endforeach
                                            </div>
                                            
                                        </tbody>
                                            
                                </table>
                            <div>
                        <div class="parent">{{$offers->links()}}</div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    

@include('sweetalert::alert')
@endsection

