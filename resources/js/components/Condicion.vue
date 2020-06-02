<template>
    <div>
        <div class="card card-primary card-outline mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <button
                            type="button"
                            class="btn btn-primary btn-block"
                            @click="abrirModal('condicion', 'registrar')"
                        >
                            <i class="far fa-plus-square"></i
                            ><b> REGISTRAR NUEVA CONDICION</b>
                        </button>
                        <!-- MODAL -->
                        <div class="modal fade text-sm" id="modal">
                            <div class="modal-dialog">
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
                                            <div v-show="errorCondicion">
                                                <div
                                                    class="alert alert-danger"
                                                    role="alert"
                                                >
                                                    <div
                                                        v-for="error in errorMostrarMsjCondicion"
                                                        :key="error"
                                                        v-text="error"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="condicion"
                                                >Condicion (*)</label
                                            >
                                            <input
                                                type="text"
                                                v-model="condicion"
                                                placeholder="condicion"
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="descripcion"
                                                >Descripcion</label
                                            >
                                            <textarea
                                                class="form-control"
                                                v-model="descripcion"
                                                placeholder="descripcion"
                                            ></textarea>
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
                                            @click="registrarCondicion()"
                                            v-if="tipoAccion == 1"
                                        >
                                            <i class="far fa-save"></i> Guardar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-success w-25"
                                            @click="actualizarCondicion()"
                                            v-if="tipoAccion == 2"
                                        >
                                            <i class="far fa-edit"></i> Editar
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
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <b>LISTADO DE CONDICIONES</b>
                        </h3>

                        <div class="card-tools">
                            <div
                                class="input-group input-group-sm"
                                style="width: 300px;"
                            >
                                <input
                                    type="text"
                                    name="table_search"
                                    class="form-control float-right"
                                    placeholder="Buscar"
                                    v-model="buscar"
                                    @keyup="listarCondicion(buscar)"
                                />

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-default"
                                        @click="listarCondicion(buscar)"
                                    >
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Condicion</th>
                                    <th>Descripcion</th>
                                    <th>Activo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in arrayCondiciones"
                                    :key="item.id"
                                >
                                    <td v-text="index"></td>
                                    <td v-text="item.condicion"></td>
                                    <td v-text="item.descripcion"></td>
                                    <td>
                                        <span
                                            class="badge badge-success"
                                            v-if="item.activo"
                                            >activo</span
                                        >
                                        <span class="badge badge-danger" v-else
                                            >Desactivado</span
                                        >
                                    </td>
                                    <td>
                                        <button
                                            type="button"
                                            @click="
                                                abrirModal(
                                                    'condicion',
                                                    'actualizar',
                                                    item
                                                )
                                            "
                                            class="btn btn-success btn-sm"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <template v-if="item.activo">
                                            <button
                                                type="button"
                                                class="btn btn-warning btn-sm"
                                                @click="
                                                    cambiarActivo(
                                                        item.id,
                                                        item.activo
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fas fa-arrow-circle-down"
                                                ></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button
                                                type="button"
                                                class="btn btn-dark btn-sm"
                                                @click="
                                                    cambiarActivo(
                                                        item.id,
                                                        item.activo
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fas fa-arrow-circle-up"
                                                ></i>
                                            </button>
                                        </template>

                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm"
                                            @click="eliminarCondicion(item.id)"
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center m-5"
                            v-if="!arrayCondiciones.length"
                        >
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
    data() {
        return {
            id: 0,
            condicion: "",
            descripcion: "",
            activo: 0,
            genero: "MASCULINO",
            edad: "",
            arrayCondiciones: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            message: "",
            errorCondicion: 0,
            errorMostrarMsjCondicion: [],
            buscar: "",
            token: localStorage.getItem("token")
        };
    },
    methods: {
        listarCondicion(buscar) {
            axios
                .get(`/api/condiciones/?buscar=${buscar}`)
                .then(response => {
                    var respuesta = response.data;
                    this.arrayCondiciones = respuesta.condiciones;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        registrarCondicion() {
            if (this.validarCondicion()) {
                return;
            }
            axios
                .post(`/api/condiciones`, {
                    condicion: this.condicion,
                    descripcion: this.descripcion,
                    activo: 1
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Condicion Registrada Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarCondicion(this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        actualizarCondicion() {
            if (this.validarCondicion()) {
                return;
            }
            let id = this.id;
            axios
                .put(`/api/condiciones/${id}`, {
                    condicion: this.condicion,
                    descripcion: this.descripcion,
                    activo: this.activo
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Condicion Actualizado Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarCondicion(this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        eliminarCondicion(id) {
            Swal.fire({
                title: "Estas seguro?",
                text: "No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminalo!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete(`/api/condiciones/${id}`)
                        .then(res => {
                            Swal.fire(
                                "Eliminado!",
                                "La condicion fue eliminada",
                                "success"
                            );
                            this.listarCondicion(this.buscar);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        },
        cambiarActivo(id, estado) {
            axios
                .put(`/api/condicionesAD/${id}/${estado}`, {})
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Se cambio el estado de la condicion",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarCondicion(this.buscar);
                })
                .catch(() => {
                    console.log(error);
                });
        },
        validarCondicion() {
            this.errorCondicion = 0;
            this.errorMostrarMsjCondicion = [];

            if (!this.condicion)
                this.errorMostrarMsjCondicion.push(
                    "la condicion no puede estar vacio"
                );

            if (this.errorMostrarMsjCondicion.length) this.errorCondicion = 1;

            return this.errorCondicion;
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.condicion = "";
            this.descripcion = "";
            this.activo = "";
            this.errorCondicion = 0;
            this.errorMostrarMsjCondicion = [];
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            switch (modelo) {
                case "condicion": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal = "REGISTRAR NUEVA CONDICION";
                            this.condicion = "";
                            this.descripcion = "";
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            this.tituloModal = "ACTUALIZAR UNA CONDICON";
                            this.tipoAccion = 2;
                            this.id = data["id"];
                            this.condicion = data["condicion"];
                            this.descripcion = data["descripcion"];
                            this.activo = data["activo"];
                            break;
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.listarCondicion(this.buscar);
    }
};
</script>
