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

class DocumentController extends Controller
{

    public function create(){

        return view ('documents.create');
    }

    public function show( Offer $offer){



        $documents = $offer->documents;
        
        
        return view ('documents.show', ['offer'=>$offer, 'documents'=>$documents]);
    }


    public function store (Offer $offer ,Request $request){


        $user = Auth::user();
  
        $mysqli = mysqli_connect ("localhost", "root","root","site_db");


    $phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
    );
    
    if(isset($_FILES['userfile'])){
        $file_post = $_FILES['userfile'];
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
        
            for ($i=0; $i<$file_count; $i++) {
                foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }
        
            $file_array = $file_ary;

        for ($i=0;$i<count($file_array);$i++){
            if($file_array[$i]['error']){
                ?> <div class="alert alert-danger"> 
                <?php echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']]; 
                ?> </div> <?php
            }
            else {
                $extensions = array('jpg','png','gif','jpeg');
                
                $file_ext = explode('.',$file_array[$i]['name']);
                
                $name = $file_ext[0];
                $name = preg_replace("!-!"," ", $name); // replace chars
                $name = ucwords($name); // capital first char
              
                $file_ext = end($file_ext);
                
                if (!in_array($file_ext, $extensions)){
                    ?> <div class="alert alert-danger"> 
                    <?php echo "{$file_array[$i]['name']} - Invalid file extension!"; 
                    ?> </div> <?php
                }
                else {

                    $location = './storage/images/'.$file_array[$i]['name']; // directory of the upload
                    move_uploaded_file($file_array[$i]['tmp_name'], $location);
                    $img_dir = $file_array[$i]['name'];

                 
                    $table = new document;
                    $table->name =  $name;
                    $table->user_id = $user->id;
                    $table->offer_id = $offer->id;

                    $table->img_dir = $img_dir;
                    $table->save();


                }
            }
        }
    }


   
    $area = Area::findOrFail($offer->area_id);
 
    
  
    return redirect()->route('offers.blockchain', ['offer'=>$offer]);


    }

   

}
