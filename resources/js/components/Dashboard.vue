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

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img
                    src="dist/img/AdminLTELogo.png"
                    alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3"
                    style="opacity: .8"
                />
                <span class="brand-text font-weight-light">SCT || UNASAM</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img
                            src="dist/img/user2-160x160.jpg"
                            class="img-circle elevation-2"
                            alt="User Image"
                        />
                    </div>
                    <div class="info">
                        <router-link
                            class="d-block"
                            to="/home"
                            v-text="name"
                        ></router-link>
                        <router-link
                            class="d-block"
                            to="/home"
                            v-text="tipo_usuario"
                        ></router-link>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul
                        class="nav nav-pills nav-sidebar flex-column"
                        data-widget="treeview"
                        role="menu"
                        data-accordion="false"
                    >
                        <li
                            class="nav-item"
                            v-if="
                                tipo_usuario === 'ADMINISTRADOR' ||
                                    tipo_usuario === 'ENFERMERO' ||
                                    tipo_usuario === 'EMPLEADO'
                            "
                        >
                            <router-link to="/home" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home<span class="right badge badge-danger"
                                        >New</span
                                    >
                                </p>
                            </router-link>
                        </li>

                        <li
                            class="nav-item"
                            v-if="tipo_usuario === 'ADMINISTRADOR'"
                        >
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
                        <li
                            class="nav-item"
                            v-if="
                                tipo_usuario === 'ADMINISTRADOR' ||
                                    tipo_usuario === 'ENFERMERO'
                            "
                        >
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

                        <li
                            class="nav-item"
                            v-if="tipo_usuario === 'ADMINISTRADOR'"
                        >
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

                        <li
                            class="nav-item"
                            v-if="tipo_usuario === 'ADMINISTRADOR'"
                        >
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

                        <li
                            class="nav-item"
                            v-if="tipo_usuario === 'ADMINISTRADOR'"
                        >
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
                Anything you want
            </div>
            <strong
                >Copyright &copy; 2014-2019
                <a href="https://adminlte.io">AdminLTE.io</a>.</strong
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
            name: localStorage.getItem("name"),
            email: localStorage.getItem("email")
        };
    },
    methods: {
        logout() {
            axios
                .post(`/api/logout`)
                .then(response => {
                    // localStorage.removeItem("tipo_usuario");
                    // localStorage.removeItem("token");
                    // localStorage.removeItem("name");
                    // localStorage.removeItem("email");
                    localStorage.clear();
                })
                .then(() => {
                    this.$router.push("/login");
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
