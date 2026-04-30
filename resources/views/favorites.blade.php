@extends('layout')

@section('title', 'Mis Favoritos')

@section('content')

<div class="container py-4">
   {{-- NAVBAR --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    {{-- LOGO --}}
    <div class="d-flex align-items-center">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 65px;">
        </a>
    </div>

    <h3 class="mb-4">Mis favoritos</h3>

    {{-- BOTONES --}}
    <div class="d-flex align-items-center">
        {{-- Corazón de Favoritos --}}
        <a href="{{ route('favorites.view') }}" class="no-style me-3">
            <span class="heart-icon {{ session('favorites') && count(session('favorites')) > 0 ? 'active' : '' }}">♡</span>
        </a>

        {{-- Perfil --}}
        <a href="#" class="me-3" data-bs-toggle="modal" data-bs-target="#adminLoginModal">
            <img src="{{ asset('images/navbar/perfil.svg') }}" alt="Usuario" style="width:24px;">
        </a>

        {{-- Carrito --}}
        <a href="#" class="me-3 position-relative">
            <img src="{{ asset('images/navbar/carrito.svg') }}" alt="Carrito" style="width:26px;">
            <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0
            </span>
        </a>

        {{-- Menu --}}
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
            <img src="{{ asset('images/navbar/menu.svg') }}" alt="Menu" style="width:26px;">
        </button>
    </div>
</div>

{{-- OVERLAY --}}
<div id="menuOverlay" class="menu-overlay" onclick="cerrarMenu()"></div>

{{-- MENÚ LATERAL --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menú</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h5 class="mb-4">Marcas</h5>
        <a href="{{ route('brands.products', 'Samsung') }}">Samsung</a>
        <a href="{{ route('brands.products', 'Xiaomi') }}">Xiaomi</a>
        <a href="{{ route('brands.products', 'Apple') }}">Apple</a>
        <a href="{{ route('brands.products', 'Realme') }}">Realme</a>
        <a href="{{ route('brands.products', 'Huawei') }}">Huawei</a>
        <a href="{{ route('brands.products', 'Motorola') }}">Motorola</a>
        <a href="{{ route('brands.products', 'Oppo') }}">Oppo</a>
    </div>
</div>

    {{-- Mostrar productos favoritos --}}
    <div class="row">
        @if(session('favorites') && count(session('favorites')) > 0)
            @foreach (session('favorites') as $id => $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ $item['image'] }}" class="card-img-top" alt="{{ $item['name'] }}" style="height: 200px; object-fit: contain;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['name'] }}</h5>
                            <p class="card-text">₡{{ number_format($item['price'], 0) }}</p>
                            <form action="{{ route('favorites.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No tienes productos en tus favoritos.</p>
        @endif
    </div>

</div>

@endsection