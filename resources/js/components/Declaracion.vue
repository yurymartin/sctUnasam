<template>
    <div class="image">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 mt-5">
                <div class="card rounded-0 mb-4">
                    <div
                        class="card-header text-left cabecera rounded-0 pt-3 pb-3"
                    >
                        <h1 class="texto">INFORMACIÓN ADICIONAL DE SALUD</h1>
                        <br />
                        <p class="text-justify">
                            Ante la emisión del Decreto Supremo que declara
                            Estado de Emergencia Nacional por las graves
                            circunstancias que afectan la vida de la Nación a
                            consecuencia del brote del COVID-19, el cual dispone
                            el aislamiento social obligatorio (cuarentena), Bajo
                            esta premisa es de suma importancia el recojo de
                            información adicional de salud de nuestros
                            colaboradores de nuestra universidad Santiago
                            Antúnez de Mayolo, información que nos servirá para
                            las siguientes decisiones en la prevención y
                            mitigación del COVID-19. Por favor brinde datos
                            verdaderos y no llene 2 veces el formulario.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 form-group">
                            <div v-show="error">
                                <div class="alert alert-danger" role="alert">
                                    <div
                                        v-for="error in arrayError"
                                        :key="error"
                                    >
                                        <p>
                                            <i
                                                class="fas fa-exclamation-triangle"
                                            ></i>
                                            {{ error }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mr-5 ml-5">
                            <div class="col-md-12 form-group">
                                <label
                                    ><span class="text-danger">*</span
                                    >Obligatorio</label
                                >
                            </div>
                            <div class="col-md-12 form-group mt-4">
                                <div class="row">
                                    <div class="col-md-9" v-if="!existe">
                                        <label
                                            >3.DNI
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            class="form-control rounded-0"
                                            :class="
                                                dni.length > 8
                                                    ? 'form-control rounded-0 border border-danger'
                                                    : 'form-control rounded-0'
                                            "
                                            placeholder="Escriba su respuesta"
                                            v-model="dni"
                                        />
                                        <span
                                            v-if="dni.length > 8"
                                            class="text-danger"
                                            >maximo 8 digitos</span
                                        >
                                    </div>
                                    <div class="col-md-12" v-else>
                                        <input
                                            type="text"
                                            class="form-control rounded-0"
                                            :class="
                                                dni.length > 8
                                                    ? 'form-control rounded-0 border border-danger'
                                                    : 'form-control rounded-0'
                                            "
                                            placeholder="Escriba su respuesta"
                                            v-model="dni"
                                            readonly
                                        />
                                    </div>
                                    <div class="col-md-3">
                                        <button
                                            v-if="!existe"
                                            class="btn btn-primary rounded-0 verificar btn-block"
                                            @click="verifyPersona()"
                                        >
                                            <i
                                                class="fas fa-user-check mr-2 ml-2"
                                            ></i>
                                            VERIFICAR
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <template v-if="existe">
                                <div class="col-md-12 form-group mt-2">
                                    <label
                                        >1.NOMBRES
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        type="text"
                                        class="form-control rounded-0"
                                        placeholder="Escriba su respuesta"
                                        v-model="nombres"
                                    />
                                </div>
                                <div class="col-md-12 form-group mt-2">
                                    <label
                                        >2.APELLIDOS
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        type="text"
                                        class="form-control rounded-0"
                                        placeholder="Escriba su respuesta"
                                        v-model="apellidos"
                                    />
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label
                                        >4.CELULAR
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        type="text"
                                        class="form-control rounded-0"
                                        placeholder="Escriba su respuesta"
                                        v-model="celular"
                                    />
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label
                                        >5.CORREO INSTITUCIONAL
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        type="text"
                                        class="form-control rounded-0"
                                        placeholder="Escriba su respuesta"
                                        v-model="email"
                                    />
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label
                                        >6.DIRECCIÓN DOMICILIARIA
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        type="text"
                                        class="form-control rounded-0"
                                        placeholder="Escriba su respuesta"
                                        v-model="direccion"
                                    />
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label
                                        >7.DEPENDENCIA ACADÉMICA O
                                        ADMINISTRATIVA EN LA QUE LABORA
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        type="text"
                                        class="form-control rounded-0"
                                        placeholder="Escriba su respuesta"
                                        v-model="organo"
                                    />
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label
                                        >8.UNIDAD ORGANICA DONDE LABORA</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control rounded-0"
                                        placeholder="Escriba su respuesta"
                                        v-model="unidad"
                                    />
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label
                                        >9.FACTORES DE RIESGO
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <table
                                        class="table table-hover text-nowrap"
                                    >
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>SI</th>
                                                <th>NO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="item in arrayCondiciones"
                                                :key="item.id"
                                            >
                                                <td
                                                    v-text="item.condicion"
                                                ></td>
                                                <td>
                                                    <input
                                                        type="radio"
                                                        :name="'a' + item.id"
                                                        value="1"
                                                    />
                                                </td>
                                                <td>
                                                    <input
                                                        type="radio"
                                                        :name="'a' + item.id"
                                                        value="0"
                                                        checked
                                                    />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header cabecera">
                                            <div class="card-title">
                                                DATOS PARA REGISTRARSE EN EL
                                                SISTEMA
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div
                                                class="col-md-12 form-group mt-4"
                                            >
                                                <label
                                                    >PASSWORD
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control rounded-0"
                                                    placeholder="Escriba su password"
                                                    v-model="password"
                                                />
                                            </div>
                                            <div
                                                class="col-md-12 form-group mt-4"
                                            >
                                                <label
                                                    >PASSWORD CONFIRMACION
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control rounded-0"
                                                    placeholder="vuelva a escribir su password"
                                                    v-model="confir_password"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div
                                class="col-md-12 form-group mt-4"
                                v-if="existe"
                            >
                                <button
                                    class="btn cabecera rounded-0 w-25 pt-2 pb-2 button"
                                    @click="registrarDocumento()"
                                    v-if="buttom"
                                >
                                    ENVIAR
                                </button>
                            </div>
                            <div class="col-md-12 form-group mt-5 mb-5">
                                <p>
                                    Revice bien sus datos antes de enviar el
                                    formulario porque el documento no se puede
                                    editar
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-9">
                                <p class="mt-4 mb-4">
                                    Este contenido a sido creado por
                                    <a href="http://ogtise.unasam.edu.pe/"
                                        >La Oficina General de Tecnologias de
                                        Informacion, Sistemas y
                                        Estadistica(OGTISE)</a
                                    >
                                </p>
                            </div>
                            <div class="col-md-3">
                                <router-link
                                    to="/login"
                                    class="btn btn-primary btn-block mt-3 mb-4 rounded-0"
                                    ><i class="fas fa-unlock-alt"></i> INICIAR
                                    SESSION</router-link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
    data() {
        return {
            nombres: "",
            apellidos: "",
            dni: "",
            direccion: "",
            email: "",
            celular: "",
            entidad: "",
            organo: "",
            unidad: "",
            password: "",
            confir_password: "",
            newArrayCondiciones: [],
            arrayCondiciones: [],
            persona: [],
            documento: false,
            error: 0,
            arrayError: [],
            existe: false,
            buttom: true,
            count: 0
        };
    },
    methods: {
        cerrar() {
            this.existe = false;
            this.nombres = "";
            this.apellidos = "";
            this.dni = "";
            this.direccion = "";
            this.email = "";
            this.celular = "";
            this.entidad = "";
            this.organo = "";
            this.unidad = "";
            this.password = "";
            this.confir_password = "";
            this.newArrayCondiciones = "";
            this.persona = "";
            this.documento = false;
            this.error = 0;
            this.buttom = true;
            this.arrayError = [];
            this.count = 0;
        },
        getCondicion() {
            axios
                .get("/api/getCondiciones")
                .then(resp => {
                    this.arrayCondiciones = resp.data.condiciones;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        verifyPersona() {
            if (!this.dni) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...Sucedio un error!",
                    text: "EL CAMPO DNI ES OBLIGATORIO!"
                });
                return;
            }
            if (this.dni.length != 8) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...Sucedio un error!",
                    text: "EL DNI TIENE QUE TENER 8 DIGITOS OBLIGATORIOS!"
                });
                return;
            }
            axios
                .get(`api/verificar?dni=${this.dni}`)
                .then(response => {
                    this.count = response.data.persona;
                })
                .then(() => {
                    if (this.count > 0) {
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title:
                                "YA CUENTAS CON UNA DECLARION JURADA REGISTRADA NO ES NECESARIO REGISTRA UNA NUEVA",
                            showConfirmButton: false,
                            timer: 3000
                        });
                        this.existe = false;
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "REGISTRA TU DECLARACION JURADA",
                            showConfirmButton: false,
                            timer: 3000
                        });
                        this.existe = true;
                    }
                })
                .catch(error => {});
        },
        registrarDocumento() {
            if (this.validar()) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...Sucedio un error!",
                    text: "algun campo esta vacio o no valido!",
                    footer: "<a href='#'>Revisar los errores detallados?</a>"
                });
                return;
            }
            this.agregarCondicion();
            this.buttom = false;
            axios
                .post("/api/declaracion", {
                    dni: this.dni,
                    nombres: this.nombres,
                    apellidos: this.apellidos,
                    direccion: this.direccion,
                    celular: this.celular,
                    // email: this.email,
                    organo: this.organo,
                    unidad: this.unidad,
                    // password: this.password,
                    dataCondiciones: this.newArrayCondiciones
                })
                .then(response => {
                    axios
                        .post(`/api/register`, {
                            persona_id: response.data.persona_id,
                            tipo_usuario_id: 3,
                            name: this.nombres,
                            email: this.email,
                            password: this.password
                        })
                        .then(response => {
                            this.cerrar();
                            Swal.fire({
                                title:
                                    "SE REGISTRO LA DECLARACION JURADA EXITOSAMENTE",
                                icon: "success",
                                width: 800,
                                padding: "3em",
                                background: "#fff url(/images/trees.png)",
                                backdrop: `
                            rgba(0,0,123,0.4)
                            url("/images/nyan-cat.gif")
                            left top
                            no-repeat
                        `,
                                timer: 2000
                            });
                        })
                        .catch(error => {
                            console.log(error);
                        });
                })
                .catch(error => {
                    console.log(error);
                });
        },
        agregarCondicion() {
            this.arrayCondiciones.map(el => {
                var id = "a" + el.id;
                var resp = document.querySelector(`input[name=${id}]:checked`)
                    .value;
                this.newArrayCondiciones.push({
                    id: el.id,
                    condicion: el.condicion,
                    respuesta: resp
                });
            });
        },
        validar() {
            this.error = 0;
            this.arrayError = [];

            if (!this.nombres)
                this.arrayError.push(
                    "el campo nombres es obligatorio de llenar"
                );

            if (!this.apellidos)
                this.arrayError.push(
                    "el campo apellidos es obligatorio de llenar"
                );

            if (!this.dni)
                this.arrayError.push("el campo dni es obligatorio de llenar");

            if (this.dni.length > 8)
                this.arrayError.push("el campo dni supero los 8 digitos");

            if (!this.celular)
                this.arrayError.push(
                    "el campo celular es obligatorio de llenar"
                );

            if (!this.email)
                this.arrayError.push("el campo email es obligatorio de llenar");

            if (!this.direccion)
                this.arrayError.push(
                    "el campo direccion es obligatorio de llenar"
                );

            if (!this.organo)
                this.arrayError.push(
                    "el campo dependencia academica es obligatorio de llenar"
                );

            if (!this.unidad)
                this.arrayError.push(
                    "el campo unidad organica es obligatorio de llenar"
                );

            if (!this.password)
                this.arrayError.push("el password es obligatorio de llenar");

            if (!this.confir_password)
                this.arrayError.push(
                    "el password de confirmacion es obligatorio de llenar"
                );

            if (this.password && this.confir_password)
                if (this.password != this.confir_password) {
                    this.arrayError.push(
                        "el password y el password de confirmacion no conciden"
                    );
                }

            if (this.arrayError.length) this.error = 1;

            return this.error;
        }
    },
    mounted() {
        this.getCondicion();
    }
};
</script>

<style>
.image {
    background: url(https://image.freepik.com/vector-gratis/vector-ilustracion-sala-juegos-concepto-moderno-esports_33099-1201.jpg)
        no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.cabecera {
    background-color: #562685;
    color: white;
}
.texto {
    font-weight: normal;
}
.radio {
    height: 18px;
    width: 18px;
    vertical-align: middle;
}
.button:hover {
    color: white;
    opacity: 0.9;
}
.verificar {
    margin-top: 28px;
    padding-top: 8px;
    padding-bottom: 8px;
}
</style>
