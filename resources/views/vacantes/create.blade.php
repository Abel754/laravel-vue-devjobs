@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('navegacion')
    @include('ui.adminnav')


@endsection


@section('content')

    <h1 class="text-2xl text-center mt-10">Nueva Vacante</h1>

    <form 
        class="max-w-lg mx-auto my-10"
        method="POST"
        action="{{route('vacantes.store')}}"
    >
        @csrf

        <div class="mb-5">
            <label 
                for="titulo" 
                class="block text-gray-700 text-sm mb-2">
            Titulo Vacante:</label>

            <input 
                id="titulo" 
                type="text" 
                class="p-3 bg-white-100 rounded form-input w-full @error('password') is-invalid @enderror" 
                name="titulo"
                placeholder="Título de la vacante"
                value="{{old('titulo')}}"
            >

            @error('titulo')
                <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{$message}}</span>
                </div>
            @enderror

        </div>

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
                for="experiencia" 
                class="block text-gray-700 text-sm mb-2">
            Experiencia:</label>

            <select 
                {{old('experiencia') == $categoria->id ? 'selected' : ''}}
                id="experiencia"
                class="block appearance-none border 
                border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white 
                focus:border-gray-500 p3 bg-gray-100 w-full"
                name="experiencia"

            >
                <option disabled selected>-Selecciona-</option>

                @foreach($experiencias as $experiencia)
                    <option value="{{$experiencia->id}}">
                        {{$experiencia->nombre}}
                    </option>
                @endforeach
            </select>

            @error('experiencia')
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

        <div class="mb-5">
            <label 
                for="salario" 
                class="block text-gray-700 text-sm mb-2">
            Salario:</label>

            <select 
                {{old('salario') == $categoria->id ? 'selected' : ''}}
                id="salario"
                class="block appearance-none border 
                border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white 
                focus:border-gray-500 p3 bg-gray-100 w-full"
                name="salario"

            >
                <option disabled selected>-Selecciona-</option>

                @foreach($salarios as $salario)
                    <option value="{{$salario->id}}">
                        {{$salario->nombre}}
                    </option>
                @endforeach
            </select>

            @error('salario')
                <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{$message}}</span>
                </div>
            @enderror

        </div>

        <div class="mb-5">
            <label 
                for="descripcion" 
                class="block text-gray-700 text-sm mb-2">
            Descripción del Puesto:</label>

            <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700"></div>

            <!-- Creem un input que contindrà el text del medium editor. Això es realitza al final de tot d'aquest arxiu -->
            <input type="hidden" name="descripcion" id="descripcion" value="{{old('descripcion')}}">

        </div>

            @error('descripcion')
                <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{$message}}</span>
                </div>
            @enderror

        <div class="mb-5">
            <label 
                for="descripcion" 
                class="block text-gray-700 text-sm mb-2">
            Imagen Vacante:</label>

            <div id="dropzoneDevJobs" class="dropzone rounded bg-gray-100"></div>

            <input type="hidden" name="imagen" id="imagen" value="{{old('imagen')}}">

            <p class="error"></p>

        </div>

            @error('imagen')
                <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{$message}}</span>
                </div>
            @enderror

        <div class="mb-5">
            <label 
                for="skills" 
                class="block text-gray-700 text-sm mb-2">
            Habilidades y Conocimientos:</label>

            @php
                $skills = ['HTML5', 'CSS3', 'CSSGrid', 'Flexbox', 'JavaScript', 'jQuery', 'Node', 'Angular', 'VueJS', 'ReactJS', 'React Hooks', 'Redux', 'Apollo', 'GraphQL', 'TypeScript', 'PHP', 'Laravel', 'Symfony', 'Python', 'Django', 'ORM', 'Sequelize', 'Mongoose', 'SQL', 'MVC', 'SASS', 'WordPress', 'Express', 'Deno', 'React Native', 'Flutter', 'MobX', 'C#', 'Ruby on Rails']
            @endphp
            <!-- Li posem els dos punts davant de skills perquè li passem un array per paràmetre -->
            <!-- També li passarem pel component Vue els skills que l'usuari ha clicat perquè no es perdin -->
            <lista-skills 
                :skills="{{json_encode($skills)}}"
                :oldskills="{{json_encode(old('skills'))}}"
            ></lista-skills>

            @error('skills')
                <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{$message}}</span>
                </div>
            @enderror

        </div>

        <button 
            type="submit" 
            class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase">
        Publicar Vacante</button>
    </form>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        // Treure l'error de la consola
        Dropzone.autoDiscover = false;
            
        // És necessari posar tota la següent comanda i a continuació el .editable és la classe que reb el nostre div on volem que tingui el MediumEditor
        
        document.addEventListener('DOMContentLoaded', () => {

            // Medium Editor

            const editor = new MediumEditor('.editable', {
                // Afegim les funcions que volem que tingui
                toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'orderedList', 'unorderedList', 'h2', 'h3'],
                    static: true,
                    sticky: true, // Perquè no es mogui al clicar en cap opció
                },
                placeholder: { // El fons que volem que aparegui abans d'escriure
                    text: 'Información de la vacante'
                }
            });

            // Utilitzem l'input creat anteriorment dient que editor (que és el div on està el medium editor)
            // Insereixi el text que anem escrivint a l'input
            editor.subscribe('editableInput', function(eventObj, editable){
                const contenido = editor.getContent();
                document.querySelector('#descripcion').value = contenido;
            });

            // No tenim manera de que el MediumEditor agafi el valor old que l'usuari havia escrit, ja que ho fem amb el seu input hidden, agafem el contingut d'allí
            editor.setContent(document.querySelector('#descripcion').value);

            // Dropzone

            // Fem el mateix procediment que en el Medium Editor
            const dropzoneDevJobs = new Dropzone('#dropzoneDevJobs', {
                url: "/vacantes/imagen", // Assignem la url on es dirigirà la imatge. Ruta creada al web.php
                dictDefaultMessage: 'Sube aquí tu archivo', // Missatge que apareix al mig
                acceptedFiles: ".png, .jpg, .jpeg, .gif, .bmp", // Extensions que acceptarà
                addRemoveLinks: true, // Permetrà esborrar la imatge que estem pujant
                dictRemoveFile: 'Borrar archivo', // Missatge que apareix com a esborrar imatge
                maxFiles: 1, // Màxim de fitxers permesos
                headers: { // Ho hem de posar sempre tal i com apareix aquí
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                init: function() { // S'executa un cop creada la const
                    if(document.querySelector('#imagen').value.trim()) { // Si la imatge conté alguna cosa
                        let imagenPublicada = {}; // Instanciem un objecte
                        imagenPublicada.size = 1234; // Definim un valor al que serà la mida de la imatge
                        imagenPublicada.name = document.querySelector('#imagen').value; // També definim un name que agafarem de l'input hidden que conté la ikmatge
                        // This és el const dropzoneDevJobs
                        // També haurem d'afegir les dues instruccions següents
                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(this, imagenPublicada, `/storage/vacantes/${imagenPublicada.name}`);
                        
                        imagenPublicada.previewElement.classList.add('dz-success'); // Li afegim les dues classes de Tailwind
                        imagenPublicada.previewElement.classList.add('dz-complete');
                    }
                },
                success: function(file, response) { // Quan l'usuari puja la imatge, file és el seu fitxer i response el return del mètode el qual interactuem amb la URL
                    document.querySelector('.error').textContent= ''; // Treurem el missatge de la <p> en cas que tingui
                    //console.log(response);
                    // Com que response és la resposta del servidor des del return del mètode, ens retorna un JSON anomenat 'correcto' amb el nom de la imatge.
                    // Assignarem aquell valor a un input de tipus hidden creat amb la ID #imagen, el qual serà el que, a l'enviar el formulari, insereixi el camp a la BD
                    document.querySelector('#imagen').value = response.correcto;

                    // File és el que apareix a la consola amb un munt d'opcions. Guardem que l'opció 'nombreServidor' sigui el nom de l'arxiu, igual que amb el value de dalt
                        //console.log(file);
                    file.nombreServidor = response.correcto;
                },
                maxfilesexceeded: function(file) { // S'executa quan l'usuari intenta pujar més de X fitxers assignats en maxFiles
                // El que farà serà esborrar tots els fitxers que s'han pujat abans i afegir l'últim pujat.
                    if(this.files[1] != null) {
                        this.removeFile(this.files[0]);
                        this.addFile(file);
                    }
                    // console.log(this.files);
                },
                removedfile: function(file, response) { // S'executa quan l'usuari esborra el fitxer que estava pujant
                    file.previewElement.parentNode.removeChild(file.previewElement); // Dins de les opcions del file, trobem previewElement.parentNode que és el div de la imatge anterior i l'esborrem del DOM

                    params = {
                        imagen: file.nombreServidor ?? document.querySelector('#imagen').value // El paràmetre imatge serà el file.nombreServidor que hem definit adalt. I amb els ?? agafa un o l'altre, el que trobi
                    }

                    axios.post('/vacantes/borrarimagen', params) // Utilitzem axios que actua com AJAX per anar al mètode de borrarimagen i li passem el paràmetre.
                        .then(respuesta => console.log(respuesta))
                }
            });

        })
    </script>

@endsection