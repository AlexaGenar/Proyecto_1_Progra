@extends('layout')

@section('title', 'Favoritos')

@section('content')

<div class="container py-4">
 {{-- NAVBAR --}}
<div class="d-flex align-items-center justify-content-between mb-4">

    {{-- LOGO --}}
    <div   class="d-flex align-items-center">
        <a href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 65px;">
     </a>
    </div>

  <h3 class="mb-4">Mis favoritos</h3>

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
        0
    </span>
</a>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                <img src="{{ asset('images/navbar/menu.svg') }}" alt="Menu" style="width:26px;">
            </button>

    </div>

</div>

{{-- OVERLAY --}}
<div id="menuOverlay" class="menu-overlay" onclick="cerrarMenu()"></div>

   {{-- MENÚ LATERAL--}}
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


    <div class="row" id="favorites-container"></div>

</div>

<script>
let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];

let productos = @json($products);

let container = document.getElementById('favorites-container');

let filtrados = productos.filter(p => favoritos.includes(p.id));

if (filtrados.length === 0) {
    container.innerHTML = `<div class="alert alert-warning">No tienes favoritos</div>`;
} else {
    filtrados.forEach(product => {
        container.innerHTML += `
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="${product.image}" class="card-img-top p-3" style="height:180px; object-fit:contain;">
                    <div class="card-body">
                        <h6>${product.name}</h6>
                        <p>${product.brand}</p>
                        <p>₡${product.price}</p>
                    </div>
                </div>
            </div>
        `;
    });
}
</script>

@endsection