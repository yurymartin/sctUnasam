<template>
    <div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <b>LISTADO DE FICHAS SINTOMATICA</b>
                        </h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Persona</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item,
                                    index) in arrayDetalle_Sintomas"
                                    :key="item.id"
                                >
                                    <td v-text="index"></td>
                                    <th v-text="item.personas.nombres+' '+item.personas.apellidos"></th>
                                    <td v-text="item.fecha"></td>
                                    <td v-text="item.hora"></td>
                                    <td>
                                        <span
                                            class="badge badge-success"
                                            v-if="item.activo"
                                            >REVISADO</span
                                        >
                                        <span class="badge badge-danger" v-else
                                            >FALTA REVISAR</span
                                        >
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-warning btn-sm pl-2 pr-2"
                                            title="REVISAR FICHA SINTOMATICA"
                                            @click="abrirModal(item)"
                                        >
                                            <i class="fas fa-clipboard-check"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <nav aria-label="Page navigation example" class="mt-3">
                            <ul class="pagination justify-content-end">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">
                                        <i class="fas fa-angle-double-left"></i>
                                    </a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent=" cambiarPagina(page)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if=" pagination.current_page <pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent=" cambiarPagina(pagination.current_page + 1)">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-body">
                                    <table
                                        class="table table-hover text-nowrap"
                                    >
                                        <thead>
                                            <tr>
                                                <th>Sintoma</th>
                                                <th>Respuesta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in data.detalle_sintomas" :key="item.id">
                                                <td v-text="item.sintomas.sintoma"></td>
                                                <td>
                                                    <label>
                                                        {{ item.respuesta ? "Si" : "No" }}
                                                    </label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Descripcion</label>
                                <textarea class="form-control" v-model="descripcion" placeholder="escribir al una descripcion o recomendacion"></textarea>
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
                            @click="RevisarFicha()"
                        >
                            <i class="far fa-save"></i> Guardar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
import * as jsPDF from "jspdf";

export default {
    data() {
        return {
            nombres: localStorage.getItem("nombres"),
            apellidos: localStorage.getItem("apellidos"),
            dni: localStorage.getItem("dni"),
            direccion: localStorage.getItem("direccion"),
            id: 0,
            ficha_id: "",
            descripcion : "",
            activo: 0,
            data: [],
            arrayDetalle_Sintomas: [],
            tituloModal: "",
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
        };
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        listarDetalle_Sintoma(page, date) {
            axios
                .get(
                    `/api/getFichas?page=${page}`
                )
                .then(response => {
                    var respuesta = response.data;
                    this.arrayDetalle_Sintomas =
                        respuesta.fichas_sintomaticas.data;
                    this.pagination = respuesta.pagination;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cambiarPagina(page) {
            let me = this;
            //acualizar la pagina Actual
            me.pagination.current_page = page;
            //enviar la peticion para visaulizar la data de la pagina
            me.listarDetalle_Sintoma(page);
        },
        RevisarFicha() {
            axios
                .put(`/api/fichassintomaticas/${this.ficha_id}`, {
                    descripcion: this.descripcion,
                    activo: 1
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "FICHA SINTOMATICA REVISADA",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.listarDetalle_Sintoma(1);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getFichaSintomatica(id) {
            axios
                .get(`/api/fichassintomaticas/${id}`)
                .then(response => {
                    this.data = response.data;
                    console.log(this.data)
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            $("#modal").modal("hide");
        },
        abrirModal(data = []) {
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            this.tituloModal = "REVISAR UNA FICHA SINTOMATICA";
            this.getFichaSintomatica(data['id']);
            this.ficha_id = data['id'];

        }
    },
    mounted() {
        this.listarDetalle_Sintoma(1);
    }
};
</script>
