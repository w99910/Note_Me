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
Vue.component('guest_form', require('./components/Guest_Form.vue').default);
Vue.component('toast', require('./components/toast.vue').default);
Vue.component('note-component',require('./components/Note_Component.vue').default);
Vue.component('calendar',require('./components/Calendar.vue').default);
Vue.component('landing-page',require('./components/Landing_Page').default);
import EditorJS from '@editorjs/editorjs';
import Undo from 'editorjs-undo';
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

    data(){
        return {
            isNav:false,
        }
    },
    methods:{
        toggle_Navbar() {

            let btn = document.querySelector('.Logout');
            console.log(btn);
            if(btn) {
                if (!this.isNav) {
                    gsap.to('.Logout', {
                        x: '0%',
                        ease: 'back.out(1.2)'
                    })
                    gsap.to('.times',{
                        rotation:90,
                        transformOrigin:"center",
                        ease:'power1.out'
                    })
                    this.isNav=true;
                } else {
                    this.hideNav();

                }
            }
        },
        hideNav:function() {
            if (this.isNav) {
                console.log('hide')
                gsap.to('.Logout', {
                    x: '100%',
                    ease: 'back.in(1.2)',
                })
                gsap.to('.times', {
                    rotation: 90,
                    transformOrigin: "center",
                    duration: 1.2,
                })
                this.isNav = false;
            }
        }
    },
    directives: {
        ClickOutside
    },

});
