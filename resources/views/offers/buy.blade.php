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
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Buy the Offer</h2></div>
                    	<img id="loader" src="/storage/images/Gear.gif">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                        </div>

                                
								<form action="{{route('offers.confirm',$offer)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                                    <div>
                                                            <h3><p class="text-center text-primary" id="pending">The Transaction is pending now ..</h3>
                                                            <h2><p class="text-center text-success" id="done" >The transaction has been successfully processed by the blockchain network, please press Confirm.</h2>
                                                            <h2><p class="text-center text-danger" id="worning" >You must use the blockcahin account address, which is saved in the system.</h2>
                                                            <h2><p class="text-center text-danger" id="worning_try_again" >Something was wrong, please, referesh the page then try again.</h2>
                                                    </div>

                                                
                                                    <div class="mb-4">
                                                    <div class="justified">                                                                  
                                                            <div><img src="{{asset('/storage/images/'.$offer->image)}}" class="img-fluid img-thumbnail" width="250"></div>
                                                            </div>
                                                            <br>
                                                    <h2><p class="text-center" id="state_title">The Current Status of the Offer in the Blockchain network</h2>
                                                    <div class="justified">
                                                                                                                                   

                                                            <textarea  name="state" id="state" rows="4" cols="40" style="background-color:#ECF0F1;" readonly></textarea>
                                                            </div></div>

                                                           
                                                                
                                                        
                                                
                                                            <label for="id" class="col-lg-2 control-label"></label>
                                                            <input name="id" id="id" value="{{$offer->id}}" type="hidden"checked>

                                                            <label for="hex_id" class="col-lg-2 control-label"></label>
                                                            <input name="hex_id" id="hex_id" value="{{$offer->hex_id}}" type="hidden"checked>
                                                            
                                                            <label for="value" class="col-lg-2 control-label"></label>
                                                            <input name="value" id="value"  value="{{$offer->value}}" type="hidden"checked>

                                                            <label for="hex_data" class="col-lg-2 control-label"></label>
                                                            <input name="hex_data" id="hex_data" value="{{$offer->hex_data}}" type="hidden"checked>
                                                        
                                                            <label for="owner" class="col-lg-2 control-label"></label>
                                                            <input name="owner" id="owner"  value="{{$user->blockchain_address}}" type="hidden"checked>


                                                                    <div>
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
                                                                    </div>



                                                            
                                                            
                                                            

                                                            <div class="mb-4">
                                                            <input  name="theOwner" id="theOwner" type="hidden" rows="1" cols="63" readonly>
                                                            </div>

                                                            <div class="mb-4">
                                                            <input  name="SmartContractAddress" type="hidden" id="SmartContractAddress" rows="1" cols="63" readonly>
                                                            </div>
                                                            
                                                            <div class="mb-2">
                                                            <button type="submit" id="Backbutton" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Confirm</button> 

                                     </form>
                                                            <a href="#" id="button" class="btn btn-success btn-lg " tabindex="-1" role="button" aria-disabled="true">Buy the Offer</a>
                                                            <a href="{{route('areas.show',$offer->area)}}" id="offers_page" class="btn btn-primary">Back to Offers Page</a> 
                                                            
							
								
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js"></script>

    <script type="text/javascript">
    
    $("#state").hide();
    $("#state_title").hide();
$("#Backbutton").hide();
$("#pending").hide();
$("#done").hide();
$("#worning").hide();
$("#worning_try_again").hide();
$("#offers_page").hide();
var web3 = new Web3(Web3.givenProvider || "https://ropsten.infura.io/v3/d43aad72782a4c6981c6abe1fb4e0790");//providers.HttpProvider('http://127.0.0.1:8545'));
//var web3 = new Web3(new Web3.providers.HttpProvider('http://127.0.0.1:8545'));

      var abi = [{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"owner","type":"address"},{"indexed":false,"internalType":"bytes16","name":"photo","type":"bytes16"},{"indexed":true,"internalType":"uint256","name":"id","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"},{"indexed":false,"internalType":"address","name":"contractAddress","type":"address"}],"name":"Event","type":"event"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"buy","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAnyContractAddress","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getAvailablilityForAnyContract","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getN","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getOwnerForAnyContract","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"_id","type":"uint256"}],"name":"getValueForAnyContract","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"newReals","outputs":[{"internalType":"contract NewReal","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"realListFromIdToArray","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address payable","name":"_owner_1","type":"address"},{"internalType":"uint256","name":"_value_1","type":"uint256"},{"internalType":"uint256","name":"_id","type":"uint256"},{"internalType":"bytes16","name":"_md5_hash_picture","type":"bytes16"}],"name":"setReal","outputs":[],"stateMutability":"nonpayable","type":"function"}] ;
var Address = '0xe01F3B9B1A614874A9364f3c67F346cf991C6B4C';


if (typeof web3 !== 'undefined') {


	let number1 = $("#value").val();
number1=parseInt(number1);
const hexValue = number1.toString(16);

const number2 = $("#hex_id").val();


web3.eth.getAccounts(function(err,accounts){
     myAccountAddress = accounts[0];
     console.log(myAccountAddress);

    var myContract = new web3.eth.Contract(abi, Address, {
from: myAccountAddress, // default from address
});
//console.log("myAccountAddress " + myAccountAddress);
//console.log("owner " + document.getElementById("owner").value);


if (myAccountAddress == document.getElementById("owner").value){
$("#button").click(function(){ 

    
    ethereum
  
  .request({
    method: 'eth_sendTransaction',
    params: [
      {
        from: myAccountAddress,
        to: '0xe01F3B9B1A614874A9364f3c67F346cf991C6B4C',
        value: hexValue,
        data:  '0xd96a094a' + number2,
      },
    ],
  })
  
  .then((txHash) => console.log(txHash))
 
  .catch((error) => console.error);
  myDisplay();
  
  //$("#loader").hide();
    
});   
//$("#loader").show();

async function myDisplay() {
	var tempOwner;
	let myPromise = new Promise(function(myResolve, myReject) {
	  $("#loader").show();
      $("#state_title").show();
      $("#state").show();
	  $("#pending").show();
	 $("#button").hide();
     document.getElementById("state").value = "Loading ..."
	  setTimeout(function() { myResolve(

        myContract.methods.getOwnerForAnyContract(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
			document.getElementById("theOwner").value = res;
            tempOwner = res;
			console.log(res)}),

        myContract.methods.getAnyContractAddress(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
			document.getElementById("SmartContractAddress").value = res;
			console.log(res)}),


		myContract.methods.getAvailablilityForAnyContract(document.getElementById("id").value).call({ from: myAccountAddress}, function( error, res){
			if (res == false && tempOwner == myAccountAddress){
				document.getElementById("state").value = "The offer has been sold by the address "+ myAccountAddress +", and the offer has been updated by the blockchain technology.";
				
				$("#done").show();
				$("#Backbutton").show();
			} else if (res == false && tempOwner != myAccountAddress){
                document.getElementById("state").value = "The offer has been sold by the address "+ tempOwner +", and the offer has been updated by the blockchain technology.";
                $("#Backbutton").show();

            } else {
				document.getElementById("state").value = "The offer has not sold and not updated by in the system. Please refresh the page then try again. Or check the balnce of your blockchain account.";
				//$("#loader").hide();
				$("#worning_try_again").show();
                $("#offers_page").show();
				//document.getElementById("SmartContractAddress").value = 0;
				//document.getElementById("theOwner").value = 0;
			};
            $("#loader").hide();
          $("#button").hide();
          $("#pending").hide();

        })
			
		
		); }, 40000)
	});
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

