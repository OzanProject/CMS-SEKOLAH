@extends('layouts.admin')

@section('header', 'Edit Profil')

@section('content')
<div class="row">
    <!-- Update Profile Information -->
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Informasi Profil</h3>
            </div>
            <form method="post" action="{{ route('profile.update') }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('patch')
                
                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($user->photo)
                            <img src="{{ asset('storage/'.$user->photo) }}" class="profile-user-img img-fluid img-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="User profile picture">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="photo" class="col-sm-3 col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo" name="photo">
                                <label class="custom-file-label" for="photo">Pilih file...</label>
                            </div>
                             @error('photo')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Profil</button>
                    @if (session('status') === 'profile-updated')
                        <span class="text-success ml-3 fade-out">Tersimpan.</span>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Update Password -->
    <div class="col-md-6">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
            </div>
             <form method="post" action="{{ route('password.update') }}" class="form-horizontal">
                @csrf
                @method('put')

                <div class="card-body">
                    <div class="form-group row">
                        <label for="current_password" class="col-sm-4 col-form-label">Password Saat Ini</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password">
                             @error('current_password')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password Baru</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                             @error('password')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                             @error('password_confirmation')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-danger">Simpan Password</button>
                     @if (session('status') === 'password-updated')
                        <span class="text-success ml-3 fade-out">Tersimpan.</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
