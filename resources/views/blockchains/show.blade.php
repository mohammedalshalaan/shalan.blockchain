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
                                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                        </div>
                                        
                                        <dl class="row">
                                      
  <dt class="col-sm-3">The Offer Title</dt>
  <dd class="col-sm-9">{{$offer->title}}.</dd>

  <dt class="col-sm-3">The Offer Hash Address</dt>
  <dd class="col-sm-9">
   
    <p>{{$block->hash}}</p>
  </dd>
  <dt class="col-sm-3">Offer Content</dt>
  <dd class="col-sm-9">{{$offer->content}}.</dd>

  
</dl>

                                            <input name = "user_id" value= "{{ $user->id }} " type="hidden"checked></input>
                                            <input name = "area_id" value= "{{ $area->id }} " type="hidden"checked></input>
                                            
                                            <a href="{{route('areas.show',$area)}}"class="float-left">
                                            <button type="button" class="btn btn-secondary" style="margin-left:0px;">Finish</button>
                                           
                                   
                            </div>     
                        
                    </div>  
                </div>      
            </div>
        </div>                           
    </div>
@include('sweetalert::alert')
@endsection
