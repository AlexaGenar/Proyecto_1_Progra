@extends('layout')

@section('title', 'Celulares ' . $brand)

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

        <h3 class="mb-0">Celulares {{ $brand }}</h3>

        {{-- BOTONES --}}
        <div class="d-flex align-items-center">

            <a href="#" class="text-decoration-none text-dark me-3">
                <span class="heart-icon">♡</span>
            </a>

            <a href="#" class="me-3 position-relative">
                <img src="{{ asset('images/navbar/carrito.svg') }}" alt="Carrito" style="width:26px;">
                <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
                </span>
            </a>

            <a href="#" onclick="abrirMenu(event)">
                <img src="{{ asset('images/navbar/menu.svg') }}" alt="Menu" style="width:26px;">
            </a>

        </div>

    </div>

    {{-- OVERLAY --}}
    <div id="menuOverlay" class="menu-overlay" onclick="cerrarMenu()"></div>

    {{-- MENÚ LATERAL --}}
    <div id="sideMenu" class="side-menu">
        <h5 class="mb-4">Marcas</h5>

        <a href="{{ route('brands.products', 'Samsung') }}">Samsung</a>
        <a href="{{ route('brands.products', 'Xiaomi') }}">Xiaomi</a>
        <a href="{{ route('brands.products', 'Apple') }}">Apple</a>
        <a href="{{ route('brands.products', 'Realme') }}">Realme</a>
        <a href="{{ route('brands.products', 'Huawei') }}">Huawei</a>
        <a href="{{ route('brands.products', 'Motorola') }}">Motorola</a>
        <a href="{{ route('brands.products', 'Oppo') }}">Oppo</a>
    </div>

    <div class="row">

        {{-- FILTRO LATERAL --}}
        <div class="col-md-3 mb-4">
            <div class="border rounded p-3">
                <h6 class="fw-bold mb-3">Filtro</h6>

                <p class="mb-1">Marca:</p>
                <span class="badge bg-secondary mb-3">{{ $brand }}</span>

                <hr>

                <p class="mb-1 fw-bold">Categorías disponibles</p>

                @foreach($products->pluck('category.name')->unique()->filter() as $categoryName)
                    <p class="mb-1 small">{{ $categoryName }}</p>
                @endforeach
            </div>
        </div>

        {{-- PRODUCTOS --}}
        <div class="col-md-9">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">

                            <img 
                                src="{{ $product->image }}" 
                                class="card-img-top p-3" 
                                style="height:170px; object-fit:contain;" 
                                alt="{{ $product->name }}"
                            >

                            <div class="card-body">
                                <h6 class="card-title">{{ $product->name }}</h6>

                                <p class="text-muted mb-1">{{ $product->brand }}</p>

                                <p class="small mb-1">
                                    RAM: {{ $product->ram }}
                                </p>

                                <p class="small mb-1">
                                    Almacenamiento: {{ $product->storage }}
                                </p>

                                <p class="small mb-2">
                                    Sistema: {{ $product->operating_system }}
                                </p>

                                <p class="fw-bold mb-2">
                                    ₡{{ number_format($product->price, 0) }}
                                </p>

                                <span class="badge bg-secondary mb-2">
                                    {{ $product->category->name ?? 'Sin categoría' }}
                                </span>

                                <br>

                                <a href="{{ route('products.detail', $product->id) }}" class="btn btn-dark btn-sm">
                                    Ver producto
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">
                            No hay productos registrados para esta marca.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

@endsection