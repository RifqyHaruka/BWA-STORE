<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title> @yield('Judul') </title>
    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    @stack('addon-style')
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- SideBar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="/images/shopping_dashboard.svg" alt="" class="mt-4" />
          </div>
          <div class="list-group list-group-flush mt-4">
            <a
              href="{{ route('dashboard') }}"
              class="list-group-item list-group-item-action  {{ (request()->is('dashboard')) ? 'active' : '' }}"
            >
              Dashboard
            </a>

            <a
              href="{{ route('dashboard-product') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/product*')) ? 'active' : '' }}"
            >
              My Product
            </a>

            <a
              href="{{ route('dashboard-transaction') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/transaction*')) ? 'active' : '' }}"
            >
              Transactions
            </a>

            <a
              href="{{ route('dashboard-settings-account') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings*')) ? 'active' : '' }}"
            >
              Store Settings
            </a>

            <a
              href="{{ route('dashboard-account') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/account*')) ? 'active' : '' }}"
            >
              My Account
            </a>

             <a href="href="{{ route('logout') }}
               onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="dropdown-item">
              Sign-Out
            </a>
          </div>
        </div>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <nav
      class="navbar navbar-expand-lg navbar-light navbar-store fixed-top "
      data-aos="fade-down"
    >
      <div class="container-fluid">
       
        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
          &laquo; Menu
        </button>

        <button
          class="navbar-toggler first-button"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent20"
          "
        >
          <div class="animated-icon1">
            <span></span><span></span><span></span>
          </div>
        </button>

       
        <div class="collapse navbar-collapse" id="navbarSupportedContent20">
      
              <!-- Desktop Menu -->
              <!-- d-non agar tidak tampil di mobil,d-lg-flex agar tampil dilayar besar dalam bentuk flex box -->
              
         
          <ul class="navbar-nav d-none d-lg-flex ml-auto">
                <li class="nav-item dropdown">
                  <!-- Agar bisa di dropdown,nav-item membuat item pada navigasi -->
                  <a href="#" class="navlink" id="navbarDropdown" role="button" data-toggle="dropdown">
                    <!-- navlink selalu ada dalam ancor yang ada pada navigasi bawaan bootstrap -->
                    <img src="/images/HaruPictProfile.png" alt="" class="rounded-circle mr-2 ml-4 profile-picture">
                    Hi, {{  Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu">
                    <a href="/dashboard.html" class="dropdown-item">Dashboard</a>
                    <a href="/dashboard-account.html" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="href="{{ route('logout') }}
                                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                  </div>
                </li>

                @php
                  $cart = App\Models\Cart::where('users_id' , Auth::user()->id)->count();   
                @endphp

  @if ($cart > 0)
                 <li class="nav-item">
                  <a href="#" class="nav-link d-inline-block ml-2">
                    <img src="/images/shopping_ada.svg" alt="">
                    <div class="card-badge">{{ $cart }}</div>
                  </a>
                </li>
  @else
  <li class="nav-item">
                  <a href="#" class="nav-link d-inline-block ml-2">
                    <img src="/images/shopping_ada.svg" alt="">
                    <div class="card-badge">0</div>
                  </a>
                </li>
  @endif
               
              </ul>

              <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Hi, {{ Auth::user()->name }}
                  </a>
                </li> 
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Cart
                  </a>
                </li>
              </ul>
        </div> 
         
      </div>
    </nav>

    <!-- Section Content -->
    @yield('content')

    
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
      AOS.init();
    </script>
    <script>
      $("#menu-toggle").click(function(e){
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });
    </script>
    <script src="/script/navbar-scroll.js"></script>
        @stack('addon-script') 
  </body>
</html>
