<template>
    <div class="absolute overflow-hidden pl-8 top-0 right-0 w-5/12 flex flex-col h-full">
        <div class="w-full h-full p-1 bg-white dark:p-small dark:bg-gray-200">
            <div class="w-full h-full border-2 border-gray-700 flex flex-col bg-secondary dark:bg-gray-700">
                <div class="w-full flex justify-between items-center">
                    <div class="w-6/12 h-full p-1">
                        <weather :messages="decoded_messages"></weather>
                    </div>
                    <div class="w-6/12 h-full p-1">
                        <tiny-calendar :messages="decoded_messages"></tiny-calendar>
                    </div>
                </div>
                <div class="w-full h-2/6 flex items-center p-1">
                    <trash :url="url" :token="token" :messages="decoded_messages"></trash>
                </div>
                <div class="w-full flex-1 flex p-1">
                    <quote :messages="decoded_messages"></quote>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let introHome;
import Scrollbar from 'smooth-scrollbar';
export default {
name: "Note",
    props:['url','token','locale','messages'],
    computed:{
        decoded_messages(){
            return JSON.parse(this.messages);
        }
    },
    methods:{
       watchLocale(){
           let element=document.querySelector('.locale-intro');
           element.value=this.locale;
           document.querySelector('.locale-intro').addEventListener('change',function(){
               axios.post('/set/locale',{value:this.value}).then((res)=>{
                   console.log(res.data);
                   if(res.status === 200){
                       window.location.reload(false);
                   }
               })
           })
       },
       info(){
           let messages=this.decoded_messages;
           window.addEventListener('DOMContentLoaded',function(){
               // Scrollbar.init(document.querySelector('.note_container'))
               introHome=new introJs().setOptions({
                   tooltipClass:'customTooltip',
                   steps:document.querySelector('.first_note')!==null?[
                       {
                           title:messages.intro_dashboard.title,
                           intro:messages.intro_dashboard.step_1
                       },
                       {
                           element:document.querySelector('.weather-intro-1'),
                           intro:messages.intro_dashboard.step_2,
                           position:'left'
                       },
                       {
                           element:document.querySelector('.weather-intro-2'),
                           intro:messages.intro_dashboard.step_3,
                       },
                       {
                           element:document.querySelector('.calendar-intro'),
                           intro:messages.intro_dashboard.step_4,
                       },
                       {
                           element:document.querySelector('.trash-intro'),
                           intro:messages.intro_dashboard.step_5,
                       },
                       {
                           element:document.querySelector('.quote-intro'),
                           intro:messages.intro_dashboard.step_6,
                       },
                       {
                           element:document.querySelector('.checkbox'),
                           intro:messages.intro_dashboard.step_7,
                       },
                       {
                           element:document.querySelector('.locale-intro'),
                           intro:messages.intro_dashboard.step_8,
                       },
                       {
                           element:document.querySelector('.first_note'),
                           intro:messages.intro_dashboard.step_9,
                       },
                       {
                           element:document.querySelector('.create-note-intro'),
                           intro:messages.intro_dashboard.step_10,
                       },
                   ]:[
                       {
                           title:messages.intro_dashboard.title,
                           intro:messages.intro_dashboard.step_1
                       },
                       {
                           element:document.querySelector('.weather-intro-1'),
                           intro:messages.intro_dashboard.step_2,
                           position:'left'
                       },
                       {
                           element:document.querySelector('.weather-intro-2'),
                           intro:messages.intro_dashboard.step_3,
                       },
                       {
                           element:document.querySelector('.calendar-intro'),
                           intro:messages.intro_dashboard.step_4,
                       },
                       {
                           element:document.querySelector('.trash-intro'),
                           intro:messages.intro_dashboard.step_5,
                       },
                       {
                           element:document.querySelector('.quote-intro'),
                           intro:messages.intro_dashboard.step_6,
                       },
                       {
                           element:document.querySelector('.checkbox'),
                           intro:messages.intro_dashboard.step_7,
                       },
                       {
                           element:document.querySelector('.locale-intro'),
                           intro:messages.intro_dashboard.step_8,
                       },
                       {
                           element:document.querySelector('.create-note-intro'),
                           intro:messages.intro_dashboard.step_10,
                       },
                   ]
               });
               // localStorage.removeItem('first-time-note-me')
               if(localStorage.getItem('first-time-note-me')===null){
                   introHome.start();
               }
           })
           document.querySelector('.help').addEventListener('click',function(){
               introHome.start();
           })
       }


    },
    created(){

    },
    mounted() {
    this.watchLocale();
        this.info();
    }
}
</script>

<style scoped>

</style>
