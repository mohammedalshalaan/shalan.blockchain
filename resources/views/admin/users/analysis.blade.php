@extends('layouts.app')


@section('content')

      <link rel="stylesheet" href="dist/sortable-tables.min.css">
      <script src="dist/sortable-tables.min.js"></script>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">

      google.charts.load('current', {packages: ['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawMultSeries);

      function drawMultSeries() {
            var data = google.visualization.arrayToDataTable([
              ['Offers', 'Your Offers and Comments', 'Total Offers and Comments'],
              ['Offers', {{$your_offers->count()}}, {{$offers_chart->count()}}],
              ['Comments', {{$your_comments->count()}}, {{$comments_chart->count()}}],
            ]);

            var options = {
              title: 'Demonstrate Your Interactions',
              chartArea: {width: '50%'},
              hAxis: {
                title: 'Total Offers And Comments',
                minValue: 0
              },
              vAxis: {
                title: 'Intractions'
              }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
          </script>


            <div class="container">
                  <div class="row justify-content-center">
                        <div class="col-md-11">
                              <div class="card">
                                  <div id="chart_div" style="width: 1000px; height: 400px;"></div>
                            </div>
                      </div>
                </div>
          </div>    
          <div class="container">
                  <div class="row justify-content-center">
                        <div class="col-md-11">
                              <div class="card">
                                                  <div class="p-3 mb-2 bg-primary text-white"><h2><p class="text-center">Your Offers</h2></div>
                                                <div class="card-body">
                                                  <table class="table">
                                                        <thead> 
                                                                <tr>
                                                                <th scope="col" >#</th>
                                                                <th scope="col" > The title of offer:</th>
                                                                <th class="numeric-sort">The total of comment</th>
                                                                <th scope="col">Created By</th>
                                                                </tr>
                                                            </thead>
                                                        <tbody>
                                                                <div class="container">   
                                                                    @foreach($offers as $offer)
                                                                            <tr>          
                                                                                    <th scope="row">{{$offer->id}}</th>
                                                                                    <td>{{$offer->title}}</td>
                                                                                    <td>{{$offer->comments->count()}}</td>
                                                                                    <td>{{$offer->user->name}}</td>
                                                                            </tr>
                                                                    @endforeach
                                                            </tbody>      
                                                    </table>
                                                    <a href="{{route('areas.index')}}"class="btn btn-primary">Back to Areas Page</a>
                                                  
                                                </div>
                                    </div>
                                <div class="parent">{{$offers->links()}} </div> 
                        </div>
                  </div>
            </div>

@endsection
