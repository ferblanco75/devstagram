@extends('layouts.app')

@section('titulo')
        Inicia sesión en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-1/2">
           <img src="{{ asset('img/login.jpg')}}" alt="Imagen de login de usuario">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action={{ route('login')}} novalidate >
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif
                
                <div>
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500                           
                        @enderror"
                    />
                    @error('email')
                    <p class="bg-red-500 text-white my-2 text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="contraseña"
                        class="border p-3 w-full rounded-lg 
                        @error('password')
                             <p class="bg-red-500 text-white my-2 text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    />
                    @error('password')
                    <p class="bg-red-500 text-white my-2 text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <input 
                    type="submit" 
                    value="Iniciar sesión" 
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>

@endsection