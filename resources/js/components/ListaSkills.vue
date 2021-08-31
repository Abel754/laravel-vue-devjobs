<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <!-- v-for -> és un for el qual fem que 'skill' amb iteració i agafi els valors del props skills -->
            <!-- Se li ha d'afegir  el v-bind:key="i" perquè és la iteració-->
            <!-- També se li afegeix :class perquè cridi directament al mètode -->
            <li 
                class="border border-gray-500 px-10 py-3 mb-3 rounded mr-4"  
                :class="verificarClaseActiva(skill)" 
                v-for="(skill, i) in this.skills" 
                v-bind:key="i"
                @click="activar"
            >{{skill}}</li>
        </ul>

        <input type="hidden" name="skills" id="skills">
    </div>

</template>

<script>
export default {
    props: ['skills', 'oldskills'],
    created: function() {
        if(this.oldskills) { // Si se li passa per props (ha clicat en alguna skill)
            const skillsArray = this.oldskills.split(','); // Els separa en un array mitjançant una coma
            skillsArray.forEach(skill => this.habilidades.add(skill)); // Per cada skill que trobem, l'afegim a l'array habilidades
        }
    },
    mounted() { // S'executa després del created sempre
        document.querySelector('#skills').value = this.oldskills; // Fem que l'input hidden tingui com a valors les skills clicades
    },
    data: function() {
        return {
            habilidades: new Set() // Set -> És com un array però no permet registres repetits
        }
    },
    methods: {
        activar(e) {
            // Si al fer click en algun llenguatge, conté la classe (ja s'ha fet click anteriorment)
            // Li treurem la classe i treurem aquest element de l'array (Set)
            if(e.target.classList.contains('bg-teal-400')) {
                e.target.classList.remove('bg-teal-400');
                this.habilidades.delete(e.target.textContent);
            } else {
                // SI no s'ha clicat anteriorment, li afegim la classe per donar-li color i l'afegim a l'array (Set)
                e.target.classList.add('bg-teal-400');
                this.habilidades.add(e.target.textContent);
            }

            // Creem una const que tingui el valor d' habilidades.
            // Al ser un Set, li hem de posar els ... davant.
            const stringHabilidades = [...this.habilidades];
            // Assignem aquesta variable a la <p> creada adalt
            document.querySelector('#skills').value = stringHabilidades;

        },
        verificarClaseActiva(skill) {
            return this.habilidades.has(skill) ? 'bg-teal-400' : ''; // Si equival el nom a una skill, la pinta de color
        }
    }
}
</script>