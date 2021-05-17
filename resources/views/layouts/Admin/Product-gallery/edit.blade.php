@extends('layouts.layout')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Product</h2>
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
                          <form action="{{ route("product.update",$product->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Product</label>
                                            <input type="text" name="name" id="" class="form-control" value="{{ $product->name }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Nama Pemilik</label>
                                           
                                           <select name="users_id" class="form-control">
                                               <option value="{{ $product->users_id }}" selected>{{ $product->user->name }}</option>
                                               @foreach ($users as $user)
                                               <option value="{{ $user->id }}">{{  $user->name }}</option>    
                                               @endforeach
                                               
                                           </select>
                                            
                                        </div>

                                          <div class="form-group">
                                            <label for="">Kategori</label>
                                           
                                          <select name="categories_id" class="form-control">
                                              <option value="{{ $product->categories_id }}">{{ $product->category->name }}</option>
                                               @foreach ($categories as $category)
                                               <option value="{{ $category->id }}">{{  $category->name }}</option>    
                                               @endforeach
                                               
                                           </select>
                                            
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="">Harga</label>
                                            <input type="number" name="price" id="" class="form-control" value="{{ $product->price }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Deskripsi</label>
                                            <textarea name= "description" id="editor">{{ $product->description }}</textarea>
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

