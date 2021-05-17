  <nav
      class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down"
    >
      <div class="container">
        <a href="/" class="navbar-brand">
          <img src="/images/nogizaka46.svg" alt="Logo" style="width: 80px ;height: 80px;" />
        </a>

        <a class="navbar-brand" href="#"></a>

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
          
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/"
                >Home </a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/categories">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reward.html">Rewards</a>
            </li>
            @guest
                 <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white d-none d-lg-flex">Sign In</a>
              </li>
            @endguest
          </ul>

          @auth
               <ul class="navbar-nav d-none d-lg-flex ml-auto">
                <li class="nav-item dropdown">
                  <!-- Agar bisa di dropdown,nav-item membuat item pada navigasi -->
                  <a href="#" class="navlink" id="navbarDropdown" role="button" data-toggle="dropdown">
                    <!-- navlink selalu ada dalam ancor yang ada pada navigasi bawaan bootstrap -->
                    <img src="/images/HaruPictProfile.png" alt="" class="rounded-circle mr-2 ml-4 profile-picture">
                    Hi, {{ Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu">
                    <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                    <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="href="{{ route('logout') }}
                                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                  </div>
                </li>
                <li class="nav-item">

                  @php 
                    $cart = App\Models\Cart::where('users_id',Auth::user()->id)->count();
                  @endphp
                  <a href="{{ route('cart') }}" class="nav-link d-inline-block ml-2">


                    @if ($cart>0)
                      <img src="/images/shopping_ada.svg" alt="">
                    <div class="card-badge">{{ $cart }}</div>
                  </a>
                </li>
              </ul>
                

                @else

               <img src="/images/shopping_ada.svg" alt="">
                    <div class="card-badge">0</div>
                  </a>
                </li>
              </ul>
                @endif
                  
              <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Hi, {{ Auth::user()->name }}
                  </a>
                </li>

                
                
          @endauth
         
        </div>
        
      </div>
         
      </div>
      
    </nav>