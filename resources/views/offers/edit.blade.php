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
            <div class="col-md-11">
                <div class="card">
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Edit Your Offer</h2></div>
                        <div class="card-body">
                    
                            <form action="{{route('offers.update',$offer)}}" method="post" enctype="multipart/form-data" >
                            @csrf
                                    
                                        <div class="mb-4">
                                        <label class="form-label">The offer title</label>
                                        <textarea class="form-control"  name="title" placeholder="Offer's title" rows=1 >{{$offer->title}} </textarea>
                                        </div>
                                                
                                        <div class="mb-4">
                                        <label class="form-label">Content</label>
                                        <textarea class="form-control"  name="content" placeholder="Offer's content" rows=3 >{{$offer->content}}</textarea>
                                        </div><br/><br/>

                                       
                                      
                                        <div class="mb-4">
                                        <label for="formFile" class="form-label">Upload Image</label>
                                        <input class="form-control" type="file" name="image">
                                        </div>
                                
                                    
                                    <a href="{{route('offers.index')}}"class="float-left">
                                    <button type="button" class="btn btn-secondary" style="margin-left:0px;">Cancel</button>
                                    <button type="submit" class="btn btn-primary"style="margin-right:0px;">Submit</button> 
                                
                                        
                            </form>
                            
                        </div> 
                    </div>  
                </div>      
            </div>
        </div>                           
    </div>
@include('sweetalert::alert')
@endsection
