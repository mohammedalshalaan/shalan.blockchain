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
                                        <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Link the Property to the blockchain address</h2></div>
                                    <div class="card-body">
                                                <form action="{{route('properties.store')}}" method="Post" enctype="multipart/form-data" >

                                                @csrf       
                                                    <br />
                                                    <br />
                                                        <div class="mb-3">
                                                        <label class="form-label">The owner bockchain Address:</label>
                                                        <input type="text" name="owner" placeholder="The owner address" class="form-control" value="{{old('owner')}}" >
                                                        </div>
                                                                
                                                        <div class="mb-3">
                                                        <label class="form-label">The Property Ciertificate Id:</label>
                                                        <textarea name="certificate_id" placeholder="The Ciertificate Id" class="form-control"  rows="1"value="{{old('certificate_id')}}"></textarea>
                                                        </div>
                                                    <br/>
                                                    <br/> 
                                                    <a href="{{route('properties.index')}}"class="float-left">
                                                            <button type="button" class="btn btn-secondary" style="margin-left:0px;">Cancel</button> 
                                                    <input name = "user_id" value= "{{ $user->id }} " type="hidden"checked></input>
                                                    <button type="submit" class="btn btn-primary"style="margin-left:0px;">Submit</button>       
                                            </form>
                                    </div>  

                            </div>      
                        </div>
                </div>                           
        </div>
@include('sweetalert::alert')
@endsection
