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

               <button class="btn btn-dark w-100 mt-4" onclick="finalizarCompra()">
    Finalizar compra
</button>

                <a href="{{ url('/') }}" class="btn btn-link w-100 mt-2">
                    Seguir comprando
                </a>
            </div>
        </div>
    </div>

</div>
{{-- MODAL COMPRA EXITOSA --}}
<div class="modal fade" id="compraExitosaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4" style="border-radius: 12px;">

            {{-- ICONO CHECK --}}
            <div class="mb-3">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#28a745"/>
                    <path d="M7 12.5L10.5 16L17 9.5" 
                          stroke="white" 
                          stroke-width="2.5" 
                          stroke-linecap="round" 
                          stroke-linejoin="round"/>
                </svg>
            </div>

            {{-- TITULO --}}
            <h4 class="fw-bold mb-2">¡Compra exitosa!</h4>

            {{-- TEXTO --}}
            <p class="text-muted mb-4">
                Tu pedido ha sido procesado correctamente.
            </p>

            {{-- BOTONES --}}
            <div class="d-grid gap-2">
                <a href="{{ url('/') }}" class="btn btn-dark">
                    Ir al inicio
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

function finalizarCompra() {
    if (carrito.length === 0) {
        alert('El carrito está vacío.');
        return;
    }

    carrito = [];
    localStorage.removeItem('carrito');

    renderCarrito();

    let modal = new bootstrap.Modal(document.getElementById('compraExitosaModal'));
    modal.show();
}

renderCarrito();
</script>

@endsection