@extends('layouts.layout')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Product</h2>
          <p class="dashboard-subtitle">
            List Of Products
          </p>
        </div>

        </div>
      </div>

      <div class="dashboard-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
                                Tambah Product Baru
                        </a>

                        <div class="table-responsive">

                            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            {{-- <td>ID</td> --}}
                                            <td>Nama</td>
                                            <td>Pemilik</td>
                                            <td>Kategori</td>
                                            <td>Harga</td>
                                            <td>Aksi</td>
                                        </tr>
                                      
                                        <tbody>

                                        </tbody>
                                    </thead>

                            </table>
                        
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

@endsection
    <!-- Section Content -->


    <!-- Bootstrap core JavaScript -->
    @push('addon-script')
        <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax:{
                url:'{!! url()->current() !!}',
            },
            columns: [
                // {data:'id', name:'id'},
                { data: 'name', name:'name' },
                { data: 'user.name', name:'user.name'},
                { data: 'category.name', name:'category.name'},
                { data: 'price', name:'price'},
                
                {   
                    data:'action',
                    name:'action',
                    orderable:false,
                    searcable:false,
                    width:'15%'
                },
            ]
               
            
        })

        
    </script>
 

    @endpush
    