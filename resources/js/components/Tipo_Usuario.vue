<template>
    <div>
        <div class="card card-primary card-outline mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <!-- <button
                            type="button"
                            class="btn btn-primary btn-block"
                            @click="abrirModal('tipo_usuario', 'registrar')"
                        >
                            <i class="far fa-plus-square"></i
                            ><b> REGISTRAR NUEVA TIPO DE USUARIO</b>
                        </button> -->
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
                                            <div v-show="errorTipo">
                                                <div
                                                    class="alert alert-danger"
                                                    role="alert"
                                                >
                                                    <div
                                                        v-for="error in errorMostrarMsjTipo"
                                                        :key="error"
                                                        v-text="error"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="tipo_usuario"
                                                >Tipo (*)</label
                                            >
                                            <input
                                                type="text"
                                                v-model="tipo_usuario"
                                                placeholder="tipo_usuario"
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
                                            @click="registrarTipo()"
                                            v-if="tipoAccion == 1"
                                        >
                                            <i class="far fa-save"></i> Guardar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-success w-25"
                                            @click="actualizarTipo()"
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
                            <b>LISTADO DE TIPOS DE USUARIOS</b>
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
                                    @keyup="listarTipo(buscar)"
                                />

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-default"
                                        @click="listarTipo(buscar)"
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
                                    <th>Tipo</th>
                                    <th>Descripcion</th>
                                    <th>Activo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in arrayTipo"
                                    :key="item.id"
                                >
                                    <td v-text="index"></td>
                                    <td v-text="item.tipo"></td>
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
                                                    'tipo_usuario',
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
                                            @click="eliminarTipo(item.id)"
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center m-5"
                            v-if="!arrayTipo.length"
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
            tipo_usuario: "",
            descripcion: "",
            activo: 0,
            arrayTipo: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            message: "",
            errorTipo: 0,
            errorMostrarMsjTipo: [],
            buscar: ""
        };
    },
    methods: {
        listarTipo(buscar) {
            axios
                .get(`api/tipo_usuarios/?buscar=${buscar}`)
                .then(response => {
                    var respuesta = response.data;
                    this.arrayTipo = respuesta.tipo_usuarios;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        registrarTipo() {
            if (this.validarTipo()) {
                return;
            }
            axios
                .post(`/api/tipo_usuarios`, {
                    tipo: this.tipo_usuario,
                    descripcion: this.descripcion
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Tipo Registrada Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarTipo(this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        actualizarTipo() {
            if (this.validarTipo()) {
                return;
            }
            let id = this.id;
            axios
                .put(`/api/tipo_usuarios/${id}`, {
                    tipo_usuario: this.tipo_usuario,
                    descripcion: this.descripcion,
                    activo: this.activo
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Tipo Actualizado Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarTipo(this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        eliminarTipo(id) {
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
                        .delete(`/api/tipo_usuarios/${id}`)
                        .then(res => {
                            Swal.fire(
                                "Eliminado!",
                                "La tipo_usuario fue eliminada",
                                "success"
                            );
                            this.listarTipo(this.buscar);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        },
        cambiarActivo(id, estado) {
            axios
                .put(`/api/tipo_usuariosAD/${id}/${estado}`, {})
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Se cambio el estado de la tipo_usuario",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarTipo(this.buscar);
                })
                .catch(() => {
                    console.log(error);
                });
        },
        validarTipo() {
            this.errorTipo = 0;
            this.errorMostrarMsjTipo = [];

            if (!this.tipo_usuario)
                this.errorMostrarMsjTipo.push(
                    "la tipo usuario no puede estar vacio"
                );

            if (this.errorMostrarMsjTipo.length) this.errorTipo = 1;

            return this.errorTipo;
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.tipo_usuario = "";
            this.descripcion = "";
            this.activo = "";
            this.errorTipo = 0;
            this.errorMostrarMsjTipo = [];
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            switch (modelo) {
                case "tipo_usuario": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal = "REGISTRAR NUEVA CONDICION";
                            this.tipo_usuario = "";
                            this.descripcion = "";
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            this.tituloModal = "ACTUALIZAR UNA CONDICON";
                            this.tipoAccion = 2;
                            this.id = data["id"];
                            this.tipo_usuario = data["tipo"];
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
        this.listarTipo(this.buscar);
    }
};
</script>
