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
                            @click="abrirModal('organo', 'registrar')"
                        >
                            <i class="far fa-plus-square"></i
                            ><b> REGISTRAR NUEVA ORGANO</b>
                        </button>
                        <!-- MODAL -->
                        <div class="modal fade text-sm" id="modal">
                            <div class="modal-dialog modal-lg">
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
                                            <div v-show="errorOrgano">
                                                <div
                                                    class="alert alert-danger"
                                                    role="alert"
                                                >
                                                    <div
                                                        v-for="error in errorMostrarMsjOrgano"
                                                        :key="error"
                                                        v-text="error"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="organo"
                                                >Nombre del Organo
                                                <span class="text-danger"
                                                    >(*)</span
                                                ></label
                                            >
                                            <input
                                                type="text"
                                                v-model="organo"
                                                placeholder="Nombre"
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="organo"
                                                >Abreviatura</label
                                            >
                                            <input
                                                type="text"
                                                v-model="slug"
                                                placeholder="abreviatura del organo"
                                                class="form-control"
                                            />
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
                                            @click="registrarOrgano()"
                                            v-if="tipoAccion == 1"
                                        >
                                            <i class="far fa-save"></i> Guardar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-success w-25"
                                            @click="actualizarOrgano()"
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
                            <b>LISTADO DE ORGANO</b>
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
                                    @keyup="listarOrgano(buscar)"
                                />

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-default"
                                        @click="listarOrgano(buscar)"
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
                                    <th>Organo</th>
                                    <th>Abreviatura</th>
                                    <th>Activo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in arrayOrganos"
                                    :key="item.id"
                                >
                                    <td v-text="index"></td>
                                    <td v-text="item.organo"></td>
                                    <td v-text="item.slug"></td>
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
                                                    'organo',
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
                                            @click="eliminarOrgano(item.id)"
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center m-5"
                            v-if="!arrayOrganos.length"
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
            organo: "",
            slug: "",
            activo: 0,
            arrayOrganos: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            message: "",
            errorOrgano: 0,
            errorMostrarMsjOrgano: [],
            buscar: ""
        };
    },
    methods: {
        listarOrgano(buscar) {
            axios
                .get("/api/organos?buscar=" + buscar)
                .then(response => {
                    var respuesta = response.data;
                    this.arrayOrganos = respuesta.organos;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        registrarOrgano() {
            if (this.validarOrgano()) {
                return;
            }
            axios
                .post(`/api/organos`, {
                    organo: this.organo,
                    slug: this.slug,
                    activo: 1
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Organo Registrada Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarOrgano(this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        actualizarOrgano() {
            if (this.validarOrgano()) {
                return;
            }
            let id = this.id;
            axios
                .put(`/api/organos/${id}`, {
                    organo: this.organo,
                    slug: this.slug,
                    activo: this.activo
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Organo Actualizado Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarOrgano(this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        eliminarOrgano(id) {
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
                        .delete(`/api/organos/${id}`)
                        .then(res => {
                            Swal.fire(
                                "Eliminado!",
                                "La organo fue eliminada",
                                "success"
                            );
                            this.listarOrgano(this.buscar);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        },
        cambiarActivo(id, estado) {
            axios
                .put(`/api/organosAD/${id}/${estado}`, {})
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Se cambio el estado de la organo",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarOrgano(this.buscar);
                })
                .catch(() => {
                    console.log(error);
                });
        },
        validarOrgano() {
            this.errorOrgano = 0;
            this.errorMostrarMsjOrgano = [];

            if (!this.organo)
                this.errorMostrarMsjOrgano.push(
                    "la organo no puede estar vacio"
                );

            if (this.errorMostrarMsjOrgano.length) this.errorOrgano = 1;

            return this.errorOrgano;
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.organo = "";
            this.slug = "";
            this.activo = "";
            this.errorOrgano = 0;
            this.errorMostrarMsjOrgano = [];
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            switch (modelo) {
                case "organo": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal = "REGISTRAR NUEVA ORGANO";
                            this.organo = "";
                            this.slug = "";
                            this.activo = "";
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            this.tituloModal = "ACTUALIZAR UNA CONDICON";
                            this.tipoAccion = 2;
                            this.id = data["id"];
                            this.organo = data["organo"];
                            this.slug = data["slug"];
                            this.activo = data["activo"];
                            break;
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.listarOrgano(this.buscar);
    }
};
</script>
