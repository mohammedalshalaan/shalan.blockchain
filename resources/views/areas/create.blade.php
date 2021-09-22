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
                                        <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Create a New Area</h2></div>
                                    <div class="card-body">
                                                <form action="{{route('areas.store')}}" method="Post" enctype="multipart/form-data" >

                                                @csrf       
                                                    <br />
                                                    <br />
                                                        <div class="mb-3">
                                                        <label class="form-label">The Area's name</label>
                                                        <input type="text" name="name" placeholder="The name" class="form-control" value="{{old('name')}}" >
                                                        </div>
                                                                
                                                        <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" placeholder="Area's description" class="form-control"  rows="3"value="{{old('description')}}"></textarea>
                                                        </div>
                                                    <br/>
                                                    <br/> 
                                                    <a href="{{route('areas.index')}}"class="float-left">
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
