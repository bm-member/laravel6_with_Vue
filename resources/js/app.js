
require('./bootstrap');
window.Swal = require('sweetalert2')
window.Vue = require('vue');

window.Toast = Swal.mixin({
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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('task-component', require('./components/Task.vue').default);

const app = new Vue({
    el: '#app',
});
