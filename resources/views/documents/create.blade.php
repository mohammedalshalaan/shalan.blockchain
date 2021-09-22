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
                                                <h4>Upload More Images for The Property</h4>
                                                <br>
                                                <p><strong>Note:</strong> The image that has been uploaded within the property information in the previuos page will be hashed and included by the transaction that will be send to the Ethereum blockchain. However, these images will be saved by the local database.</p>
                                                <div class="mb-4">
                                                <input type="file" name="userfile[]" value="" multiple="">
                                                </div>

                                            
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
