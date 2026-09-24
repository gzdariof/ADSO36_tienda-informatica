<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Informática</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">SENA - Tienda Informática</a>
        <a href="{{ route('productos.create') }}" class="btn btn-outline-light">Nuevo Producto</a>
    </div>
</nav>

<div class="container my-5">
    <h2 class="mb-4 text-center">Catálogo de Productos Informáticos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <!-- Slider Carousel Bootstrap -->
                    @if(!empty($producto->imagenes) && count($producto->imagenes) > 0)
                        <div id="carousel-{{ $producto->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($producto->imagenes as $index => $imgBase64)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $imgBase64 }}" class="d-block w-100" style="height: 220px; object-fit: cover;" alt="Imagen {{ $producto->nombre }}">
                                    </div>
                                @endforeach
                            </div>
                            @if(count($producto->imagenes) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $producto->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $producto->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Sin+Imagen" class="card-img-top" alt="Sin Imagen">
                    @endif

                    <div class="card-body">
                        <span class="badge bg-info text-dark mb-2">{{ $producto->categoria }}</span>
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($producto->descripcion, 80) }}</p>
                        <h6 class="text-success font-weight-bold">${{ number_format($producto->precio, 2) }}</h6>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">No hay productos registrados en la tienda.</div>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>
