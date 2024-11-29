<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Usuario</label>
    <input type="text" class="form-control" id="name"
        value="{{ old('name', isset($usuario->name) ? $usuario->name : '') }}" name="name">
    @error('name')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror
</div>

<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email </label>
    <input type="email" class="form-control" value="{{ old('email', isset($usuario->email) ? $usuario->email : '') }}"
        id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
    @error('email')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    @error('password')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"> confirmar Password</label>
    <input type="password" name="password_confirmation" class="form-control">
    @error('password_confirmation')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror

</div>
<div class="mb-3">
    @php
        // print_r($tipo);
    @endphp
    <label for="exampleInputPassword1" class="form-label">Nivel Administrativo</label>
    @isset($usuario->tipoAdmin->tipo)
        <i style="color: rgb(12, 150, 24)"> Nivel {{ $usuario->tipoAdmin->tipo }}</i>
    @endisset

    <select class="form-control" name="tipo_admin" id="exampleInputPassword1">
        @isset($usuario->tipoAdmin->tipo)
            <option value="{{ $usuario->tipo_admin_id }}">{{ $usuario->tipoAdmin->tipo }}</option>
        @endisset
        @foreach ($tipo as $list)
            <option value="{{ $list->id }}">{{ $list->tipo }}</option>
        @endforeach
    </select>
    @error('tipo_admin')
        <div class="alert alert-danger" role="alert">{{ $message }}.</div>
    @enderror

</div>
