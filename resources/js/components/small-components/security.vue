<template>
    <div class="h-full w-1/2  border-2 border-gray-600 dark:border-gray-400 flex flex-col justify-between  bg-dark-yellow dark:bg-gray-800">
       <div class="w-full h-1/2 justify-between  flex flex-col p-4">
           <h1 class="text-xl text-dark-black dark:text-gray-200">Security</h1>
           <div class="w-full h-full text-dark-black dark:text-gray-200  flex flex-col items-center justify-evenly  py-2 ">
               <div class="w-full items-center flex justify-between">
                   <label class="w-3/12">Current Password:</label><input class="w-8/12 focus:outline-none px-2 py-1 dark:text-dark-black" v-model="current_password" type="password" />
               </div>
               <div class="w-full items-center flex justify-between">
                   <label class="w-3/12">New Password:</label><input class="w-8/12 focus:outline-none px-2 py-1 dark:text-dark-black" v-model="new_password" type="password" />
               </div>
               <div class="w-full items-center flex justify-between">
                   <label class="w-3/12">Retype new Password:</label><input class="w-8/12 focus:outline-none px-2 py-1 dark:text-dark-black" v-model="confirm_password" type="password" />
               </div>
               <div class="w-full items-center flex justify-between">
                   <div class="w-3/12"></div>
                   <div class="w-8/12 flex items-center">
                       <button class="bg-about text-white focus:outline-none px-2 py-1 border-2 border-gray-600" @click="changePassword">Change Password</button>
                   </div>
               </div>
           </div>
       </div>
       <div class="w-full h-1/2 flex items-center p-4 justify-center p-4">
           <div class="w-full h-full flex flex-col border-2 border-gray-600 bg-white" v-show="!loading">
               <div class="flex w-full h-1/2 flex justify-between items-center flex-col" v-show="user.password_security===null">
                   You haven't enable 2FA yet.
                   <button class="bg-dark-yellow text-white focus:outline-none px-2 py-1 border-2 border-gray-600" @click="enable2FA">Enable Google 2fa</button>
               </div>
               <div class="flex w-full h-full flex justify-between items-center flex-col" v-show="user.password_security!==null">

                   <div class="verify-google2fa flex items-center justify-center" v-show="!enable2fa">
                         <img :src="google2fa_url" alt="" />
                       <div class="flex flex-col h-8/10 justify-evenly">
                       <label>
                            <input v-model="verify_code" class="focus:outline-none px-2 py-2 border-2 border-gray-600" placeholder="Verify Code" type="password">
                        </label>
                        <button class="bg-dark-red w-8/12 text-white focus:outline-none px-2 py-1 border-2 border-gray-600" @click="verify2FA">Verify Code</button>
                       </div>
                       </div>
                   <div class="disable-2fa flex flex-col w-full h-full p-3 justify-center" v-show="enable2fa">
                       You have enabled 2fa.
                       <button class="bg-dark-red text-white focus:outline-none px-2 py-1 border-2 border-gray-600" @click="disable2FA">Disable 2FA</button>
                       </div>
               </div>
           </div>
       </div>
        <toast v-if="showToast1" :time="1" :message="message" start @changeToast="DeleteToast"></toast>
    </div>
</template>

<script>
export default {
name: "security",
    data(){
    return{
         current_password:'',
        new_password:'',
        confirm_password:'',
        user:'',
        loading:true,
        google2fa_url:'',
        google2fa_secret:'',
        verify_code:'',
        message:'',
        showToast1:false,
        google2fa_enable:false,
    }
    },
    computed:{
      enable2fa(){
          return this.user.password_security!==null&&this.google2fa_enable;
      }
    },
    methods:{
         check2FA(){
             axios.post('/check/2fa').then((res)=>{
                 console.log(res)
                 this.user=res.data.user;
                 this.google2fa_url=res.data.google2fa_url;
                this.loading=false;
                if(this.user.password_security!==null)
                {this.google2fa_enable=this.user.password_security.google2fa_enable;}
             });
         },
        enable2FA(){
             axios.post('/enable/2fa').then((res)=>{
                 console.log(res)
                 this.user=res.data.user;
                      this.google2fa_url=res.data.google2fa_url;
                      this.message='Please scan the QR and enter the verify code.'
                 this.showToast1=true;
             })
        },
        verify2FA(){
             if(this.verify_code.trim().length!==0){
            axios.post('/verify/2fa',{verify_code:this.verify_code}).then((res)=>{
                console.log(res);
                this.message=res.data.message;
                this.showToast1=true;
                if(res.status === 200) {
                    this.google2fa_enable = true;
                }
            })
            }
             else {
                 this.message='Empty Verify Code.Please Fill'
                 this.showToast1=true;
             }
         },
        disable2FA(){
            axios.post('/disable/2fa').then((res)=>{
               console.log(res)
                this.message=res.data.message;
               this.showToast1=true;
               if(res.status===200){
                   this.user=res.data.user;
                   this.google2fa_enable=false;
               }
            })
        },
        changePassword(){
             console.log(this.new_password.trim().length>7)
             if(this.new_password.trim().length<7){
                  this.message='Password must have minimum 8 words.';
                  this.showToast1=true;
                  return;
             }
             else if(this.new_password!==this.confirm_password){
                  this.message='Unmatched Password.';
                  this.showToast1=true;
                  return;
              }
          axios.post('change/password',{new_password:this.new_password,password:this.current_password})
          .then((res)=>{
              console.log(res);
              this.message=res.data.message;
              this.showToast1=true;
              if(res.data.code === 'success'){
                  this.new_password='';
                  this.current_password='';
                  this.confirm_password='';
              }
          })
        },
        DeleteToast(){
          this.showToast1=false;
        }
    },
    created(){
        this.check2FA();
    },
    mounted(){

    }
}
</script>

<style scoped>

</style>
