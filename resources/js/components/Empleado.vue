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
                            @click="abrirModal('empleados', 'registrar')"
                        >
                            <i class="far fa-plus-square"></i
                            ><b> REGISTRAR NUEVO EMPLEADO</b>
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
                                            <div v-show="errorEmpleado">
                                                <div
                                                    class="alert alert-danger"
                                                    role="alert"
                                                >
                                                    <div
                                                        v-for="(error,
                                                        index) in errorMostrarMsjEmpleado"
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
                                            <div class="col-md-6 form-group">
                                                <label>Condicion (*)</label>
                                                <select
                                                    class="form-control"
                                                    v-model="condicion_id"
                                                >
                                                    <option value="0">
                                                        -- Seleccionar la
                                                        condicion del empleado
                                                        --
                                                    </option>
                                                    <option
                                                        v-for="item in arrayCondiciones"
                                                        :key="item.id"
                                                        v-text="item.condicion"
                                                        :value="item.id"
                                                    ></option>
                                                </select>
                                                <!-- <v-select
                                                    @search="selectCondicion"
                                                    label="condicion"
                                                    :options="arrayCondiciones"
                                                    placeholder="Buscar condicion..."
                                                    @input="getCondiciones"
                                                ></v-select> -->
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="empleado"
                                                    >DNI (*)</label
                                                >
                                                <input
                                                    type="number"
                                                    v-model="dni"
                                                    placeholder="dni"
                                                    class="form-control"
                                                    autocomplete="off"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="dni.length > 8"
                                                    >maximo 8 digitios</span
                                                >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="nombres"
                                                    >Nombres (*)</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="nombres"
                                                    placeholder="nombres"
                                                    autocomplete="off"
                                                />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="apellidos"
                                                    >Apellidos (*)</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="apellidos"
                                                    placeholder="apellidos"
                                                    autocomplete="off"
                                                />
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="edad">Edad</label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    v-model="edad"
                                                    placeholder="edad"
                                                />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="genero"
                                                    >Genero</label
                                                >
                                                <select
                                                    class="form-control"
                                                    v-model="genero"
                                                >
                                                    <option value="MASCULINO"
                                                        >MASCULINO</option
                                                    >
                                                    <option value="FEMENINO"
                                                        >FEMENINO</option
                                                    >
                                                </select>
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
                                            @click="registrarEmpleado()"
                                            v-if="tipoAccion == 1"
                                        >
                                            <i class="far fa-save"></i> Guardar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-success w-25"
                                            @click="actualizarEmpleado()"
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
                            <b>LISTADO DE EMPLEADOS</b>
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
                                    @keyup="listarEmpleado(1, buscar)"
                                />

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-default"
                                        @click="listarEmpleado(1, buscar)"
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
                                    <th>DNI</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Edad</th>
                                    <th>Genero</th>
                                    <th>Condicion</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in arrayEmpleados"
                                    :key="item.id"
                                >
                                    <td v-text="index"></td>
                                    <td v-text="item.dni"></td>
                                    <td v-text="item.nombres"></td>
                                    <td v-text="item.apellidos"></td>
                                    <td v-text="item.edad"></td>
                                    <td v-text="item.genero"></td>
                                    <td>
                                        <span
                                            class="badge badge-primary"
                                            v-text="item.condiciones.condicion"
                                        ></span>
                                    </td>
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
                                                    'empleados',
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
                                            @click="eliminarEmpleado(item.id)"
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center mt-5 mr-5"
                            v-if="!arrayEmpleados.length"
                        >
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <nav aria-label="Page navigation example" class="mt-3">
                            <ul class="pagination justify-content-end">
                                <li
                                    class="page-item"
                                    v-if="pagination.current_page > 1"
                                >
                                    <a
                                        class="page-link"
                                        href="#"
                                        @click.prevent="
                                            cambiarPagina(
                                                pagination.current_page - 1,
                                                buscar
                                            )
                                        "
                                    >
                                        <i class="fas fa-angle-double-left"></i>
                                    </a>
                                </li>
                                <li
                                    class="page-item"
                                    v-for="page in pagesNumber"
                                    :key="page"
                                    :class="[page == isActived ? 'active' : '']"
                                >
                                    <a
                                        class="page-link"
                                        href="#"
                                        @click.prevent="
                                            cambiarPagina(page, buscar)
                                        "
                                        v-text="page"
                                    >
                                    </a>
                                </li>
                                <li
                                    class="page-item"
                                    v-if="
                                        pagination.current_page <
                                            pagination.last_page
                                    "
                                >
                                    <a
                                        class="page-link"
                                        href="#"
                                        @click.prevent="
                                            cambiarPagina(
                                                pagination.current_page + 1,
                                                buscar
                                            )
                                        "
                                    >
                                        <i
                                            class="fas fa-angle-double-right"
                                        ></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
    data() {
        return {
            id: 0,
            condicion_id: 0,
            dni: "",
            nombres: "",
            apellidos: "",
            edad: 0,
            genero: "MASCULINO",
            activo: 0,
            edad: "",
            arrayEmpleados: [],
            arrayCondiciones: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            message: "",
            errorEmpleado: 0,
            errorMostrarMsjEmpleado: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            buscar: ""
        };
    },
    computed: {
        imagen() {
            return this.imagenMiniatura;
        },
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
    components: {
        vSelect
    },
    methods: {
        listarEmpleado(page, buscar) {
            axios
                .get(`/api/empleados?page=${page}&buscar=${buscar}`)
                .then(response => {
                    var respuesta = response.data;
                    this.arrayEmpleados = respuesta.empleados.data;
                    this.pagination = respuesta.pagination;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cambiarPagina(page, buscar) {
            let me = this;
            //acualizar la pagina Actual
            me.pagination.current_page = page;
            //enviar la peticion para visaulizar la data de la pagina
            me.listarEmpleado(page, buscar);
        },
        selectCondicion() {
            axios
                .get(`/api/getCondiciones`)
                .then(response => {
                    let respuesta = response.data;
                    this.arrayCondiciones = respuesta.condiciones;
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        registrarEmpleado() {
            if (this.validarEmpleado()) {
                return;
            }
            axios
                .post(`/api/empleados`, {
                    condicion_id: this.condicion_id,
                    dni: this.dni,
                    nombres: this.nombres,
                    apellidos: this.apellidos,
                    edad: this.edad,
                    genero: this.genero
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Empleado Registrado Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarEmpleado(1, this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        actualizarEmpleado() {
            if (this.validarEmpleado()) {
                return;
            }
            let id = this.id;
            axios
                .put(`/api/empleados/${id}`, {
                    condicion_id: this.condicion_id,
                    dni: this.dni,
                    nombres: this.nombres,
                    apellidos: this.apellidos,
                    edad: this.edad,
                    genero: this.genero,
                    activo: this.activo
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Empleado Actualizado Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarEmpleado(1, this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        eliminarEmpleado(id) {
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
                        .delete(`/api/empleados/${id}`)
                        .then(res => {
                            Swal.fire(
                                "Eliminado!",
                                "El empleado fue eliminada",
                                "success"
                            );
                            this.listarEmpleado(1, this.buscar);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        },
        cambiarActivo(id, estado) {
            axios
                .put(`/api/empleadosAD/${id}/${estado}`, {})
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Se cambio el estado del empleado",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarEmpleado(1, this.buscar);
                })
                .catch(() => {
                    console.log(error);
                });
        },
        validarEmpleado() {
            this.errorEmpleado = 0;
            this.errorMostrarMsjEmpleado = [];

            if (this.condicion_id == 0)
                this.errorMostrarMsjEmpleado.push(
                    "Seleccione la condicion del empleado"
                );

            if (!this.dni)
                this.errorMostrarMsjEmpleado.push(
                    "El dni no puede estar vacio"
                );

            if (this.dni.length > 8)
                this.errorMostrarMsjEmpleado.push(
                    "El dni supero los 8 digitos"
                );

            if (!this.nombres)
                this.errorMostrarMsjEmpleado.push(
                    "Los nombres no pueden estar vacio"
                );

            if (!this.apellidos)
                this.errorMostrarMsjEmpleado.push(
                    "Los apellidos no pueden estar vacio"
                );

            if (!this.edad)
                this.errorMostrarMsjEmpleado.push(
                    "La edad no puede estar vacio"
                );

            if (this.errorMostrarMsjEmpleado.length) this.errorEmpleado = 1;

            return this.errorEmpleado;
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.condicion_id = 0;
            this.dni = "";
            this.nombres = "";
            this.apellidos = "";
            this.edad = "";
            this.genero = "MASCULINO";
            this.activo = 0;
            this.arrayCondiciones = [];
            this.errorEmpleado = 0;
            this.errorMostrarMsjEmpleado = [];
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            this.selectCondicion();
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            switch (modelo) {
                case "empleados": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal = "REGISTRAR NUEVO EMPLEADO";
                            this.condicion_id = 0;
                            this.dni = "";
                            this.nombres = "";
                            this.apellidos = "";
                            this.edad = "";
                            this.genero = "MASCULINO";
                            this.activo = 0;
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            this.tituloModal = "ACTUALIZAR UNA CONDICON";
                            this.tipoAccion = 2;
                            this.id = data["id"];
                            this.condicion_id = data["condicion_id"];
                            this.dni = data["dni"];
                            this.nombres = data["nombres"];
                            this.apellidos = data["apellidos"];
                            this.edad = data["edad"];
                            this.genero = data["genero"];
                            this.activo = data["activo"];
                            break;
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.listarEmpleado(1, this.buscar);
    }
};
</script>
