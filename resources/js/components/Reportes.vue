<template>
    <div>
        <div class="row mt-3">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-warning">
                    <span class="info-box-icon">
                        <export-excel
                            class="btn btn-warning"
                            :data="json_data"
                            :fields="json_fields"
                            worksheet="My Worksheet"
                            title="LOS EMPLEADOS REGISTRADOS CON SUS DATOS EN GENERAL"
                            :name="`empleados_${date}_${time}.xls`"
                        >
                            <i class="fas fa-file-import fa-3x"></i>
                        </export-excel>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-number"
                            >TODOS LOS EMPLEADOS CON SUS DATOS EN GENERAL</span
                        >
                        <span class="info-box-text text-xs"
                            >Excel de los empleados en general</span
                        >
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description"
                            >descargar en el icono</span
                        >
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-warning">
                    <span class="info-box-icon">
                        <export-excel
                            class="btn btn-warning"
                            :data="json_data_1"
                            :fields="json_fields_1"
                            worksheet="My Worksheet"
                            title="EMPLEADOS CON SUS CONDICIONES Y SUS RESPUESTAS"
                            :name="`empleados_condicion_${date}_${time}.xls`"
                        >
                            <i class="fas fa-file-import fa-3x"></i>
                        </export-excel>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-number"
                            >EMPLEADOS CON CONDICIONES Y RESPUESTAS</span
                        >
                        <span class="info-box-text text-xs"
                            >Excel de los empleados en general</span
                        >
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description"
                            >descargar en el icono</span
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";
import excel from "vue-excel-export";
Vue.use(excel);

export default {
    data() {
        return {
            date: "",
            time: "",
            json_fields: {
                id: "id",
                dni: "dni",
                nombres: "nombres",
                nombres: "apellidos",
                direccion: "direccion",
                celular: "celular",
                email: "email",
                peso: "peso",
                talla: "talla",
                imc: "imc",
                organo: "organo",
                unidad: "unidad"
            },
            json_data: [],
            // segundo reporte
            json_fields_1: {
                id: "id",
                dni: "dni",
                Nombres_Apellidos: "persona",
                Email: "apellidos",
                Direccion: "direccion",
                Celular: "celular",
                Organo: "organo",
                Unidad: "unidad",
                Condicion: "condicion",
                Respuesta: "respuesta"
            },
            json_data_1: []
        };
    },
    methods: {
        allEmpleados() {
            axios.get(`/api/allEmpleados`).then(resp => {
                this.json_data = resp.data.data;
            });
        },
        allEmpleadosCondicion() {
            axios
                .get(`/api/allEmpleadosCondicion`)
                .then(resp => {
                    this.json_data_1 = resp.data.data;
                })
                .then(() => {
                    console.log(this.json_data_1);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fechaActual() {
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth() + 1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
            if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
            this.date = ano + "" + mes + "" + dia;
        },
        Timestamp() {
            var d = new Date();
            var h = d.getHours();
            var m = d.getMinutes();
            var s = d.getSeconds();
            this.time = h + "" + m + "" + s;
            console.log(this.time);
        }
    },
    mounted() {
        this.fechaActual();
        this.Timestamp();
        this.allEmpleados();
        this.allEmpleadosCondicion();
    }
};
</script>
