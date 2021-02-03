<template>
     <div class="quote-intro w-full relative h-full bg-dark-red font-poppins border-2 border-gray-800 dark:border-gray-200 px-2 py-1 flex flex-col">
          <h1 class="text-lg font-poppins font-bold text-gray-100">{{quote.title}}</h1>
         <p class="text-dark-yellow"><i class="fas fa-quote-left text-sm text-white"></i> {{quote.quote}} <i class="fas fa-quote-right text-sm text-white"></i><span class="text-white"> - {{quote.author}}</span>
         </p>
         <span class="absolute bottom-0 right-0 mr-1 mb-1" :style="{fontSize:10+'px'}">{{quote.copyright}}</span>
     </div>
</template>

<script>
let introHome;
export default {
name: "Quote",
    props:['messages'],

    data(){
    return{
        quote:{
            title:'',
            quote:'',
            author:'',
            copyright:'theysaidso.com',
        },
            }
    },
    created(){
        let instance = axios.create();
        delete instance.defaults.headers.common['X-CSRF-TOKEN'];
        delete instance.defaults.headers.common['X-Requested-With'];
        instance.get('https://quotes.rest/qod?language=en',{
            headers:{
                'accept':'application/json',
            }
        }).then((res)=>{
            this.quote.author=res.data.contents.quotes[0].author;
            this.quote.title=res.data.contents.quotes[0].title;
            this.quote.quote=res.data.contents.quotes[0].quote;
        })
    },
    mounted() {


    }

}
</script>

<style scoped>

</style>
