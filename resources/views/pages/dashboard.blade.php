@extends('layouts.dashboard')

@section('Judul')
    Dashboard
@endsection

@section('content')

    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Dashboard</h2>
          <p class="dashboard-subtitle">
            Look,You Are a Nogizaka Family Now!
          </p>
        </div>

        <div class="dashboard-content">
          <div class="row">
            <div class="col-md-4">
              <div class="card mb-2">
                <div class="card-body">
                  <div class="dashboard-card-title">
                    Customer
                  </div>
                  <div class="dashboard-card-subtitle">
                    {{ number_format($customer) }}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-2">
                <div class="card-body">
                  <div class="dashboard-card-title">
                    Revenue
                  </div>
                  <div class="dashboard-card-subtitle">
                    {{ number_format($revenue) }}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-2">
                <div class="card-body">
                  <div class="dashboard-card-title">
                   Transactions
                  </div>
                  <div class="dashboard-card-subtitle">
                   {{number_format($transaction_count)}}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12 mt-2">
               <h5 class="mb-3">Recent Transaction</h5>

               @foreach ($transaction_data as $transaction)
                    <a href="{{ route('dashboard-transaction-details', $transaction->id) }}"
               class="card card-list d-block">

                  <div class="card-body">
                    <div class="row">
                     <div class="col-md-1">
                        <img src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}" class="w-75">
                     </div>
                     <div class="col-md-4">
                       {{ $transaction->produk->name ?? '' }}
                     </div>

                     <div class="col-md-3">
                        {{ $transaction->user->name ?? '' }}
                     </div>

                     <div class="col-md-3">
                     {{ $transaction->created_at ?? '' }}
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
@endsection

@push('addons-script')
    <script>
      $("#menu-toggle").click(function(e){
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });
    </script>
    <script src="/script/navbar-scroll.js"></script>
@endpush