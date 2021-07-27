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
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Creare New Offer</h2></div>
                    
                                        <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                        </div>

                                <div class="card-body">
                    
                                    <form action="{{route('documents.store',$offer)}}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                           
                                                    
                                                <div class="mb-4">
                                                <label for="formFile" class="form-label">Upload Image</label>
                                                <input type="file" name="userfile[]" value="" multiple="">
                                                </div>

                                            <input name = "user_id" value= "{{ $user->id }} " type="hidden"checked></input>
                                            <input name = "area_id" value= "{{ $area->id }} " type="hidden"checked></input>
                                            
                                            <a href="{{route('areas.show',$area)}}"class="float-left">
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
