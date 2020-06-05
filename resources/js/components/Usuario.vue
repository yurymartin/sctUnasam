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
                            @click="abrirModal('users', 'registrar')"
                        >
                            <i class="far fa-plus-square"></i
                            ><b> REGISTRAR UNA NUEVO USUARIO</b>
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
                                            <div v-show="errorUser">
                                                <div
                                                    class="alert alert-danger"
                                                    role="alert"
                                                >
                                                    <div
                                                        v-for="(error,
                                                        index) in errorMostrarMsjUser"
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
                                                <label>Empleado (*)</label>
                                                <v-select
                                                    v-model="select"
                                                    class="style-chooser text-lg"
                                                    @search="selectPersonas"
                                                    label="persona"
                                                    :options="arrayPersonas"
                                                    placeholder="Buscar persona por el dni, nombres o apellidos..."
                                                    @input="getPersonas"
                                                ></v-select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label
                                                    >Tipo de Usuario (*)</label
                                                >
                                                <select
                                                    v-model="tipo_usuario_id"
                                                    class="form-control"
                                                >
                                                    <option value="0"
                                                        >--Seleccione el Tipo de
                                                        Usuario</option
                                                    >
                                                    <option
                                                        :value="item.id"
                                                        v-for="item in arrayTipoUsers"
                                                        :key="item.id"
                                                        v-text="item.tipo"
                                                    ></option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="name"
                                                    >Login (*)</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="name"
                                                    placeholder="login del usuario"
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="email"
                                                    >Email (*)</label
                                                >
                                                <input
                                                    type="email"
                                                    v-model="email"
                                                    placeholder="email del usuario"
                                                    class="form-control"
                                                />
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="password"
                                                    >Password (*)</label
                                                >
                                                <input
                                                    type="password"
                                                    v-model="password"
                                                    placeholder="password del usuario"
                                                    class="form-control"
                                                />
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="password"
                                                    >Password Confirm (*)</label
                                                >
                                                <input
                                                    type="password"
                                                    v-model="confirmpassword"
                                                    placeholder="password de confirmacion del usuario"
                                                    class="form-control"
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
                                            @click="registrarUser()"
                                            v-if="tipoAccion == 1"
                                        >
                                            <i class="far fa-save"></i> Guardar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-success w-25"
                                            @click="actualizarUser()"
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
                                    @keyup="listarUser(1, buscar)"
                                />

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-default"
                                        @click="listarUser(1, buscar)"
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
                                    <th>Empleado</th>
                                    <th>Tipo Usuario</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in arrayUsers"
                                    :key="item.id"
                                >
                                    <td v-text="index"></td>
                                    <td v-text="item.personas.nombres"></td>
                                    <td
                                        v-text="
                                            item.personas.nombres +
                                                ' ' +
                                                item.personas.apellidos
                                        "
                                    ></td>
                                    <td v-text="item.tipo_usuarios.tipo"></td>
                                    <td v-text="item.name"></td>
                                    <td v-text="item.email"></td>
                                    <td>
                                        <span
                                            :class="
                                                item.activo
                                                    ? 'badge badge-primary'
                                                    : 'badge badge-danger'
                                            "
                                            v-text="
                                                item.activo
                                                    ? 'Activo'
                                                    : 'Desactivado'
                                            "
                                        ></span>
                                    </td>
                                    <td>
                                        <button
                                            type="button"
                                            @click="
                                                abrirModal(
                                                    'users',
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
                                            @click="eliminarUser(item.id)"
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center m-5"
                            v-if="!arrayUsers.length"
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
            persona_id: 0,
            tipo_usuario_id: 0,
            name: "",
            email: "",
            password: "",
            confirmpassword: "",
            activo: 0,
            arrayUsers: [],
            arrayTipoUsers: [],
            arrayPersonas: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            message: "",
            errorUser: 0,
            errorMostrarMsjUser: [],
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
            token: localStorage.getItem("token")
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
        listarUser(page, buscar) {
            axios
                .get(`/api/users?page=${page}&buscar=${buscar}`)
                .then(response => {
                    var respuesta = response.data;
                    this.arrayUsers = respuesta.users.data;
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
            me.listarUser(page, date, buscar);
        },
        selectPersonas(search, loading) {
            let me = this;
            loading(true);
            var url = "/api/getPersonas?filtro=" + search;
            axios
                .get(url)
                .then(function(response) {
                    let respuesta = response.data;
                    me.arrayPersonas = respuesta.personas;
                    loading(false);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getPersonas(val1) {
            this.loading = true;
            this.persona_id = val1.id;
        },
        getTipoUsuarios() {
            var url = "/api/getTipo_usuario";
            axios
                .get(url)
                .then(response => {
                    let respuesta = response.data;
                    this.arrayTipoUsers = respuesta.tipo_usuarios;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        registrarUser() {
            if (this.validarUser()) {
                return;
            }
            axios
                .post(`/api/users`, {
                    persona_id: this.persona_id,
                    tipo_usuario_id: this.tipo_usuario_id,
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Usuario Registrado Exitosamente",
                        showConfirmButton: false,
                        timer: 10007
                    });
                    console.log(response);
                    this.listarUser(1, this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cambiarActivo(id, estado) {
            axios
                .put(`/api/usersAD/${id}/${estado}`, {})
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Se cambio el estado del usuario",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarUser(1, this.buscar);
                })
                .catch(() => {
                    console.log(error);
                });
        },
        analizarEstado() {
            if (parseInt(this.user) > 40) {
                this.estado = "Enfermo";
            } else {
                this.estado = "Saludable";
            }
        },
        actualizarUser() {
            if (this.validarUser()) {
                return;
            }
            let id = this.id;
            axios
                .put(`/api/users/${id}`, {
                    persona_id: this.persona_id,
                    tipo_usuario_id: this.tipo_usuario_id,
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "User Actualizado Exitosamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    this.listarUser(1, this.buscar);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        eliminarUser(id) {
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
                        .delete(`/api/users/${id}`)
                        .then(res => {
                            Swal.fire(
                                "Eliminado!",
                                "El usuaario fue eliminada",
                                "success"
                            );
                            this.listarUser(1, this.buscar);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        },
        validarUser() {
            this.errorUser = 0;
            this.errorMostrarMsjUser = [];

            if (this.persona_id == 0)
                this.errorMostrarMsjUser.push("Seleccione el persona");

            if (this.tipo_usuario_id == 0)
                this.errorMostrarMsjUser.push("Seleccione el tipo de usuario");

            if (!this.name)
                this.errorMostrarMsjUser.push("falta ingresar el login");

            if (!this.email)
                this.errorMostrarMsjUser.push("falta ingresar el email");

            if (this.tipoAccion == 1) {
                if (!this.password)
                    this.errorMostrarMsjUser.push("falta ingresar el password");
                if (!this.confirmpassword)
                    this.errorMostrarMsjUser.push(
                        "falta ingresar el password de confirmacion"
                    );
            }

            if (this.password != this.confirmpassword)
                this.errorMostrarMsjUser.push("no condicen los passwords");

            if (this.errorMostrarMsjUser.length) this.errorUser = 1;

            return this.errorUser;
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.persona_id = 0;
            this.tipo_usuario_id = 0;
            this.name = "";
            this.email = "";
            this.password = "";
            this.confirmpassword = "";
            this.activo = 0;
            this.user = "";
            this.estado = "";
            this.activo = 0;
            this.arrayPersonas = [];
            this.errorUser = 0;
            this.errorMostrarMsjUser = [];
            this.select = "";
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            this.getTipoUsuarios();
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            switch (modelo) {
                case "users": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal = "REGISTRAR NUEVO EMPLEADO";
                            this.persona_id = 0;
                            this.tipo_usuario_id = 0;
                            this.name = "";
                            this.email = "";
                            this.password = "";
                            this.activo = 0;
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            this.tituloModal = "ACTUALIZAR UNA CONDICON";
                            this.tipoAccion = 2;
                            this.id = data["id"];
                            this.persona_id = data["persona_id"];
                            this.tipo_usuario_id = data["tipo_usuario_id"];
                            this.name = data["name"];
                            this.email = data["email"];
                            this.activo = data["activo"];
                            break;
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.listarUser(1, this.buscar);
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
</style>
