@extends('layouts.app')

@section('titulo')
    Crea un nuevo posteo
@endsection


@section('contenido')   
    <div class="md:flex md:items-center">
        <div class="md:w-1/2">
            imagen aqui
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action={{ route('register')}} method="POST" >
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
                        class="border p-3 w-full rounded-lg @error('name') border-red-500                           
                        @enderror"
                    />
                    @error('name')
                        <p class="bg-red-500 text-white my-2 text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
            </form>
        </div>
    </div> 
@endsection