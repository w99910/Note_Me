<template>
    <div class="profile-card transform w-full h-full border-2 border-gray-600 p-2   dark:bg-gray-200">
        <div
            class="py-1 relative items-center w-full h-full flex justify-evenly flex-col bg-white dark:text-gray-200  dark:bg-gray-800">
            <span class="text-lg text-yellow-500 absolute top-0 right-2 cursor-pointer" @click="editProfile"
                  v-show="editable">Change</span>
            <h1 class="text-xl">Note Me</h1>
            <div class="flex w-full h-5/6 px-2">
                <div class="avatar w-4/12 flex justify-center h-full">
                    <div class="w-8/12">
                        <avatar ref="avatar"></avatar>

                    </div>
                </div>
                <div class="profile_contents justify-evenly flex flex-col w-8/12 h-full px-2">
                    <div class="name flex justify-between items-center w-full">
                        <span class="w-3/12">Name:</span>
                        <input type="text" v-model="auth_user.name" spellcheck="false"
                               class="bg-transparent p-0 border-none focus:outline-none focus:ring-0 ring-0 w-8/12"/>
                    </div>
                    <div class="email flex justify-between items-center w-full">
                        <span class="w-3/12">Email:</span>
                        <input type="text" v-model="auth_user.email" spellcheck="false"
                               class="bg-transparent p-0 border-none focus:outline-none focus:ring-0 ring-0 w-8/12"/>

                    </div>
                    <div class="password flex justify-between items-center w-full">
                        <span class="w-3/12">Password:</span>
                        <span class="w-8/12"><i class="fas fa-circle mr-2" v-for="i in [1,2,3,4,5,6,7,8]"></i></span>
                    </div>
                    <div class="join flex justify-between items-center w-full">
                        <span class="w-3/12">Joined:</span>
                        <span class="w-8/12">{{ getDate }}</span>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default {
    name: "profile-card",
    props: ['user'],
    data() {
        return {
            isExpand: true,
            editable: false,
            auth_user: this.user,
            initial_name:this.user.name,
            initial_email:this.user.email,

        }
    },
    methods: {
        editProfile() {
           if(this.auth_user.name.trim().length!==0&&this.isValidEmail()){
                 axios.post('/change/profile',{name:this.auth_user.name,email:this.auth_user.email})
                     .then((res)=>{
                         if(res.data.code==='success') {
                             this.auth_user=res.data.user;
                             this.$emit('showMessage', {message: res.data.message});
                         }else{
                             this.editable=false;
                             this.auth_user.email=this.initial_email;
                             this.$emit('showMessage', {message: res.data.message});
                         }
                          console.log(res);
                 })
           }
           else {
               this.auth_user.name=this.initial_name;
               this.auth_user.email=this.initial_email;
               this.$emit('showMessage', {message: 'Name and Email fields are required and email must be valid'});

           }

        },
        isValidEmail(){
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(this.auth_user.email.toLowerCase());
        },
    },
    watch: {
        'auth_user.name': function (new_value, old_value) {
            this.editable= !(this.initial_name===new_value);
        },
        'auth_user.email':function(new_value,old_value){
            this.editable= !(this.initial_email===new_value);
        }
    },
    computed: {
        getDate() {
            let date = new Date(this.auth_user.created_at);
            return `${date.toDateString()}`;
        },

    },
    mounted() {
        console.log(this.$refs.avatar)
    }
}
</script>

<style scoped>
.profile-card {
    transition: 1s;
}
</style>
