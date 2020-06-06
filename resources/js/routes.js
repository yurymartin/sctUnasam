import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from './components/Dashboard'
import Home from './components/Home'
import Empleado from './components/Empleado'
import Temperatura from './components/Temperatura'
import Condicion from './components/Condicion'
import Sintoma from './components/Sintoma'
import Organo from './components/Organo'
import Unidad_Organica from './components/Unidad_Organica'
import Tipo_Usuario from './components/Tipo_Usuario'
import Usuario from './components/Usuario'
import Login from './components/Login'
import Error404 from './components/404'
import Juramentacion from './components/Juramentacion'
import Perfil from './components/Perfil'
import Declaracion from './components/Declaracion'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [{
            path: '/home',
            name: '/dashboard',
            component: Dashboard,
            children: [{
                    path: '/home',
                    name: 'home',
                    component: Home,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/empleados',
                    name: 'empleados',
                    component: Empleado,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/temperaturas',
                    name: 'temperaturas',
                    component: Temperatura,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/condiciones',
                    name: 'condiciones',
                    component: Condicion,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/sintomas',
                    name: 'sintomas',
                    component: Sintoma,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/organos',
                    name: 'organos',
                    component: Organo,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/unidades_organicas',
                    name: 'unidades_organicas',
                    component: Unidad_Organica,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/tipo_usuarios',
                    name: 'tipo_usuarios',
                    component: Tipo_Usuario,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/usuarios',
                    name: 'usuarios',
                    component: Usuario,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/juramentacion',
                    name: 'juramentacion',
                    component: Juramentacion,
                    meta: {
                        Auth: true
                    }
                },
                {
                    path: '/perfil',
                    name: 'perfil',
                    component: Perfil,
                    meta: {
                        Auth: true
                    }
                },
            ]
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                login: true
            }
        },
        {
            path: '/',
            name: 'declaracion',
            component: Declaracion
        },
        {
            path: '*',
            component: Error404,
        }
    ],
    mode: 'history'
})

router.beforeEach((to, from, next) => {
    if (to.meta.Auth && !window.localStorage.getItem('token')) {
        next({
            path: '/login'
        });
    } else {
        if (localStorage.getItem("token")) {
            axios.defaults.headers.common['Authorization'] = localStorage.getItem("token");
        } else {
            axios.defaults.headers.common['Authorization'] = null;
        }
        next();
    }
});


router.beforeEach((to, from, next) => {
    if (to.meta.login && window.localStorage.getItem('token')) {
        next({
            path: '/home'
        });
    } else {
        next();
    }
});


export default router
