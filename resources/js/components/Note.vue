<template>
    <div class="absolute overflow-hidden pl-8 top-0 right-0 w-5/12 flex flex-col h-full">
        <div class="w-full h-full p-1 bg-white dark:p-small dark:bg-gray-200">
            <div class="w-full h-full border-2 border-gray-700 flex flex-col bg-secondary dark:bg-gray-700">
                <div class="w-full flex justify-between items-center">
                    <div class="w-6/12 h-full p-1">
                        <weather></weather>
                    </div>
                    <div class="w-6/12 h-full p-1">
                        <tiny-calendar></tiny-calendar>
                    </div>
                </div>
                <div class="w-full h-2/6 flex items-center p-1">
                    <trash :url="url" :token="token"></trash>
                </div>
                <div class="w-full flex-1 flex p-1">
                    <quote></quote>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let introHome;
export default {
name: "Note",
    props:['url','token'],
    methods:{
       watchLocale(){
           let element=document.querySelector('.locale-intro');
           // element.value='mm'
           document.querySelector('.locale-intro').addEventListener('change',function(){
               axios.post('/set/locale',{value:this.value}).then((res)=>{
                   console.log(res.data);
                   if(res.status === 200){

                       // window.location.reload(false);
                   }
               })
           })
       },
       info(){
           window.addEventListener('DOMContentLoaded',function(){
               introHome=new introJs().setOptions({
                   tooltipClass:'customTooltip',
                   steps:[
                       {
                           title:'Welcome to Note Me',
                           intro:"I hope you are doing great.Let's explore together."
                       },
                       {
                           element:document.querySelector('.weather-intro-1'),
                           intro:'This is current weather indicator.',
                           position:'left'
                       },
                       {
                           element:document.querySelector('.weather-intro-2'),
                           intro:'You can change option of the city on your own.Click here and type your city.',
                       },
                       {
                           element:document.querySelector('.calendar-intro'),
                           intro:'This is a tiny calendar with your scheduled notes.Scheduled days will be highlighted.',
                       },
                       {
                           element:document.querySelector('.trash-intro'),
                           intro:'This is like a recycle bin in case you might delete notes accidentally and want to restore it.',
                       },
                       {
                           element:document.querySelector('.quote-intro'),
                           intro:'This is a quote to motivate you daily.',
                       },
                       {
                           element:document.querySelector('.checkbox'),
                           intro:'Toggle Light Mode/Dark Mode.',
                       },
                       {
                           element:document.querySelector('.locale-intro'),
                           intro:'Change Language of Website.',
                       },
                       {
                           element:document.querySelector('.create-note-intro'),
                           intro:"Let's create some note.",
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
