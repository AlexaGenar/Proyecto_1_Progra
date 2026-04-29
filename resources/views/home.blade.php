@extends('layout')

@section('title', 'Inicio - Tienda de Celulares')

@section('content')

<div class="container py-4">

 {{-- NAVBAR --}}
<div class="d-flex align-items-center justify-content-between mb-4">

    {{-- LOGO --}}
    <div class="d-flex align-items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 65px;">
    </div>

    {{-- BUSCADOR --}}
    <div style="width: 55%;">
        <form method="GET" action="/" class="d-flex">
            <input 
                type="text" 
                name="search" 
                class="form-control"
                style="height: 42px; border-radius: 10px;"
                placeholder="Buscar celulares..."
                value="{{ $search ?? '' }}"
            >
            <button class="btn btn-outline-dark ms-2" type="submit">
                Buscar
            </button>
        </form>
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


 {{-- HERO CAROUSEL --}}
<div id="carouselProductos" class="carousel slide mb-5" data-bs-ride="carousel">

    <div class="carousel-inner">

        @foreach($products as $index => $product)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                
                <div class="d-flex justify-content-center align-items-center bg-light" style="height: 300px;">
                    <img src="{{ $product->image }}" 
                         class="d-block"
                         style="max-height: 250px; object-fit: contain;"
                         alt="{{ $product->name }}">
                </div>

                <div class="carousel-caption d-none d-md-block">
                    <h5 class="bg-dark text-white px-3 py-1 d-inline-block rounded">
                        {{ $product->name }}
                    </h5>
                </div>

            </div>
        @endforeach

    </div>

    {{-- BOTONES --}}
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
    </button>

</div>

  {{-- CATEGORÍAS --}}
<div class="row text-center mb-5">
    @foreach($categories as $category)
        <div class="col">
            <a href="{{ route('categories.products', $category->id) }}" class="text-decoration-none text-dark">
                <div class=" mx-auto mb-2 d-flex align-items-center justify-content-center"
                     style="width:60px; height:60px;">
                    <img src="{{ asset('images/categoria.png') }}" 
                         alt="{{ $category->name }}" 
                         style="width:150px;">
                </div>
                <small>{{ $category->name }}</small>
            </a>
        </div>
    @endforeach
   
</div>

    {{-- RECOMENDADOS --}}
    <h4 class="mb-4">Recomendados</h4>

    <div class="row">
       @forelse($products as $product)
    <div class="col-md-3 mb-4">
        <div class="card h-100 position-relative">
            {{-- CORAZÓN --}}
<button class="btn position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent"
        onclick="toggleFavorito({{ $product->id }}, this)">
    <span class="heart-icon">♡</span>
</button>
            <img 
                src="{{ $product->image }}" 
                class="card-img-top p-3" 
                style="height:180px; object-fit:contain;" 
                alt="{{ $product->name }}"
            >

            <div class="card-body">
                <h6 class="card-title">{{ $product->name }}</h6>
                <p class="text-muted mb-1">{{ $product->brand }}</p>
                <p class="small mb-1">{{ $product->ram }} | {{ $product->storage }}</p>
                <p class="fw-bold">₡{{ number_format($product->price, 0) }}</p>

                <span class="badge bg-secondary m-2">
                    {{ $product->category->name ?? 'Sin categoría' }}
                </span>
                <br/>
                <a href="{{ route('products.detail', $product->id) }}" class="btn btn-dark btn-sm">
                                    Ver producto
                                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-warning">
            No hay productos registrados.
        </div>
    </div>
@endforelse
 <div class="mt-4 d-flex justify-content-center">
    {{ $products->withQueryString()->links() }}
</div>
    </div>

  {{-- BENEFICIOS --}}
<div class="row text-center my-5">

    {{-- COMPRA SEGURA --}}
    <div class="col-md-4 mb-4">
        <div class="p-4 shadow-sm rounded bg-white h-100 benefit-card">

            <img src="{{ asset('images/beneficios/compra_segura.png') }}" 
                 alt="Compra segura" 
                 style="width:60px;" class="mb-3">

            <h6 class="fw-bold">Compra segura</h6>
            <p class="text-muted small mb-0">
                Protegemos tus datos y tu compra en todo momento.
            </p>

        </div>
    </div>

    {{-- GARANTÍA --}}
    <div class="col-md-4 mb-4">
        <div class="p-4 shadow-sm rounded bg-white h-100 benefit-card">

            <img src="{{ asset('images/beneficios/garantia.png') }}" 
                 alt="Garantía" 
                 style="width:60px;" class="mb-3">

            <h6 class="fw-bold">Garantía incluida</h6>
            <p class="text-muted small mb-0">
                Todos nuestros productos cuentan con respaldo.
            </p>

        </div>
    </div>

    {{-- ENVÍOS --}}
    <div class="col-md-4 mb-4">
        <div class="p-4 shadow-sm rounded bg-white h-100 benefit-card">

            <img src="{{ asset('images/beneficios/envio.png') }}" 
                 alt="Envíos" 
                 style="width:60px;" class="mb-3">

            <h6 class="fw-bold">Envíos a todo el país</h6>
            <p class="text-muted small mb-0">
                Entregamos en cualquier parte del país.
            </p>

        </div>
    </div>

</div>

    {{-- FOOTER --}}
    <footer class="row mt-5 pt-4 border-top">
            <div class="col-md-3">
    <h6>Redes sociales</h6>

    <a href="#" class="social-icon me-2">
        <img src="{{ asset('images/social/facebook.svg') }}" alt="Facebook">
    </a>

    <a href="#" class="social-icon me-2">
        <img src="{{ asset('images/social/instagram.svg') }}" alt="Instagram">
    </a>
        </div>

        <div class="col-md-3">
            <h6>Contactos</h6>
            <p class="mb-1">Correo</p>
            <p class="mb-1">Teléfono</p>
            <p>Ubicación</p>
        </div>

        <div class="col-md-3">
            <h6>Información</h6>
            <p class="mb-1">Sobre nosotros</p>
            <p class="mb-1">Métodos de pago</p>
            <p>Ayuda</p>
        </div>

        <div class="col-md-3">
            <h6>Términos y condiciones</h6>
            <p class="mb-1">Políticas</p>
            <p class="mb-1">Garantías</p>
            <p>Privacidad</p>
        </div>
    </footer>

</div>

@endsection