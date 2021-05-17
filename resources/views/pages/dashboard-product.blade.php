@extends('layouts/dashboard')

@section('Judul')
    My Products   
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">My Products</h2>
          <p class="dashboard-subtitle">
            Look,You Are a Nogizaka Family Now!
          </p>
        </div>

        <div class="dashboard-content">
            <div class="row">
              <div class="col-12">
                <a href="{{ route('create') }}" class="btn btn-success">
                    Add New Product
                </a>
              </div>
            </div>

            <div class="row mt-4">

              @foreach ($produks as $produk)
                   <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{route('dashboard-product-details',$produk->id)}}" class="card card-dashboard-product d-block">
                  <div class="card-body">
                    <img src="{{ Storage::url($produk->galleries->first()->photo) }}" alt="" class="w-50 mb-2">
                    <div class="product-title">
                      {{ $produk->name }}
                    </div>

                    <div class="product-subtitle">
                      {{ $produk->category->name }}
                    </div>

                  </div>
                </a>
              </div>
              @endforeach
             
            </div>
        </div>
      </div>

      

    </div>   
@endsection