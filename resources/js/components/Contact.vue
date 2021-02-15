<template>
    <div class="p-10 w-full h-full bg-white dark:bg-gray-900 border-gray-50 border-l-2">
       <div class="w-full h-full border-2 flex flex-row-reverse border-gray-600 dark:border-light-white">
            <img :src="url+'images/note_12thFeb.png'">
       </div>
    </div>
</template>

<script>
export default {
name: "Contact",
    props:['url'],
    data(){
        return {

        }
    },
    methods:{

    },
    mounted() {
          console.log(this.url)
    }
}
</script>

<style scoped>

</style>
