{{-- @extends('layout.app')

@section('title', 'login')

@section('content') --}}

<style>
    .form {
        width: 450px;
    }
</style>



<h1 class="text-center"> login</h1>

<div class="container">
    <div class="row justify-content-center">




        <form class="border p-3 form" method="post" action="{{ route('login.store') }}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">

            </div>

            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <button type="submit" class="btn btn-primary">Iniciar</button>
        </form>
    </div>

</div>
{{-- @endsection --}}
