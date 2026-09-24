<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Registrar Nuevo Producto Informático</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <select name="categoria" class="form-select" required>
                        <option value="Portatiles">Portátiles</option>
                        <option value="Ratones">Ratones</option>
                        <option value="Impresoras">Impresoras</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Precio ($)</label>
                    <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Imágenes (Máximo 300 KB cada una)</label>
                    <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*" required>
                    <small class="text-muted">Puede seleccionar múltiples archivos.</small>
                </div>

                <button type="submit" class="btn btn-success">Guardar Producto</button>
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
