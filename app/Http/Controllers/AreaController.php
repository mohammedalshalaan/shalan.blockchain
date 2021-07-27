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
//dd($areas);
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
            'description' =>'required|max:200',
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
        $offers = $area->offers()->where('state' ,'=', 'The offer has been saved by the blockchain technology.')->latest()->paginate(5);
        //$offers = $area->offers->where('state' ,'=', 'true');
        //$offers = $area->latest()->paginate(5);
        /*
        $offers = DB::table('offers')
                ->where('state', '=', false)
               // ->where('age', '>', 35)
                ->get();
        
*/
        //$offers = DB::table('offers')->select('state', false);
        $user = Auth::user();
       
        //dd($offers1);
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