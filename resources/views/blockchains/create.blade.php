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
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Send an Offer to the Blockchain network</h2></div>
                    	<img id="loader" src="/storage/images/Gear.gif">
                                        <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                        </div>

                                <div class="card-body">
								<div>
								<h2><p class="text-center">The Current Status of the Offer in the Blockchain network</h2>

								<h3><p class="text-center text-primary" id="pending">The Transaction is pending now ..</h3>
								<h2><p class="text-center text-success" id="done" >The transaction has been successfully processed by the blockchain, please press Confirm button for confirming</h2>
								<h2><p class="text-center text-danger" id="worning_try_again" >Please, referesh the page and try again</h2>

								<h2><p class="text-center text-danger" id="worning" >You must use the blockcahin account address, which is saved in the system</h2></div>

								<form action="{{route('offers.confirm',$offer)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                            
                            			<label for="id" class="col-lg-2 control-label"></label>
                                        <input name="id" id="id" value="{{$offer->id}}" type="hidden"checked>
                                        
                                        <label for="owner" class="col-lg-2 control-label"></label>
                                        <input name="owner" id="owner"  value="{{$offer->owner}}" type="hidden"checked>

                                        <label for="hex_data" class="col-lg-2 control-label"></label>
                                        <input name="hex_data" id="hex_data" value="{{$offer->hex_data}}" type="hidden"checked>
									
									

										<div class="mb-4">
										<label for="state" class="col-lg-3 control-label"> The Status of the Offer</label>
										<textarea  name="state" id="state" rows="2" cols="63" readonly></textarea>
										</div>

										
										<div class="mb-4">
										<label for="theOwner" class="col-lg-3 control-label"> The Current Owner</label>
										<textarea  name="theOwner" id="theOwner" type="text" rows="1" cols="63" readonly></textarea>
										</div>

										<div class="mb-4">
										<label for="SmartContractAddress" class="col-lg-3 control-label"> Smart Contract Address</label>
										<textarea  name="SmartContractAddress" id="SmartContractAddress" rows="1" cols="63" readonly></textarea>
										</div>
										
                                        <div class="mb-2">
										
										
										
										<button type="submit" id="Backbutton" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Confirm</button> 

										</form>
										<a href="#" id="button" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Sent the Offer to the Blockchain</a>
										
									</div>
								</div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js"></script>

    <script type="text/javascript">
$("#Backbutton").hide();
$("#worning").hide();
$("#pending").hide();
$("#done").hide();
$("#worning_try_again").hide();
var web3 = new Web3(Web3.givenProvider || "https://ropsten.infura.io/v3/d43aad72782a4c6981c6abe1fb4e0790");//providers.HttpProvider('http://127.0.0.1:8545'));

      var abi = [{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"owner","type":"address"},{"indexed":false,"internalType":"bytes16","name":"photo","type":"bytes16"},{"indexed":true,"internalType":"uint256","name":"id","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"},{"indexed":false,"internalType":"address","name":"contractAddress","type":"address"}],"name":"Event","type":"event"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"buy","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAnyContractAddress","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAvailablilityForAnyContract","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getN","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getOwnerForAnyContract","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getValueForAnyContract","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"newReals","outputs":[{"internalType":"contract NewReal","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToArray","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address payable","name":"_owner_1","type":"address"},{"internalType":"uint256","name":"_value_1","type":"uint256"},{"internalType":"uint256","name":"_id","type":"uint256"},{"internalType":"bytes16","name":"_md5_hash_picture","type":"bytes16"}],"name":"setReal","outputs":[],"stateMutability":"nonpayable","type":"function"}] ;
var Address = '0xe01F3B9B1A614874A9364f3c67F346cf991C6B4C';
console.log($("#hex_data").val());

if (typeof web3 !== 'undefined') {


web3.eth.getAccounts(function(err,accounts){
     myAccountAddress = accounts[0];
     console.log(myAccountAddress);

     var myContract = new web3.eth.Contract(abi, Address, {
from: myAccountAddress, // default from address
});

if (myAccountAddress == document.getElementById("owner").value){
$("#button").click(function() {
    myDisplay();
	ethereum
  
  .request({
	method: 'eth_sendTransaction',
	params: [
	  {
		from: myAccountAddress,
		to: '0xe01F3B9B1A614874A9364f3c67F346cf991C6B4C',
		
		data:   $("#hex_data").val(),

		//gasPrice: '0x4A817C800',
		//gas: '0x11497',
	  },
	],
  })
  
  .then((txHash) => console.log(txHash))
  
  .catch((error) => console.error);
 
//	$("#loader").show();
});   

async function myDisplay() {
	
	let myPromise = new Promise(function(myResolve, myReject) {
	  $("#loader").show();
	  $("#pending").show();
	 $("#button").hide();
	  setTimeout(function() { myResolve(

	

		myContract.methods.getAvailablilityForAnyContract(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
			if (res == true){
				document.getElementById("state").value = "The real has been saved by the blockchain technology.";
				
				$("#done").show();
				$("#Backbutton").show();
			} else {
				document.getElementById("state").value = "The offer has not saved by the blockchain technology. Please refresh the page then try again. ";
				//$("#loader").hide();
				$("#worning_try_again").show();
				//document.getElementById("SmartContractAddress").value = 0;
				//document.getElementById("theOwner").value = 0;
			}}),
			
			
			myContract.methods.getAnyContractAddress(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
			document.getElementById("SmartContractAddress").value = res;
			console.log(res)}),
		
		myContract.methods.getOwnerForAnyContract(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
			document.getElementById("theOwner").value = res;
			console.log(res);
			
          
			$("#loader").hide();
          $("#button").hide();
          $("#pending").hide();
////////


////////
		})
		
		
		); },40000)
	});
   //document.getElementById("demo").innerHTML = await myPromise;
  }
} else {
	$("#worning").show();
	$("#button").hide();
}
//console.log(myContract);
});


}
    	
</script>

</body>
@endsection

