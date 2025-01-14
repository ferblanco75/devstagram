@extends('layouts.app')

@section('titulo')
        Registrate en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-1/2">
           <img src="{{ asset('img/registrar.jpg')}}" alt="no hay foto">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="/register" method="POST" >
                @csrf
                <div>
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input 
                        id="name"
                        name="name"
                        type="text"
                        placeholder="tu nombre"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Usuario
                    </label>
                    <input 
                        id="username"
                        name="Username"
                        type="text"
                        placeholder="tu nombre de usuario"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <div>
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="email de registro"
                        class="border p-3 w-full rounded-lg"
                    />
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
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <div>
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                      repetir contraseña
                    </label>
                    <input 
                        id="password"
                        name="password_confirmation"
                        type="password_confirmation"
                        placeholder="repite la contraseña"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <input 
                    type="submit" 
                    value="crear cuenta" 
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>

@endsection