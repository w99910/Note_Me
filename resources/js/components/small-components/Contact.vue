<template>
    <div class="w-10/12 tracking-wide font-poppins flex-col h-full flex justify-evenly absolute top-0">
       <h1 class="text-xl font-bowlby mt-1  self-center text-dark-red">{{ messages.contact_me }}</h1>
        <div class="letter mt-1 flex flex-col h-3/5 justify-evenly">
              <h1>{{ messages.hello }}</h1>
            <p>{{ messages.I }} <input class="bg-transparent focus:outline-none ring-0 focus:ring-0 border-0 border-b px-2 w-2/12 py-1" type="text" v-model="name" />
                {{  messages.tell }}  <input class="bg-transparent focus:outline-none ring-0 border-0 focus:ring-0 border-b px-2 w-4/12 py-1" type="text" v-model="title" />.</p>
            <p>{{ messages.is_about }}</p>
            <div class="w-full flex">
                <input class="bg-transparent focus:outline-none ring-0 focus:ring-0 border-0 border-b px-2 w-full pb-1" type="text" v-model="content" />
            <p>.</p>
            </div>
                <div class="w-full flex mt-1">
            <p>{{ messages.contact_email }}</p><input class="bg-transparent focus:outline-none ring-0 border-0 focus:ring-0 border-b px-2 w-4/12 py-1" type="text" v-model="email" /><p>.</p>
            </div>
                <p>{{  messages.sincerely }} </p>
            <div class="flex items-center justify-between">
            <p>{{uppername}}</p>
                <div class="w-5/12">
                        <button class="focus:outline-none p-2 rounded-full bg-white dark:bg-gray-100" @click="sendMail">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 stroke-current text-gray-200 dark:text-gray-100" viewBox="0 0 64 64"><path d="M60.86,13.26a1,1,0,0,0,0-.28s0,0,0,0,0-.05,0-.08a1,1,0,0,0-.11-.19l-.11-.11-.08-.08-.06,0-.14-.07-.17-.06-.15,0h-.3L3.86,24.49a1,1,0,0,0-.25,1.86l15.56,8.11,2.51,15.73a1,1,0,0,0,.09.28l0,.06a1,1,0,0,0,.19.24l0,0a1,1,0,0,0,.22.14h.06l.06,0a1,1,0,0,0,.3,0h0A1,1,0,0,0,23,51l.09,0,.14-.06,10.92-6.72,11.23,7.38a1,1,0,0,0,1.49-.49l14-37.42a1,1,0,0,0,.06-.32S60.86,13.28,60.86,13.26Zm-35,23.91a1,1,0,0,0-.15.14l0,0a1,1,0,0,0-.17.31l0,0-2.56,8L21.18,34.36l28.13-14.5ZM52.65,15.89,20.08,32.68,7,25.85ZM24.44,47.77l2.62-8.24L32.27,43Zm21,1.42-10.68-7h0l-6.46-4.24L57.75,16.1Z" data-name="Layer 2"/></svg>
                        </button>
                </div>
            </div>
        </div>
        <div class="w-full h-20"> </div>
    </div>
</template>

<script>
export default {
    props:['messages'],
    name: "Contact",
    data(){
        return {
            name:'',
            email:'',
            title:'',
            content:'',
            message:'',

        }
    },
    computed:{
        uppername(){
            return this.name.charAt(0).toUpperCase()+this.name.slice(1);
        }

    },
    methods:{
        changeToast(){
            console.log('changeToast')
        },
        sendMail(){
            if(this.check&&this.isValidEmail(this.email)){
                    axios.post('/send/mail',{name:this.uppername,email:this.email,title:this.title,contents:this.content}).then((res)=>{
                        this.$emit('showToast',this.message)
                    })
            }
            else{
                this.message = '';
                console.log(this.check())
               if(!this.check())
                   this.message +=this.messages.fill_empty+' ';
               }
               if(!this.isValidEmail(this.email)){
                   this.message+=this.messages.enter_valid_email;
               }
                this.$emit('showToast',this.message)

        },
        check(){
            return this.name.trim().length!==0&&this.title.trim().length!==0&&this.content.trim().length!==0;
        },
        isValidEmail(email){
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email.toLowerCase());
        },
    }

}
</script>

<style scoped>

</style>
