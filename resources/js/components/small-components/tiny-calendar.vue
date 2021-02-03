<template>
<div class="calendar-intro w-full h-full flex flex-col justify-between items-center border-none relative">
     <span class="text-lg font-poppins font-bold text-gray-100">{{ messages.Scheduled_Notes}}</span>
    <v-calendar is-expanded :theme="theme" :attributes="attributes" :is-dark="isDark"></v-calendar>
</div>
</template>

<script>
export default {
    name: "tiny-calendar",
    props:['messages'],

    data(){
        return{
            theme: {
                container: {
                    light: 'border-2 vc-bg-dark-red border-gray-600',  // Classes to apply for light mode
                    dark: 'dark-container-class',  // Classes to apply for dark mode
                }
            },
            isDark:false,
            attributes:[],
        }
    },
    methods:{

    },
    created(){
        if (localStorage.theme_noteme === 'dark'||localStorage.theme_noteme !== undefined) {
        this.isDark=true;
        }
        axios.post('schedules').then((res)=>{

                if(res.data.length!==0) {
                    for (let i of res.data) {
                        let date = [];
                        if(i.note!==null) {
                            date.push(new Date(i.created_at));
                            this.attributes.push({
                                // dot:{
                                //     style:{
                                //         backgroundColor:i.note.color,
                                //         margin:'1px',
                                //     }
                                // },
                                highlight: {
                                    style: {
                                        backgroundColor: i.note.color,
                                    }
                                },
                                dates: date,
                                popover: {
                                    label: i.note.title,
                                }
                            });
                        }
                    }
                }
        })
    },
    mounted() {
        let el=this;
        document.querySelector('#checkbox').addEventListener('change',function(value){
            if(this.checked){
                el.isDark=true;
            }else{
                el.isDark=false;
            }
            console.log('Dark:',el.isDark);
        });
    }
}
</script>

<style scoped>
   >>>.vc-container{
       border:2px solid #f3f3f3 !important;
   }
</style>
