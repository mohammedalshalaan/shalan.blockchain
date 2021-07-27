@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">The City</div>

                <div class="card-body">
               
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title:</th>
      <th scope="col">Actions:</th>
    </tr>
  </thead>
  <tbody>
 
  <tr>
      <th scope="row">number</th>
      <td>1</td>
     
      <td>
     
        <a href="link"><button type="button" class="btn btn-primary float-left">Show</button></a>
   
      <form action = "link" method="POST" class="float-left">
      @csrf
      {{ method_field('DELETE')}}
      <button type="submit" class="btn btn-danger">Delete</button></td></a>
      </form>

    </tr>

  </tbody>
</table>

<a href="offers.show" class="btn btn-primary">Add City</a></td>

                   
                </div>
            

            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')

@endsection
