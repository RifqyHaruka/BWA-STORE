@extends('layouts.layout')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">User</h2>
          <p class="dashboard-subtitle">
            Edit User
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
                          <form action="{{ route("user.update",$user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama User</label>
                                            <input type="text" name="name" id="" class="form-control" value="{{ $user->name }}">
                                        </div>

                                        
                                    </div>

                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" id="" class="form-control" value="{{ $user->email}}">
                                        </div>

                                        
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="passsword" name="passsword" id="" class="form-control">
                                        </div>

                                        
                                    </div>

                                       <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Roles</label>
                                           <select name="roles" id="" class="form-control" {{ $user->roles }}>
                                             <option value="ADMIN">ADMIN</option>
                                             <option value="USER">USER</option>
                                           </select>
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

    
      
