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
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Update Images for the New Offer</h2></div>
                        <div class="card-body">
                    
                            <form action="{{route('documents.edit',$offer)}}" method="post" enctype="multipart/form-data" >
                            @csrf
                                    <div class="mb-4">    
                                        <div class="d-inline p-2 bg-success text-white">The area title : {{$area->title}}</div> 
                                    </div>

                                    <div class="mb-4">    
                                        <div class="d-inline p-2 bg-success text-white">The Offer title : {{$offer->title}}</div> 
                                    </div>
                                        
                                                
                                       
                                        <div class="mb-4">
                                        <label for="formFile" class="form-label">Upload Image</label>
                                        <input type="file" name="userfile[]" value="" multiple="">
                                        </div>

                
                                    
                                    
                                    <input name = "user_id" value= "{{ $user->id }} " type="hidden"checked></input>
                                    <input name = "area_id" value= "{{ $area->id }} " type="hidden"checked></input>
                                    
                                    
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
