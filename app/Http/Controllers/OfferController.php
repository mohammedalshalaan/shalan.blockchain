<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Offer;
use App\Area;
use App\Document;
use App\Property;
use App\User;
use App\Mail\thefinalmail;
use Illuminate\Support\Facades\Mail;
use kornrunner\Keccak;

use Auth;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Auth::user()->offers()->latest()->paginate(5);
        
        return view('offers.index', ['offers' => $offers]);
        
    }
   

    public function show(Offer $offer)
    {
        $comments = $offer->comments()->latest()->paginate(5);
       
        
        return view('offers.show', ['offer'=>$offer,'comments'=>$comments]);
    }


    public function addblog(area $area)
    {
    
        $user = Auth::user();
        return redirect()->route('offers.create',['area'=> $area,'user'=>$user]);

    }


    public function create(area $area)
    {
        $user = Auth::user();
        return view('offers.create',['area'=> $area,'user'=>$user,]);
    }

    public function store (Area $area ,Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'title' =>'required|max:100',
            'content' =>'required|max:1000',
            'user_id' =>'required',
            'area_id' =>'required',
            'value' =>'required',
            'owner' =>'required | max:42 | min:42',
            'certificate_id' => 'required | exists:App\Property,certificate_id',
            'image' => 'required|mimes:jpg,jpeg,bmp,png'
        ]); 
        
        $properties = Property::all();// call the properties that have been stored by the admin.
        $ownerValidate = $validatedData['owner'];
        $certificateValidate = $validatedData['certificate_id'];
        
        foreach ($properties as $property){ // this is for matching the Certificate id with the blockchain address that have been stored in the property table.
           if ($certificateValidate == $property->certificate_id){
               if ($property->owner != $ownerValidate){
                $validatedData = $request->validate([
                    'certificate_id' => 'in',
                    ]);
               }
           }
        }

        

        
    
        //owner
        $string = "0x8c726dc3000000000000000000000000"; //0xd96a094a = 34 characters
        $string2 = $validatedData['owner']; // 40 characters
        $string2 = preg_replace('/0x/','', $string2); 
        $string .= $string2; // 74 characters
        
       
        //value
        $octValue = $validatedData['value'];
        $octValue2 = base_convert($octValue,10,16);
        $hexNumber = strlen($octValue2);
        $totalZeros = 64 - $hexNumber;
        $embededValue = "";

        for ($x = 0; $x < $totalZeros; $x++){

            $embededValue .= "0";
            
        }
        $embededValue .= $octValue2; //32 bytes for the value or the property price

        $offer = new Offer;
        $offer->title = $validatedData['title'];
        $offer->area_id = $validatedData['area_id'];
        $offer->content = $validatedData['content'];
        $offer->user_id = $validatedData['user_id'];
        $offer->value = $validatedData['value'];
        $offer->certificate_id = $validatedData['certificate_id'];
        $offer->owner = $validatedData['owner'];
        $offer->save();


       if ($request->hasFile('image')){
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('images',$filename,'public');
        $offer->update(['image'=>$filename]);
        $offer->save();

        $test_file_read1 = ('./storage/images/'.$offer->image);
        $test_file_read = file_get_contents($test_file_read1);
        $test_file_hash = hash_file("md5", $test_file_read1, FALSE);
        $offer->hash_picture =  $test_file_hash;
        $offer->save();
        } 
       
        //offer_id
        $octId = $offer->id;
        $octId2 = base_convert($octId,10,16);
        $hexIdNumber = strlen($octId2);
        $totalZerosOfId = 64 - $hexIdNumber;
        $embededId = "";
        
        for ($x = 0; $x < $totalZerosOfId; $x++){

            $embededId .= "0";
            
        }
        
        $embededId .= $octId2; // 32 bytes for the offer id.

         //certificate_id
         $octCertificate_id = $offer->certificate_id;
         $octCertificate_id2 = base_convert($octCertificate_id,10,16);
         $hexIdNumber = strlen($octCertificate_id2);
 
         $totalZerosOfId = 64 - $hexIdNumber;
        
         $embededCertificate_id = "";
         for ($x = 0; $x < $totalZerosOfId; $x++){
 
             $embededCertificate_id .= "0";
             
         }
         $embededCertificate_id .= $octCertificate_id2; // 32 bytes for the certificate id
        
        //hash_pictute
        $octHash_picture = $offer->hash_picture;
        $octHash_picture1  = strlen($octHash_picture);
        $totalZerosOf_hash_pictre = 64 - $octHash_picture1;
        $embeded_hash_picture = "";

        for ($x = 0; $x < $totalZerosOf_hash_pictre; $x++){

            $embeded_hash_picture .= "0";
            
        }
        
        $octHash_picture .= $embeded_hash_picture; //32 bytes for the picture,
        ///
        $hexData = "";
        $hexData .= $string;
        $hexData .= $embededValue;// value encoded
        $hexData .= $embededId;// offer id encoded
        $hexData .= $octHash_picture; //hash value of the image
        $hexData .= $embededCertificate_id; // certificate id encoded
        $offer->hex_data = $hexData; // the obove data is encluded in this variable.
        $offer->hex_id = $embededId;
        $offer->save();

        
        return view('documents.create', ['user'=> $user,'offer'=> $offer, 'area'=>$area]);
              
    }
    

    public function destroy($id) // this function will not be used owing to the transaction in the ethereum blockchain is not able to be deleted
    {
        
        $offer = Offer::findOrFail($id);
        $offer->delete();

        $title = $offer->title;
        return redirect()->route('offers.index')->with('success', 'offer ' .$title. ' was deleted');
    }


    public function edit(Offer $offer)
    {
      
        if ($offer->user_id != Auth::id()){
            return abort(404); // this is for preventing the unauthorised users.
        }
        return view('offers.edit')->with([
            'offer'=>$offer,
        ]);
        return redirect()->route('offers.update', ['offers'=>$offers]);

    }
    
    public function update(Request $request, Offer $offer){

        if ($offer->user_id != Auth::id()){
            return abort(403); // this is for preventing the unauthorised users.
        }
        
        $validatedData = $request->validate([
            'title' =>'required|max:30',
            'content' =>'required|max:500',
            'image' => 'required|mimes:jpeg,bmp,png'
        ]); 
        

        $offer->update($request->only(['title','content','image']));

        $user = Auth::user();
        if ($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            $offer->update(['image'=>$filename]);
        } 
        
        $area = Area::findOrFail($offer->area_id);
        return view('documents.edit', ['user'=> $user,'offer'=> $offer, 'area'=>$area]);
           
        
    }

    public function selectimage(Offer $offer){

        //dd($request->all());
        return view('offers.selectimage',['offer'=>$offer]);


    }
    

     public function buy(Offer $offer)
     {
        $user = Auth::user();
         $offer = Offer::findOrFail($offer->id);

         return view('offers.buy',['offer'=>$offer, 'user' =>$user]); 
         
     }

     public function confirm(Offer $offer, Request $request){

        $user = Auth::user();
        $olduser = User::findOrFail($offer->user_id);
   
        $validatedData = $request->validate([
           
            'hash' =>'required',
            'state' =>'required',
            'valid' =>'required',
            'the_new_owner' =>'required',
            'user_id' =>'required'
        ]);
        
        //dd($request);
    
        $offer = Offer::findOrFail($offer->id);
       
      
        $string = $validatedData['hash'];
        $string = preg_replace('/[0x]{2}/','', $string);
    
        /////
        $properties = Property::all();// call the properties that have been stored by the admin.
        
        $ownerValidate = $validatedData['the_new_owner'];
        $certificateValidate = $offer->certificate_id;;
        
        foreach ($properties as $property){ // this is for updating the property table.
           if ($certificateValidate == $property->certificate_id){
               
            $property->owner = $ownerValidate;
            $property->save();
                
               }
           }
        ////////

        ////////
        $offers = Offer::all();
        $offer_certificate_id = $offer->certificate_id;
        foreach ($offers as $offer){ 
            if ($offer_certificate_id == $offer->certificate_id){
                
                $offer->valid = 'false';
                $offer->save();
                
            }
            }
        /////////

       $offer->hash = $string;
       $offer->user_id = $validatedData['user_id'];
       $offer->state = $validatedData['state'];
       $offer->valid = $validatedData['valid'];
       $offer->owner = $validatedData['the_new_owner'];
       $offer->save();
    
       //it will be activated later:
       //Mail::to($user->email)->send(new \App\Mail\RSBlockchain($offer)); // informs the buyer
       //Mail::to($olduser->email)->send(new \App\Mail\RSBlockchain($offer)); // informs the seller
       
        $title = $offer->title;
        $area = Area::findOrFail($offer->area_id);
        $offers = $area->offers()->latest()->paginate(5);

        $user = Auth::user();
        return view('offers.confirm', ['area'=>$area, 'offers'=>$offers , 'user'=>$user, 'offer'=>$offer])
        ->with('success', 'Offer: '.$title. ' was sold');
 
    }

    public function showMyOffer(Offer $offer)
    {
        $comments = $offer->comments()->latest()->paginate(5);
       
        
        return view('offers.showMyOffer', ['offer'=>$offer,'comments'=>$comments]);
    }
    public function cancel(Offer $offer)
    {
        $user = Auth::user();
        return view('offers.cancel', ['offer'=>$offer ,'user'=>$user]);
    }



}
