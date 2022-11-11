/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * Vuex import and configuration.
 */
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        baseUrl: 'http://localhost:8000',
        plantClassificationId: null,
        item: {

        },
        plant: {
            user_id: '',
            bonsai_style_id: '',
            plant_classification_id: '',
            name: '',
            specimen: '',
            age: '',
            description: '',
            main_picture: '',
            height: '',
            interventions: [],
            pictures: [],
            videos: [],
        },
        transaction: {
            status: '',
            message: '',
            alert: '',
            target: '',
            errors: []
        },
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('card-component', require('./components/CardComponent.vue').default);
Vue.component('input-container-component', require('./components/InputContainerComponent.vue').default);
Vue.component('plant-card-component', require('./components/PlantCardComponent.vue').default);
Vue.component('plant-create-component', require('./components/PlantCreate.vue').default);
Vue.component('plant-edit-component', require('./components/PlantEdit.vue').default);
Vue.component('plant-view-component', require('./components/PlantView.vue').default);

Vue.component('register-component', require('./components/Register.vue').default);
Vue.component('login-component', require('./components/Login.vue').default);
Vue.component('home-component', require('./components/Home.vue').default);
Vue.component('plant-component', require('./components/Plant.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
