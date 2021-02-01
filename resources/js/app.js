/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import gsap from "gsap/dist/gsap";
import * as THREE from 'three';
window.gsap=require('gsap/dist/gsap').gsap;
window.Vue = require('vue');
window.THREE=THREE;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('Test', require('./components/Test.vue').default);
Vue.component('form-component', require('./components/Form.vue').default);
Vue.component('Note', require('./components/Note.vue').default);
// Vue.component('guest_form', require('./components/Guest_Form.vue').default);
Vue.component('toast', require('./components/toast.vue').default);
Vue.component('note-component',require('./components/Note_Component.vue').default);
Vue.component('calendar',require('./components/Calendar.vue').default);
Vue.component('landing-page',require('./components/Landing_Page').default);
Vue.component('weather',require('./components/small-components/Weather').default);
Vue.component('trash',require('./components/small-components/trash').default);
Vue.component('quote',require('./components/small-components/Quote').default);
Vue.component('tiny-calendar',require('./components/small-components/tiny-calendar').default);
import EditorJS from '@editorjs/editorjs';
import Undo from 'editorjs-undo';
import introJs from 'intro.js';
import "intro.js/minified/introjs.min.css";

window.introJs=introJs;
window.Marker = require('@editorjs/marker');
window.Paragraph=require('@editorjs/paragraph');
window.list=require('@editorjs/list');
window.quote=require('@editorjs/quote');
window.Checklist=require('@editorjs/checklist');
window.LinkTool = require('@editorjs/link');
window.AttachesTool = require('@editorjs/attaches');
window.Table = require('@editorjs/table');
window.CodeTool = require('@editorjs/code');
window.Underline=require('@editorjs/underline');
window.Hyperlink = require('editorjs-hyperlink');
window.EditorJS=EditorJS;
window.Undo=Undo;
window.addEventListener('DOMContentLoaded',function(){
    if (localStorage.theme_noteme === 'dark'||localStorage.theme_noteme !== undefined) {
        document.querySelector('html').classList.add('dark');
        document.querySelector('#checkbox').checked=true;
        if(document.querySelector('#video1')!==null){
           let video1= document.querySelector('#video1')
           let video2= document.querySelector('#video2')

                video2.classList.remove('z-0')
                video2.classList.add('z-10');

               video1.classList.remove('z-10')
                video1.classList.add('z-0');

        }
    }
    document.querySelector('#checkbox').addEventListener('change',function(value){
        if(this.checked){
            localStorage.theme_noteme='dark';
            document.querySelector('html').classList.add('dark');
        }else{
            localStorage.removeItem('theme_noteme');
            document.querySelector('html').classList.remove('dark');
        }
    });
});

import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

// Register components in your 'main.js'
Vue.component('v-calendar', Calendar)
Vue.component('v-date-picker', DatePicker)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import ClickOutside from 'vue-click-outside';
const app = new Vue({
    el: '#app',

});
