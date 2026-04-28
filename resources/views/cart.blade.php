@extends('layout')

@section('title', 'Carrito')

@section('content')

<div class="container py-5">

 {{-- NAVBAR --}}
<div class="d-flex align-items-center justify-content-between mb-4">

    {{-- LOGO --}}
    <div   class="d-flex align-items-center">
        <a href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 65px;">
     </a>
    </div>

  <h3 class="mb-4">Vista previa de la orden</h3>

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

    <div class="row">
        <div class="col-md-8" id="cart-products"></div>

        <div class="col-md-4">
            <div class="border p-4">
                <h5>Resumen</h5>

                <div class="d-flex justify-content-between mt-3">
                    <span>Subtotal</span>
                    <strong id="subtotal">₡0</strong>
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span>Impuestos</span>
                    <strong id="taxes">₡0</strong>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong id="total">₡0</strong>
                </div>

                <button class="btn btn-dark w-100 mt-4">
                    Finalizar compra
                </button>

                <a href="{{ url('/') }}" class="btn btn-link w-100 mt-2">
                    Seguir comprando
                </a>
            </div>
        </div>
    </div>

</div>

<script>
let productos = @json($products);
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
let contenedor = document.getElementById('cart-products');

function renderCarrito() {
    contenedor.innerHTML = '';
    let subtotal = 0;

    if (carrito.length === 0) {
        contenedor.innerHTML = '<div class="alert alert-warning">El carrito está vacío.</div>';
    }

    carrito.forEach(item => {
        let producto = productos.find(p => p.id === item.id);

        if (!producto) return;

        let totalProducto = producto.price * item.cantidad;
        subtotal += totalProducto;

        contenedor.innerHTML += `
            <div class="d-flex align-items-center border-bottom py-3">
                <img src="${producto.image}" style="width:80px; height:80px; object-fit:contain;" class="me-3">

                <div class="flex-grow-1">
                    <h6>${producto.name}</h6>
                    <p class="mb-1 text-muted">${producto.brand}</p>
                    <button class="btn btn-link text-danger p-0" onclick="eliminarProducto(${producto.id})">Eliminar</button>
                </div>

                <div class="d-flex align-items-center me-4">
                    <button class="btn btn-outline-secondary btn-sm" onclick="cambiarCantidad(${producto.id}, -1)">-</button>
                    <span class="mx-3">${item.cantidad}</span>
                    <button class="btn btn-outline-secondary btn-sm" onclick="cambiarCantidad(${producto.id}, 1)">+</button>
                </div>

                <strong>₡${totalProducto.toLocaleString()}</strong>
            </div>
        `;
    });

    let impuestos = subtotal * 0.13;
    let total = subtotal + impuestos;

    document.getElementById('subtotal').textContent = '₡' + subtotal.toLocaleString();
    document.getElementById('taxes').textContent = '₡' + impuestos.toLocaleString();
    document.getElementById('total').textContent = '₡' + total.toLocaleString();
}

function cambiarCantidad(id, cambio) {
    let item = carrito.find(p => p.id === id);

    if (!item) return;

    item.cantidad += cambio;

    if (item.cantidad < 1) {
        carrito = carrito.filter(p => p.id !== id);
    }

    localStorage.setItem('carrito', JSON.stringify(carrito));
    renderCarrito();
}

function eliminarProducto(id) {
    carrito = carrito.filter(p => p.id !== id);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    renderCarrito();
}

renderCarrito();
</script>

@endsection