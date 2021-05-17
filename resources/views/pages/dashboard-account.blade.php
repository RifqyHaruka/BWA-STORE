@extends('layouts/dashboard')

@section('Judul')
   Transaction Details
@endsection

@section('content')
      <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Akun Saya</h2>
          <p class="dashboard-subtitle">
           Edit Akun Saya
          </p>
        </div>

        <div class="dashboard-content">
          <div class="col-12">
            <form action="{{ route('dashboard-settings-redirect', 'dashboard-account' )}}" method="POST" enctype="multipart/form-data" id="locations"> 
              @csrf
            <div class="card card-account">
              <div class="card-body">
                 <div class="row" data-aos="fade-up" data-aos-delay="150">
             <hr />
           </div>

         
           <div class="row" data-aos="fade-up" data-aos-delay="200">
             <div class="col-md-6">
               <div class="form-group">
                 <label for="name">Your Name</label>
                 <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                 
               </div>
             </div>

             <div class="col-md-6">
               <div class="form-group">
                 <label for="email">Your Email</label>
                 <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                 
                 
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                 <label for="text">Addres One</label>
                 <input type="text" name="address_one" id="address_one" class="form-control" value="{{ $user->address_one }}">
                 
                 
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                 <label for="text">Address Two</label>
                 <input type="text" name="address_two" id="address_two" class="form-control" value="{{ $user->address_two }}">
                 
                 
               </div>
             </div>
             <div class="col-md-4">
               <div class="form-group">
                 <label for="provinces_id">Provinsi</label>
                 <select name="provinces_id" id="province" class="form-control" v-if="provinces" v-model="provinces_id" required>
                   <option :value="province.id" v-for="province in provinces" >@{{ province.name }}</option>
                 </select>
                 <select v-else name="" id="" class="form-control"></select>

           </div>
           </div>

          <div class="col-md-4">
               <div class="form-group">
                 <label for="regencies_id">Kabupaten</label>
                 <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                   <option v-for="regency in regencies" :value="regency.id"  >@{{ regency.name }}</option>
                 </select>
                 <select v-else name="" id="" class="form-control"></select>
           </div>
       </div>

        <div class="col-md-4">
               <div class="form-group">
                 <label for="postCode">Post Code</label>
                 <input type="text" name="zip_code" id="postCode" class="form-control" value="{{ $user->zip_code }}">
                 
               </div>
             </div>

             <div class="col-md-6">
               <div class="form-group">
                 <label for="country">Country</label>
                 <input type="text" name="country" id="postCode" class="form-control" value="">
                 
               </div>
             </div>

             <div class="col-md-6">
               <div class="form-group">
                 <label for="mobile">Mobile</label>
                 <input type="text" name="phone_number" id="mobile" class="form-control" value="{{ $user->phone_number }}">
                 
               </div>
             </div>
              </div>

              <div class="row button-coba">
                <div class="col text-right">
                  <button class="btn btn-success px-4 mt-4">
                    Save Now
                  </button>
                </div>
              </div>
              </form>
              </div>

              <div class="row" data-aos="fade-up" data-aos-delay="150">
             <hr />
           </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      

    </div>
@endsection

@push('addon-script')
     <script src="/vendor/vue/vue.js"></script>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el:"#locations",
        // Elemen dengan Id gallery dihandle dengan vue js
        mounted(){
          AOS.init();
          this.getProvincesData();
          //mounted adalah Script yang akan dijalankan saat muncul
        },
        data:{
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null    
        },
        methods:{
            getProvincesData(){
                var self=this;
               axios.get('{{ route('api-provinces') }}').then(function(response){
                self.provinces = response.data; //response.data adalah data yang ada di api, self.provinces adalah variable provinsi, parameter response pada function adalah berisi data data api
              })
            },
            getRegenciesData(){
             var self=this;
              axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
              .then(function(response){
                 self.regencies = response.data; //response.data adalah data yang ada di api, self.provinces adalah variable provinsi, parameter response pada function adalah berisi data data api
               })
             },
        },

        watch: {
          provinces_id: function(val, oldval){
            this.regencies_id = null;
            this.getRegenciesData();
          }
         }


      });
    </script>
    <script src="/script/navbar-scroll.js"></script>
@endpush