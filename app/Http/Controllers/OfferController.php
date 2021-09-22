<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;// The controllers bath.
use Illuminate\Http\Request;// For validation and other requests.
use RealRashid\SweetAlert\Facades\Alert;// Alert feature.
//The System Models
use App\Offer; 
use App\Area;
use App\Document;
use App\Property;
use App\Comment;
use App\User;
use App\Mail\RSBlockchain; // The email that has been set up for our system.
use Illuminate\Support\Facades\Mail; 
use Auth;// For authorize user


class OfferController extends Controller
{
    public function index()// This function returns the whole offers according to the creation date, then paginates the result, so each page will contain 5 offers. 
    {
        $offers = Auth::user()->offers()->latest()->paginate(5);
        
        return view('offers.index', ['offers' => $offers]);
        
    }
   

    public function show(Offer $offer)// This function returns the whole comments that contain the desired offer_id according to the creation date, then paginates the result, so each page will contain 5 comments.
    {
        $comments = $offer->comments()->latest()->paginate(5);
       
        return view('offers.show', ['offer'=>$offer,'comments'=>$comments]);
    }


    public function addarea(area $area)// This function redirects the user from the Area model to the Offer model, so the user creates a new offer withtin this area. 
    {
       
        $user = Auth::user();
        return redirect()->route('offers.create',['area'=> $area,'user'=>$user]);

    }


    public function create(area $area)// This function returns the view page with the area and the Auth user abjects for creation of a new offer.
    {
        $user = Auth::user();
        return view('offers.create',['area'=> $area,'user'=>$user]);
    }

    public function store (Area $area ,Request $request)// This function stores the main variables of the propery before the system sends the transaction to the Ethereum blockchain. In addition, it returns the Auth user, offer and area objects. 
    {
        $user = Auth::user();// Only the authorized user performs this function.
        $validatedData = $request->validate([// Laravel provides the validate method to check the restrictions, which have been set on the values that have been sent by the input fields.
            'title' =>'required|string|max:100',// this field is required, and it must be <= 100 characters.
            'content' =>'required|string|max:1000',// this field is required, and it must be <= 1000 characters.
            'area_id' =>'required | integer',// this field is required.
            'value' =>'required | integer',// this field is required.
            'certificate_id' => 'required| integer | exists:App\Property,certificate_id', //certificate_id must be existed in the property tabel that has been filled in by admin.
            'image' => 'required|mimes:jpg,jpeg,png'// this field is required, and the extension of the image must be jpg,jpeg,bmp or png.
        ]); 
        
        $properties = Property::all();// Call all the properties that have been stored by the admin in the properties table.
        $ownerValidate = $user->blockchain_address;// It takes the value that has been sent by the owner input field.
        $certificateValidate = $validatedData['certificate_id'];//It takes the value that has been sent by the certificate_id input field.
        
        foreach ($properties as $property){ // this loop is for matching the certificate_id with the certificate_id and the blockchain address that have been stored in the property table.
           if ($certificateValidate == $property->certificate_id){
               if ($property->owner != $ownerValidate){
                $validatedData = $request->validate([
                    'certificate_id' => 'in',
                    ]);
               }
           }
        }
    
        //owner// embed 0x8c726dc3000000000000000000000000, which is the code of the setReal function in the smart contract, into the owner input field.
        $string = "0x8c726dc3000000000000000000000000"; //= 34 characters
        $string2 = $user->blockchain_address;; // 40 characters
        $string2 = preg_replace('/0x/','', $string2); // this is for remove the first two characters which are 0x.
        $string .= $string2; // 74 characters
        ///////
       
        //value// encode the value input field.
        $octValue = $validatedData['value']; // It takes the value of the value input field.
        $octValue2 = base_convert($octValue,10,16); // It transfers the value to Hex value.
        $hexNumber = strlen($octValue2);// It calculates the length of the value.
        $totalZeros = 64 - $hexNumber; // It deducts the length of the value, which has been converted to Hex, from 64 characters
        $embededdValue = "";

        for ($x = 0; $x < $totalZeros; $x++){

            $embededdValue .= "0";// embed zeros.
            
        }
        $embededdValue .= $octValue2; //32 bytes for the value or the property price. The zeros are embedded into the actual value length.

        $offer = new Offer; // a new offer object from the Offer class or model.
        $offer->title = $validatedData['title'];// save the title that has been sent by the title input field.
        $offer->area_id = $validatedData['area_id'];// save the area_id that has been sent by the area_id input field.
        $offer->content = $validatedData['content'];// save the content that has been sent by the content input field.
        $offer->user_id = $user->id;// save the user_id that has been sent by the user_id input field.
        $offer->value = $validatedData['value'];// save the value that has been sent by the value input field.
        $offer->certificate_id = $validatedData['certificate_id'];// save the certificate_id that has been sent by the certificate_id input field.
        $offer->owner = $user->blockchain_address;;// save the owner that has been sent by the owner input field.
        $offer->save();// save.


       if ($request->hasFile('image')){// if the image input field has a file. 
        $filename = $request->image->getClientOriginalName();// It takes the original name of the image.
        $request->image->storeAs('images',$filename,'public');// It is the path that is used to store the image.
        $offer->update(['image'=>$filename]);//it updates the image variable in the offer object.
        $offer->save();//save.

        //The image is hashed by md5 hash function = 32 characters.
        $test_file_read1 = ('./storage/images/'.$offer->image);// It reads the file.
        $test_file_read = file_get_contents($test_file_read1);//It gets the content of the image.
        $test_file_hash = hash_file("md5", $test_file_read1, FALSE);// The hash function.
        $offer->hash_picture =  $test_file_hash;// save the value in hash_picture.
        $offer->save();//save.
        } 
       
        //offer_id //encode the offer_id input field.
        $octId = $offer->id;// It takes the value of the offer id input field.
        $octId2 = base_convert($octId,10,16);// It transfers the value to Hex value.
        $hexIdNumber = strlen($octId2); // It calculates the length of the id.
        $totalZerosOfId = 64 - $hexIdNumber;//It deducts the length of the id, which has been converted to Hex, from 64 characters.
        $embededId = "";
        
        for ($x = 0; $x < $totalZerosOfId; $x++){

            $embededId .= "0";//embed zeros.
            
        }
        
        $embededId .= $octId2; // 32 bytes for the offer id.

         //certificate_id //encode the certificate_id input field.
         $octCertificate_id = $offer->certificate_id;// It takes the value of the certificate_id input field.
         $octCertificate_id2 = base_convert($octCertificate_id,10,16);// It transfers the value to Hex value.
         $hexIdNumber = strlen($octCertificate_id2);  // It calculates the length of the certificate_id.
         $totalZerosOfId = 64 - $hexIdNumber;//It deducts the length of the certificate_id, which has been converted to Hex, from 64 characters.
         $embededCertificate_id = "";

         for ($x = 0; $x < $totalZerosOfId; $x++){
 
             $embededCertificate_id .= "0";//embed zeros.
             
         }
         $embededCertificate_id .= $octCertificate_id2; // 32 bytes for the certificate id
        
        //hash_pictute //encode the hash_pictute input field.
        $octHash_picture = $offer->hash_picture;// It takes value of the hash_pictute input field.
        $octHash_picture1  = strlen($octHash_picture);// It calculates the length of the hash_pictute.
        $totalZerosOf_hash_pictre = 64 - $octHash_picture1;//It deducts the length of the hash_pictute, which has been converted to Hex, from 64 characters.
        $embeded_hash_picture = "";

        for ($x = 0; $x < $totalZerosOf_hash_pictre; $x++){

            $embeded_hash_picture .= "0";//embed zeros.
            
        }
        
        $octHash_picture .= $embeded_hash_picture; //32 bytes for the picture,
        ///
        $hexData = "";
        $hexData .= $string;// 0x8c726dc3000000000000000000000000 + the encoded owner address 
        $hexData .= $embededdValue;// the value is hashed and encoded.
        $hexData .= $embededId;// offer id is hashed and encoded.
        $hexData .= $octHash_picture; //the content of the image is hashed and encoded.
        $hexData .= $embededCertificate_id; // the certificate id is hashed and encoded
        $offer->hex_data = $hexData; // the obove data is embedded into this variable. This is for sent the blockchain transaction.
        $offer->hex_id = $embededId;//the offer id has been hashed encoded.
        $offer->save();// save.

        
        return view('documents.create', ['user'=> $user,'offer'=> $offer, 'area'=>$area]);// sent the Auth user, the offer, and the area to the second step, which is for uploading the rest of the property pictures.  
              
    }
    

     public function buy(Offer $offer)// This function returns the buy view.
     {
        $user = Auth::user();// The authorized user.

         return view('offers.buy',['offer'=>$offer, 'user' =>$user]); // It returns the offers.buy view with offer object and the Auth user.
         
     }

     public function confirm(Offer $offer, Request $request){// This function saves the the blockcahin transaction, which has been generated by the Ethereum blockchain, in the local database.

        $user = Auth::user();// The authorised user.
        $olduser = User::findOrFail($offer->user_id);// In the buy process, it is for a temporary save of the previous owner to send an email to the seller and the buyer. 
   
        $validatedData = $request->validate([/// Laravel provides the validate method to check the restrictions, which have been set on the values that have been sent by the input fields.
           
            'hash' =>'required| max:42 | min:42',// this field is required, and it must be equal 42 characters. It is for the address of the offer in the Ethereum blockchain
            'state' =>'required',// this field is required. // It contains the current state of the offer, if the value == true, then the property is still for silling, if the value == false, then the property is sold. 
            'valid' =>'required', //this field is required. It contains the value that indicates the validation of the offer, if the value == true, then the offer is valid, it the value == false, then the propery is invalid. 
            'tx' =>'max:66'// this field is required. It contains the last transaction hash that has been generated by the create, buy or cancel preocess.
        ]);
       
        /////
        $properties = Property::all();// call the properties that have been stored by the admin.
        $certificateValidate = $offer->certificate_id;;
        
        foreach ($properties as $property){ // this is for updating the property table.
           if ($certificateValidate == $property->certificate_id){
               
            $property->owner = $user->blockchain_address;
            $property->save();
                
               }
           }
        ////////

        ////////
        $offers = Offer::all();// call the offers that have been stored in the local database.
        $offer_certificate_id = $offer->certificate_id;// It collects the certificate id of the offer.
        foreach ($offers as $offer){ // Thie loop is for update the value of the valid variable of the offer.
            if ($offer_certificate_id == $offer->certificate_id){
                
                $offer->valid = 'false';
                $offer->save();
                
            }
            }
        
        /////////save.
       $offer->hash = $validatedData['hash'];
       $offer->tx = $validatedData['tx'];
       $offer->state = $validatedData['state'];
       $offer->valid = $validatedData['valid'];
       $offer->owner = $user->blockchain_address;
       $offer->user_id = $user->id;
       $offer->save();
       
        
        $area = Area::findOrFail($offer->area_id); // It finds the Area object that has the area_id that is stored in the offer object.
        $offers = $area->offers()->latest()->paginate(5); //collects the whole offers in this area object according to the creation date, then paginates the result, so each page will contain 5 offers. 
        
        Mail::to($user->email)->send(new \App\Mail\RSBlockchain($offer)); // informs the buyer
        if ($user != $olduser){
            Mail::to($olduser->email)->send(new \App\Mail\RSBlockchain($offer)); // informs the seller
        }
        

        return view('offers.confirm', ['area'=>$area, 'offers'=>$offers , 'user'=>$user, 'offer'=>$offer]); // It returns the offers.confirm view with the area, offers, user and offer objects.
 
    }

    public function showMyOffer(Offer $offer)
    {
        $comments = $offer->comments()->latest()->paginate(5);//collects the whole comments in this offer object according to the creation date, then paginates the result, so each page will contain 5 comments. 
       
        return view('offers.showMyOffer', ['offer'=>$offer,'comments'=>$comments]);// It returns the offers.showMyOffer view with the offer and comments objects.
    }
    public function cancel(Offer $offer)// This function returns the offers.carete view to cancel an offer.
    {
        $user = Auth::user();// the authorized user.
        if ($offer->user_id != Auth::id()){
            return abort(404);
        }
        return view('offers.cancel', ['offer'=>$offer ,'user'=>$user]); //It returns the offers.cancel view with offer and user objects.
    }
    public function blockchain(Offer $offer){
        $user = Auth::user();
        return view('blockchains.create', ['offer'=>$offer, 'user'=>$user]);
    } 

}
