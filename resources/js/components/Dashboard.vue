<template>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        data-widget="pushmenu"
                        href="#"
                        role="button"
                        ><i class="fas fa-bars"></i
                    ></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="btn btn-danger btn-sm" @click="logout">
                        Cerrar Session
                    </button>
                </li>
            </ul>
        </nav>

        <div v-if="Object.entries(arraykey).length > 0">
            <!-- DIRECTIVO -->
            <aside class="main-sidebar sidebar-light-primary elevation-4" v-if="key == arraykey[3].key">
                <router-link to="/perfil" class="brand-link text-center">
                    <span class="brand-text font-weight-light"
                        ><b>SCT || UNASAM</b></span
                    >
                </router-link>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info text-center">
                            <h5 v-text="nombres + ' ' + apellidos"><b></b></h5>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <li class="nav-item">
                                <router-link to="/home" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Home<span class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/reportes" class="nav-link">
                                    <i class="nav-icon far fa-folder-open"></i>
                                    <p>
                                        Reportes<span class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- EMPLEADO -->
            <aside class="main-sidebar sidebar-light-primary elevation-4" v-if="key == arraykey[2].key">
                <router-link to="/perfil" class="brand-link text-center">
                    <span class="brand-text font-weight-light"
                        ><b>SCT || UNASAM</b></span
                    >
                </router-link>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info text-center">
                            <h5 v-text="nombres + ' ' + apellidos"><b></b></h5>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <li class="nav-item">
                                <router-link to="/home" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Home<span class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/perfil" class="nav-link">
                                    <i class="nav-icon far fa-chart-bar"></i>
                                    <p>
                                        Mis Temperaturas<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/fichassintomaticas" class="nav-link">
                                    <i class="nav-icon far fa-file-alt"></i>
                                    <p>
                                        Mis Fichas Sintomaticas<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- MEDICO  -->
            <aside class="main-sidebar sidebar-light-primary elevation-4" v-if="key == arraykey[1].key" >
                <router-link to="/perfil" class="brand-link text-center">
                    <span class="brand-text font-weight-light"
                        ><b>SCT || UNASAM</b></span
                    >
                </router-link>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info text-center">
                            <h5 v-text="nombres + ' ' + apellidos"><b></b></h5>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <li class="nav-item">
                                <router-link to="/home" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Home<span class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/temperaturas" class="nav-link">
                                    <i class="nav-icon fas fa-temperature-high"></i>
                                    <p>
                                        Temperaturas<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/fichas" class="nav-link">
                                    <i class="nav-icon far fa-file-alt"></i>
                                    <p>
                                        Fichas Sintomaticas<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- ADMINISTRADOR -->
            <aside class="main-sidebar sidebar-light-primary elevation-4" v-if="key == arraykey[0].key">
                <router-link to="/perfil" class="brand-link text-center">
                    <span class="brand-text font-weight-light"
                        ><b>SCT || UNASAM</b></span
                    >
                </router-link>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info text-center">
                            <h5 v-text="nombres + ' ' + apellidos"><b></b></h5>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <li class="nav-item">
                                <router-link to="/home" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Home<span class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/empleados" class="nav-link">
                                    <i class="nav-icon far fa-address-card"></i>
                                    <p>
                                        Empleados<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/temperaturas" class="nav-link">
                                    <i class="nav-icon fas fa-temperature-high"></i>
                                    <p>
                                        Temperaturas<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/condiciones" class="nav-link">
                                    <i class="nav-icon fas fa-first-aid"></i>
                                    <p>
                                        Condicion<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/sintomas" class="nav-link">
                                    <i class="nav-icon fas fa-procedures"></i>
                                    <p>
                                        Sintomas<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/Organos" class="nav-link">
                                    <i class="nav-icon far fa-building"></i>
                                    <p>
                                        Organo<span class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link
                                    to="/unidades_organicas"
                                    class="nav-link"
                                >
                                    <i class="nav-icon fas fa-laptop-house"></i>
                                    <p>
                                        Unidades Organicas<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/tipo_usuarios" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Tipo de Usuarios<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/usuarios" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Usuarios<span
                                            class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </router-link>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
        </div>


        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Sistema de Control de Covid 19 UNASAM
            </div>
            <strong>
                Copyright &copy; 2020
                || <a href="http://ogtise.unasam.edu.pe/">Oficina General de Tecnologias de Informacion, Sistemas y Estadistica (OGTISE)</a>
                || developed by <a href="https://www.facebook.com/yurizito.martin">Yury martin</a>
                && <a href="https://www.facebook.com/mdelcastillorobles">Max Del Castillo</a>.
                </strong>
        </footer>
    </div>
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
    }
};
</script>
