<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Offer;
use App\Area;
use App\Document;
use App\Blockchain;
use App\User;
use App\Mail\RSBlockchain;
use Illuminate\Support\Facades\Mail;

use Auth;
use Illuminate\Support\Facades\DB;

class BlockchainController extends Controller
{
    /*
    public function create(){

        return view ('blockchains.create');
    }

    public function store(Offer $offer ,Request $request){

       
        $user = Auth::user();
       
        $validatedData = $request->validate([
           
            'owner' =>'required',
            'value' =>'required'
        ]); 
        
        //dd($request);
       $block = new Blockchain;
       
       $block->offer_id = $offer->id;  
       $block->user_id = $offer->user_id;
       $block->owner = $validatedData['owner'];
       $block->save();

       $offer->value = $validatedData['value'];
       $offer->save();


        $title = $offer->title;
        $area = Area::findOrFail($offer->area_id);
        $offers = $area->offers()->latest()->paginate(5);
/*
      return redirect()->route('areas.show', ['area'=>$area, 'offers'=>$offers , 'user'=>$user])
    ->with('success', 'Offer: '.$title. ' was saved');

        $user = Auth::user();
        return view ('blockchains.price', ['block'=>$block,'area'=>$area, 'offers'=>$offers , 'user'=>$user, 'offer'=>$offer]);
   
    }

    public function show(Blockchain $blockchain){

        dd($blockchain);

        return view ('blockchains.show');
    }

    public function main(Blockchain $blockchain){

        $title = $offer->title;
        $area = Area::findOrFail($offer->area_id);
        $offers = $area->offers()->latest()->paginate(5);

       
       
      return redirect()->route('areas.show', ['area'=>$area, 'offers'=>$offers , 'user'=>$user])
    ->with('success', 'Offer: '.$title. ' was saved');
    }

*/
public function create(Offer $offer ,Request $request){

    //dd($request);
    $user = Auth::user();
   
    $validatedData = $request->validate([
       
        'SmartContractAddress' =>'required',
        'owner' =>'required',
        'state' =>'required'
    ]); 
    
    //dd($request);

    $offer = Offer::findOrFail($offer->id);
   
  
    $string = $validatedData['SmartContractAddress'];
    $string = preg_replace('/[0x]{2}/','', $string);

   
   $offer->hash = $string;
   $offer->owner = $validatedData['owner'];
   $offer->state = $validatedData['state'];
   $offer->save();

   Mail::to($user->email)->send(new \App\Mail\RSBlockchain($offer));
    $title = $offer->title;
    $area = Area::findOrFail($offer->area_id);
    $offers = $area->offers()->latest()->paginate(5);
/*
  return redirect()->route('areas.show', ['area'=>$area, 'offers'=>$offers , 'user'=>$user])
->with('success', 'Offer: '.$title. ' was saved');
*/
    $user = Auth::user();
    return redirect()->route('areas.show', ['area'=>$area, 'offers'=>$offers , 'user'=>$user])
    ->with('success', 'Offer: '.$title. ' was saved');
    

    //route('areas.show',$offer->area
}
}