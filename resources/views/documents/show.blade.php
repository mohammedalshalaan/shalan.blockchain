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
                    <div class="p-3 mb-3 bg-primary text-white"><h2><p class="text-center">The Pictures of : {{$offer->title}}</h2></div>
                        <div class="card-body">
                        <a href="{{route('offers.show',$offer)}}"class="btn btn-primary">Back to the Offer Page</a>     
                         
                                <br/><br />
                                <tbody>
                                            @foreach($documents as $document)
                                                    <tr>  <br/><br />
                                                    <h2><p class="text-center">The name of the Pictute: {{$document->name}}</h2>
                                                    <img src="{{asset('/storage/images/'.$document->img_dir)}}" class="rounded mx-auto d-block" width="600" alt="img_dir"> 
                                                     
                                                    </tr>
                                </tbody>
                                            @endforeach 
                                    
                                            <br/><br />
                            <a href="{{route('offers.show',$offer)}}"class="btn btn-primary">Back to the Offer Page</a> 
                        
                    </div>
                   
                </div>
                                     
            </div> 
           
        </div>                            
    </div>

@include('sweetalert::alert')
@endsection
