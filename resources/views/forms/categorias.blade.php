<div class="mb-3 mt-5">

    <input type="text" class="form-control mb-4" id="name"
        value="{{ old('name', isset($categorias->nombre) ? $categorias->nombre : '') }}" name="name">
    @error('name')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror
</div>
