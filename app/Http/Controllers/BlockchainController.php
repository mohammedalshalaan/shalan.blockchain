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
  
public function create(Offer $offer ,Request $request){

    dd($request);
   
}
}