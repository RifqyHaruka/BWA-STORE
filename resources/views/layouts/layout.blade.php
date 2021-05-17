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

    <title>Store - Your Best Marketplace</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- SideBar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="/images/glove.png" style="width: 80px; height: 80px" alt="" class="mt-4" />
          </div>
          <div class="list-group list-group-flush mt-4">
        

                <a
              href="{{ route("admin-dashboard") }}"
              class="list-group-item list-group-item-action"
            >
             Dashboard
            </a>
            <a
              href=""
              class="list-group-item list-group-item-action"
            >
              Product
            </a>

            <a
              href="{{ route("category.index") }}" 
              {{-- admin dari prefix pada route karena ga bisa resource gatau kenapa --}}
              class="list-group-item list-group-item-action {{ (request()->is('admin/category*')) ? 'active' : "" }}"
            >
              Categories
            </a>

            <a
              href="{{ route('transaction.index') }}"
              class="list-group-item list-group-item-action"
            >
              Transactions
            </a>

                <a
              href=""
              class="list-group-item list-group-item-action"
            >
              Users
            </a>



            <a
              href=""
              class="list-group-item list-group-item-action"
            >
              Sign-Out
            </a>
          </div>
        </div>

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
                    Hi,Haruka
                  </a>
                  <div class="dropdown-menu">
                    <a href="/dashboard.html" class="dropdown-item">Dashboard</a>
                    <a href="/dashboard-account.html" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="/" class="dropdown-item">Logout</a>
                  </div>
                </li>
            
              </ul>

              <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Hi,Haruka
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

    @yield('content')

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
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

