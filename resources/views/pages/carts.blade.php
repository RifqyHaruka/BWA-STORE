@extends('layouts.app')

@section('title')

    Store Cart
    
@endsection

@section('content')
     <div class="page-content page-cart">

      <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb mt-4">
                  <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                  </li>

                  <li class="breadcrumb-item active">
                    Cart
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

     <section class="store-cart">
       <div class="container">
         <div class="row" data-aos="fade-up" data-aos-delay="100">
          
           <div class="col-12 table-responsive"></div>
              <table class="table table-borderless table-cart">
                <thead>
                  <tr>
                    <td>Image</td>
                    <td>Name &amp; Seller</td>
                    <td>Price</td>
                    <td>Menu</td>
                  </tr>
                </thead>
                <tbody>
                  
                  @php
                  $totalprice=0;
                  @endphp
                  @foreach ($carts as $cart)
                     <tr>
                    <td style="width: 20%;"><img src="{{ Storage::url($cart->product->galleries->first()->photo) }}" alt="" class="cart-image w-100"></td>
                    <td style="width: 35%;"><div class="product-title">{{ $cart->product->name }}</div>  
                     <div class="product-subtitle">{{ $cart->user->store_name }}</div>  
                    </td>
                    
                    <td style="width: 35%;"><div class="product-title">{{ number_format ($cart->product->price) }}</div>  
                     <div class="product-subtitle">USD</div></td>

                     <td style="width: 25%;">
                      <form action="{{ route('cartdelete', $cart->id) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-remove-cart">
                       Remove
                     </button> 
                  </form>
                  </td>
                  </tr> 
                   @php
                    $totalprice+= $cart->product->price   
                  @endphp
                  @endforeach
                 
                </tbody>
              </table>
         </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
             <hr />
           </div>

           <div class="col-12" data-aos="fade-up" data-aos-delay="150">
             <h2 class="mb-4" style="margin-top: 50px">Shipping Details</h2>
          

             <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
              @csrf
              <input type="hidden" name="total_price" value="{{ $totalprice }}"> 
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
             <div class="col-md-6">
               <div class="form-group">
                 <label for="address_one">Address 1</label>
                 <input type="text" name="address_one" id="addressOne" class="form-control" value="Taman Kenari Jagorawi">
                 
               </div>
             </div>

             <div class="col-md-6">
               <div class="form-group">
                 <label for="address_two">Address 2</label>
                 <input type="text" name="address_two" id="addressOne" class="form-control" value="Taman Kenari Jagorawi">
                 
                 
               </div>
             </div>
             <div class="col-md-4">
               <div class="form-group">
                 <label for="provinces_id">Provinsi</label>
                 <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
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
                 <label for="zip_code">Post Code</label>
                 <input type="text" name="zip_code" id="postCode" class="form-control" value="16810">
                 
               </div>
             </div>

            

             <div class="col-md-6">
               <div class="form-group">
                 <label for="phone_number">Phone number</label>
                 <input type="text" name="phone_number" id="postCode" class="form-control" value="16810">
               </div>
             </div>

             </form>
              <div class="row" data-aos="fade-up" data-aos-delay="150">
             <hr />
           </div>

           <div class="col-12" data-aos="fade-up" data-aos-delay="150">
             <h2 class="mb-4">Payment Information</h2>


             <div class="row" data-aos="fade-up" data-aos-delay="150">

                <div class="col-4 col-md-2">
                  <div class="product-title">$</div>
                  <div class="product-subtitle">Pajak Kota</div>
                </div>
              

                <div class="col-4 col-md-3">
                  <div class="product-title">$</div>
                  <div class="product-subtitle">Pengiriman Ke Jakarta</div>
                </div>
              

                <div class="col-4 col-md-2">
                  <div class="product-title ">$</div>
                  <div class="product-subtitle ">Pajak Kota</div>
                </div>

                
                <div class="col-4 col-md-2">
                  <div class="product-title text-success">{{ number_format($totalprice ?? 0) }}</div>
                  <div class="product-subtitle text-success">Total Biaya</div>
                </div>

                <div class="col-8 col-md-3">
                  <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                    Check Out Now
                  </button>
                </div>
            

              </div>
              </div>

               
            

           

           
          
              
</div>
              </div>

              
     </section>
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