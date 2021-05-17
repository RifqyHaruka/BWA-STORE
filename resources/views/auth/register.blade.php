@extends('layouts.auth')

@section('content')

 <div class="page-content page-auth" id="register" style="">
      <div class="section-store-auth" data-aos="fade-up"> 
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">

            <div class="col-lg-5">
              <h2>Belanja Kebutuhan Nogi,Lebih Mudah</h2>
                <form method="POST" action="{{ route('register') }}" class="mt-3">
                        @csrf

                 <div class="form-group">
                  <label for="FullName">FullName</label>
                  {{-- <input type="text" id="FullName" class="form-control is-valid" v-model="name" autofocus> --}}
                  <input id="name" type="text" 
                  class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" 
                   required autocomplete="name" 
                   autofocus id="FullName"
                    v-model="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

                <div class="form-group">
                  <label for="Email Address">Email Address</label>
                  {{-- <input type="email" id="Email Adress" class="form-control is-invalid" v-model="email"> --}}
                  <input id="email"
                  type="email" 
                  class="form-control @error('email') is-invalid @enderror" 
                  name="email" value="{{ old('email') }}" 
                  required autocomplete="email"
                  v-model="email"
                  @change="checkForEmailAvailablity()"
                  :class="{'is-invalid' : this.email_unavailable }">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

                 <div class="form-group">
                  <label for="password">Password</label>
                  {{-- <input type="password" id="password" class="form-control is-invalid" v-model="password"> --}}
                  <input id="password" 
                  type="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  name="password" required autocomplete="new-password" 
                  >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                
                <div class="form-group">
                  <label for="password-confirmation">Password Confirm</label>
                  {{-- <input type="password" id="password" class="form-control is-invalid" v-model="password"> --}}
                   <input id="password-confirmation" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                   @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
<div class="form-group">
                  <label for="" class="mt-2">Store</label>
                  <p class="text-muted">
                    Apakah Anda Juga Ingin Membuka Toko
                  </p>

                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" 
                      class="custom-control-input" 
                      name="is_store_open" 
                      id="openStoreTrue" 
                      v-model="is_store_open" 
                      :value="true">

                      <label for="openStoreTrue" class="custom-control-label">
                        Iya,Boleh
                      </label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" 
                      class="custom-control-input" 
                      name="is_store_open" 
                      id="openStoreFalse" 
                      v-model="is_store_open" 
                      :value="false">

                      <label for="openStoreFalse" class="custom-control-label">
                        Ga,Makasih
                      </label>
                    </div>
                </div>

                <div class="form-group" v-if="is_store_open">
                  <label >Nama Toko</label>
                  <input type="text"
                  v-model="store_name"
                  id="store_name"
                  class="form-control  @error('store_name') is-invalid @enderror"
                  name="store_name" required autocomplete autofocus>

                   @error('store_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

                 <div class="form-group" v-if="is_store_open">
                  <label >Kategori</label>
                  <select name="categories_id" class="form-control">
                    <option value="" disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-success btn-block  mt-4"
                  :disable="this.email_unavailable" >
                    Sign Up Now
                  </button>

                  <a href="{{ route('login') }}" class="btn btn-signup  btn-block mt-2">
                   Back To Sign In
                </a>
                </div>
                
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
                          
                </div>


                

<div class="container" style="display: none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    

@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
     <script src="https://unpkg.com/vue-toasted"></script>
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script>Vue.use(Toasted);

     var register = new Vue({
       el:'#register',
       mounted(){
         AOS.init();
      
       },
       methods: {
          checkForEmailAvailablity : function(){
              var self = this; //biar bisa dipake didalma axios
              axios.get('{{ route('api-register-check') }}',{
                params: {
                  email:this.email
                }
              })
          .then(function (response) {
            if(response.data=='Available') {
            self.$toasted.show(
           "Email Anda tersedia",
           {
             position : "top-center",
             className:'rounded',
             duration:1000,
           }
         );
         self.email_unavailable = false;
            }

            else {
          self.$toasted.error(
           "Maaf, Anda sudah terdaftar pada situs kami.",
           {
             position : "top-center",
             className:'rounded',
             duration:1000,
           }
         );
         self.email_unavailable=true;
            }
            // handle success
            // console.log(response);
          });
        

          }
       },
       data(){
         return{
              name:"Rifqy Adli Damhuri",
              email:"rifqyHaruka@gmail.com",
              is_store_open:true,
              store_name:"",
              email_unavailable:false
         }
     
       }
     })
    </script>
@endpush
