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
													<h3><p class="text-center text-primary" id="pending">Please wait, the transaction is pending now, this almost takes 40 seconds.</h3>
													<h2><p class="text-center text-success" id="done" >The transaction has been successfully processed by the blockchain, please press Confirm button for confirming</h2>
													<h2><p class="text-center text-danger" id="worning_try_again" >Something was wrong, please, try again</h2>
													<h2><p class="text-center text-danger" id="worning" >You must use the blockcahin account address, which is saved in the system</h2>
												</div>

									<form action="{{route('offers.confirm',$offer)}}" method="post" enctype="multipart/form-data">
                                        	@csrf
												<input name="user_id" id="user_id" value="{{$user->id}}"type="hidden"checked >

                                        		<input name="id" id="id" value="{{$offer->id}}" type="hidden"checked>
                                                                         
                                        		<input name="owner" id="owner"  value="{{$offer->owner}}" type="hidden"checked>
	
                                        		<input name="hex_data" id="hex_data" value="{{$offer->hex_data}}" type="hidden"checked>
									
												<div class="mb-4">
												<input  name="state" id="state" type="hidden">
												<input  name="valid" id="valid" type="hidden">
												<input  name="the_new_owner" id="the_new_owner" type="hidden">
												<input  name="hash" id="hash" type="hidden">
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
	
	$("#state_title").hide();
	$("#stateShow").hide();
	$("#Backbutton").hide();
	$("#worning").hide();
	$("#pending").hide();
	$("#done").hide();
	$("#worning_try_again").hide();
	
	var web3 = new Web3(Web3.givenProvider || "https://ropsten.infura.io/v3/d43aad72782a4c6981c6abe1fb4e0790");
	//providers.HttpProvider('http://127.0.0.1:8545'));
 	
	var abi =[{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"owner","type":"address"},{"indexed":false,"internalType":"bytes16","name":"photo","type":"bytes16"},{"indexed":true,"internalType":"uint256","name":"id","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"},{"indexed":false,"internalType":"address","name":"contractAddress","type":"address"},{"indexed":false,"internalType":"uint256","name":"certificate","type":"uint256"},{"indexed":false,"internalType":"bool","name":"valid","type":"bool"},{"indexed":false,"internalType":"bool","name":"availability","type":"bool"}],"name":"Event","type":"event"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"buy","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"cancelOffer","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAnyCertificate","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAnyContractAddress","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAvailablilityForAnyContract","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getOwnerForAnyContract","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getTheHashValueForAnyContract","outputs":[{"internalType":"bytes16","name":"","type":"bytes16"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getValidForAnyContract","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"offerHash","type":"address"}],"name":"getValidForAnyContractByaddress","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getValueForAnyContract","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"newReals","outputs":[{"internalType":"contract NewReal","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"realListFromAddressToArrayId","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheAvailability","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheCertificate","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheMd5_hash_picture","outputs":[{"internalType":"bytes16","name":"","type":"bytes16"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheValidation","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheValue","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToTheWoner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToaddress","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address payable","name":"_owner_1","type":"address"},{"internalType":"uint256","name":"_value_1","type":"uint256"},{"internalType":"uint256","name":"_id","type":"uint256"},{"internalType":"bytes16","name":"_md5_hash_picture","type":"bytes16"},{"internalType":"uint256","name":"_certificate","type":"uint256"}],"name":"setReal","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"theContractOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"}];
	var Address = '0xDefc55B32b87B3B0982348e28C3279d6729Fc09b';

	
    if (typeof web3 !== 'undefined') {
		
		web3.eth.getAccounts(function(err,accounts){
		myAccountAddress = accounts[0];
		console.log(myAccountAddress);

		var myContract = new web3.eth.Contract(abi, Address, {from: myAccountAddress,});

		if (myAccountAddress == document.getElementById("owner").value){

		$("#button").click(function() {
		myDisplay();
		ethereum
		.request({
			method: 'eth_sendTransaction',
			params: [
				{
					from: myAccountAddress,
					to: '0xDefc55B32b87B3B0982348e28C3279d6729Fc09b',
					data:$("#hex_data").val(),
					},
					],
					})
					.then((txHash) => console.log(txHash))
					.catch((error) => console.error);
});   
let temp_smart_contract;
async function myDisplay() {

let myPromise = new Promise(function(myResolve, myReject) {
	
	$("#state_title").show();
	$("#stateShow").show();
  	$("#loader").show();
  	$("#pending").show();
 	$("#button").hide();
 	document.getElementById("stateShow").value = "Loading ..."
  
  setTimeout(function() { myResolve(
	
	myContract.methods.getAnyContractAddress(document.getElementById("id").value).call({ from: myAccountAddress}, function(error, res){
		if (res == "0x0000000000000000000000000000000000000000"){
			document.getElementById("stateShow").value = " The offer has not been saved by the blockchan";
		}
		else{
			document.getElementById("hash").value = res;
			temp_smart_contract = res;
		}
		
		console.log(res);
		}),
	

	myContract.methods.getAvailablilityForAnyContract(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
		if (res == true){
			
			document.getElementById("stateShow").value = "The offer "+ temp_smart_contract +" has been saved by the blockchain technology.";
			document.getElementById("state").value =res;
			document.getElementById("valid").value =res;
			$("#done").show();
			$("#Backbutton").show();
		
		} else {
		
			document.getElementById("stateShow").value = "The offer has not saved by the blockchain technology. Please refresh the page then try again. ";
			document.getElementById("state").value ='fail';
			document.getElementById("valid").value ='fail';
			$("#worning_try_again").show();
			
		}}),
		
		

			myContract.methods.getOwnerForAnyContract(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
				document.getElementById("the_new_owner").value = res;
				console.log(res);
				
				$("#loader").hide();
				$("#button").hide();
				$("#pending").hide();
	}));
	 },45000)
});
}
} else {

$("#worning").show();
$("#button").hide();

}
});
}	
</script>
</body>
@endsection
