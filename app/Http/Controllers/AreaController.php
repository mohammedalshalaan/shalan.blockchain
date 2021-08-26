<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Offer;
use App\Area;
use App\User;
use App\Comment;
use Auth;

class AreaController extends Controller
{
    public function index()
    {

        $areas = Area::latest()->paginate(5);

        return view('areas.index', ['areas'=>$areas]);
    }

    public function create()
    {
        $user = Auth::user();
        $areas = Area::all();


        return view('areas.create',['user' => $user,'areas'=>$areas]);
    }

    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' =>'required|max:30',
            'description' =>'required|max:300',
            'user_id' =>'required'
        ]); 
        
        $a = new Area;
        $a->name = $validatedData['name'];
        $a->description = $validatedData['description'];
        $a->user_id = $validatedData['user_id'];
        $a->save();

       
        $name = $a->name;

        return redirect()->route('areas.index')->with('success', 'City: '.$name. ' was saved');
      
    }

    public function show(area $area)
    {
        $offers1 = $area->offers()->where('state' ,'=', 'true');
        $offers = $offers1->where('valid' ,'=', 'true')->latest()->paginate(5);
      
        $offers_for_Sell = $area->offers()->where('state' ,'=', 'true');
        $offers_valid_and_for_sell = $offers_for_Sell->where('valid' ,'=', 'true')->count();
        $area->total_offer_for_sell = $offers_valid_and_for_sell;
        $area->save();
       
        $user = Auth::user();
       
       
        return view('areas.show', ['area'=>$area, 'offers'=>$offers , 'user'=>$user]);
    }

   
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $name = $area->name;
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Area ' .$name. ' was deleted');
    
    }

   

   

}
