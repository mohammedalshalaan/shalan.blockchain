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
<head>
   
</head>
<body>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-13">
                <div class="card">
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Confirmation</h2></div>
                    <img id="loader" src="/storage/images/Gear.gif">
                                        <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                        </div>

                                <div class="card-body">
                                
								<h2><p class="text-center text-success" id="done" >The transaction has been successfully processed by the local system and the blockchain technology</h2>
                                <div class="justified">                                                                  
                                <div><img src="{{asset('/storage/images/'.$offer->image)}}" class="img-fluid img-thumbnail" width="250"></div>
                                </div>
                                                    <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">Real ID</th>
                                                                <th scope="col">The Offer's Address</th>
                                                                <th scope="col">Owner Address</th>
                                                                <th scope="col">Price (wei)</th>
                                                                <th scope="col">Created at</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                <th>{{$offer->id}}</th>
                                                                <td>{{$offer->hash}}</td>
                                                                <td>{{$offer->owner}}</td>
                                                                <td>{{$offer->value}}</td>
                                                                <td>{{$offer->created_at}}</td>
                                                                </tr>
                                                            
                                                            </tbody>
                                                            </table>
                                                            <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">Transaction Hash</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                <td>{{$offer->tx}}</td>
                                                                </tr>
                                                            
                                                            </tbody>
                                                            </table>
															<a href="{{route('areas.show',$offer->area)}}"class="btn-lg active btn btn-primary">Back to Offers Page</a> 

                                                
                                                
                                                   

                                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

</body>
@endsection

