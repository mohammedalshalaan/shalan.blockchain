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
                                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>

                                <div class="card-body">
                                        <form action="{{route('offers.store',$area)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                                    
                                                    <div class="mb-4">
                                                    <label class="form-label">The offer title:</label>
                                                    <input type=text class="form-control"  name="title" id="title" placeholder="Offer's title"  value="{{old('title')}}"></input>
                                                    </div>

                                                    <div class="mb-4">
                                                                <label class="form-label">The Certificate ID:</label>
                                                                <input id="certificate_id" value="{{old('certificate_id')}}" class="form-control @error('certificate_id') is-invalid @enderror" name="certificate_id" required autocomplete="certificate_id" autofocus>

                                                                @error('certificate_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                           
                                                        </div>

                                                    <div class="mb-4">
                                                    <label class="form-label">Owner Name:</label>
                                                    <input class="form-control"  name="name" id="name"  value="{{$user->name}}" rows="1" size="42" readonly>
                                                    </div>

                                                    

                                                  

                                                  
                                                    <div class="mb-4">
                                                    <div class="input-group">
                                                   
                                                    <input size="50" type="text"  aria-label="Dollar amount (with dot and two decimal places)"name="value" id="value" placeholder="The value of the offer"  value="{{old('value')}}" >
                                                    <span class="input-group-text">Wei (1 ETH = 1e18 wei)</span>
                                                    </div>
                                                    </div>

                                                    <div class="mb-4">
                                                    <label class="form-label"> The Description:</label>
                                                    <textarea class="form-control"  name="content" id="content" placeholder="The offer's description" rows="5" >{{old('content')}}</textarea>
                                                    </div>
                                                    
                                                   

                                                <div class="mb-4">

                                                    <label for="formFile" class="form-label">Upload Image</label>
                                                    <input class="form-control" id="image" type="file" name="image">
                                                    <br>
                                                    <p><strong>Note:</strong> The image will be hashed and included by the transaction that will be send to the Ethereum blockchain.</p>
    
                                                </div>
   
                                                   
                                                    <input name = "area_id" value= "{{ $area->id }} " type="hidden"checked></input>

                                                    <a href="{{route('areas.show',$area)}}"class="float-left">
                                                    <button type="button" class="btn btn-secondary" style="margin-left:0px;">Cancel</button>
                                                    <button type="submit" class="btn btn-primary"style="margin-right:0px;">Next</button> 
                                                    </form>
                                </div>   
                        
                    </div>  
                </div>      
            </div>
        </div>                           
</div>
    

@include('sweetalert::alert')
@endsection
