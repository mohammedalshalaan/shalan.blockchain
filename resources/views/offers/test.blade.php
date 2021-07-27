@extends('layouts.app')


@section('content')

<head>
   
    <title>Document</title>

   

</head>
<body>
    <div class="container">

        <h1>Coursetro Instructor</h1>

        <h2 id="instructor"></h2>

        <img id="loader" src="http://blockchain_final.test/storage/images/Gear.gif">

		
		<label for="name" class="col-lg-2 control-label">First Name</label>
        <input id="name" type="text">

        <label for="age" class="col-lg-2 control-label">Instructor Age</label>
        <input id="age" type="text">

        <button id="button">Update Instructor</button>

    </div>

   
	
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	
	<script>
       if (typeof web3 !== 'undefined') {
            web3 = new Web3(web3.currentProvider);
        } else {
            // set the provider you want from Web3.providers
            web3 = new Web3(new Web3.providers.HttpProvider("HTTP://127.0.0.1:7545"));
        }
        web3.eth.defaultAccount = web3.eth.accounts[0];

        var CoursetroContract = web3.eth.contract([
	{
		"constant": false,
		"inputs": [
			{
				"name": "_fName",
				"type": "string"
			},
			{
				"name": "_age",
				"type": "uint256"
			}
		],
		"name": "setInstructor",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "name",
				"type": "string"
			},
			{
				"indexed": false,
				"name": "age",
				"type": "uint256"
			}
		],
		"name": "Instructor",
		"type": "event"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getInstructor",
		"outputs": [
			{
				"name": "",
				"type": "string"
			},
			{
				"name": "",
				"type": "uint256"
			},
			{
				"name": "",
				"type": "address"
			},
			{
				"name": "",
				"type": "address"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	}
]);

var Coursetro = CoursetroContract.at('0x5F00C24374FEC4518fCb9fac4f968f11bb5bff3f');

var instructorEvent = Coursetro.Instructor();

instructorEvent.watch(function(error, result){
            if (!error)
                {
                    $("#loader").hide();
                    $("#instructor").html(result.args.name + ' (' + result.args.age + ' years old)');
                } else {
                    $("#loader").hide();
                    console.log(error);
                }
        });


       $("#button").click(function() {
           Coursetro.setInstructor($("#name").val(), $("#age").val());
		   $("#loader").show();
       });

    </script>

    
</body>

@endsection
