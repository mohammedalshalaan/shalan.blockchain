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


<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-14">
                <div class="card">
                    <div class="p-3 mb-3 bg-primary text-white"><h2><p class="text-center">Offer's title : {{$offer->title}}</h2></div>
                        <div class="card-body">

                        
                        <div class="mb-4">
                            <a href="{{route('areas.show',$offer->area)}}"class="btn-lg active btn btn-primary">Back to Offers Page</a> 
                        

                    
                        <a href="{{route('offers.buy',$offer)}}"class="btn btn-success btn-lg active"role="button" aria-pressed="true" >Buy</a>
                        </div>
                        <div class="justified">                                                                  
                        <div><img src="{{asset('/storage/images/'.$offer->image)}}" class="img-fluid img-thumbnail" width="250"></div>
                        </div>
                        <br>
                        <div><p>{{$offer->content}}</p></div>
                                <div>

                                    <table class="table ">
                                                                        <thead>
                                                                            <tr>
                                                                      
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                            
                                                                            <th></th>
                                                                            <th></th>
                                                                            </tr>
                                                                        </tbody>
                                                                        </table>     
                            </div>
                            
                          

                                                                <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">Real ID</th>
                                                                <th scope="col">Contract Address</th>
                                                                <th scope="col">Owner Address</th>
                                                                <th scope="col">Price (wei)</th>
                                                                <th scope="col">Created at</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                <th>{{$offer->id}}</th>
                                                                <td>{{$offer->hash}}</td>
                                                                <td>{{$offer->owner}}</td>
                                                                <td>{{$offer->value}}</td>
                                                                <td>{{$offer->created_at}}</td>
                                                                </tr>
                                                            
                                                            </tbody>
                                                            </table>
                            <div class="mb-4">
                                    <a href="{{route('documents.show',$offer)}}"class="btn btn-primary">Show All Pictures</a> 
             
                                   
                            </div>
                                
                            
                        </div>
                    </div>
                                
                <div class="card">
                    <div class="p-1 mb-0 bg-light text-dark"><h3><p class="text-center">Comments</h3></div>
                                <div class="card-body">
                                <table class="table">
                                <table class="table">
                                <thead> 
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Comment:</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Actions:</th>

                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach($comments as $comment)
                                            <tr>          
                                                    <th scope="row">{{$comment->id}}</th>
                                                    <td>{{$comment->body}}</td>
                                                    <td>{{$comment->user->name}}</td>
                                                    <td>{{$comment->created_at}}</td>
                                                    <td>
                                                    <a href="{{route('comments.show',$comment)}}"><button type="button" class="btn btn-primary float-left">show</button></a>
                                                
                                                    </td>
                                            </tr>
                                    </tbody>
                                    @endforeach 
                                           
                            </table>
                            <div>
                            <form action="{{route('comments.addpost',$offer)}}" method="post">
                                    @csrf     
                                    
                                    <input name = "offer_id" value= "{{ $offer->id }} " type="hidden"checked></input>
                                    <button type="submit" class="btn btn-primary">Create Comment</button>   
                                    </form> 
                                    <br>
                            <a href="{{route('areas.show',$offer->area)}}"class="btn btn-primary">Back to Offers Page</a>  </div>
                        </div>
                    </div>
                    <div class="parent">{{$comments->links()}} </div> 
                </div>
                                     
            </div> 
           
        </div>                            
    </div>
</body>
@include('sweetalert::alert')
@endsection
