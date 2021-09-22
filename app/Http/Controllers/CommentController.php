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

class CommentController extends Controller
{
    public function index()
    {
        
        $comments = Auth::user()->comments()->latest()->paginate(5);
       

        return view('comments.index', ['comments'=>$comments]);
    }

    public function create(Offer $offer)
    {
        $user = Auth::user();
        
        return view('comments.create',['user' => $user,'offer'=>$offer]);
    }
    
     public function edit(Comment $comment)
    {
      
        if ($comment->user_id != Auth::id()){
            return abort(404);
        }
        return view('comments.edit')->with([
            'comment'=>$comment,
        ]);
       

    }

    public function update(Request $request, Comment $comment){

        if ($comment->user_id != Auth::id()){
            return abort(403);
        }
        //dd($request);
        $validatedData = $request->validate([
            'content' =>'required|string|max:300',
     
        ]); 
        $comment->update($request->only(['content']));
     
        
        return redirect()->route('comments.index')
        ->with('success', 'The comment was updated');

        }

    public function store(Request $request)
    {
        $user = Auth::user();
       
        $validatedData = $request->validate([
            'offer_id' =>'required',
            'content' =>'required|string|max:300'
            
        ]); 
        
        $offer = Offer::findOrFail($validatedData['offer_id']);
        
        $a = new Comment;
        $a->user_id = $user->id;
        $a->offer_id = $validatedData['offer_id'];
        $a->content = $validatedData['content'];
        $a->save();

       
        return redirect()->route('offers.show',['offer'=> $offer]);
      
    }


    public function show(comment $comment)
    {
        
        $user = Auth::user();
        $offer = Offer::findOrFail($comment->offer_id);
       
       
        return view('comments.show', ['comment'=>$comment,'user'=>$user, 'offer'=> $offer]);
    }
   
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $name = $comment->name;
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment ' .$name. ' was deleted');
    
    }

   

   

}
