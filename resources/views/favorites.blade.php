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

        <a href="#" class="me-3">
            <img src="{{ asset('images/navbar/perfil.svg') }}" alt="Usuario" style="width:24px;">
        </a>

        <a href="#" class="me-3">
            <img src="{{ asset('images/navbar/carrito.svg') }}" alt="Carrito" style="width:26px;">
        </a>

        <a href="#">
            <img src="{{ asset('images/navbar/menu.svg') }}" alt="Menu" style="width:26px;">
        </a>

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