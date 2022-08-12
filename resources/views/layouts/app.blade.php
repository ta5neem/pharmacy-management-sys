<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      @guest
                      @else

                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Manufacturer
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/manufacturer/all">all Manufacturers</a>
                          <a class="dropdown-item" href="/manufacturer/add">add Manufacturer</a>

                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Manufacturer Return List
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/manufacturerreturnlist/all">all Manufacturer Return Lists</a>
                          <a class="dropdown-item" href="/manufaturerreturnlist/add">add Manufacturer Return List</a>

                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Inventory
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/inventory/all">all Inventories</a>
                          <a class="dropdown-item" href="/inventory/add">add Inventory</a>
                            <a class="dropdown-item" href="/inventory/transfer">Inventory Transfer</a>

                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Message
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/message/all">all messages</a>
                          <a class="dropdown-item" href="/message/add">add message</a>

                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Responses
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/response/all">all Responses</a>
                          <a class="dropdown-item" href="/responses/add">add Responses</a>

                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        recieved order
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/recieved order/all">all recieved orders</a>
                          <a class="dropdown-item" href="/recieved order/add">add recieved order</a>

                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        orders
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/orders/all">all orders</a>
                          <a class="dropdown-item" href="/order/add">add order</a>
                            <a class="dropdown-item" href="/required/order/all">required order</a>

                        </div>
                      </li>

                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        other options
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/reports/all"> reports</a>
                          <a class="dropdown-item" href="/Financial/reports">Financial reports</a>
                          <a class="dropdown-item" href="/Totalbill/reports">Totalbill reports</a>
                        </div>
                      </li>


                      @endguest
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

                        <!-- Dropdown -->

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
