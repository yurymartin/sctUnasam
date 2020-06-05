<template>
    <section class="content">
        <div class="container-fluid mt-3">
            <!-- Small boxes (Stat box) -->
            <div class="row" v-if="key == arraykey[2].key">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>0</h3>
                            <p>SEGUIMIENTO DE MIS TEMPERATURAS</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-chart-bar"></i>
                        </div>
                        <router-link to="/perfil" class="small-box-footer">
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0</h3>
                            <p>DECLARACION JURADA</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <router-link
                            to="/juramentacion"
                            class="small-box-footer"
                        >
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="row" v-if="key == arraykey[1].key">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0<sup style="font-size: 20px">%</sup></h3>

                            <p>REGISTRO DE TEMPERATURAS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-temperature-high"></i>
                        </div>
                        <router-link
                            to="/temperaturas"
                            class="small-box-footer"
                        >
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="row" v-if="key == arraykey[0].key">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>0</h3>
                            <p>EMPLEADOS</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-address-card"></i>
                        </div>
                        <router-link to="/empleados" class="small-box-footer">
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0<sup style="font-size: 20px">%</sup></h3>

                            <p>REGISTRO DE TEMPERATURAS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-temperature-high"></i>
                        </div>
                        <router-link
                            to="/temperaturas"
                            class="small-box-footer"
                        >
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>

                            <p>CONDICIONES MEDICAS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-first-aid"></i>
                        </div>
                        <router-link to="/condiciones" class="small-box-footer">
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>

                            <p>SINTOMAS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-procedures"></i>
                        </div>
                        <router-link to="/sintomas" class="small-box-footer">
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>

                            <p>ORGANOS</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-building"></i>
                        </div>
                        <router-link to="/organos" class="small-box-footer">
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>

                            <p>UNIDADES ORGANICAS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-laptop-house"></i>
                        </div>
                        <router-link
                            to="/unidades_organicas"
                            class="small-box-footer"
                        >
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0<sup style="font-size: 20px">%</sup></h3>

                            <p>TIPOS DE USUARIOS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <router-link
                            to="/tipo_usuarios"
                            class="small-box-footer"
                        >
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>0</h3>
                            <p>USUARIOS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <router-link to="/users" class="small-box-footer">
                            Mas informacion...
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            tipo_usuario: localStorage.getItem("tipo_usuario"),
            email: localStorage.getItem("email"),
            key: localStorage.getItem("key"),
            persona: localStorage.getItem("persona"),
            nombres: localStorage.getItem("nombres"),
            apellidos: localStorage.getItem("apellidos"),
            buscar: "",
            arrayTipo: [],
            arraykey: []
        };
    },
    methods: {
        logout() {
            axios
                .post(`/api/logout`)
                .then(response => {
                    localStorage.clear();
                })
                .then(() => {
                    this.$router.push("/login");
                })
                .catch(error => {
                    console.log(error);
                });
        },
        listarTipo(buscar) {
            axios
                .get(`api/tipo_usuarios/?buscar=${buscar}`)
                .then(response => {
                    var respuesta = response.data;
                    this.arrayTipo = respuesta.tipo_usuarios;
                })
                .then(() => {
                    this.arrayTipo.map(el => {
                        this.arraykey.push({ key: el.key });
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.listarTipo(this.buscar);
        // console.log(this.arraykey);
    }
};
</script>
