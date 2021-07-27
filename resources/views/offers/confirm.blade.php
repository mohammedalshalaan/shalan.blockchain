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
            <div class="col-md-11">
                <div class="card">
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Confirmation</h2></div>
                    <img id="loader" src="/storage/images/Gear.gif">
                                        <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                        </div>

                                <div class="card-body">
                                

								
                            <label for="id" class="col-lg-2 control-label">Offer_ID</label>
                                        <input name="id" id="id" type="text" value="{{$offer->id}}">
                                        
										<label for="event"></lable>

                                        <label for="hex_id" class="col-lg-2 control-label">Owner Address</label>
                                        <input name="hex_id" id="hex_id" type="text" value="{{$offer->hex_id}}">

                                        <label for="hex_data" class="col-lg-2 control-label">Esate hex_data</label>
                                        <input name="hex_data" type="text" id="hex_data" value="{{$offer->hex_data}}">

										<label for="value" class="col-lg-2 control-label">Owner Address</label>
                                        <input name="value" id="value" type="text" value="{{$offer->value}}">

										<label for="event" class="col-lg-2 control-label"> event</label>
                                        <input name="event" id="event" type="text">


                                        <button id="button">confirm</button>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js"></script>

    <script type="text/javascript">
var myContract;
$(document).ready(function () {
var web3 = new Web3(new Web3.providers.HttpProvider('http://127.0.0.1:8545'));

      var abi = [
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_id",
				"type": "uint256"
			}
		],
		"name": "buy",
		"outputs": [],
		"stateMutability": "payable",
		"type": "function"
	},
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "bool",
				"name": "State",
				"type": "bool"
			},
			{
				"indexed": true,
				"internalType": "uint256",
				"name": "id",
				"type": "uint256"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "text1",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "text2",
				"type": "string"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "theOwner",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "SmartContractAddress",
				"type": "address"
			}
		],
		"name": "Event",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "address payable",
				"name": "_owner_1",
				"type": "address"
			},
			{
				"internalType": "uint72",
				"name": "_value_1",
				"type": "uint72"
			},
			{
				"internalType": "uint256",
				"name": "_id",
				"type": "uint256"
			},
			{
				"internalType": "bytes16",
				"name": "_md5_hash_picture",
				"type": "bytes16"
			}
		],
		"name": "setReal",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_id",
				"type": "uint256"
			}
		],
		"name": "getAnyContractAddress",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_id",
				"type": "uint256"
			}
		],
		"name": "getAvailablilityForAnyContract",
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
				"name": "_id",
				"type": "uint256"
			}
		],
		"name": "getOwnerForAnyContract",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_id",
				"type": "uint256"
			}
		],
		"name": "getValueForAnyContract",
		"outputs": [
			{
				"internalType": "uint72",
				"name": "",
				"type": "uint72"
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
				"internalType": "contract NewReal",
				"name": "",
				"type": "address"
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
		"name": "realListFromIdToArray",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
];


var Address = '0x9F66a22A992752ba2918d6e56b98439757A177A7';


if (typeof web3 !== 'undefined') {

let number1 = $("#value").val();
number1=parseInt(number1);
const hexValue = number1.toString(16);

const number2 = $("#hex_id").val();


web3.eth.getAccounts(function(err,accounts){
     myAccountAddress = accounts[0];
     console.log(myAccountAddress);

    myContract = new web3.eth.Contract(abi, Address, {
from: myAccountAddress, // default from address
});

//event
myContract.getPastEvents('Event', {
    filter: {id :document.getElementById("id").value}, // Using an array means OR: e.g. 20 or 23
    //fromBlock: 0,
    toBlock: 'latest',
}, function(error, events){ 
	if (!error){
		//$("#loader").show();
		document.getElementById("event").value = events[0].returnValues.State;
	}
	else{
		//$("#loader").show();
		 console.log(error);
	}
	
	
	 });
	

/*
myContract.events.Event({
    //filter: {myIndexedParam: [20,23], myOtherIndexedParam: '0x123456789...'}, // Using an array means OR: e.g. 20 or 23
    fromBlock: 0,
	//toBlock: 'latest'
}, function(error, event){ console.log(event); })
.on("connected", function(subscriptionId){
    console.log(event); // same results as the optional callback above
});
*/



//myContract.events.Event({}).on('', event => console.log(event));
/*
const ev =  myContract.getPastEvents(
	'Event',
	//{fromBlock:0, toBlock:1}
);
$("#event").html(ev[0].State);
console.log(ev);
	/*
	{}, {fromBlock:1, toBlock: 'latest'});
ev.watch(function(error, result){
            if (!error)
                {
                    //$("#loader").hide();
					console.log(result.blockNumber);
					//console.log(result.args.State);
                    //$("#event").html(result.args.State);
                } else {
                    //$("#loader").hide();
                    console.log(error);
                }
        });
*/

$("#button").click(function(){ 
	//$("#loader").show();
	
	ethereum
  
  .request({
	method: 'eth_sendTransaction',
	params: [
	  {
		from: accounts[0],
		to: '0x9F66a22A992752ba2918d6e56b98439757A177A7',
		value: hexValue,
		data:  '0xd96a094a' + number2,
	  },
	],
  })
  
  .then((txHash) => console.log(txHash))
  
  .catch((error) => console.error);
  
  myContract.getPastEvents('Event', {
    filter: {id :document.getElementById("id").value}, // Using an array means OR: e.g. 20 or 23
    //fromBlock: 0,
    toBlock: 'latest',
}, function(error, events){ 
	if (!error){
		//$("#loader").show();
		document.getElementById("event").value = events[0].returnValues.State;
	}
	else{
		//$("#loader").show();
		 console.log(error);
	}
	
	
	 });
	

	
});   

//console.log(myContract);
});


}
})  	
</script>

</body>
@endsection

