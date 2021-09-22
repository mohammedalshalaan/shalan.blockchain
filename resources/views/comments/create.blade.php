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
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Creare New Comment</h2></div>
                        <div class="card-body">
                    
                            <form action="{{route('comments.store')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                                        
                                        <div class="d-inline p-2 bg-success text-white">The offer title : {{$offer->title}}</div><br/><br/>
                                       
                                                
                                        <div class="mb-4">
                                        <label class="form-label">Comment</label>
                                        <textarea class="form-control"  name="content" id="content" placeholder="Comment"  value="{{old('content')}}" rows="3" ></textarea>
                                        </div><br/><br/>
                                    
                                    <input name = "offer_id" value= "{{ $offer->id }} " type="hidden"checked></input>
                                   
                                    
                                    
                                    <a href="{{route('offers.show',$offer)}}"class="float-left">
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
