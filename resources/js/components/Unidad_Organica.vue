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
                                            <div v-show="errorUnidad">
                                                <div
                                                    class="alert alert-danger"
                                                    role="alert"
                                                >
                                                    <div
                                                        v-for="error in errorMostrarMsjUnidad"
                                                        :key="error"
                                                        v-text="error"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Organos</label>
                                            <select
                                                v-model="organo_id"
                                                class="form-control"
                                            >
                                                <option value="0"
                                                    >--Seleccionar el
                                                    organo--</option
                                                >
                                                <option
                                                    v-for="item in arrayOrganos"
                                                    :key="item.id"
                                                    :value="item.id"
                                                    v-text="item.organo"
                                                ></option>
                                            </select>
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
                                                v-model="unidad"
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
                                            @click="registrarUnidad()"
                                            v-if="tipoAccion == 1"
                                        >
                                            <i class="far fa-save"></i> Guardar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-success w-25"
                                            @click="actualizarUnidad()"
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
                                    @keyup="listarUnidad(buscar)"
                                />

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-default"
                                        @click="listarUnidad(buscar)"
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
                                    <th>Unidad Organica</th>
                                    <th>Abreviatura</th>
                                    <th>Organo</th>
                                    <th>Abreviatura</th>
                                    <th>Activo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in arrayUnidades"
                                    :key="item.id"
                                >
                                    <td v-text="index"></td>
                                    <td v-text="item.unidad"></td>
                                    <td v-text="item.slug"></td>
                                    <td v-text="item.organos.organo"></td>
                                    <td v-text="item.organos.slug"></td>
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
                                            @click="eliminarUnidad(item.id)"
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center m-5"
                            v-if="!arrayUnidades.length"
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
            organo_id: 0,
            unidad: "",
            slug: "",
            activo: 0,
            arrayUnidades: [],
            arrayOrganos: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            message: "",
            errorUnidad: 0,
            errorMostrarMsjUnidad: [],
            buscar: ""
        };
    },
    methods: {
        listarUnidad(buscar) {
            axios
                .get("/api/unidades_organicas?buscar=" + buscar)
                .then(response => {
                    var respuesta = response.data;
                    this.arrayUnidades = respuesta.unidades_organicas;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getOrganos() {
            axios
                .get("/api/getOrganos")
                .then(response => {
                    this.arrayOrganos = response.data.organos;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        registrarUnidad() {
            if (this.validarUnidad()) {
                return;
            }
            axios
                .post(`/api/unidades_organicas`, {
                    organo_id: this.organo_id,
                    unidad: this.unidad,
                    slug: this.slug
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Unidad Organica Registrada Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarUnidad(this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        actualizarUnidad() {
            if (this.validarUnidad()) {
                return;
            }
            let id = this.id;
            axios
                .put(`/api/unidades_organicas/${id}`, {
                    organo_id: this.organo_id,
                    unidad: this.unidad,
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
                    this.listarUnidad(this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        eliminarUnidad(id) {
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
                        .delete(`/api/unidades_organicas/${id}`)
                        .then(res => {
                            Swal.fire(
                                "Eliminado!",
                                "La organo fue eliminada",
                                "success"
                            );
                            this.listarUnidad(this.buscar);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        },
        cambiarActivo(id, estado) {
            axios
                .put(`/api/unidades_organicasAD/${id}/${estado}`, {})
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Se cambio el estado de la organo",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarUnidad(this.buscar);
                })
                .catch(() => {
                    console.log(error);
                });
        },
        validarUnidad() {
            this.errorUnidad = 0;
            this.errorMostrarMsjUnidad = [];

            if (this.organo_id === 0)
                this.errorMostrarMsjUnidad.push("Falta seleccionar el organo");

            if (!this.unidad)
                this.errorMostrarMsjUnidad.push(
                    "la organo no puede estar vacio"
                );

            if (this.errorMostrarMsjUnidad.length) this.errorUnidad = 1;

            return this.errorUnidad;
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.organo = "";
            this.slug = "";
            this.activo = "";
            this.errorUnidad = 0;
            this.errorMostrarMsjUnidad = [];
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            this.getOrganos();
            switch (modelo) {
                case "organo": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal =
                                "REGISTRAR UNA NUEVA UNIDAD ORGANICA";
                            this.organo_id = 0;
                            this.unidad = "";
                            this.slug = "";
                            this.activo = "";
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            this.tituloModal = "ACTUALIZAR UNA UNIDAD ORGANICA";
                            this.tipoAccion = 2;
                            this.id = data["id"];
                            this.organo_id = data["organo_id"];
                            this.unidad = data["unidad"];
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
        this.listarUnidad(this.buscar);
    }
};
</script>
