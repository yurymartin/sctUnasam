<template>
    <div>
        <div class="card card-primary card-outline mt-3">
            <div class="card-header">
                <div class="card-title">
                    <b>LISTADO TUS TEMPERATURAS REGISTRADAS</b>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Temperatura</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in temperaturas"
                            :key="item.id"
                        >
                            <td v-text="index"></td>
                            <td v-text="item.temperatura"></td>
                            <td v-text="item.fecha"></td>
                            <td v-text="item.hora"></td>
                            <td>
                                <span
                                    :class="
                                        item.estado == 'Saludable'
                                            ? 'badge badge-info'
                                            : 'badge badge-danger'
                                    "
                                    v-text="item.estado"
                                ></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
    data() {
        return {
            temperaturas: [],
            nombres: localStorage.getItem("nombres"),
            apellidos: localStorage.getItem("apellidos"),
            dni: localStorage.getItem("dni"),
            direccion: localStorage.getItem("direccion"),
            celular: localStorage.getItem("celular"),
            persona_id: localStorage.getItem("persona")
        };
    },
    methods: {
        listarTemperaturas() {
            axios
                .get(`api/getTemperaturas/${this.persona_id}`)
                .then(response => {
                    this.temperaturas = response.data.temperaturas;
                    console.log(response.data);
                });
        }
    },
    mounted() {
        this.listarTemperaturas();
    }
};
</script>
