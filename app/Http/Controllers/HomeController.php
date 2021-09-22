<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Offer;
use App\Area;
use App\User;
use App\Phone;
use App\Image;
use App\Comment;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $areas = Area::latest()->paginate(5);
       
        return view('areas.index', ['areas'=>$areas]);
       
    }

    public function create()
    {
  
    }

    public function destroy($id)
    {
   
    }

    public function store(Request $request)
    {
        //
        
    }

}
