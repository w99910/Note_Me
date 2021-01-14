<template>
<div v-show="start!==null" class="toast sm:w-3/12 h-12 fixed top-0 right-0 flex items-center m-4 bg-white text-black justify-center text-center">
     {{message}}
</div>
</template>

<script>
export default {
    name: "toast",
    props:{
        'message':{
            Type:String,
            required:true,
        },
        'time':{
            required:true,
            default:1,
        },
        'start':{
            default:null,
            Type:Boolean,
        }
    },
    data(){
        return {

        }
    },
    watch:{
        start(){
            let tl1=gsap.timeline({ease:'back.out(2)'});
           if(this.start){
               tl1.from('.toast',{
                   x:'150%',
                   duration:`${this.time}`,
                   ease:'back.out(2.4)'
               })
               tl1.to('.toast',{
                   x:'150%',
                   duration:`${this.time}`,
                   delay:'1.5',
                   ease:'back.in(2.4)',
                   onComplete:()=>{
                       this.start=false;
                   }
               })

           }
        }
    },
    methods:{
        animate(){
            let tl1=gsap.timeline();
            tl1.from('.toast',{
                x:'150%',
                duration:`${this.time}`,
                ease:'back.out(2.4)'
            })
            tl1.to('.toast',{
                x:'150%',
                duration:`${this.time}`,
                delay:'1.5',
                ease:'back.in(2.4)',
            })
        }
    },
    mounted(){
        console.log(this.start)
         if(this.start!==null){
             this.animate();
         }
    }

}
</script>

<style scoped>

</style>
