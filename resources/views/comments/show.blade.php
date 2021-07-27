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
                    <div class="p-3 mb-3 bg-primary text-white"><h2><p class="text-center"> The Comment from: {{$comment->user->name}}</h2></div>
                        <div class="card-body">     
                            <div class="mb-3">
                            <p class="lh-lg"><h5><b>{{$comment->body}}</b><h5></p>
                            </div>
                        
                            <a href="{{route('offers.show',$comment->offer)}}"class="btn btn-primary" style="margin-left:0px;">Back to Offer Page</a>
                            
                           
                           
                           
                        </div>
                    </div>                  
                </div>                   
            </div>  
        </div>                            
    </div>

@include('sweetalert::alert')
@endsection
