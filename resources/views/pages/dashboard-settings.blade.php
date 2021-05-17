@extends('layouts/dashboard')

@section('Judul')
   Transaction Details
@endsection

@section('content')
      <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Store Settings</h2>
          <p class="dashboard-subtitle">
            Look,You Are a Nogizaka Family Now!
          </p>
        </div>

        <div class="dashboard-content">
          <div class="col-12">
            <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-account' )}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card">
                <div class="card-body">
                  <div class="row ">
                      <div class="col-md-6">
                         <div class="form-group" >
                  <label >Nama Toko</label>
                  <input type="text" name="store_name" class="form-control" value="{{ $user->store_name }}">
                </div>
               </div>

               <div class="col-md-6">

                   <div class="form-group" v-if="is_store_open">
                  <label >Kategori</label>
                  <select name="category" class="form-control">
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>    
                    @endforeach
                    
                  </select>
                </div>

                </div>

                      <div class="col-md-6">
                        
                <div class="form-group">
                  <label for="" class="mt-2">Store</label>
                  <p class="text-muted">
                    Apakah Saat Ini Toko Anda Buka?
                  </p>

                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" 
                      class="custom-control-input" 
                      name="store_status"
                      value="1" 
                      id="openStoreTrue" 
                      {{ $user->store_status == 1 ? 'checked' : '' }}
                      >

                      <label for="openStoreTrue" class="custom-control-label">
                        Buka
                      </label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" 
                      class="custom-control-input" 
                      name="store_status" 
                      id="openStoreFalse"
                      value="0" 
                      {{ $user->store_status == 0 || $user->store_status == NULL ?  'checked' : '' }}
                     >

                      <label for="openStoreFalse" class="custom-control-label">
                        Sementara Tutup
                      </label>
                    </div>
                </div>
                      </div>

                  </div>

                   <div class="row button-coba">
                <div class="col text-right ">
                  <button class="btn btn-success px-4 " type="submit">
                    Save Now
                  </button>
                </div>
              </div>
              </form>
                </div>
              </div>
           
          </div>
        </div>
      </div>

      

    </div>
@endsection

@push('addon-script')
     <script>
      $("#menu-toggle").click(function(e){
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });
    </script>
    <script src="/script/navbar-scroll.js"></script>
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var TransactionDetails = new Vue({
        el: '#TransactionDetails',
        data:{
          status : "SHIPPING",
          resi : "75325845632158"
        }
      });

    </script>
@endpush