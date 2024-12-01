<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Proveedores</label>
    <input type="text" class="form-control" id="name"
        value="{{ old('name', isset($proveedor->nombre) ? $proveedor->nombre : '') }}" name="name">
    @error('name')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">contacto</label>
    <input type="text" class="form-control" id="contacto"
        value="{{ old('contacto', isset($proveedor->contacto) ? $proveedor->contacto : '') }}" name="contacto">
    @error('name')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror
</div>
