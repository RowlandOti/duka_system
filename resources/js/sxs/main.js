//Imports
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import VeeValidate from 'vee-validate'
import App from './App'
import router from './routes'
import store from "./store/store";

//Load Plugins
Vue.use(VueRouter)
Vue.use(Vuetify)
Vue.use(VeeValidate, { inject: false })

export const vm = new Vue({
    el: '#app',
    render: h => h(App),
    router,
    store,
});
