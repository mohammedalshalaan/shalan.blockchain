<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Offer;
use App\Area;
use App\Property;
use App\User;
use App\Comment;
use Auth;

class PropertyController extends Controller
{
    public function index()
    {
         $user = Auth::user();
        if ($user->id != 1) {// only the admin.
            return abort(404);
        }

        $properties = Property::latest()->paginate(5);

        return view('properties.index', ['properties'=>$properties]);
    }

    public function create()
    {
         $user = Auth::user();
        if ($user->id != 1) {// only the admin.
            return abort(404);
        }
       
        $properties = Property::all();


        return view('properties.create',['user' => $user,'properties'=>$properties]);
    }

    public function store(Request $request)
    {
         $user = Auth::user();
        if ($user->id != 1) {// only the admin.
            return abort(404);
        }
       
        $validatedData = $request->validate([
    
            'owner' =>'required | max:42 | min:42' ,
           
            'certificate_id'=>'required | unique:App\Property,certificate_id'
        ]); 
        
        $a = new Property;
        $a->owner = $validatedData['owner'];
        $a->certificate_id = $validatedData['certificate_id'];
        $a->save();
        return redirect()->route('properties.index');  
    }

    public function destroy($id)
    {  
        $property = Property::findOrFail($id);
        $name = $property->name;
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Property ' .$name. ' was deleted');
    }
}
