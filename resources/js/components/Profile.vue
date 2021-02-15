<template>
<div class="bg-white font-poppins dark:bg-gray-700 w-full flex pr-2 items-center justify-between  h-full py-5">
     <div class="h-full w-1/2 flex flex-col justify-around">
         <div class="w-full h-1/2 flex items-center justify-center px-4">
            <profile-card :user="JSON.parse(user)" @showMessage="showMessage"></profile-card>
         </div>
         <div class="w-full h-1/2 flex items-center justify-center p-4">
         <chart></chart>
         </div>
     </div>
       <security></security>
    <toast v-if="showToast" :message="error_message" :time="1" start @changeToast="HideToast"></toast>

</div>

</template>

<script>
import chart from './small-components/chart';
import security from './small-components/security';
export default {
    name: "Profile",
     props:['localization','locale','user'],
    components:{
      'chart':chart,
        security,
    },
    data(){
        return{
            messages:JSON.parse(this.localization),
            showToast:false,
            error_message:'',
        }
    },
    methods:{
        showMessage(data){
               this.error_message=data.message;
               this.showToast=true;
        },
        HideToast(){
            this.showToast=false;
        },
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
    },
    created(){

    },
    mounted(){
        this.watchLocale();
    },
}
</script>

<style scoped>

</style>
