<template>
    <div v-show="start!==null" class="p-3 border-2 border-gray-600 bg-dark-yellow toast sm:w-3/12 h-16 fixed top-0 right-0 flex items-center z-200 m-4 bg-white text-black justify-evenly text-center">
         <span><i class="fas fa-info-circle mx-2 text-white"></i></span>
        <div class="w-full flex">{{message}}</div>
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
            default:1,
            required:true,
        },
        'start':{
            default:null,
            Type:Boolean,
        },
        'delay':{
            default:'0',
            Type:String,
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
                   delay:'1',
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
                delay:this.delay,
                duration:`${this.time-0.2}`,
                ease:'ease.out'
            })
            tl1.to('.toast',{
                x:'150%',
                duration:`${this.time-0.2}`,
                delay: `${+this.delay + 1.5}`,
                ease:'ease.out',
                onComplete:()=>{
                    this.$emit('changeToast',true);
                }
            })
        }
    },
    mounted(){
         if(this.start!==null){
             this.animate();
         }
    }

}
</script>

<style scoped>

</style>
