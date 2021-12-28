import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import Auth from './Auth.vue';

Vue.use(VueAxios, axios)

new Vue({
    el: '#vueAuthForm',
    template: '<Auth/>',
    components: { Auth }
});