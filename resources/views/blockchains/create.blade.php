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
            <div class="col-md-11">
                <div class="card">
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Send the offer to the Blockchain network</h2></div>
                    	<img id="loader" src="/storage/images/Gear.gif">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                        </div>
                                
								<div class="card-body">
												<div>
													<h3><p class="text-center text-primary" id="pending">Please wait, the transaction is pending now, this almost takes 120 seconds.</h3>
													<h2><p class="text-center text-success" id="done" >The transaction has been successfully processed by the blockchain, please press Confirm button for confirming</h2>
													<h2><p class="text-center text-danger" id="worning_try_again" >Something was wrong, please, try again</h2>
													<h2><p class="text-center text-danger" id="worning" >You must use the blockcahin account address, which is saved in the system</h2>
												</div>

									<form action="{{route('offers.confirm',$offer)}}" method="post" enctype="multipart/form-data">
                                        	@csrf
											

                                        		<input name="id" id="id" value="{{$offer->id}}" type="hidden"checked>
                                                                         
                                        		<input name="owner" id="owner"  value="{{$user->blockchain_address}}" type="hidden"checked>
	
                                        		<input name="hex_data" id="hex_data" value="{{$offer->hex_data}}" type="hidden"checked>
									
												<div class="mb-4">
												<input  name="state" id="state" type="hidden">
												<input  name="valid" id="valid" type="hidden">
												
												<input  name="hash" id="hash" type="hidden">
												<input  name="tx" id="tx" type="hidden">
												</div>

										<div class="mb-4">
											<div class="justified">                                                                  
											<img src="{{asset('/storage/images/'.$offer->image)}}" class="img-fluid img-thumbnail" width="250">
											</div>
										</div>
										<br>
										
										<div class="mb-4">	
											<p class="text-center" id="state_title">The Current Status of the offer in the Blockchain network:</p>
											<div class="justified">
											<textarea  name="stateShow" id="stateShow" rows="4" cols="40" style="background-color:#ECF0F1;" readonly></textarea>
										</div></div>
													<div>
														<table class="table table-striped">
																<thead>
																	<tr>
																	<th scope="col">Real ID</th>
																	<th scope="col">The Offer's title</th>
																	<th scope="col">Owner Address</th>
																	<th scope="col">Price (wei)</th>
																	<th scope="col">Created at</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																	<th>{{$offer->id}}</th>
																	<td>{{$offer->title}}</td>
																	<td>{{$offer->owner}}</td>
																	<td>{{$offer->value}}</td>
																	<td>{{$offer->created_at}}</td>
																	</tr>
																</tbody>
																</table>
													</div>
											<button type="submit" id="Backbutton" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Confirm</button>
									</form>
										<a href="#" id="button" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Sent the Offer to the Blockchain</a>	
								</div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js"></script>

    <script type="text/javascript">
	// hide some html componants.
	$("#state_title").hide();
	$("#stateShow").hide();
	$("#Backbutton").hide();
	$("#worning").hide();
	$("#pending").hide();
	$("#done").hide();
	$("#worning_try_again").hide();
	// web3 object with the infura link for ropsten network. 
	var web3 = new Web3(Web3.givenProvider || "https://ropsten.infura.io/v3/d43aad72782a4c6981c6abe1fb4e0790");  
	
 	//abi code for the smart contract.
	var abi =[{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"owner","type":"address"},{"indexed":false,"internalType":"bytes16","name":"photo","type":"bytes16"},{"indexed":true,"internalType":"uint256","name":"id","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"},{"indexed":false,"internalType":"address","name":"contractAddress","type":"address"},{"indexed":false,"internalType":"uint256","name":"certificate","type":"uint256"},{"indexed":false,"internalType":"bool","name":"valid","type":"bool"},{"indexed":false,"internalType":"bool","name":"availability","type":"bool"}],"name":"Event","type":"event"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"buy","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"cancelOffer","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAnyCertificate","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAnyContractAddress","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAvailablilityForAnyContract","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getOwnerForAnyContract","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getTheHashValueForAnyContract","outputs":[{"internalType":"bytes16","name":"","type":"bytes16"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getValidForAnyContract","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"offerHash","type":"address"}],"name":"getValidForAnyContractByaddress","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getValueForAnyContract","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"newReals","outputs":[{"internalType":"contract NewReal","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"realListFromAddressToArrayId","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheAvailability","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheCertificate","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheMd5_hash_picture","outputs":[{"internalType":"bytes16","name":"","type":"bytes16"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheValidation","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheValue","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheWoner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToaddress","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address payable","name":"_owner_1","type":"address"},{"internalType":"uint256","name":"_value_1","type":"uint256"},{"internalType":"uint256","name":"_id","type":"uint256"},{"internalType":"bytes16","name":"_md5_hash_picture","type":"bytes16"},{"internalType":"uint256","name":"_certificate","type":"uint256"}],"name":"setReal","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"theContractOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"}];
	// the address of the smart contract in the Ethereum blockchain.
	var Address = '0xDefc55B32b87B3B0982348e28C3279d6729Fc09b';
	//the transaction variable of the transaction hash that will be generated by the Ethereum blockchain.
	var Tex;
	
	// if statement if web3 is defined.
    if (typeof web3 !== 'undefined') {
		
		//get the the current blockchain account.
		web3.eth.getAccounts(function(err,accounts){
		//the first account address.
		myAccountAddress = accounts[0];
		//console.log(myAccountAddress);
		// It collects abi and the smart contract address together with the first account address in the blockcahin wallet. 
		var myContract = new web3.eth.Contract(abi, Address, {from: myAccountAddress,});
		
		//if the that is stored in the local database == the current address
		if (myAccountAddress == document.getElementById("owner").value){
			//button will be allowed.
		$("#button").click(function() {// if the button is pressed.
		//myDisplay function will be called.
		myDisplay();
		ethereum
		.request({// the MetaMask wallet will be opened.
			method: 'eth_sendTransaction',
			params: [
				{
					from: myAccountAddress, // the current Ethereum address
					to: '0xDefc55B32b87B3B0982348e28C3279d6729Fc09b',// the smart contract address
					data:$("#hex_data").val(),// the hex_data that has been stored the the local database.
					},
					],
					})
					.then((txHash) => Tex = txHash)// the transaction hash.
					.catch((error) => console.error);
});   

let temp_smart_contract;// this is for a temporary storing of the smart contract. 

async function myDisplay() {
	
let myPromise = new Promise(function(myResolve, myReject) {// this is for waiting until the transaction has been created.
	
	$("#state_title").show();
	$("#stateShow").show();
  	$("#loader").show();
  	$("#pending").show();
 	$("#button").hide();
 	document.getElementById("stateShow").value = "Loading ..."
  
  setTimeout(function() { myResolve(// the below will waite until the transaction has been generated by the Ethereum blockchain. 
	
	//getAnyContractAddress is the function that has been created in the smart contract. According to the offer_id, it returns the address of the sub smart contract that is generated by the main smart contract. In our system, the sub smart contract is considered as the offer address in the Ethereum blockcahin. 
	myContract.methods.getAnyContractAddress(document.getElementById("id").value).call({ from: myAccountAddress}, function(error, res){
		if (res == "0x0000000000000000000000000000000000000000"){// if the result == 0x0000000000000000000000000000000000000000
			document.getElementById("stateShow").value = " The offer has not been saved by the blockchan"; // According to the result that has been obtained by the getAnyContractAddress function, the stateShow input field will be filled in by " The offer has not been saved by the blockchan".
			document.getElementById("tx").value = Tex; // the tx input field will be filled in by the result that has been gotten by the MetaMask wallet.
		}
		else{
			document.getElementById("hash").value = res;// the hash input field will be filled in by the result that has been gotten by the getAnyContractAddress function.
			temp_smart_contract = res;
			document.getElementById("tx").value = Tex; // the tx input field will be filled in by the result that has been gotten by the MetaMask wallet.
		}
		
		
		}),
	
	//getAvailablilityForAnyContract is the function that has been created in the smart contract. According to the offer_id, it returns a bool value of the availability and the validation of the offer.
	myContract.methods.getAvailablilityForAnyContract(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
		if (res == true){// if the result == true
			
			document.getElementById("stateShow").value = "The offer "+ temp_smart_contract +" has been saved by the blockchain technology.";// According to the result that has been obtained by the getAvailablilityForAnyContract function, the stateShow input field will be filled in by "The offer "+ temp_smart_contract +" has been saved by the blockchain technology.".
			document.getElementById("state").value =res; // the state input field will be filled in by the result that has been gotten by the getAvailablilityForAnyContract function.
			document.getElementById("valid").value =res;// the valid input field will be filled in by the result that has been gotten by the getAvailablilityForAnyContract function.
			$("#done").show();// this informs the user that the process is done.
			$("#Backbutton").show();// the Backbutton will be shown.
			$("#loader").hide();// the in progress picture will be hidden.
				$("#button").hide();// the button will be hidden.
				$("#pending").hide();// the pending message will be hidden.
		
		} else {
		
			document.getElementById("stateShow").value = "The offer has not saved by the blockchain technology. Please refresh the page then try again. ";/// If the result is not true, then the stateShow input field will be filled in by "The offer has not saved by the blockchain technology. Please refresh the page then try again. ".
			document.getElementById("state").value ='fail';// the state input field will be filled in by fail value.
			document.getElementById("valid").value ='fail';// the state input field will be filled in by fail value.
			$("#worning_try_again").show(); //the worning message will be showen.
			$("#loader").hide();// the in progress picture will be hidden.
				$("#button").hide();// the button will be hidden.
				$("#pending").hide();// the pending message will be hidden.
			
		}}));
	 },120000)// it is the time that is needed to generate the transaction by the Ethereum blockchain. 
});
}
} else {

$("#worning").show();// the worning message will be hidden.
$("#button").hide();// the in button will be hidden.

}
});
}	
</script>

<script type="text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
</body>
@endsection
