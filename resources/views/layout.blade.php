<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tienda de Celulares')</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <style>
    .carousel-item {
        transition: transform 0.6s ease-in-out;
    }

    .social-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    transition: all 0.3s ease;
}

.social-icon img {
    width: 20px;
}

.social-icon:hover {
    background-color: black;
}

.social-icon:hover img {
    filter: invert(1);
}

.heart-icon {
    font-size: 35px;
    color: #555;
    transition: all 0.3s ease;
}

.heart-icon.active {
    color: red;
}

a.no-style {
    text-decoration: none;
    color: inherit;
}

a.no-style:focus,
a.no-style:active {
    outline: none;
    box-shadow: none;
}

.menu-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.25);
    z-index: 998;
}

.side-menu {
    position: fixed;
    top: 0;
    right: -280px;
    width: 260px;
    height: 100vh;
    background: #fff;
    z-index: 999;
    padding: 30px 25px;
    box-shadow: -5px 0 20px rgba(0,0,0,0.15);
    transition: right 0.3s ease;
}

.side-menu.active {
    right: 0;
}

.menu-overlay.active {
    display: block;
}

.side-menu a {
    display: block;
    padding: 12px 0;
    color: #111;
    text-decoration: none;
    border-bottom: 1px solid #eee;
}

.side-menu a:hover {
    color: #0d6efd;
    padding-left: 6px;
}
</style> 
</head>
<script>
    function incrementar() {
        let input = document.getElementById('cantidad');
        input.value = parseInt(input.value) + 1;
    }

    function decrementar() {
        let input = document.getElementById('cantidad');
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function toggleFavorito(id, btn) {

    let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];

    if (favoritos.includes(id)) {
        favoritos = favoritos.filter(f => f !== id);
        btn.querySelector('.heart-icon').classList.remove('active');
    } else {
        favoritos.push(id);
        btn.querySelector('.heart-icon').classList.add('active');
    }

    localStorage.setItem('favoritos', JSON.stringify(favoritos));
}

document.addEventListener('DOMContentLoaded', () => {

    let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];

    document.querySelectorAll('[onclick^="toggleFavorito"]').forEach(btn => {
        let id = parseInt(btn.getAttribute('onclick').match(/\d+/)[0]);

        if (favoritos.includes(id)) {
            btn.querySelector('.heart-icon').classList.add('active');
        }
    });

});

function obtenerCarrito() {
    return JSON.parse(localStorage.getItem('carrito')) || [];
}

function guardarCarrito(carrito) {
    localStorage.setItem('carrito', JSON.stringify(carrito));
    actualizarContadorCarrito();
}

function agregarAlCarrito(productId) {
    let cantidadInput = document.getElementById('cantidad');
    let cantidad = cantidadInput ? parseInt(cantidadInput.value) : 1;

    let carrito = obtenerCarrito();
    let producto = carrito.find(item => item.id === productId);

    if (producto) {
        producto.cantidad += cantidad;
    } else {
        carrito.push({
            id: productId,
            cantidad: cantidad
        });
    }

    guardarCarrito(carrito);
}

function actualizarContadorCarrito() {
    let carrito = obtenerCarrito();
    let total = carrito.reduce((sum, item) => sum + item.cantidad, 0);

    let contador = document.getElementById('cart-count');
    if (contador) {
        contador.textContent = total;
    }
}

document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);

function abrirMenu(event) {
    event.preventDefault();

    document.getElementById('sideMenu').classList.add('active');
    document.getElementById('menuOverlay').classList.add('active');
}

function cerrarMenu() {
    document.getElementById('sideMenu').classList.remove('active');
    document.getElementById('menuOverlay').classList.remove('active');
}

function mostrarModalCarrito() {
    let modal = new bootstrap.Modal(document.getElementById('productoAgregadoModal'));
    modal.show();
}
</script>
<body class="bg-light">

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
{{-- MODAL LOGIN ADMIN --}}
<div class="modal fade" id="adminLoginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">

            <div class="modal-header">
                <h5 class="modal-title">Acceso administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">
                        Entrar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>