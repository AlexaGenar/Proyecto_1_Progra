@extends('layout')

@section('title', 'Carrito')

@section('content')

<div class="container py-5">

    {{-- NAVBAR --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        {{-- LOGO --}}
        <div class="d-flex align-items-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 65px;">
            </a>
        </div>

        <h3 class="mb-4">Vista previa de la orden</h3>

        {{-- BOTONES --}}
        <div class="d-flex align-items-center">
            <a href="#" class="no-style">
                <span class="heart-icon me-3">♡</span>
            </a>
            <a href="#" class="me-3" data-bs-toggle="modal" data-bs-target="#adminLoginModal">
                <img src="{{ asset('images/navbar/perfil.svg') }}" alt="Usuario" style="width:24px;">
            </a>

            <a href="#" class="me-3 position-relative">
                <img src="{{ asset('images/navbar/carrito.svg') }}" alt="Carrito" style="width:26px;">
                <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ session()->get('cart') ? count(session()->get('cart')) : 0 }}
                </span>
            </a>
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

    {{-- Mostrar los productos del carrito --}}
    <div class="row">
        <div class="col-md-8">
            @if(session('cart') && count(session('cart')) > 0)
                <div id="cart-products">
                    @foreach (session('cart') as $id => $item)
                        <div class="d-flex justify-content-between align-items-center mb-4 p-3 border rounded shadow-sm">
                            <div class="d-flex align-items-center">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" style="width: 80px; height: auto; object-fit: cover;">
                                <span class="ms-3">{{ $item['name'] }}</span>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <span class="d-block text-muted">₡{{ number_format($item['price'], 0) }} por unidad</span>
                                <span class="d-block">Cantidad: {{ $item['quantity'] }}</span>
                                <hr class="my-2">
                                <strong class="d-block">Total: ₡{{ number_format($item['price'] * $item['quantity'], 0) }}</strong>
                            </div>
                            <div class="ms-3">
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">Eliminar</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No tienes productos en tu carrito.</p>
            @endif
        </div>

        {{-- Resumen del carrito --}}
        <div class="col-md-4">
            <div class="border p-4 rounded shadow-sm">
                <h5>Resumen</h5>
                <div class="d-flex justify-content-between mt-3">
                    <span>Subtotal</span>
                    <strong id="subtotal">₡{{ number_format($subtotal, 0) }}</strong>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span>Impuestos</span>
                    <strong id="taxes">₡{{ number_format($taxes, 0) }}</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong id="total">₡{{ number_format($total, 0) }}</strong>
                </div>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark w-100 mt-4">Finalizar compra</button>
                </form>
                <a href="{{ url('/') }}" class="btn btn-link w-100 mt-2">Seguir comprando</a>
            </div>
        </div>
    </div>

</div>

@endsection