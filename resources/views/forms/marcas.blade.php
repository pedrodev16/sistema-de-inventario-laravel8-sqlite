<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Marca</label>
    <input type="text" class="form-control" id="name"
        value="{{ old('name', isset($marcas->nombre) ? $marcas->nombre : '') }}" name="name">
    @error('name')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror
</div>
