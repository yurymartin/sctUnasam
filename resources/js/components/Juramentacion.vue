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
                        <!-- <div class="modal fade text-sm" id="modal">
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
                            </div>
                        </div> -->
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
    <!-- <section class="mt-5">
        <div class="error-page">
            <h1 class="headline text-danger">500</h1>
            <div class="error-content">
                <h3>
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    ¡Vaya! Algo salió mal.
                </h3>

                <p>
                    Trabajaremos en arreglar eso de inmediato. Mientras tanto,
                    puede <router-link to="/home">volver al panel</router-link>
                    o intentar usar el formulario de búsqueda.
                </p>
            </div>
            <img
                src="https://image.flaticon.com/icons/svg/2910/2910692.svg"
                alt="error 500"
                class="w-50 h-50 mt-5"
            />
        </div>
    </section> -->
    <!-- <div class="card card-primary card-outline mt-3" v-show="false">
            <div class="card-header">
                <div class="card-title"><b>DOCUMENTO DE JURAMENTACION</b></div>
            </div>
            <div v-show="errorJuramentacion">
                <div class="alert alert-danger" role="alert">
                    <div
                        v-for="error in errorMostrarMsjJuramentacion"
                        :key="error"
                    >
                        <b
                            ><i class="fas fa-exclamation-triangle"></i>
                            {{ error }}</b
                        >
                        <br />
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Declaracion Jurada</p>
                <p>
                    <span class="text-danger"><b>Yo, (*)</b></span>
                    <input
                        type="text"
                        v-model="persona"
                        class="text-danger w-50 mr-5"
                        readonly
                    />
                    identificado(a) con el
                    <span class="text-danger"><b>DNI/CE N° (*)</b></span>
                    <input
                        type="number"
                        v-model="dni"
                        class="text-danger w-25"
                        readonly
                    />
                    <br />, declaro lo siguente respecto a mis condiciones de
                    salud
                </p>
                <br />
                <h5>
                    PRESENTO ALGUNA DE LAS SIGUENTES CONDICIONES DE SALUD* SI NO
                    <span class="text-danger"><b>(*)</b></span>
                </h5>
                <div class="card card-body">
                    <form class="formCondiciones">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>condicion</th>
                                    <th>SI</th>
                                    <th>NO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in arrayCondiciones"
                                    :key="item.id"
                                >
                                    <td v-text="item.condicion"></td>
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
                    </form>
                </div>
                <br /><br />
                <p>
                    *Factores de riesgo de acuerdo a Documento técnico aprobado
                    mediante RM 193-2020-MINSA
                </p>
                <p>
                    Asimismo, declaro que dentro de mi vivienda residen los
                    siguentes familiares que cuenta con las siguentes
                    condiciones que los ubican dentro del grupo de riesgo
                </p>
                <hr />
                <hr />
                <h5>
                    <b
                        >FICHA DE SINTOMATOLOGIA COVIT-19 PAR AEL REGRESO AL
                        TRABAJO</b
                    >
                </h5>
                <br />
                <p>Declaracion Jurada</p>
                <p>
                    He recibido explicacion del objetivo de esta evaluacion y me
                    comprometo a responder con la verdad
                </p>
                <br /><span class="text-danger"
                    ><b>Entidad Publica: (*)</b></span
                >
                <input
                    type="text"
                    v-model="entidad"
                    class="w-50 text-danger mr-5"
                    readonly
                />.<span class="text-danger"><b>Ruc: (*)</b></span>
                <input
                    type="text"
                    v-model="ruc"
                    class="w-25 text-danger"
                    readonly
                />
                <br /><br /><span class="text-danger"><b> Organo: (*)</b></span>
                <select
                    v-model="organo_id"
                    class="w-75 text-danger"
                    @change="getUnidadOrganica()"
                >
                    <option value="0"
                        >------------ Seleccionar el Organo a que pertence
                        ----------------</option
                    >
                    <option
                        v-for="item in arrayOrganos"
                        :key="item.id"
                        :value="item.id"
                        v-text="item.organo"
                    ></option>
                </select>
                <br /><br />
                <template v-if="arrayUnidades.length">
                    <span class="text-danger"
                        ><b> Unidad orgánica: (*)</b></span
                    >
                    <select v-model="unidad_id" class="w-75 text-danger">
                        <option value="0"
                            >------------ Seleccionar el Organo a que pertence
                            ----------------</option
                        >
                        <option
                            v-for="item in arrayUnidades"
                            :key="item.id"
                            :value="item.id"
                            v-text="item.unidad"
                        ></option>
                    </select>
                </template>
                <br /><br /><br /><br /><span class="text-danger"
                    ><b>Nombres y Apellidos: (*)</b></span
                >
                <input
                    type="text"
                    v-model="persona"
                    class="text-danger w-50 mr-5"
                    readonly
                /><span class="text-danger"><b>DNI: (*)</b></span>
                <input
                    type="number"
                    class="text-danger"
                    v-model="dni"
                    readonly
                /><br /><br />
                <span class="text-danger"><b>Direccion: (*)</b></span
                ><input
                    type="text"
                    class="text-danger w-50 mr-5"
                    v-model="direccion"
                    readonly
                /><span class="text-danger"><b>Celular: (*)</b></span>
                <input
                    type="text"
                    class="text-danger"
                    v-model="celular"
                    readonly
                />
                <br /><br />
                <p>
                    En los últimos 14 dias calendario he tenido alguno de los
                    síntomas siguentes
                </p>
                <br />
                <span class="text-danger"><b>(*)</b></span>
                <div class="card card-body">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Sintoma</th>
                                <th>SI</th>
                                <th>NO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in arraySintomas" :key="item.id">
                                <td v-text="item.sintoma"></td>
                                <td>
                                    <input
                                        type="radio"
                                        :name="'b' + item.id"
                                        value="1"
                                    />
                                </td>
                                <td>
                                    <input
                                        type="radio"
                                        :name="'b' + item.id"
                                        value="0"
                                        checked
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr class="bg-dark " />
                <p class="text-justify">
                    Todos los datos expresados en esta ficha constituyen una
                    declaración jurada de mi parte
                </p>
                <p>
                    He sido informado que, de omitir o falsear información,
                    puedo perjudiciar la salud de mis compañeros y la mia
                    propia, lo cual constituye una falta grave ala salud
                    pública, asumo sus consecuencias
                </p>
                <br />
                <div class="row">
                    <div class="col-md-8">
                        <label for="">Fecha: {{ date }}</label>
                    </div>
                    <div class="col-md-4">
                        <label for=""
                            >Firma: ___________________________________</label
                        >
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button
                    class="btn btn-primary btn-block"
                    @click="registrarDocumento()"
                    v-show="button"
                >
                    GUARDAR DOCUMENTO
                </button>
            </div>
        </div> -->
</template>

<script>
import jsPDF from "jspdf";
import Swal from "sweetalert2";
export default {
    data() {
        return {
            nombres: localStorage.getItem("nombres"),
            apellidos: localStorage.getItem("apellidos"),
            dni: localStorage.getItem("dni"),
            direccion: localStorage.getItem("direccion"),
            celular: localStorage.getItem("celular"),
            persona_id: localStorage.getItem("persona"),
            persona: "",
            entidad: "UNIVERSIDAD NACIONAL SANTIAGO ANTUNEZ DE MAYOLO",
            ruc: "20166550239",
            arrayCondiciones: [],
            arrayOrganos: [],
            arrayUnidades: [],
            arraySintomas: [],
            newArrayCondiciones: [],
            newArraySintomas: [],
            organo_id: 0,
            unidad_id: 0,
            date: "",
            data: [],
            respuestaCondicion: "",
            errorJuramentacion: 0,
            errorMostrarMsjJuramentacion: [],
            button: true,
            documento: false
        };
    },
    methods: {
        verifyDocumento() {
            axios
                .get(`api/verifyDocumento/${this.persona_id}`)
                .then(response => {
                    this.data = response.data;
                    this.documento = response.data.res;
                });
        },
        getCondicion() {
            axios
                .get("/api/condiciones")
                .then(resp => {
                    this.arrayCondiciones = resp.data.condiciones;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getOrgano() {
            axios
                .get("/api/organos")
                .then(resp => {
                    this.arrayOrganos = resp.data.organos;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getUnidadOrganica() {
            axios
                .get(`/api/getUnidades_Organicas?organo_id=${this.organo_id}`)
                .then(resp => {
                    this.arrayUnidades = resp.data.unidades_organicas;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getSintomas() {
            axios
                .get("/api/sintomas")
                .then(resp => {
                    this.arraySintomas = resp.data.sintomas;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        registrarDocumento() {
            if (this.validar()) {
                return;
            }
            this.button = false;
            this.agregarCondicion();
            this.agregarSintoma();
            axios
                .post("/api/fichassintomaticas", {
                    persona_id: this.persona_id,
                    dataCondiciones: this.newArrayCondiciones,
                    dataSintomas: this.newArraySintomas,
                    unidad_id: this.unidad_id
                })
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "El Documento se registro Exitosamente!",
                        showConfirmButton: false,
                        timer: 1500
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
        agregarSintoma() {
            this.arraySintomas.map(el => {
                var id = "b" + el.id;
                var resp = document.querySelector(`input[name=${id}]:checked`)
                    .value;
                this.newArraySintomas.push({
                    id: el.id,
                    sintoma: el.sintoma,
                    respuesta: resp
                });
            });
        },
        fechaActual() {
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth() + 1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
            if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
            this.date = ano + "/" + mes + "/" + dia;
        },
        validar() {
            this.errorJuramentacion = 0;
            this.errorMostrarMsjJuramentacion = [];

            if (this.organo_id == 0)
                this.errorMostrarMsjJuramentacion.push(
                    "falta seleccionar el organo"
                );

            if (this.unidad_id == 0)
                this.errorMostrarMsjJuramentacion.push(
                    "falta seleccionar la unidad organica"
                );

            if (this.errorMostrarMsjJuramentacion.length)
                this.errorJuramentacion = 1;

            return this.errorJuramentacion;
        },
        downloadPDF() {
            const doc = new jsPDF();
            const html = this.$refs.content.innerHTML;

            // doc.autoTable({html:"#my-table"});
            doc.setFont("helvetica");
            doc.setFontSize(9);
            doc.fromHTML(html, 11, 11);
            doc.save("covit.pdf");
        }
    },
    mounted() {
        // this.verifyDocumento();
        // this.persona = this.nombres + " " + this.apellidos;
        // this.getCondicion();
        // this.getOrgano();
        // // this.getUnidadOrganica();
        // this.getSintomas();
        // this.fechaActual();
        // this.agregarCondicion();
    }
};
</script>
