@extends('layouts/dashboard')

@section('Judul')
    Product Add
@endsection

@section('content')
      <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Create New Products</h2>
          <p class="dashboard-subtitle">
            Look,You Are a Nogizaka Family Now!
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
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                       @csrf
              <div class="card">
                <div class="card-body">
                  <div class="row ">
                      <div class="col-md-6">
                         <div class="form-group">
                   <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                  <label>Product Name</label>
                  <input type="text"  class="form-control" name="name" >
                </div>
               </div>

                  <div class="col-md-6">
                         <div class="form-group">
                  <label>Price</label>
                  <input type="number"  class="form-control" name="price">
                </div>
               </div>

               <div class="col-md-12 mt-3">

                   <div class="form-group">
                  <label >Category</label>
                  <select name="categories_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    
                  </select>
                </div>

                </div>

                 <div class="col-md-12 mt-3">
                        
                <div class="form-group" >
                  <label>Description</label>
                  <textarea id="editor" name="description"></textarea>
                </div>
                
                      </div>

                      <div class="col-md-12 mt-3">
                        
                <div class="form-group" >

                  <label>Thumbnail</label>
                  <input type="file" name="photo" class="form-control" >
                </div>
                <p class="text-muted">Kamu dapat Memilih lebih dari satu</p>
                      </div>

                      

                  </div>

                   <div class="row mt-4 ">
                <div class="col-12  text-right">
                  <button class="btn btn-success px-4" type="submit">
                    Save Now
                  </button>
                  
                </div>
              </div>
              </form>

            

                  
                </div>
              </div>
           
          </div>
        </divs>
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