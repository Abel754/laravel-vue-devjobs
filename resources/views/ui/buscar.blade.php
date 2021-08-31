<h2 class="my-10 text-2xl text-gray-700">Busca una Vacante</h2>

<form action="{{route('vacantes.buscar')}}" method="POST">
    @csrf

    <div class="mb-5">
        <label
            for="titulo"
            class="block text-gray-700 text-sm mb-2">
        Categoría:</label>

        <select
            id="categoria"
            class="block appearance-none border
            border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white
            focus:border-gray-500 p3 bg-gray-100 w-full"
            name="categoria"

        >
            <option disabled selected>-Selecciona-</option>

            @foreach($categorias as $categoria)
                <option
                    {{old('categoria') == $categoria->id ? 'selected' : ''}}
                    value="{{$categoria->id}}">
                    {{$categoria->nombre}}
                </option>
            @endforeach
        </select>

        @error('categoria')
            <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{$message}}</span>
            </div>
        @enderror

    </div>

    <div class="mb-5">
        <label
            for="ubicacion"
            class="block text-gray-700 text-sm mb-2">
        Ubicación:</label>

        <select
            {{old('ubicacion') == $categoria->id ? 'selected' : ''}}
            id="ubicacion"
            class="block appearance-none border
            border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white
            focus:border-gray-500 p3 bg-gray-100 w-full"
            name="ubicacion"

        >
            <option disabled selected>-Selecciona-</option>

            @foreach($ubicaciones as $ubicacion)
                <option value="{{$ubicacion->id}}">
                    {{$ubicacion->nombre}}
                </option>
            @endforeach
        </select>

        @error('ubicacion')
            <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{$message}}</span>
            </div>
        @enderror

    </div>

    <button
        type="submit"
        class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline-none focus:shadow-outline uppercase mt-10"
    >
        Buscar Vacantes
    </button>
</form>
