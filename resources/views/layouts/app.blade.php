<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<style>
div.parent {
  position: relative;
  height: 0px;
}

div.absolute {
  position: absolute;
  width: 100%;
  bottom: 10px;
  
 
} 

div.relative {
  position: relative;
  width: 100%;
  bottom: 0px;
  right:0px;
 
} 

div.fixed {
  position: fixed;
  width: 50%;
  bottom: 0px;
  right:0px;
  top:0;
} 

div.sticky {
  position: sticky;
  width: 0%;
  bottom: 0px;
  
} 

#instructor {
    padding:1em;
    background-color:#fff;
    margin: 1em 0;
}

#loader {
    width: 100px;
    display:none;
}

div.fleft { float: left; } 

div.justified {
        display: flex;
        justify-content: center;
        
    }

</style>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="/js/web3.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

   

   <!-- old -->
   
   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                PT: Applying Blockchain Technology to the Buy and Sale Transactions. Supervisor: Dr. Anton Setzer. Student: Mohammed Alshalan
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('areas.index')}}"> Home Page - The Areas</a>
                                <a class="dropdown-item" href="{{ route('offers.index')}}"> Your Offers</a>
                                <a class="dropdown-item" href="{{ route('comments.index')}}"> Your Comments</a>
                                <a class="dropdown-item" href="{{ route('users.analysis')}}">Analysis</a>
                                <a class="dropdown-item" href="{{ route('users.profile')}}">User Profile</a>
                           
                                
                                @can('manage-users')

                                <a class="dropdown-item" href="{{ route('admin.users.index')}}">User Roles</a>
                                <a class="dropdown-item" href="{{ route('properties.index')}}">Regiter Property</a>
                                @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                   
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    
        <main class="py-5">
            @yield('content')
        </main>
    </div>
</body>
</html>
