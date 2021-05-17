@extends('layouts.layout')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Transaction</h2>
          <p class="dashboard-subtitle">
            Edit Product
          </p>
        </div>

        </div>
      </div>

      <div class="dashboard-content">
          <div class="row">
              <div class="col-md-12">
                  @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  <div class="card">
                      <div class="card-body">
                          <form action="{{ route("transaction.update",$item->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                       

                                        <div class="form-group">
                                            <label for="">Transaction Status</label>
                                           
                                           <select name="transaction_status" class="form-control">
                                               <option value="{{ $item->transaction_status  }}" selected>{{ $item->transaction_status }}</option>
                                               <option value="SHIPPING">SHIPPING</option>
                                               <option value="SUCCESS">SUCCESS</option> 

                                             
                                               
                                           </select>
                                            
                                        </div>

                                          

                                        <div class="form-group">
                                            <label for="">Harga</label>
                                            <input type="number" name="price" id="" class="form-control" value="{{ $item->total_price}}">
                                        </div>

                                       
                                        
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">Save Now</button>
                                    </div>
                                </div>

                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

@endsection
    <!-- Section Content -->

    
@push('addon-script')
 <script src= "https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js" >
    
 </script>
 
 <script>
       CKEDITOR.replace( 'editor' );
 </script>
 @endpush

