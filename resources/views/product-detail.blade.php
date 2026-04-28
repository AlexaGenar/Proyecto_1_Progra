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

        <a href="#" class="me-3">
            <img src="{{ asset('images/navbar/perfil.svg') }}" alt="Usuario" style="width:24px;">
        </a>

        <a href="#">
            <img src="{{ asset('images/navbar/menu.svg') }}" alt="Menu" style="width:26px;">
        </a>

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
  
        <a href="#" class="ms-2" onclick="agregarAlCarrito({{ $product->id }})">
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