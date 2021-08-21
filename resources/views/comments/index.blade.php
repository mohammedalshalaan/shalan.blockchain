@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Your Comments</h2></div>
                        <div class="card-body">
                                <table class="table">
                                    <thead> 
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">The Comment:</th>
                                            <th scope="col">On Offer:</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Actions:</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                            <div class="container">   
                                                @foreach($comments as $comment)
                                                        <tr>          
                                                                <th scope="row">{{$comment->id}}</th>
                                                                <td>{{$comment->content}}</td>
                                                                <td>{{$comment->offer->title}}</td>
                                                                <td>{{$comment->user->name}}</td>
                                                                <td>
                                                                <a href="{{route('comments.edit',$comment)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                                            <form action = "{{route('comments.destroy', $comment)}}" method="POST" class="float-left"></a>
                                                                @csrf
                                                                    {{ method_field('DELETE')}}
                                                                    <button type="submit" class="btn btn-danger">Delete</button></td></a>
                                                                </form>
                                                        </tr>
                                                @endforeach
                                        </tbody>      
                                </table>
                            <div>
                        </div>
                    </div>
                <div class="parent">{{$comments->links()}} </div>
            </div>
        </div>
    </div>

@include('sweetalert::alert')
@endsection

