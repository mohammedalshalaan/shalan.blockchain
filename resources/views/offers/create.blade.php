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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    

    <script src="/js/web3.min.js"></script>


  
</head>
<body>
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
                                                                <input id="certificate_id" class="form-control @error('certificate_id') is-invalid @enderror" name="certificate_id" required autocomplete="certificate_id" autofocus>

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
                                                    <label class="form-label">Owner Address:</label>
                                                    <input class="form-control"  name="owner" id="owner"  value="{{$user->blockchain_address}}" rows="1" size="42" readonly>
                                                    </div>

                                                  

                                                  
                                                    <div class="mb-4">
                                                    <div class="input-group">
                                                   
                                                    <input size="20" type="text"  aria-label="Dollar amount (with dot and two decimal places)"name="value" id="value" placeholder="The value of the offer"  value="{{old('value')}}" >
                                                    <span class="input-group-text">Wei (1 ETH = 1e18 wei)</span>
                                                    </div>
                                                    </div>

                                                    <div class="mb-4">
                                                    <label class="form-label">Certificate ID:</label>
                                                    <textarea class="form-control"  name="content" id="content" placeholder="The offer's description" rows="5" >{{old('content')}}</textarea>
                                                    </div>
                                                    
                                                   

                                                    <div class="mb-4">
                                                    <label for="formFile" class="form-label">Upload Image</label>
                                                    <input class="form-control" id="image" type="file" name="image">
                                                    </div>
   
                                                    <input name = "user_id" value= "{{ $user->id }} " type="hidden"checked></input>
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
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <script>
    validate()
        //const Web3 = require('web3');
        //let web3 = new Web3();

       // if (typeof web3 !== 'undefined') {
          //  web3 = new Web3(web3.currentProvider);
     //   } else {
            // set the provider you want from Web3.providers

           

            //web3.setProvider(new Web3.providers.HttpProvider('http://localhost:8545'));
            web3 = new Web3(new Web3.providers.HttpProvider('http://127.0.0.1:8545'));
      //  }

      web3.eth.defaultAccount = web3.eth.accounts[0];

var RealContract = web3.eth.contract([
    {
        "anonymous": false,
        "inputs": [
            {
                "indexed": false,
                "internalType": "bytes32",
                "name": "CurrentBlock",
                "type": "bytes32"
            }
        ],
        "name": "Block",
        "type": "event"
    },
    {
        "anonymous": false,
        "inputs": [
            {
                "indexed": false,
                "internalType": "address",
                "name": "owner",
                "type": "address"
            },
            {
                "indexed": false,
                "internalType": "uint256",
                "name": "value",
                "type": "uint256"
            }
        ],
        "name": "Real",
        "type": "event"
    },
    {
        "inputs": [],
        "name": "getInstructor",
        "outputs": [
            {
                "internalType": "address",
                "name": "",
                "type": "address"
            },
            {
                "internalType": "uint256",
                "name": "",
                "type": "uint256"
            }
        ],
        "stateMutability": "view",
        "type": "function"
    },
    {
        "inputs": [
            {
                "internalType": "address",
                "name": "_owner_1",
                "type": "address"
            },
            {
                "internalType": "uint256",
                "name": "_value_1",
                "type": "uint256"
            }
        ],
        "name": "setReal",
        "outputs": [],
        "stateMutability": "nonpayable",
        "type": "function"
    }
]);

var RealPrimary = RealContract.at('0xe6ba6b9C2aC31420C76F52D1f074EE269cb26779');

var realEvent = RealPrimary.Real();
realEvent.watch(function(error, result){
            if (!error)
                {
                    $("#loader").hide();
                    $("#real").html(result.args.owner + ' (' + result.args.value + ' Coins)');
                } else {
                    $("#loader").hide();
                    console.log(error);
                }
        });

var hash = RealPrimary.Block({},'latest');
hash.watch(function(error, result){
            if (!error)
                {    
                    $("#loader").hide();
                    $("#hash").html(result.args.CurrentBlock);
                } else {
                    $("#loader").hide();
                    console.log(error);
                }
        });

$("#button2").click(function() {
    $("#loader").show();
    RealPrimary.setReal($("#owner").val(), $("#value").val());
    //RealPrimary.lastBlock(0).val();
});

</script>

                
</body>

@include('sweetalert::alert')
@endsection
