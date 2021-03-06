
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Datepicker from 'vuejs-datepicker';
import {Datetime} from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('vacation-form', require('./components/VacationForm.vue').default);
Vue.component('datetime', Datetime);
Vue.component('date-time', require('./components/DatetimeInput.vue').default);
Vue.component('create-salary', require('./components/CreateSalaryForm.vue').default);
Vue.component('attendance-report', require('./components/AttendanceReport.vue').default);
Vue.component('salary-report', require('./components/SalaryReport.vue').default);
Vue.component('employee-salaries', require('./components/EmployeeSalaries.vue').default);
Vue.component('create-job-card', require('./components/CreateJobCard.vue').default);
Vue.component('pagination', require('./components/Pagination.vue').default);
Vue.component('datepicker', Datepicker);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#wrapper'
});
