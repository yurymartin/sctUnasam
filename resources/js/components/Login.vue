<template>
    <div class="login-page" v-if="arrayTipoUsers.length">
        <div class="login-box">
            <div class="login-logo">
                <p>SCT | UNASAM</p>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">
                        Inicia sesión para comenzar tu sesión
                    </p>

                    <div class="input-group mb-4">
                        <select class="form-control" v-model="tipo_usuario_id">
                            <option
                                :value="item.id"
                                v-for="item in arrayTipoUsers"
                                :key="item.id"
                                v-text="item.tipo"
                            ></option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user-lock"></i>
                            </div>
                        </div>
                    </div>

                    <span class="text-danger" v-if="errorEmail"
                        >el email es obligatorio (*)</span
                    >
                    <div
                        :class="
                            errorEmail
                                ? 'input-group mb-3 border border-danger rounded'
                                : 'input-group mb-3'
                        "
                    >
                        <input
                            type="email"
                            class="form-control"
                            placeholder="Email"
                            v-model="email"
                        />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <span class="text-danger" v-if="errorPassword"
                        >el password es obligatorio (*)</span
                    >
                    <div
                        :class="
                            errorPassword
                                ? 'input-group mb-3 border border-danger rounded'
                                : 'input-group mb-3'
                        "
                    >
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Password"
                            v-model="password"
                        />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button
                                type="submit"
                                class="btn btn-primary btn-block rounded-0"
                                @click="login()"
                            >
                                <i class="fas fa-unlock-alt"></i> INGRESAR
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
    data() {
        return {
            nombres: "",
            apellidos: "",
            direccion: "",
            celular: "",
            dni: "",
            email: "",
            tipo_usuario_id: 3,
            password: "",
            arrayTipoUsers: [],
            errorEmail: false,
            errorPassword: false,
            token: "",
            type: "",
            tipo_usuario: ""
        };
    },
    methods: {
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
        login() {
            if (this.validar()) {
                return;
            }
            axios
                .post(`/api/login`, {
                    email: this.email,
                    password: this.password,
                    tipo_usuario_id: this.tipo_usuario_id
                })
                .then(response => {
                    if (response.data.res) {
                        this.token = response.data.token.token;
                        this.type = response.data.type;
                        this.key = response.data.tipo_usuario.key;
                        this.persona = response.data.persona.id;
                        this.nombres = response.data.persona.nombres;
                        this.apellidos = response.data.persona.apellidos;
                        this.dni = response.data.persona.dni;
                        this.direccion = response.data.persona.direccion;
                        this.celular = response.data.persona.celular;
                        console.log(response.data.persona);
                        localStorage.setItem(
                            "token",
                            this.type + " " + this.token
                        );
                        localStorage.setItem("persona", this.persona);
                        localStorage.setItem("nombres", this.nombres);
                        localStorage.setItem("apellidos", this.apellidos);
                        localStorage.setItem("dni", this.dni);
                        localStorage.setItem("direccion", this.direccion);
                        localStorage.setItem("celular", this.celular);
                        localStorage.setItem("key", this.key);
                        this.$router.push("/home");
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire(
                            "Error!",
                            "Credenciales Incorrectas O el usuario esta inactivo",
                            "error"
                        );
                        this.password = "";
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        validar() {
            if (!this.email) this.errorEmail = true;
            if (!this.password) this.errorPassword = true;
        }
    },
    mounted() {
        this.getTipoUsuarios();
    }
};
</script>
