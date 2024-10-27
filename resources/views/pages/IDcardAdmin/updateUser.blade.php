@if(Auth::user()->role === 'idcardadmin')
@extends('layout.idcardadminlayout')
@elseif(Auth::user()->role === 'mainadmin')
@endif


@section('updateuser')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Update User</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('idcard-admin-panel.updateUser',['user' => $users->id])  }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" value="{{ $users->name }}" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required value="{{ $users->password }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="button" id="togglePassword">
                                        Show
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div> -->
                        <!-- <div class="form-group mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <select class="form-control" id="role" name="role">
                              <option value="none" selected disable>--Select User Role--</option>
                                <option value="itservicesadmin">IT Services Admin</option>
                                <option value="idcardadmin">ID Card Admin</option>
                                <option value="resultadmin">Result Admin</option>
                            </select>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Update Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const toggleButton = this;

            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the button text
            toggleButton.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    </script>
@endsection