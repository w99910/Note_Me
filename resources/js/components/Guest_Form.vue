<template>
    <div class="w-full sm:w-1/2 flex flex-col items-center justify-around text-primary h-3/5 text-center relative">
        <div class="login-form transform translate-y-full fixed w-full right-0 h-5/6 bottom-0 z-10 rounded-t-2xl p-5 flex flex-col sm:flex-row items-center justify-center"  >
<!--              <div class="w-full flex items-center justify-center ">-->
<!--                  <img src="/images/login_note_me.png" alt="login" class="w-8/12 bg-cover object-center">-->
<!--              </div>-->

            <div class="w-full h-full flex flex-col sm:flex-row justify-between items-center justify-center p-4 sm:p-10 rounded-2xl relative" style="background: #6A5B5B;">
                <div class="absolute top-0 right-0 bg-white rounded-bl-full"><button class="px-3 focus-within:outline-none" @click="showLogin">-</button></div>
                <div class="animation_me w-1/2 h-full"></div>

                <div class="flex flex-col w-full mt-2 sm:mt-0 sm:w-5/12 text-dark-black h-full justify-center p-2 sm:p-10 rounded-2xl bg-white">
                    <span class="text-xl font-bold">Let's Rock and Roll :D</span>
                    <form action="/note_me_login" method="post" class="w-full h-full">
                        <input type="hidden" name="_token" :value="csrf">
                    <div class="flex sm:mb-0 mb-1 relative justify-center flex-col items-center w-full h-1/4">
                    <div class="flex justify-start items-center w-full"><label for="email" class="w-3/12 flex">Email:</label>
                    <input id="email" name="email" class="text-gray-800 ml-3 focus:outline-none rounded-full py-1 px-2 w-9/12" type="text" v-model="email" required>
                    </div>
                        <span class="text-red-500 w-full flex items-end justify-end sm:justify-center bottom-0 right-0" v-if="!isValidMail"><span>Please enter valid email.</span></span>

                    </div>
                <div class="flex sm:mb-0 mb-1 relative justify-center flex-col items-center w-full h-1/4">
                    <div class="flex justify-start items-center w-full"><label for="password" class="w-3/12 flex">Password:</label>
                    <input id="password" name="password" class="text-gray-800 ml-3 focus:outline-none rounded-full py-1 px-2 w-9/12" type="password" v-model="password" required>
                    </div>
                        <span class="text-red-500 w-full flex items-end justify-end sm:justify-center bottom-0 right-0" v-if="!isValidPassword" ><span>Password Field is required.</span></span>

                </div>
                <div class=" relative flex items-center justify-start w-full  h-1/4">
                    <label for="checkbox" class="flex">Remember Me?</label>
                    <input id="checkbox" name="remember" class="ml-3 focus:outline-none" type="checkbox" v-model="remember">

                </div>
                <div class="w-full flex items-center justify-end mt-1 sm:mt-4">
                    <button class="focus:outline-none text-center text-white rounded-full px-5 py-2 w-9/12 sm:w-full self-end" type="submit" style="background: #658795;" :disabled="!isDisable">Login</button>

                </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="register-form transform translate-y-full fixed w-full right-0 h-5/6 bottom-0 z-10 rounded-t-2xl p-5 flex flex-col sm:flex-row items-center justify-center"  >
            <div class="w-full h-full flex flex-col sm:flex-row justify-between items-center justify-center p-4 sm:p-10 rounded-2xl relative" style="background: #6A5B5B;">
                <div class="absolute top-0 right-0 bg-white rounded-bl-full"><button class="px-3 focus-within:outline-none" @click="showSignUp">-</button></div>
                <div class="flex flex-col w-full mt-2 sm:mt-0 sm:w-5/12 text-dark-black h-full justify-center p-2 sm:p-10 rounded-2xl bg-white">
                    <span class="text-xl font-bold">Let's Rock and Roll :D</span>
                    <form action="/note_me_register" method="post" class="w-full h-full">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="flex sm:mb-0 mb-1 relative justify-center flex-col items-center w-full h-1/4">
                            <div class="flex justify-start items-center w-full"><label for="name" class="w-3/12 flex">Name:</label>
                                <div class="flex w-9/12 items-center justify-center rounded-full border pr-2 border-2">
                                    <input id="name" name="name" class="border-none focus:ring-0 text-gray-800 rounded-full py-1 px-2 w-full" type="text" v-model="name">
                                </div>
                                </div>
                            <span class="text-red-500 w-full flex items-end justify-end sm:justify-center bottom-0 right-0" v-if="nameError!==null"><span>{{nameError}}</span></span>
                        </div>
                        <div class="flex sm:mb-0 mb-1 relative justify-center flex-col items-center w-full h-1/4">
                            <div class="flex justify-start items-center w-full"><label for="email1" class="w-3/12 flex">Email:</label>
                                <div class="flex w-9/12 items-center justify-center rounded-full border pr-2 border-2">
                                <input id="email1" name="email1" class="text-gray-800 rounded-full focus:ring-0 border-none py-1 px-2 w-full" type="text" v-model="email1" required>
                                </div>
                                </div>
                            <span class="text-red-500 w-full flex items-end justify-end sm:justify-center bottom-0 right-0" v-if="!isValidMail"><span>Please enter valid email.</span></span>
                        </div>
                        <div class="flex sm:mb-0 mb-1 relative justify-center flex-col items-center w-full h-1/4">
                            <div class="flex justify-start items-center w-full"><label for="password1" class="w-3/12 flex">Password:</label>
                                <div class="flex w-9/12 items-center justify-center rounded-full border pr-2 border-2">
                                <input id="password1" name="password1" class="text-gray-800 rounded-full focus:ring-0 border-none py-1 px-2 w-full" type="password" v-model="password1" required>
                                <i class="fas fa-eye" @click="togglePass"></i>
                                </div>
                            </div>
                            <span class="text-red-500 w-full flex items-end justify-end sm:justify-center bottom-0 right-0" v-if="!isValidPassword" ><span>Password Field is required.</span></span>

                        </div>
                        <div class="w-full flex items-center justify-end mt-1 sm:mt-4">
                            <button class="focus:outline-none text-center text-white rounded-full px-5 py-2 w-9/12 sm:w-full self-end" type="submit" style="background: #658795;">Sign Up</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="text-lg sm:text-2xl font-bold w-full flex justify-center h-3/5" style="text-align: start">
            <div class="owl-carousel">
                <div>Ease your daily tasks with Note Me.</div>
                <div>Note me is a SaaS in which you can create your own
                    notes, schedule your tasks, check the rating of your weekly
                    or monthly finishing tasks</div>
                <div>and if you are developer,  run
                    your code on our website's playground, browse your notes on
                    any device's web browsers, get daily tips from us,</div>
                <div>let note me
                    notify you with email or desktop notification. </div>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row justify-evenly w-full sm:w-8/12 items-center h-full">
            <button class="focus:outline-none text-center text-dark-red border-none w-full sm:w-4/12   bg-white rounded-full py-3" @click="showLogin()">Login</button>
            <button class=" focus:outline-none text-white bg-dark-red border-none w-full sm:w-4/12 mt-2 sm:mt-0  rounded-full py-3" @click="showSignUp()">Sign Up</button>
        </div>
    </div>
</template>

<script>
 import {GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader';
 import {FBXLoader} from 'three/examples/jsm/loaders/FBXLoader';
let renderer,container,scene,camera,animations=[],character,hemi_light,mixer,clock,
    angry_action, no_action,thoughtful_action,clap_action,head_action,point_action,whatever_action,wave_action,current_action;
export default {
    props:['csrf'],

    name: "guest_form",
    data(){
        return {
            name:'',
            nameError:null,
            isOpen:false,
            email:'',
            password:'',
            email1:'',
            password1:'',
            isValidMail:true,
            remember:false,
            isValidPassword:true,
            enableAni:true,
            isOpen_register:false,
        }
    },
    computed:{
      isDisable(){
             return this.ValidateForms(this.email,this.password);
      }
    },
    watch:{
        name() {
            if(this.HasString(this.name)){
                this.nameError='Name field is required.'
            }
            else{
                this.nameError=null;
            }
        },
      email(){
          if(this.enableAni) {
              let think = mixer.clipAction(point_action);
              let el=this;
              think.enabled = true;
              think.reset();
              think.setEffectiveWeight(1.0);
              think.setEffectiveTimeScale(1.0);
              think.setLoop(THREE.LoopOnce,1);
              think.clampWhenFinished=true;
              think.crossFadeFrom(current_action, 0.2, true);
              think.play();
              this.enableAni=false;
              current_action = think;
              think.getMixer().addEventListener('finished',()=>{
                let wave=mixer.clipAction(wave_action);
                wave.reset();
                wave.crossFadeFrom(current_action,0.4,true)
                wave.play();
                current_action=wave;
                el.enableAni=true;
              })
          }
          if(this.isValidEmail(this.email)){
              this.isValidMail=true;
          }
          else{
              this.isValidMail=false;
          }
      },
        password(){
          if(this.password.trim().length===0){
              this.isValidPassword=false;
          }
          else {
              this.isValidPassword=true;
          }
        }
    },

    methods:{
        HasString(value){
          return value.trim().length===0;
        },
        Login(){

            if(this.ValidateForms(this.email,this.password)) {

                axios.post('/note_me_login', {
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                }).then((res) => {
                    console.log(res)
                });
            }
        },
        togglePass(){
            let input=document.getElementById('password1');
            if(input.type==='password')
          {
              input.type='text';
          }
          else{
              input.type='password';
          }
        },

        ValidateForms(email,password){
          return this.isValidEmail(email)&&password.trim().length!==0;
        },
        showLogin(){
          this.isOpen=!this.isOpen;
          if(this.isOpen) {
              gsap.to('.login-form', {
                  y: '0%',
                  ease: 'power1.out',
                  duration: 1,
              })
          }
          else {
              gsap.to('.login-form', {
                  y: '100%',
                  ease: 'power1.out',
                  duration: 1,
              })
          }
        },
        showSignUp(){
            this.isOpen_register=!this.isOpen_register;
            if(this.isOpen_register) {
                gsap.to('.register-form', {
                    y: '0%',
                    ease: 'power1.out',
                    duration: 1,
                })
            }
            else {
                gsap.to('.register-form', {
                    y: '100%',
                    ease: 'power1.out',
                    duration: 1,
                })
            }
        },
        SignUp(){
            if(this.ValidateForms(this.email1,this.password1)) {

                axios.post('/note_me_register', {
                    email: this.email1,
                    password: this.password1,
                }).then((res) => {
                    console.log(res)
                });
            }
        },
        isValidEmail(email){
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email.toLowerCase());
        },
        _Req(){
            let dt=clock.getDelta();
            requestAnimationFrame( this._Req );
            renderer.render( scene, camera );
            if(mixer!==undefined){mixer.update(dt)}
        },
        _Resize(){

            camera.aspect = container.width/container.height;
            camera.updateProjectionMatrix();

            renderer.setSize( container.width,container.height);
        }
    },
    created(){
      clock=new THREE.Clock();
    },
    mounted(){
        let el=this;
        window.addEventListener('resize',function(){
            if(camera&&renderer){
                el._Resize();
            }
        })
        container=document.querySelector('.animation_me').getBoundingClientRect();
        scene=new THREE.Scene();
      camera=new THREE.PerspectiveCamera(45,container.width/container.height,0.01,1000);

      renderer=new THREE.WebGLRenderer({alpha:true});
        renderer.setClearColor(0xffffff, 0);
           camera.position.z=2;
      hemi_light=new THREE.HemisphereLight(0xffffbb, 0x080820, 1);
      scene.add(hemi_light);
      const light = new THREE.AmbientLight( 0x404040 ); // soft white light
        scene.add( light );
      renderer.setSize(container.width,container.height);
      document.querySelector('.animation_me').appendChild(renderer.domElement);
         let loader=new GLTFLoader();
         loader.load('/images/me.glb',function(obj){
             character=obj.scene;
             mixer=new THREE.AnimationMixer(character);
             obj.animations.forEach((ani)=>{
                 animations.push({name:ani.name,action:ani})
             })
             angry_action=obj.animations[0];
             clap_action=obj.animations[1];
             head_action=obj.animations[3];
             no_action=obj.animations[4];
             point_action=obj.animations[5];
             thoughtful_action=obj.animations[6];
             wave_action=obj.animations[7];
             whatever_action=obj.animations[8];
             current_action=mixer.clipAction(wave_action);
             current_action.play();
             character.position.set(0,-3.1,-1);
             scene.add(character);

             camera.lookAt(0,-1.0,0);
         })

      this._Req();
    },
}
</script>

<style scoped>

</style>
