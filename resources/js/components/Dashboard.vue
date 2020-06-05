<template>
    <div class="wrapper" v-if="arraykey.length">
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
                    <!-- <a
                        class="nav-link"
                        data-widget="control-sidebar"
                        data-slide="true"
                        href="#"
                        role="button"
                        ><i class="fas fa-th-large"></i
                    ></a> -->
                    <button class="btn btn-danger btn-sm" @click="logout">
                        Cerrar Session
                    </button>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <aside class="main-sidebar sidebar-light-primary elevation-4" v-if="key == arraykey[2].key">
            <router-link to="/perfil" class="brand-link text-center">
                <span class="brand-text font-weight-light"><b>SCT || UNASAM</b></span>
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
                            <router-link to="/perfil" class="nav-link">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>
                                    Perfil<span class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/juramentacion" class="nav-link">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p>
                                    Documento<span
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

        <!-- -------------------------------------------SIDER BAR ---------------------------------------------- -->
        <aside class="main-sidebar sidebar-light-primary elevation-4" v-else>
            <router-link to="/perfil" class="brand-link text-center">
                <span class="brand-text font-weight-light"><b>SCT || UNASAM</b></span>
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
                        <li class="nav-item" v-if="key == arraykey[0].key">
                            <router-link to="/home" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home<span class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="key == arraykey[0].key">
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
                        <li class="nav-item" v-if="key == arraykey[0].key || key == arraykey[1].key">
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

                        <li class="nav-item" v-if="key == arraykey[0].key">
                            <router-link to="/condiciones" class="nav-link">
                                <i class="nav-icon fas fa-head-side-cough"></i>
                                <p>
                                    Condicion<span
                                        class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="key == arraykey[0].key">
                            <router-link to="/sintomas" class="nav-link">
                                <i class="nav-icon fas fa-head-side-cough"></i>
                                <p>
                                    Sintomas<span
                                        class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="key == arraykey[0].key">
                            <router-link to="/Organos" class="nav-link">
                                <i class="nav-icon fas fa-head-side-cough"></i>
                                <p>
                                    Organo<span class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="key == arraykey[0].key">
                            <router-link to="/unidades_organicas" class="nav-link" >
                                <i class="nav-icon fas fa-head-side-cough"></i>
                                <p>
                                    Unidades Organicas<span
                                        class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="key == arraykey[0].key ">
                            <router-link to="/tipo_usuarios" class="nav-link" >
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Tipo de Usuarios<span
                                        class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item" v-if="key == arraykey[0].key ">
                            <router-link to="/usuarios" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuarios<span
                                        class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>

                        <!-- <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Active Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inactive Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
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
                sistema de control de temperatura v1.0
            </div>
            <strong
                >Copyright &copy; 2019 || developed by
                <a href="https://www.facebook.com/yurizito.martin">
                    Yury martin chauca</a
                >.</strong
            >
            All rights reserved.
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
        // console.log(this.arraykey);
    }
};
</script>
