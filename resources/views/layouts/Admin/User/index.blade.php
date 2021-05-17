@extends('layouts.layout')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">User</h2>
          <p class="dashboard-subtitle">
            List Of Users
          </p>
        </div>

        </div>
      </div>

      <div class="dashboard-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
                                Tambah User Baru
                        </a>

                        <div class="table-responsive">

                            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                         
                                            <td>Nama</td>
                                            <td>Email</td>
                                            <td>Roles</td>
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
                // { data: 'id', name:'id' }
                { data: 'name', name:'name' },
                { data: 'email', name:'email'},
                { data: 'roles', name:'roles' },
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
    