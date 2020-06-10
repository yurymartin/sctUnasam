<template>
    <div>
        <div class="card card-primary card-outline mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <button
                            type="button"
                            class="btn btn-primary btn-block"
                            @click="abrirModal('personas', 'registrar')"
                        >
                            <i class="far fa-plus-square"></i
                            ><b>
                                REGISTRAR NUEVA FICHA SNTOMATOLOGICA COVIT-19</b
                            >
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
                                        <div class="row">
                                            <div class="col-md-8 form-group">
                                                <label>Entidad Publica</label>
                                                <span class="text-danger"
                                                    >(*)</span
                                                >
                                                <input
                                                    type="text"
                                                    readonly
                                                    class="form-control form-control-sm"
                                                    v-model="entidad"
                                                />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>Ruc</label>
                                                <span class="text-danger"
                                                    >(*)</span
                                                >
                                                <input
                                                    type="text"
                                                    readonly
                                                    class="form-control form-control-sm"
                                                    v-model="ruc"
                                                />
                                            </div>
                                            <br /><br />
                                            <div class="col-md-8 form-group">
                                                <label
                                                    >Nombres y Apellidos</label
                                                >
                                                <span class="text-danger"
                                                    >(*)</span
                                                >
                                                <input
                                                    type="text"
                                                    readonly
                                                    class="form-control form-control-sm"
                                                    v-model="persona"
                                                />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>DNI</label>
                                                <span class="text-danger"
                                                    >(*)</span
                                                >
                                                <input
                                                    type="text"
                                                    readonly
                                                    class="form-control form-control-sm"
                                                    v-model="dni"
                                                />
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <label>Direccion</label>
                                                <span class="text-danger"
                                                    >(*)</span
                                                >
                                                <input
                                                    type="text"
                                                    readonly
                                                    class="form-control form-control-sm"
                                                    v-model="direccion"
                                                />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>Celular</label>
                                                <span class="text-danger"
                                                    >(*)</span
                                                >
                                                <input
                                                    type="text"
                                                    readonly
                                                    class="form-control form-control-sm"
                                                    v-model="celular"
                                                />
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card card-body">
                                                    <table
                                                        class="table table-hover text-nowrap"
                                                    >
                                                        <thead>
                                                            <tr>
                                                                <th>Sintoma</th>
                                                                <th>SI</th>
                                                                <th>NO</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                v-for="item in arraySintomas"
                                                                :key="item.id"
                                                            >
                                                                <td
                                                                    v-text="
                                                                        item.sintoma
                                                                    "
                                                                ></td>
                                                                <td>
                                                                    <input
                                                                        type="radio"
                                                                        :name="
                                                                            'b' +
                                                                                item.id
                                                                        "
                                                                        value="1"
                                                                    />
                                                                </td>
                                                                <td>
                                                                    <input
                                                                        type="radio"
                                                                        :name="
                                                                            'b' +
                                                                                item.id
                                                                        "
                                                                        value="0"
                                                                        checked
                                                                    />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
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
                                            @click="registrarDetalle_Sintoma()"
                                            v-if="tipoAccion == 1"
                                        >
                                            <i class="far fa-save"></i> Guardar
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <b>MIS FICHAS SINTOMATICA</b>
                        </h3>

                        <div class="card-tools">
                            <div>
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="date"
                                    @change="
                                        listarDetalle_Sintoma(
                                            1,
                                            date,
                                            persona_id
                                        )
                                    "
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
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Recomendaciones</th>
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
                                    <td v-text="item.fecha"></td>
                                    <td v-text="item.hora"></td>
                                    <td v-text="item.descripcion"></td>
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
                                            title="descargar ficha"
                                            @click="
                                                getFichaSintomatica(item.id)
                                            "
                                        >
                                            <i class="far fa-file-pdf"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center mt-5 mr-5"
                            v-if="!arrayDetalle_Sintomas.length"
                        >
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <nav
                                aria-label="Page navigation example"
                                class="mt-3"
                            >
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
                                                    persona_id
                                                )
                                            "
                                        >
                                            <i
                                                class="fas fa-angle-double-left"
                                            ></i>
                                        </a>
                                    </li>
                                    <li
                                        class="page-item"
                                        v-for="page in pagesNumber"
                                        :key="page"
                                        :class="[
                                            page == isActived ? 'active' : ''
                                        ]"
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click.prevent="
                                                cambiarPagina(
                                                    page,
                                                    date,
                                                    persona_id
                                                )
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
                                                    persona_id
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
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div v-if="pdf" ref="content">
            <h5>ANEXO 03</h5>
            <h5>FICHA DE SINTOMATOLOGÍA COVIT-19 PARA EL REGRESO AL TRABAJO</h5>
            <p>Declaración Jurada</p>
            <p>
                He recibido explicacion del objetivo de esta evaluacion y me
                comprometo a responder con la verdad
            </p>
            <p>
                <b>Entidad Pública: </b>
                <span v-text="entidad"></span>&nbsp;&nbsp;
                <b>Ruc: </b>
                <span v-text="ruc"></span>
            </p>
            <p>
                <b>Órgano: </b>&nbsp;&nbsp;&nbsp;
                <span v-text="data.ficha_sintomatica.personas.organo"></span>
                <b>Unidad orgánica: </b>
                <span v-text="data.ficha_sintomatica.personas.unidad"></span>
            </p>
            <br /><br />
            <p>
                <b>Apellidos y Nombres:</b>&nbsp;&nbsp;
                <span v-text="persona"></span>
                <b>DNI:</b>
                <span v-text="dni"></span>
            </p>
            <p>
                <b>Dirección:</b>
                <span v-text="direccion"></span>
                <b>Celular:</b>
                <span v-text="celular"></span>
            </p>
            <br /><br />
            <p>
                En los últimos 14 dias calendario he tenido alguno de los
                síntomas siguentes
            </p>

            <div class="col-md-12">
                <hr />
                <hr />
                <table>
                    <thead>
                        <tr>
                            <th>Sintoma</th>
                            <th>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="item in data.detalle_sintomas"
                            :key="item.id"
                        >
                            <td v-text="item.sintomas.sintoma"></td>
                            <td>
                                <label>
                                    {{ item.respuesta ? "Si" : "No" }}
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr />
            </div>

            <p>
                Todos los datos expresados en esta ficha constituyen una
                declaración jurada de mi parte
            </p>
            <br />
            <p>
                He sido informado que, de omitir o falsear información, puedo
                perjudiciar la salud de mis compañeros y la mia propia, lo cual
                constituye una falta grave ala salud pública, asumo sus
                consecuencias
            </p>
            <br /><br />
            <p>
                <b>Fecha: </b>
                <span v-text="data.ficha_sintomatica.fecha"></span>
                <span>-----------------</span>
                <b>Firma: </b>
                <span>_______________________________________</span>
            </p>
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
            celular: localStorage.getItem("celular"),
            persona_id: localStorage.getItem("persona"),
            persona:
                localStorage.getItem("nombres") +
                " " +
                localStorage.getItem("apellidos"),
            entidad: "UNIVERSIDAD NACIONAL SANTIAGO ANTUNEZ DE MAYOLO",
            ruc: "20166550239",
            date: "",
            id: 0,
            sintoma_id: "",
            activo: 0,
            data: [],
            arrayDetalle_Sintomas: [],
            arraySintomas: [],
            newArraySintomas: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            pdf: false
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
        listarDetalle_Sintoma(page, date, persona_id) {
            axios
                .get(
                    `/api/fichassintomaticas?page=${page}&date=${date}&persona_id=${persona_id}`
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
        cambiarPagina(page, date, persona_id) {
            let me = this;
            //acualizar la pagina Actual
            me.pagination.current_page = page;
            //enviar la peticion para visaulizar la data de la pagina
            me.listarDetalle_Sintoma(page, date, persona_id);
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
        registrarDetalle_Sintoma() {
            this.agregarSintoma();
            axios
                .post(`/api/fichassintomaticas`, {
                    persona_id: this.persona_id,
                    dataSintomas: this.newArraySintomas
                })
                .then(response => {
                    this.cerrarModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "FICHA SINTOMATICA REGISTRADA",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.listarDetalle_Sintoma(1, this.date, this.persona_id);
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
                })
                .then(() => {
                    this.pdf = true;
                })
                .then(() => {
                    this.generatePdf();
                    this.pdf = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cerrarModal() {
            this.tipoAccion = 0;
            this.tituloModal = "";
            this.id = 0;
            this.newArraySintomas = [];
            this.arraySintomas = [];
            $("#modal").modal("hide");
        },
        abrirModal(modelo, accion, data = []) {
            $("#modal").modal({
                backdrop: "static",
                keyboard: false
            });
            this.getSintomas();
            switch (modelo) {
                case "personas": {
                    switch (accion) {
                        case "registrar": {
                            this.tituloModal =
                                "REGISTRAR UNA NUEVA FICHA SINTOMATOLOGICA";
                            this.newArraySintomas = [];
                            this.tipoAccion = 1;
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
        },
        //jspdf does not include the bootstrap style layout
        generatePdf() {
            var doc = new jsPDF("p", "pt", "A4");
            doc.setFontSize(11);
            var margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };

            doc.fromHTML(this.$refs.content, margins.left, margins.top, {
                width: margins.width
            });

            doc.save(`ficha_${this.persona}_${this.date}`);
        }
    },
    mounted() {
        this.fechaActual();
        this.listarDetalle_Sintoma(1, this.date, this.persona_id);
    }
};
</script>
