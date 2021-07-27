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
  

    public function setting()
    {
   
        return view('personal.setting');

    }


    public function analysis()
    {

       $your_offers = Auth::User()->offers();
       $your_comments = Auth::User()->comments();

       $offers = Auth::User()->offers()->paginate(5);

       $offers_chart = Offer::all();
       $comments_chart = Comment::all();
    

       return view('personal.analysis', [
           'your_offers'=>$your_offers ,
           'offers'=>$offers,
           'your_comments'=> $your_comments,
           'offers_chart'=> $offers_chart,
           'comments_chart'=> $comments_chart]);
    }

   


}
