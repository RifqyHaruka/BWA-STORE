@extends('layouts/dashboard')

@section('Judul')
   Transaction
@endsection

@section('content')
     <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Transaction</h2>
          <p class="dashboard-subtitle">
            Look,You Are a Nogizaka Family Now!
          </p>
        </div>

        <div class="dashboard-content">
          

          <div class="row mt-3">
            <div class="col-12 mt-2">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Sells Product</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Buy Product</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      @foreach ($selltransaction as $sell)
          <a href="{{ route('dashboard-transaction-details', $sell) }}"
               class="card card-list d-block">
              
                  <div class="card-body">
                    <div class="row">
                     <div class="col-md-1">
                        <img src="{{ Storage::url($sell->product->galleries->first()->photo ?? '') }}" alt="" class="w-50">
                     </div>
                     <div class="col-md-4">
                       {{ $sell->product->name }}
                     </div>

                     <div class="col-md-3">
                      {{ $sell->product->user->store_name }} 
                      {{-- user adalah nama function relasi yang di buat di model --}}
                     </div>

                     <div class="col-md-3">
                       {{ $sell->product->user->created_at }} 
                     </div>

                     <div class="col-md-1 d-none d-md-block">
                       <img src="/images/arrow.svg" alt="">
                     </div>
                     
                    </div>

                    
                  </div>
                    </a>
      @endforeach
    

                    
                  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    @foreach ($buytransaction as $buy)
         <a href="{{ route('dashboard-transaction-details', $buy->id) }}"
               class="card card-list d-block">
                  <div class="card-body">
                    <div class="row">
                     <div class="col-md-1">
                        <img src="{{ Storage::url($buy->product->galleries->first()->photo ?? '') }}" alt="" class="w-50">
                     </div>
                     <div class="col-md-4">
                       {{ $buy->product->name }}
                     </div>

                     <div class="col-md-3">
                       {{ $buy->product->user->store_name }}
                     </div>

                     <div class="col-md-3">
                       {{ $buy->product->user->created_at }}
                     </div>

                     <div class="col-md-1 d-none d-md-block">
                       <img src="/images/arrow.svg" alt="">
                     </div>



                     
                    </div>

                    
                  </div>
                    </a>
    @endforeach
   
                  </div>
  
</div>
               

                  
                  
            
            </div>
          </div>
        </div>
      </div>

      

    </div> 
@endsection

@push('addon-script')
       <script src="/script/navbar-scroll.js"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
    function thisFileUpload(){
       document.getElementById('file').click();
     }
    </script>
    <script>
                        CKEDITOR.replace( 'editor' );
                </script>
@endpush