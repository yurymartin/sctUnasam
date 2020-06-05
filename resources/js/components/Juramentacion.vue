<template>
    <div>
        <div class="card card-primary card-outline mt-3" v-if="documento">
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
                    Yo,
                    <label for="" v-text="persona"><b></b></label>
                    identificado(a) con el DNI/CE N°
                    <label for="" v-text="dni"><b></b></label>, declaro lo
                    siguente respecto a mis condiciones de salud
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
                                    <th>Respuesta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in arrayCondiciones"
                                    :key="item.id"
                                >
                                    <td v-text="item.condicion"></td>
                                    <td class="text-lg">
                                        <span class="badge badge-info">{{
                                            item.respuesta ? "SI" : "NO"
                                        }}</span>
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
                <br />
                Entidad Publica:
                <label for="" v-text="entidad" class="mr-5"><b></b></label>
                Ruc:
                <label for="" v-text="ruc"><b></b></label>
                <br /><br />Organo:
                <label for="" v-text="data.organo.organo"><b></b></label>
                <br /><br />Unidad Organica:
                <label for="" v-text="data.unidad.unidad"><b></b></label>
                <br /><br />
                Nombres y Apellidos:<label for="" v-text="persona" class="mr-5"
                    ><b></b
                ></label>
                DNI:<label for="" v-text="dni"><b></b></label>
                <br /><br />Direccion :<label
                    for=""
                    v-text="direccion"
                    class="mr-5"
                ></label
                >Celular :<label for="" v-text="celular"><b></b></label>
                <br /><br />
                <p>
                    En los últimos 14 dias calendario he tenido alguno de los
                    síntomas siguentes
                </p>
                <br />
                <div class="card card-body">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Sintoma</th>
                                <th>Respuesta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in arraySintomas" :key="item.id">
                                <td v-text="item.sintoma"></td>
                                <td class="text-lg">
                                    <span class="badge badge-info">{{
                                        item.respuesta ? "SI" : "NO"
                                    }}</span>
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
                        <label for=""
                            >Fecha: {{ data.detalle_ficha.fecha }}</label
                        >
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
                    class="btn btn-success btn-block"
                    @click="registrarDocumento()"
                    v-show="button"
                >
                    DESCARGAR DOCUMENTO
                </button>
            </div>
        </div>
        <div class="card card-primary card-outline mt-3" v-else>
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
        </div>
    </div>
</template>

<script>
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
                .post("/api/juramentacion", {
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
        pdf() {}
    },
    mounted() {
        this.verifyDocumento();
        this.persona = this.nombres + " " + this.apellidos;
        this.getCondicion();
        this.getOrgano();
        // this.getUnidadOrganica();
        this.getSintomas();
        this.fechaActual();
        // this.agregarCondicion();
    }
};
</script>
