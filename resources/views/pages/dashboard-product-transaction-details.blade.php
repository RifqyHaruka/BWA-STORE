@extends('layouts/dashboard')

@section('Judul')
   Transaction Details
@endsection

@section('content')
      <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">{{ $transactiondetail->code }}</h2>
          <p class="dashboard-subtitle">
            Transcations Details
          </p>
        </div>

        <div class="dashboard-content" id="TransactionDetails">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-md-4">
                        <img src="{{ Storage::url($transactiondetail->product->galleries->first()->photo ?? '') }}" alt="" class="w-75 mb-3" >
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="product-title">
                              Customer Name
                            </div>
                            <p class="product-subtitle">
                              {{$transactiondetail->transaction->user->name }}
                            </p>
                          </div>

                          <div class="col-12 col-md-6 ">
                            <div class="product-title">
                            Product Name
                            </div>
                            <p class="product-subtitle">
                              {{$transactiondetail->product->name}}
                            </p>
                          </div>

                           <div class="col-12 col-md-6 bungkus">
                            <div class="product-title">
                             Date of Transaction
                            </div>
                            <p class="product-subtitle">
                            {{$transactiondetail->created_at}}
                            </p>
                          </div>

                          <div class="col-12 col-md-6 bungkus">
                            <div class="product-title">
                              Status
                            </div>
                            <p class="product-subtitle text-danger">
                             {{ $transactiondetail->transaction->transaction_status}}
                            </p>
                          </div>

                          <div class="col-12 col-md-6 bungkus">
                            <div class="product-title">
                            Total Amount
                            </div>
                            <p class="product-subtitle">
                              {{ number_format($transactiondetail->transaction->total_price) }}
                            </p>
                          </div>

                          <div class="col-12 col-md-6 bungkus">
                            <div class="product-title">
                              Mobile 
                            </div>
                            <p class="product-subtitle">
                              {{ $transactiondetail->transaction->user->phonme_number }}
                            </p>
                          </div>

                          
                         
                        </div>
                      
                      </div>

                      
                    </div>
                  <form action="{{ route('dashboard-transaction-update',$transactiondetail->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    <div class="row">
                      <div class="col-12 mt-4">
                        <h5>
                          Shipping Information
                        </h5>
                         <div class="col-12">
                           
                              <div class="row">
                            <div class="col-12 col-md-4">
                            <div class="product-title">
                              Address I
                            </div>
                            <p class="product-subtitle">
                              {{ $transactiondetail->transaction->user->address_one }}
                            </p>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="product-title">
                              Address II 
                            </div>
                            <p class="product-subtitle">
                              {{ $transactiondetail->transaction->user->address_two }}
                            </p>
                          </div>

                          <div class="col-12">
                          <div class="row">
                            <div class="col-12 col-md-4">
                            <div class="product-title">
                              Provinsi
                            </div>
                            <p class="product-subtitle">
                              {{ App\Models\Province::find($transactiondetail->transaction->user->provinces_id)->name ?? '' }}
                            </p>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="product-title">
                              City
                            </div>
                            <p class="product-subtitle">
                              {{ App\Models\Regency::find($transactiondetail->transaction->user->regencies_id)->name ?? '' }}
                            </p>
                          </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row">
                            <div class="col-12 col-md-4">
                            <div class="product-title">
                             Postal Code
                            </div>
                            <p class="product-subtitle">
                             {{ $transactiondetail->transaction->user->zip_code }}
                            </p>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="product-title">
                              Country
                            </div>
                            <p class="product-subtitle">
                             Indonesia
                            </p>
                          </div>

                          <div class="col-12 col-md-3 bungkus">
                            <div class="product-title">
                              Status
                            </div>
                           <select name="shipping_status" id="status" class="form-control"
                           v-model="status">
                           <option value="UNPAID">Unpaid</option>
                           <option value="PENDING">Pending</option>
                           <option value="SHIPPING">Shipping</option>
                           <option value="SUCCESS">Success</option>
                          </select>
                          </div>

                          <template v-if="status=='SHIPPING'">
                            <div class="col-md-3 bungkus">
                              <div class="product-title">
                                Input Resi
                              </div>
                              <input type="text" class="form-control" name="resi" v-model="resi">
                            </div>
                            <div class="col-md-2 bungkus">
                              <button type="submit" class="btn btn-success btn-block mt-4">Update Resi</button>
                            </div>

                          </template>

                        </div>
                          </div>
                        </div>

                        
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12 text-right bungkus">
                        <button type="submit" class="btn btn-success mt-4">Save Now</button>
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
          status : "{{ $transactiondetail->shipping_status }}",
          resi : "{{ $transactiondetail->resi }}"
        }
      });

    </script>
@endpush