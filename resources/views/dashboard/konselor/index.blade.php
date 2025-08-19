@extends('layout.app')
@section('title', 'Dashboard')
@section('content')
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="">
            <h1 class="page-title fw-semibold fs-20 mb-0">
                Dashboard
            </h1>
            <div class="">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{-- Banner Sambutan --}}
    <div class="row">
        <div class="col-12">
            <div class="p-4 rounded bg-primary text-white mb-4">
                <h2 class="text-white">Selamat datang, {{ auth()->user()->name }}!</h2>
                <p>Semoga harimu menyenangkan dan penuh produktivitas.</p>
            </div>

        </div>
    </div>

@endsection
