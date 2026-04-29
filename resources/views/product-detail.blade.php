@extends('layout')

@section('title', $product->name)

@section('content')

<div class="container py-5">

   {{-- NAVBAR --}}
<div class="d-flex align-items-center justify-content-between mb-4">

    {{-- LOGO --}}
    <div   class="d-flex align-items-center">
        <a href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 65px;">
    </div>

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


    <div class="row justify-content-center align-items-start">

        {{-- IMAGEN --}}
        <div class="col-md-5 mb-4">
            <div class="border rounded d-flex align-items-center justify-content-center p-4"
                 style="min-height: 430px;">
                <img 
                    src="{{ $product->image }}" 
                    alt="{{ $product->name }}" 
                    class="img-fluid"
                    style="max-height: 380px; object-fit: contain;"
                >
            </div>
        </div>

        {{-- INFORMACIÓN --}}
        <div class="col-md-5 mb-4">
            <div class="border rounded p-4 h-100">

                <h3 class="fw-bold mb-3">{{ $product->name }}</h3>

                <h4 class="text-primary fw-bold mb-4">
                    ₡{{ number_format($product->price, 0) }}
                </h4>

                <p class="text-muted">
                    {{ $product->description }}
                </p>

                <hr>

                <h6 class="fw-bold mb-3">Características</h6>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item px-0">
                        <strong>Marca:</strong> {{ $product->brand }}
                    </li>

                    <li class="list-group-item px-0">
                        <strong>RAM:</strong> {{ $product->ram }}
                    </li>

                    <li class="list-group-item px-0">
                        <strong>Almacenamiento:</strong> {{ $product->storage }}
                    </li>

                    <li class="list-group-item px-0">
                        <strong>Sistema operativo:</strong> {{ $product->operating_system }}
                    </li>

                    <li class="list-group-item px-0">
                        <strong>Categoría:</strong> {{ $product->category->name ?? 'Sin categoría' }}
                    </li>
                </ul>

                {{-- ACCIONES --}}
                <div class="d-flex align-items-center gap-2 mb-4">
                   {{-- BOTÓN MENOS --}}
    <button type="button" class="btn btn-outline-secondary" onclick="decrementar()">-</button>

    {{-- INPUT --}}
    <input 
        type="number" 
        id="cantidad" 
        class="form-control text-center" 
        value="1" 
        min="1" 
        style="width: 70px;"
    >

    {{-- BOTÓN MÁS --}}
    <button type="button" class="btn btn-outline-secondary" onclick="incrementar()">+</button>

    {{-- CARRITO --}}
  
    <a href="#" class="ms-2" onclick="agregarAlCarrito({{ $product->id }}); mostrarModalCarrito();">
    <img src="{{ asset('images/navbar/carrito.svg') }}" alt="Carrito" style="width:26px;">
</a>

    {{-- COMPRAR --}}
    <button class="btn btn-dark ms-2">
        Comprar
    </button>

</div>

                <a href="#"class="text-decoration-none text-dark">
                    ♡ Añadir a favoritos
                </a>

            </div>
        </div>

    </div>

</div>

@endsection

{{-- MODAL PRODUCTO AGREGADO --}}
<div class="modal fade" id="productoAgregadoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4" style="border-radius: 12px;">

            <div class="mb-3">
                <svg width="55" height="55" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="12" fill="#28a745"/>
                    <path d="M7 12.5L10.5 16L17 9.5" 
                          stroke="white" 
                          stroke-width="2.5" 
                          stroke-linecap="round" 
                          stroke-linejoin="round"/>
                </svg>
            </div>

            <h5 class="fw-bold mb-2">Producto agregado</h5>

            <p class="text-muted mb-4">
                El producto fue agregado al carrito correctamente.
            </p>

            <div class="d-grid gap-2">
                <a href="#" class="btn btn-dark">
                    Ver carrito
                </a>

                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Seguir comprando
                </button>
            </div>

        </div>
    </div>
</div>