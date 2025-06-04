@extends('layouts.app')

@section('titulo')
    {{ $post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{$post->titulo}}">
            <div class="p-3 flex items-center gap-4">

            @auth

                 @if($post->checkLike(auth()->user()))
                   <form method="POST" action="{{route('posts.likes.destroy', $post)}}">
                        @method('DELETE')
                        @csrf
                        <div class="my-4" >
                            <button type="submit">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                 @else
                    <form method="POST" action="{{route('posts.likes.store', $post)}}">
                        @csrf
                        <div class="my-4" >
                            <button type="submit">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="size-6">
                                    <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                 @endif

                <form method="POST" action="{{route('posts.likes.store', $post)}}">
                    @csrf
                    <div class="my-4" >
                        <button type="submit">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                            </svg>
                        </button>
                    </div>

                </form>
            @endauth

                <p class="font-bold ">{{ $post->likes->count() }}
                    <span class="font-normal"
                </p>
            </div>
            <div>
                <p class="font-bold" >{{$post->user->username}}</p>
                <p class="text-sm text-gray-500 ">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion}}
                </p>
            </div>

            @auth
                @if( $post->user_id === auth()->user()->id )
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta publicación?')">
                    @csrf
                    @method('DELETE')
                    <input 
                        type="submit" 
                        value="Eliminar publicación" 
                        class="bg-red-500 hover:bg-red-600 rounded text-white font-bold mt-4 cursor-pointer"
                    />
                </form>
                @endif
            @endauth

        </div>
        <div class="md:w-1/2 p-5 ">
            <div class="shadow bg-white p-5 mb-5">

            @auth            
                <p class="text-xl font-bold text-center mb-4">Agrega un comentario</p>

                @if(session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase boldx">
                        {{session('mensaje')}}
                    </div>
                @endif
                
                <form action="{{ route('comentarios.store', ['post'=> $post, 'user'=> $user ] )}} " method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Añade un comentario
                        </label>
                        <textarea
                            id="comentario"
                            name="comentario"
                            placeholder="Agrego un comentario"
                            class="border p-3 w-full rounded-lg @error('name') border-red-500                           
                            @enderror">
                        </textarea>

                        @error('descripcion')
                            <p class="bg-red-500 text-white my-2 text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <input 
                    type="submit" 
                    value="Comentar" 
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                    >
                </form>

            @endauth    
            
            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">
                @if ($post->comentarios->count())
                    @foreach( $post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comentario->user ) }}"class="font-bold">{{ $comentario->user->username }}</a>
                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="p-10 text-center">No hay comentarios aun</p>
                @endif
            </div>

            </div>
        </div>

    </div>
@endsection