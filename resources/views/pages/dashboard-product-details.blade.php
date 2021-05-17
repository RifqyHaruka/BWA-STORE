@extends('layouts/dashboard')

@section('Judul')
    Product Details  
@endsection

@section('content')
   <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Kaki Haruka Magazine</h2>
          <p class="dashboard-subtitle">
            Product Details
          </p>
        </div>

        <div class="dashboard-content">
          <div class="row">
          <div class="col-12">
                @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <form action="{{ route('dashboard-product-update',$products->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
              <div class="card">
                <div class="card-body">
                  <div class="row ">
                      <div class="col-md-6">
                         <div class="form-group" >
                  <label>Product Name</label>
                  <input type="text"  class="form-control" value="{{ $products->name }}" name="name">
                </div>
               </div>

                  <div class="col-md-6">
                         <div class="form-group" >
                  <label>Price</label>
                  <input type="number"  class="form-control" value="{{ $products->price }}" name="price">
                </div>
               </div>

               <div class="col-md-12 mt-3">

                   <div class="form-group">
                  <label >Category</label>
                  <select name="categories_id" class="form-control">
                    <option value="{{ $products->categories_id }}">Tidak Diganti ( {{ $products->category->name }} )</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>    
                    @endforeach
                    
                  </select>
                </div>

                </div>

                 <div class="col-md-12 mt-3">
                        
                <div class="form-group" >
                  <label>Description</label>
                  <textarea id="editor" name="description">{!! $products->description !!}</textarea>
                </div>
                
                      </div>

                   
                       
                <div class="col-12  text-right">
                  <button class="btn btn-success px-4 btn-block" type="submit">
                   Update Data
                  </button>
                </div>
                </form>
              </div>

                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            @foreach ($products->galleries as $gallery)
                                 <div class="col-md-4">
                              <div class="gallery-container">
                              
                                <img src="{{ Storage::url($gallery->photo ?? '') }}" alt="" class="w-100" > 
                                <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                                  <img src="/images/btn-delete.png" alt="">
                                </a>
                              </div>
                            </div>
                            @endforeach
                           
                            <div class="col-12">

                              <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="products_id" value="{{ $products->id }}">
                                <input type="hidden" name="users_id" value="{{ $products->users_id }}">
                              <input type="file" id="file" style="display: none;" multiple name="photo" onchange="form.submit()" >
                              <button class="btn btn-secondary btn-block mt-3" onclick="thisFileUpload()" type="button">
                                Add Photo
                              </button>
                              </form>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
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