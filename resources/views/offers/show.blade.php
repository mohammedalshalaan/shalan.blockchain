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


<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <div class="p-3 mb-3 bg-primary text-white"><h2><p class="text-center">Offer's title : {{$offer->title}}</h2></div>
                        <div class="card-body">

                        
                        <div class="mb-4">
                            <a href="{{route('areas.show',$offer->area)}}"class="btn btn-primary">Back to Offers Page</a> 
                        </div>

                        <div class="mb-4">
                        <a href="{{route('offers.buy',$offer)}}"class="btn btn-success btn-lg active"role="button" aria-pressed="true" >Buy</a>
                        
                        </div>

                       
                        <div class="mb-4">
                            <div class="sticky"><img src="{{asset('/storage/images/'.$offer->image)}}" width="300" alt="avatar"/></div>
                            </div>
                            <div>Created at: {{$offer->created_at}}</div>
                                <br/><br/>
                            <a href="{{route('documents.show',$offer)}}"class="btn btn-primary">Show Pictures</a> 


                                    

                            <form action="{{route('comments.addpost',$offer)}}" method="post">
                            @csrf   
                                    
                                    
                                    <div class="mb-4">
                                    <p class="lh-lg"><h5><b>{{$offer->content}}</b><h5></p>
                                    </div>

                                            
                                        
                                    <input name = "offer_id" value= "{{ $offer->id }} " type="hidden"checked></input>
                                <button type="submit" class="btn btn-primary">Create Comment</button>       
                            </form> 
                        </div>
                    </div>
                                
                <div class="card">
                    <div class="p-1 mb-0 bg-light text-dark"><h3><p class="text-center">Comments</h3></div>
                                <div class="card-body">
                                <table class="table">
                                <table class="table">
                                <thead> 
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Comment:</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Actions:</th>

                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach($comments as $comment)
                                            <tr>          
                                                    <th scope="row">{{$comment->id}}</th>
                                                    <td>{{$comment->body}}</td>
                                                    <td>{{$comment->user->name}}</td>
                                                    <td>{{$comment->created_at}}</td>
                                                    <td>
                                                    <a href="{{route('comments.show',$comment)}}"><button type="button" class="btn btn-primary float-left">show</button></a>
                                                
                                                    </td>
                                            </tr>
                                    </tbody>
                                    @endforeach 
                                           
                            </table>
                            <a href="{{route('areas.show',$offer->area)}}"class="btn btn-primary">Back to Offers Page</a> 
                        </div>
                    </div>
                    <div class="parent">{{$comments->links()}} </div> 
                </div>
                                     
            </div> 
           
        </div>                            
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<script>

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
            "internalType": "uint8",
            "name": "value",
            "type": "uint8"
        }
    ],
    "name": "Real",
    "type": "event"
},
{
    "inputs": [
        {
            "internalType": "bytes32",
            "name": "addr",
            "type": "bytes32"
        },
        {
            "internalType": "uint8",
            "name": "value",
            "type": "uint8"
        }
    ],
    "name": "buy",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
},
{
    "inputs": [
        {
            "internalType": "bytes32",
            "name": "addr",
            "type": "bytes32"
        }
    ],
    "name": "getAvailable",
    "outputs": [
        {
            "internalType": "bool",
            "name": "",
            "type": "bool"
        }
    ],
    "stateMutability": "view",
    "type": "function"
},
{
    "inputs": [],
    "name": "getBlock",
    "outputs": [
        {
            "internalType": "bytes32",
            "name": "",
            "type": "bytes32"
        }
    ],
    "stateMutability": "view",
    "type": "function"
},
{
    "inputs": [
        {
            "internalType": "bytes32",
            "name": "addr",
            "type": "bytes32"
        }
    ],
    "name": "getList",
    "outputs": [
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
    "inputs": [],
    "name": "getN",
    "outputs": [
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
            "internalType": "uint256",
            "name": "",
            "type": "uint256"
        }
    ],
    "name": "newReals",
    "outputs": [
        {
            "internalType": "address",
            "name": "owner_1",
            "type": "address"
        },
        {
            "internalType": "uint8",
            "name": "value_1",
            "type": "uint8"
        },
        {
            "internalType": "bool",
            "name": "available",
            "type": "bool"
        }
    ],
    "stateMutability": "view",
    "type": "function"
},
{
    "inputs": [
        {
            "internalType": "bytes32",
            "name": "",
            "type": "bytes32"
        }
    ],
    "name": "realList",
    "outputs": [
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
            "internalType": "uint8",
            "name": "_value_1",
            "type": "uint8"
        }
    ],
    "name": "setReal",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
}
]);

var RealPrimary = RealContract.at('0x0f377d0A2F7dB8f8D8D6802873F65BFBb4A3EA96');



var hash = RealPrimary.Block({},'latest');
hash.watch(function(error, result){
        if (!error)
            {    
                $("#hash").html(result.args.CurrentBlock);
            } else {
               
                console.log(error);
            }
    });

    const ethereumButton = document.querySelector('.enableEthereumButton');
const sendEthButton = document.querySelector('.sendEthButton');

let accounts = [];

//Sending Ethereum to an address
sendEthButton.addEventListener('click', () => {
  ethereum
    .request({
      method: 'eth_sendTransaction',
      params: [
        {
          from: accounts[0],
          to: '0x0f377d0A2F7dB8f8D8D6802873F65BFBb4A3EA96',
          
          data: '0xce71c25e000000000000000000000000756b6165d3102cc959014003c907907d6f47b5f70000000000000000000000000000000000000000000000000000000000000016'
        },
      ],
    })
    .then((txHash) => console.log(txHash))
    .catch((error) => console.error);
});

ethereumButton.addEventListener('click', () => {
  getAccount();
});

async function getAccount() {
  accounts = await ethereum.request({ method: 'eth_requestAccounts' });
}



</script>

</body>
@include('sweetalert::alert')
@endsection
