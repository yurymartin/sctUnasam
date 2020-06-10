<template>
    <div>
        <div class="card card-primary card-outline mt-3">
            <div class="card-header">
                <div class="card-header">
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <button
                            type="button"
                            class="btn btn-primary btn-block"
                            @click="abrirModal('temperaturas', 'registrar')"
                        >
                            <i class="far fa-plus-square"></i
                            ><b> REGISTRAR UNA NUEVA TEMPERATURA</b>
                        </button>
                        <!-- MODAL -->
                        <div class="modal fade text-sm" id="modal">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4
                                            class="modal-title"
                                            v-text="tituloModal"
                                        ></h4>
                                        <button
                                            type="button"
                                            class="close"
                                            @click="cerrarModal()"
                                        >
                                            <span aria-hidden="true"
                                                >&times;</span
                                            >
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12 form-group">
                                            <span class="text-danger"
                                                >Aquellos Campos que tengan el
                                                simbolo (*) son
                                                obligatorios</span
                                            >
                                            <br /><br />
                                            <div v-show="errorTemperatura">
                                                <div
                                                    class="alert alert-danger"
                                                    role="alert"
                                                >
                                                    <div
                                                        v-for="(error,
                                                        index) in errorMostrarMsjTemperatura"
                                                        :key="error"
                                                        v-text="
                                                            index +
                                                                1 +
                                                                '- ' +
                                                                error
                                                        "
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="empleado"
                                                    >Temperatura (*)</label
                                                >
                                                <input
                                                    type="number"
                                                    v-model="temperatura"
                                                    placeholder="temperatura"
                                                    class="form-control"
                                                    @keyup="analizarEstado"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="modal-footer justify-content-between"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-danger w-25"
                                            @click="cerrarModal()"
                                        >
                                            <i class="far fa-window-close"></i>
                                            Cerrar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-primary w-25"
                                            @click="registrarTemperatura()"
                                            v-if="tipoAccion == 1 && button"
                                        >
                                            <i class="far fa-save"></i> Guardar
                                        </button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.END MODAL -->
                    </div>
                </div>
            </div>
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
            persona_id: localStorage.getItem("persona"),
            tituloModal: "",
            tipoAccion: 0,
            errorTemperatura: 0,
            errorMostrarMsjTemperatura: [],
            temperatura: 0,
            estado: "",
            button: true
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
        },
        registrarTemperatura() {
            if (this.validarTemperatura()) {
                return;
            }
            this.button = false;
            axios
                .post(`/api/temperaturas`, {
                    persona_id: this.persona_id,
                    temperatura: this.temperatura,
                    estado: this.estado
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Temperatura Registrado Exitosamente",
                        showConfirmButton: false,
                        timer: 10007
                    });
                    this.listarTemperaturas();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.temperatura = 0;
            this.estado = "";
            this.errorTemperatura = 0;
            this.errorMostrarMsjTemperatura = [];
            this.button = true;
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            switch (modelo) {
                case "temperaturas": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal = "REGISTRAR NUEVA TEMPERATURA";
                            this.temperatura = 0;
                            this.estado = "";
                            this.activo = 0;
                            this.tipoAccion = 1;
                            break;
                        }
                    }
                }
            }
        },
        validarTemperatura() {
            this.errorTemperatura = 0;
            this.errorMostrarMsjTemperatura = [];

            if (!this.temperatura)
                this.errorMostrarMsjTemperatura.push("El temperatura no puede estar vacio");

            if (this.errorMostrarMsjTemperatura.length)
                this.errorTemperatura = 1;

            return this.errorTemperatura;
        },
        analizarEstado() {
            if (parseInt(this.temperatura) > 40) {
                this.estado = "Enfermo";
            } else {
                this.estado = "Saludable";
            }
        },
    },
    mounted() {
        this.listarTemperaturas();
    }
};
</script>
