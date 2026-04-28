@extends('layout')

@section('title', 'Administración de productos')

@section('content')

<div class="container py-4">

   <div class="position-relative mb-4">

    {{-- LOGO --}}
    <a href="{{ url('/') }}" class="position-absolute start-0 top-50 translate-middle-y">
        <img src="{{ asset('images/logo.png') }}" style="height:65px;">
    </a>

    {{-- TÍTULO CENTRADO --}}
    <h3 class="text-center m-0">Administración de productos</h3>

</div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO AGREGAR --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">
            Agregar producto
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Marca</label>
                        <input type="text" name="brand" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Precio</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>RAM</label>
                        <input type="text" name="ram" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Almacenamiento</label>
                        <input type="text" name="storage" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Sistema operativo</label>
                        <input type="text" name="operating_system" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Categoría</label>
                        <select name="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Link de imagen</label>
                        <input type="text" name="image" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Descripción</label>
                        <textarea name="description" class="form-control" rows="2" required></textarea>
                    </div>
                </div>

                <button class="btn btn-dark">
                    Agregar producto
                </button>
            </form>
        </div>
    </div>

    {{-- LISTA PRODUCTOS --}}
    <h4 class="mb-3">Productos registrados</h4>

    @foreach($products as $product)
        <div class="card mb-3">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row align-items-center">

                        <div class="col-md-2">
                            <img src="{{ $product->image }}" class="img-fluid" style="height:100px; object-fit:contain;">
                        </div>

                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Nombre</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <label>Marca</label>
                                    <input type="text" name="brand" class="form-control" value="{{ $product->brand }}">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <label>Precio</label>
                                    <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <label>RAM</label>
                                    <input type="text" name="ram" class="form-control" value="{{ $product->ram }}">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <label>Almacenamiento</label>
                                    <input type="text" name="storage" class="form-control" value="{{ $product->storage }}">
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label>Sistema operativo</label>
                                    <input type="text" name="operating_system" class="form-control" value="{{ $product->operating_system }}">
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label>Categoría</label>
                                    <select name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Link de imagen</label>
                                    <input type="text" name="image" class="form-control" value="{{ $product->image }}">
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label>Descripción</label>
                                    <textarea name="description" class="form-control" rows="2">{{ $product->description }}</textarea>
                                </div>

                                <div class="col-md-12 d-flex gap-2 mt-2">
                                    <button class="btn btn-primary btn-sm">
                                        Actualizar
                                    </button>
                                </form>

                                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este producto?')">
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>

            </div>
        </div>
    @endforeach
   <div class="mt-4 d-flex justify-content-center">
    {{ $products->withQueryString()->links() }}
</div>

</div>

@endsection