@extends('layouts.admin')

@section('header', 'Dashboard Admin')

@section('content')
<div class="row">
    <!-- Stat Cards -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total_registrants'] }}</h3>
                <p>Pendaftar PPDB</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <a href="{{ route('admin.ppdb.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['registrants_accepted'] }}</h3>
                <p>Siswa Diterima</p>
            </div>
            <div class="icon">
                <i class="fas fa-check"></i>
            </div>
            <a href="{{ route('admin.ppdb.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-purple"> <!-- AdminLTE might not have bg-purple by default, usually warning/danger/primary/secondary. Falling back to primary or custom style if needed, let's use warning for contrast -->
            <div class="inner" style="color: white !important;">
                <h3>{{ $stats['active_voting'] }}</h3>
                <p>Voting Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-vote-yea"></i>
            </div>
            <a href="{{ route('admin.voting.index') }}" class="small-box-footer" style="color: white !important;">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
         <style>.bg-purple { background-color: #6f42c1 !important; color: white; }</style>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['total_articles'] }}</h3>
                <p>Artikel Published</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <a href="{{ route('admin.articles.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<h5 class="mb-2">Data Master</h5>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{ $stats['total_students'] }}</h3>
                <p>Total Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate text-primary"></i>
            </div>
            <a href="{{ route('admin.students.index') }}" class="small-box-footer text-primary">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{ $stats['total_teachers'] }}</h3>
                <p>Total Guru</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher text-success"></i>
            </div>
            <a href="{{ route('admin.teachers.index') }}" class="small-box-footer text-success">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{ $stats['total_committees'] }}</h3>
                <p>Total Panitia</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie text-secondary"></i>
            </div>
            <a href="{{ route('admin.committees.index') }}" class="small-box-footer text-secondary">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{ $stats['total_classrooms'] }}</h3>
                <p>Total Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-school text-warning"></i>
            </div>
            <a href="{{ route('admin.classrooms.index') }}" class="small-box-footer text-warning">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Akses Cepat</h3>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-center">
                     <a href="{{ route('admin.students.index') }}" class="btn btn-app">
                        <i class="fas fa-user-graduate"></i> Data Siswa
                     </a>
                     <a href="{{ route('admin.teachers.index') }}" class="btn btn-app">
                        <i class="fas fa-chalkboard-teacher"></i> Data Guru
                     </a>
                     <a href="{{ route('admin.voting.create') }}" class="btn btn-app">
                        <i class="fas fa-vote-yea"></i> Buat Voting
                     </a>
                     <a href="{{ route('admin.articles.create') }}" class="btn btn-app">
                        <i class="fas fa-edit"></i> Tulis Artikel
                     </a>
                     <a href="{{ route('admin.ppdb.index') }}" class="btn btn-app">
                        <i class="fas fa-users"></i> Cek Pendaftar
                     </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
