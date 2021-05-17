@extends('layouts.app')

@section('Title')
    Store Home Page
@endsection

@section('content')

<div class="page-content page-home">
        <section class="store-carousel pt-4">
            <div class="container">
              <div class="row">
                <div class="col-12" data-aos="zoom-in">
                  <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li class="active" 
                      data-target="#storeCarousel"
                      data-slide-to="0"></li>
                      <li  
                      data-target="#storeCarousel"
                      data-slide-to="1"></li>
                      <li
                      data-target="#storeCarousel"
                      data-slide-to="2"></li>
                    </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/images/HaloweenHaruka1.jpeg" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="/images/HaloweenHaruka2.jpeg" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="images/Ayameme.jpeg" class="d-block w-100" alt="...">
                          </div>
                        </div>

                        <a class="carousel-control-prev" href="#storeCarousel" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#storeCarousel" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>

                        </div>
                      </div>
                  </div>
                </div>
             
            </div>
        </section>

        <section class="store-trend-categories mt-5">
          <div class="container">
            <div class="row">
              <div class="col-12" data-aos="fade-up">
                <h5>Trend Categories</h5>
              </div>
            </div>

            <div class="row">
                @php $incrementCategory = 0 @endphp
                @forelse ($categories as $category)
                    <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $incrementCategory+=100 }}">
                  <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                    <div class="categories-image">
                      <img src="{{ Storage::url($category->photo) }}" alt=""class="w-100"> 
                      
                      {{-- Manggilnya gabisa langsung harus lewat storage kalau photo --}}
                      <p class="categories-text">{{ $category->name }}</p>
                    </div>
                  </a>
                </div>
                @empty
                    <div class="col-12 text-center py-5" 
                    data-aos="fade-up"
                    data-aos-delay="100">
                      No Categories Yet
                    </div>
                @endforelse ($categories as $category)   

            </div>
          </div>
        </section>

        <section class="store-new-products mt-5">
          <div class="container">
            <div class="row">
              <div class="col-12 " data-aos="fade-up">
                <h5>New Products</h5>
              </div>
            </div>
<div class="row">
  @php
    $incrementCategory=0
  @endphp
  @foreach ($products as $product)
       <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementCategory+=100 }}">
                  <a href="{{route('details',$product->slug)  }}" class="component-products d-block">
                    <div class="products-thumbnail">
                        <div class="products-image" style="
                        @if($product->galleries)
                          background-image:url('{{ Storage::url($product->galleries->first()->photo) }}')
                        @else
                          background-color:#eee
                        @endif
                        
                        ">

                        </div>
                    </div>
                  
                    <div class="products-text">
                      {{ $product->name }}
                    </div>

                    <div class="products-price">
                      {{ $product->price }}
                    </div>
                  </a>
            </div> 
  @endforeach
                      
            </div>
          </div>
        </section>

    </div>
    </div>
    
@endsection

