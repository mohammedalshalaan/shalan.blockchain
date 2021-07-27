<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Offer;
use App\Comment;
use App\User;
use Auth;
use App\Mail\thefinalmail;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function index()
    {

        $comments = Auth::user()->comments()->latest()->paginate(5);

        return view('comments.index', ['comments' => $comments]);
        
    }

    public function show(Comment $comment)
    {

        return view('comments.show', ['comment'=>$comment]);
    }

    public function addpost(Offer $offer)
    {
        
        $user = Auth::user();

       return redirect()->route('comments.create',['offer'=> $offer,'user'=>$user]);

    }

    public function create(Offer $offer)
    {
        
        $user = Auth::user();

        return view('comments.create',['offer'=> $offer,'user'=>$user]);

    }

    

    public function store (Offer $offer ,Request $request)
    {
         
        $validatedData = $request->validate([
            'body' =>'required|max:60',
            'user_id' =>'required',
            'offer_id' =>'required'
     
        ]); 
        
        $a = new Comment;
        $a->body = $validatedData['body'];
        $a->user_id = $validatedData['user_id'];
        $a->offer_id = $validatedData['offer_id'];
        $a->save();

       
        if ($offer->user_id != Auth::id()){
       
            $email = $offer->user('email')->get();
       
            Mail::to($email)->send(new thefinalmail());
        }

       
        $comments = $offer->comments()->latest()->paginate(5);
        $user = Auth::user();
        
      
            return redirect()->route('offers.show', ['offer'=>$offer, 'comments'=>$comments , 'user'=>$user])
            ->with('success', 'The comment was created');
        
       
    }



    public function edit(Comment $comment)
    {
      
        if ($comment->user_id != Auth::id()){
            return abort(404);
        }
        return view('comments.edit')->with([
            'comment'=>$comment,
        ]);
        return redirect()->route('comments.update', ['comments'=>$comments ]);

    }

    public function update(Request $request, Comment $comment){

        if ($comment->user_id != Auth::id()){
            return abort(403);
        }
        //dd($request);
        $validatedData = $request->validate([
            'body' =>'required|max:60',
     
        ]); 
        $comment->update($request->only(['body']));
     
        
        return redirect()->route('comments.index')
        ->with('success', 'The comment was updated');

        }


        public function destroy($id)
        {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return redirect()->route('comments.index')->with('success', 'The comment was deleted');
        }

}

    

