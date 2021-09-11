



require('./bootstrap');
import Vue from 'vue'

window.Vue = require('vue');

//Vuerouter
import VueRouter from 'vue-router'
Vue.use(VueRouter);

import {routes} from "./routes/index"


import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)



Vue.component('website_master', require('./components/website/index').default);

//Sweetalert
import 'sweetalert2/src/sweetalert2.scss'
import Swal from 'sweetalert2'
window.Swal = require('sweetalert2')

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast;


const router = new VueRouter({
    routes,
    mode: 'history',
    base: '/',
});


const app = new Vue({
    el: '#app',router
}).$mount('#app');

