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
            'title' =>'required|max:30',
            'description' =>'required|max:300',
            'user_id' =>'required'
        ]); 
        
        $a = new Area;
        $a->title = $validatedData['title'];
        $a->description = $validatedData['description'];
        $a->user_id = $validatedData['user_id'];
        $a->save();

       
        $title = $a->title;

        return redirect()->route('areas.index')->with('success', 'Area: '.$title. ' was saved');
      
    }

    public function show(area $area)
    {
        $offers = $area->offers()->where('state' ,'=', 'The real is available, and it has been saved by the system.')->latest()->paginate(5);
      
        $offersForSell = $area->offers()->where('state' ,'=', 'The real is available, and it has been saved by the system.')->count();
        $area->total_offer_for_sell = $offersForSell;
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
