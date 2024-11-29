<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre de categoria</label>
    <input type="text" class="form-control" id="name"
        value="{{ old('name', isset($categorias->nombre) ? $categorias->nombre : '') }}" name="name">
    @error('name')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror
</div>
