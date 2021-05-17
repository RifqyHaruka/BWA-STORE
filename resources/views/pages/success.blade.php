@extends('layouts.success')

@section('title')

    Store Details Page
    
@endsection

@section('content')
 
       <div class="page-content page-success">
      <section class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-item-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/images/cd success.svg" alt="" />

              <h2 class="mt-4">Transaction Success</h2>
              <p class="mt-2">
                Selamat kamu sudah berhasil membeli meerchandise nogizaka,dan
                telah menjadi pecinta nogizaka sejati
              </p>

              <div>
                <a href="/" class="btn btn-success w-50 mt-4">
                  My Dashboard
                </a>
                <a href="/categories" class="btn btn-signup w-50 mt-2">
                  Lanjut Belanja
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection

