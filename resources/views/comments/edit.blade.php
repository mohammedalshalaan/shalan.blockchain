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
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Edit Your Comment</h2></div>
                        <div class="card-body">
                    
                            <form action="{{route('comments.update',$comment)}}" method="post" enctype="multipart/form-data" >
                            @csrf
                                    
                                        
                                        <div class="mb-4">
                                        <label class="form-label">The Comment</label>
                                        <textarea class="form-control"  name="body" placeholder="Comment" rows=3 >{{$comment->body}}</textarea>
                                        </div><br/><br/>
                                
                                    
                                    <a href="{{route('comments.index')}}"class="float-left">
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
