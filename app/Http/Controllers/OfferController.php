<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Offer;
use App\Area;
use App\Document;
use App\User;
use App\Mail\thefinalmail;
use Illuminate\Support\Facades\Mail;

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
        //dd($request);
        $validatedData = $request->validate([
            'title' =>'required|max:20',
            'content' =>'required|max:500',
            'user_id' =>'required',
            'area_id' =>'required',
            'value' =>'required',
            'owner' =>'required | max:42 | min:42' ,
            'certificate_type' => 'required',
            'certificate_id'=>'required',
           
            'image' => 'required|mimes:jpg,jpeg,bmp,png'
        ]); 
       
        //owner
        $string = "0xcf8191da000000000000000000000000"; //0xd96a094a
        $string2 = $validatedData['owner'];
        $string2 = preg_replace('/0x/','', $string2);
        $string .= $string2;
        
    
       
        //value
        $octValue = $validatedData['value'];
        $octValue2 = base_convert($octValue,10,16);
        $hexNumber = strlen($octValue2);

        $totalZeros = 64 - $hexNumber;
       
        $embededValue = "";
        for ($x = 0; $x < $totalZeros; $x++){

            $embededValue .= "0";
            
        }
        $embededValue .= $octValue2;

       
       $offer = new Offer;
       $offer->title = $validatedData['title'];
       $offer->area_id = $validatedData['area_id'];
       $offer->content = $validatedData['content'];
       $offer->user_id = $validatedData['user_id'];
       $offer->value = $validatedData['value'];
       $offer->certificate_type = $validatedData['certificate_type'];
       $offer->certificate_id = $validatedData['certificate_id'];
       $offer->owner = $string2;
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
       
        $title = $offer->title;
        //$offers = $area->offers()->latest()->paginate(5);
        $user = Auth::user();
        
        //offer_id
        $octId = $offer->id;
        $octId2 = base_convert($octId,10,16);
        $hexIdNumber = strlen($octId2);

        $totalZerosOfId = 64 - $hexIdNumber;
       
        $embededId = "";
        for ($x = 0; $x < $totalZerosOfId; $x++){

            $embededId .= "0";
            
        }
        $embededId .= $octId2;

        //hash_pictute
        $octHash_picture = $offer->hash_picture;
        //$octHash_picture2 = base_convert($octHash_picture,10,16);
        $octHash_picture1  = strlen($octHash_picture);

        $totalZerosOf_hash_pictre = 64 - $octHash_picture1;
       
        $embeded_hash_picture = "";
        for ($x = 0; $x < $totalZerosOf_hash_pictre; $x++){

            $embeded_hash_picture .= "0";
            
        }
        $octHash_picture .= $embeded_hash_picture;

        ///
        $hexData = "";
        $hexData .= $string;
        $hexData .= $embededValue;
        $hexData .= $embededId;
        $hexData .= $octHash_picture;
        $offer->hex_data = $hexData;
        $offer->hex_id = $embededId;
        $offer->save();


       
        return view('documents.create', ['user'=> $user,'offer'=> $offer, 'area'=>$area]);
        //return redirect()->route('areas.show', ['area'=>$area, 'offers'=>$offers , 'user'=>$user])
        //->with('success', 'Offer: '.$title. ' was saved');
        
       
    }
    
    
    
    public function destroy($id)
    {
        
        $offer = Offer::findOrFail($id);
        $offer->delete();

        $title = $offer->title;
        return redirect()->route('offers.index')->with('success', 'offer ' .$title. ' was deleted');
    }


    public function edit(Offer $offer)
    {
      
        if ($offer->user_id != Auth::id()){
            return abort(404);
        }
        return view('offers.edit')->with([
            'offer'=>$offer,
        ]);
        return redirect()->route('offers.update', ['offers'=>$offers]);

    }
    
    public function update(Request $request, Offer $offer){

        if ($offer->user_id != Auth::id()){
            return abort(403);
        }
        //dd($request);
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
            //return redirect()->route('offers.index')
            //->with('success', 'Offer was updated');
        
    }

    public function selectimage(Offer $offer){

        //dd($request->all());
        return view('offers.selectimage',['offer'=>$offer]);


    }
    

    public function apiIndex(Request $request)
    {

     $comments = Comment::all();
     return $comments;

    }

    public function apiStore(Request $request)
    {
        
        $a = new App\Comment;
        $a->body = $request['body'];
        $a->save();
        return $a;
     }

     public function buy(Offer $offer)
     {
         
         $offer = Offer::findOrFail($offer->id);

         return view('offers.buy',['offer'=>$offer]); 
         
     }

     public function confirm(Offer $offer, Request $request){

        //dd($request);
        $user = Auth::user();
        $olduser = User::findOrFail($offer->user_id);
   
        $validatedData = $request->validate([
           
            'SmartContractAddress' =>'required',
            'state' =>'required',
            'theOwner' =>'required'
        ]); 
        
        //dd($request);
    
        $offer = Offer::findOrFail($offer->id);
       
      
        $string = $validatedData['SmartContractAddress'];
        $string = preg_replace('/[0x]{2}/','', $string);
    
       
       $offer->hash = $string;
       $offer->state = $validatedData['state'];
       $offer->owner = $validatedData['theOwner'];
       $offer->save();
    
       Mail::to($user->email)->send(new \App\Mail\RSBlockchain($offer));
       Mail::to($olduser->email)->send(new \App\Mail\RSBlockchain($offer));
       
        $title = $offer->title;
        $area = Area::findOrFail($offer->area_id);
        $offers = $area->offers()->latest()->paginate(5);
    /*
      return redirect()->route('areas.show', ['area'=>$area, 'offers'=>$offers , 'user'=>$user])
    ->with('success', 'Offer: '.$title. ' was saved');
    */
        $user = Auth::user();
        return redirect()->route('areas.show', ['area'=>$area, 'offers'=>$offers , 'user'=>$user])
        ->with('success', 'Offer: '.$title. ' was sold');
 
    }
}
