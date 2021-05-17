@extends('layouts.app')

@section('title')

    Store Details Page
    
@endsection

@section('content')
 <!-- Page Content -->
    <div class="page-details" style="margin-top: 120px">
      <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb ">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                  </li>

                  <li class="breadcrumb-item active">
                    Product Details
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-gallery" id="gallery">
      <div class="container ">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8 d-flex justify-content-center" style="margin-right: -50px" data-aos="zoom-in">
            <transition name="slide-fade" mode="out-in">
              <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" alt="" class="w-50 main-image">
            </transition>
          </div>
         
          <div class="col-lg-2">
            <div class="row">
              <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo,index) in photos" :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                  <a href="#" @click="changeActive(index)">
                    <img :src="photo.url" alt="" class="w-50 thumbnail-image" :class="{active: index == activePhoto}">
                      <!-- {active: index == activePhotos} kalau true maka kelas active otomatis terbuat  -->
                  </a>
              </div>
            </div>
          </div>
          
         
        </div>

        {{-- <div class="row mt-4">
          <div class="container">
            
        </div> --}}
          
        </div>
      </div>
    </section>

    <div class="store-details-container" data-aos="fade-up" style="margin-top:80px ">
      <section class="store-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" style="margin-right: 35px">
              <h1>{{ $products->name }}</h1>
              <div class="owner">By {{ $products->user->store_name }}</div>
              <div class="price">$ {{ number_format($products->price) }}</div>
            </div>
            <div class="col-lg-2" data-aos="zoom-in" >
              @auth
              <form action="{{ route('details-addtocart', $products->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button href="" class="btn btn-success px-4 text-white btn-block mb-3" type="submit">
                  Add to Cart
                </button>
              </form>
               
               @else  
               <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                  Sign In To Add to Cart
                </a> 
              @endauth
               

              </div>
          </div>
        </div>
      </section>

      <section class="store-description">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8">
             {!! $products->description !!}
            </div>
          </div>
        </div>
      </section>

      <section class="store-review">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mt-3 mb-3">
              <h5>Customer Review (3)</h5>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-lg-8">
              <ul class="list-unstyled">
                <li class="media">
                  <img src="/images/HayakawaRounded.png" alt="" class="mr-3 rounded-circle">
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">
                      Hayakawa Seira
                    </h5>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-lg-8">
              <ul class="list-unstyled">
                <li class="media">
                  <img src="/images/picRounded.png" alt="" class="mr-3 rounded-circle">
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">
                      Hayakawa Seira
                    </h5>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-lg-8">
              <ul class="list-unstyled">
                <li class="media">
                  <img src="/images/TsusuiRounded.png" alt="" class="mr-3 rounded-circle">
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">
                      Tsusui Ayame
                    </h5>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
    </div>



    </div>
    
@endsection

@push('addon-script')
     <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el:"#gallery",
        // Elemen dengan Id gallery dihandle dengan vue js
        mounted(){
          AOS.init();
          //mounted adalah Script yang akan dijalankan saat muncul
        },
        data:{
          activePhoto:0, //Ini adalah id gambar
          photos:[

          @foreach($products->galleries as $gallery)
             {
                id:{{ $gallery->id }},
                url:"{{ Storage::url($gallery->photo) }}",
              },
          @endforeach    
          ],
        },

        methods:{
          changeActive(id){
            this.activePhoto = id;
          }
        }

      }
        
        
      )
    </script>
    <script src="/script/navbar-scroll.js"></script>
@endpush