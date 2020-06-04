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
                                            <div class="col-md-10 form-group">
                                                <label>Persona (*)</label>
                                                <v-select
                                                    v-model="select"
                                                    class="style-chooser text-lg"
                                                    @search="selectEmpleados"
                                                    label="empleado"
                                                    :options="arrayEmpleados"
                                                    placeholder="Buscar empleado por el dni, nombres o apellidos..."
                                                    @input="getEmpleados"
                                                ></v-select>
                                            </div>
                                            <div class="col-md-2 form-group">
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
                                            v-if="tipoAccion == 1"
                                        >
                                            <i class="far fa-save"></i> Guardar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-success w-25"
                                            @click="actualizarTemperatura()"
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
                            <b>LISTADO DE REGISTROS DE TEMPERATURAS</b>
                        </h3>

                        <div class="card-tools">
                            <div
                                class="input-group input-group-sm"
                                style="width: 400px;"
                            >
                                <input
                                    type="text"
                                    name="table_search"
                                    class="form-control float-right"
                                    placeholder="Buscar"
                                    v-model="buscar"
                                    @keyup="listarTemperatura(1, date, buscar)"
                                />

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-default"
                                        @click="
                                            listarTemperatura(1, date, buscar)
                                        "
                                    >
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <input
                                    type="date"
                                    class="form-control ml-3"
                                    v-model="date"
                                    @change="listarTemperatura(1, date, buscar)"
                                />
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
                                    <th>Empleado</th>
                                    <th>Temperatura</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in arrayTemperaturas"
                                    :key="item.id"
                                >
                                    <td v-text="index"></td>
                                    <td v-text="item.empleados.dni"></td>
                                    <td
                                        v-text="
                                            item.empleados.nombres +
                                                ' ' +
                                                item.empleados.apellidos
                                        "
                                    ></td>
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
                                    <td>
                                        <button
                                            type="button"
                                            @click="
                                                abrirModal(
                                                    'temperaturas',
                                                    'actualizar',
                                                    item
                                                )
                                            "
                                            class="btn btn-success btn-sm"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm"
                                            @click="
                                                eliminarTemperatura(item.id)
                                            "
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center m-5"
                            v-if="!arrayTemperaturas.length"
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
                                                date,
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
                                            cambiarPagina(page, date, buscar)
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
                                                date,
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
            select: "",
            id: 0,
            empleado_id: 0,
            temperatura: 0,
            estado: "",
            activo: 0,
            arrayTemperaturas: [],
            arrayEmpleados: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            message: "",
            errorTemperatura: 0,
            errorMostrarMsjTemperatura: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            buscar: "",
            date: ""
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
    components: {
        vSelect
    },
    methods: {
        listarTemperatura(page, date, buscar) {
            axios
                .get(
                    `/api/temperaturas?page=${page}&date=${date}&buscar=${buscar}`
                )
                .then(response => {
                    var respuesta = response.data;
                    this.arrayTemperaturas = respuesta.temperaturas.data;
                    this.pagination = respuesta.pagination;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cambiarPagina(page, date, buscar) {
            let me = this;
            //acualizar la pagina Actual
            me.pagination.current_page = page;
            //enviar la peticion para visaulizar la data de la pagina
            me.listarTemperatura(page, date, buscar);
        },
        selectEmpleados(search, loading) {
            let me = this;
            loading(true);
            var url = "/api/getEmpleados?filtro=" + search;
            axios
                .get(url)
                .then(function(response) {
                    let respuesta = response.data;
                    me.arrayEmpleados = respuesta.empleados;
                    loading(false);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getEmpleados(val1) {
            this.loading = true;
            this.empleado_id = val1.id;
        },
        registrarTemperatura() {
            if (this.validarTemperatura()) {
                return;
            }
            axios
                .post(`/api/temperaturas`, {
                    empleado_id: this.empleado_id,
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
                    console.log(response);
                    this.listarTemperatura(1, this.date, this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        analizarEstado() {
            if (parseInt(this.temperatura) > 40) {
                this.estado = "Enfermo";
            } else {
                this.estado = "Saludable";
            }
        },
        actualizarTemperatura() {
            if (this.validarTemperatura()) {
                return;
            }
            let id = this.id;
            axios
                .put(`/api/temperaturas/${id}`, {
                    empleado_id: this.empleado_id,
                    temperatura: this.temperatura,
                    estado: this.estado
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Temperatura Actualizado Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarTemperatura(1, this.date, this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        eliminarTemperatura(id) {
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
                        .delete(`/api/temperaturas/${id}`)
                        .then(res => {
                            Swal.fire(
                                "Eliminado!",
                                "El empleado fue eliminada",
                                "success"
                            );
                            this.listarTemperatura(1, this.date, this.buscar);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        },
        validarTemperatura() {
            this.errorTemperatura = 0;
            this.errorMostrarMsjTemperatura = [];

            if (this.empleado_id == 0)
                this.errorMostrarMsjTemperatura.push(
                    "Seleccione la nombres del empleado"
                );

            if (!this.temperatura)
                this.errorMostrarMsjTemperatura.push(
                    "El temperatura no puede estar vacio"
                );

            if (this.errorMostrarMsjTemperatura.length)
                this.errorTemperatura = 1;

            return this.errorTemperatura;
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.empleado_id = 0;
            this.temperatura = "";
            this.estado = "";
            this.activo = 0;
            this.arrayEmpleados = [];
            this.errorTemperatura = 0;
            this.errorMostrarMsjTemperatura = [];
            this.select = "";
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            // this.getCondiciones();
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            switch (modelo) {
                case "temperaturas": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal = "REGISTRAR NUEVO EMPLEADO";
                            this.nombres_id = 0;
                            this.temperatura = "";
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
                            this.nombres_id = data["nombres_id"];
                            this.temperatura = data["temperatura"];
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
        },
        fechaActual() {
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth() + 1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
            if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
            this.date = ano + "-" + mes + "-" + dia;
        }
    },
    mounted() {
        this.fechaActual();
        this.listarTemperatura(1, this.date, this.buscar);
    }
};
</script>

<style>
.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle,
.style-chooser .vs__dropdown-menu {
    background: #dfe5fb;
    border: none;
    color: #394066;
    text-transform: lowercase;
    font-variant: small-caps;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
    fill: #394066;
}
.v-select .dropdown-toggle .clear {
    display: none;
}
</style>
