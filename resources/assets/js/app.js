
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('image-input', require('./components/ImageInput.vue'));

const app = new Vue({
    el: '#app',
});

// var images = document.getElementById("node-body").getElementsByTagName("img");
// for (var i=0; i<images.length; i++) {
//   images[i].classList.add('mike-testing');
//   console.log(images[i].classList);
// }
// console.log(images);
// x.classList.add('mike-testing');

$(document).ready(function() {
  // all custom jQuery will go here
});
