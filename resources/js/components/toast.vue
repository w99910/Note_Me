<template>
<div class="toast sm:w-3/12 h-12 fixed top-0 right-0 flex items-center m-4 bg-white text-black justify-center text-center">
     {{message}}
</div>
</template>

<script>
export default {
    name: "toast",
    props:['message','time'],
    data(){
        return {

        }
    },
    methods:{

    },
    mounted(){
        let tl=gsap.timeline({ease:'power1.out'});
        tl.from('.toast',{
            x:'150%',
            duration:`${this.time}`,
        })
        tl.to('.toast',{
            x:'150%',
            duration:`${this.time}`,
            delay:'1'
        })
    }

}
</script>

<style scoped>

</style>
