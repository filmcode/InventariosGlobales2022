<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Observaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <form action="/observaciones/{{$id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid">
                     <div class="grid grid-cols-1 p-10">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Descripción:</label>
                        <textarea name="descripcion" cols="30" rows="10" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 md-textarea form-control"></textarea>
                    </div>
                </div>
                <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                    <a href="{{ route('carros.index') }}" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                    <button type="submit" class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
                </div>
            </form> 
            </div>
        </div>
    </div>
</x-app-layout>
