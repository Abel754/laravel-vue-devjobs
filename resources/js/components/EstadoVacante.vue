<template>
    <!-- El key és perquè es canviï en temps real -->
    <span
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
        :class="claseEstadoVacante()"
        @click="cambiarEstado"
        :key= "estadoVacanteData"
    >
        {{estadoVacante}}
    </span>
</template>

<script>
export default {
    props:['estado', 'vacanteId'],
    mounted() {
        this.estadoVacanteData = Number(this.estado); // Com que ve en String, no passem a Number
    },
    data: function() {
        return {
            estadoVacanteData: null
        }
    },
    methods: {
        claseEstadoVacante() {
            // Si està en verd, posem vermell i al revés
            return this.estadoVacanteData === 1 ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800"
        },
        cambiarEstado() { // Li assignem activa o inactiva
            if(this.estadoVacanteData === 1) {
                this.estadoVacanteData = 0;
            } else {
                this.estadoVacanteData = 1;
            }

            // Enviar a axios
            // Creem variable params, tot el que enviem des de params, accedirem des del Request del mètode al que anem
            const params = {
                estado: this.estadoVacanteData
            }
            axios
                .post('/vacantes/' + this.vacanteId, params) // Enviem a aquesta ruta definida en el web.php
                .then(respuesta => console.log(respuesta))
                .catch(error => console.log(error))
        }
    },
    computed: {
        estadoVacante() {
            return this.estadoVacanteData === 1 ? 'Activa' : 'Inactiva' // Canviem el text
        }
    }
}
</script>
