<template>
      <div class="animation w-full h-full z-20">
          <div class="fixed px-4 py-4 sm:px-8 sm:py-5 top-0 left-0 h-16 z-30 flex items-center bg-white justify-between  w-full border-b-2 border-gray-600">
              <div class="w-1/2 flex items-center">
              <h1 class="text-title stroke-1 font-bowlby add_stroke text-3xl">Note Me</h1>
              </div>
                  <div class="w-5/12 flex justify-between items-center">
                    <div class="w-1/2 flex items-center justify-evenly">
                        <div class="flex items-center py-2">
                        <label class="flex items-center justify-center px-2 py-1">
                          <img :src="img_src+'/images/translate.png'" class="w-12 h-12" alt="translate">
                          <select class="border-none focus:outline-none focus:ring-0" @change="ChangeLocale()" v-model="locale">
                            <option value="en"><a :href="img_src+'/en'">en</a></option>
                              <option value="mm"><a :href="img_src+'/mm'">mm</a></option>
                              <option>es</option>
                              <option>jpn</option>
                          </select>
                      </label>
                        </div>
                      <label for="checkbox" class="flex">
                      <input id="checkbox" type="checkbox" value="false" @change="ChangeNight()" v-model="checkbox" />
                      <span class="check"></span>
                      </label>
                    </div>
                      <div class="flex items-center justify-evenly" :class="locale==='mm'?'text-md w-6/12':'text-xl w-5/12 '">
                          <button class="focus:outline-none px-2 py-1 font-bowlby tracking-wider text-login " :class="locale==='mm'?'font-extrabold':'add_stroke'">{{messages.login}}</button>
                          <button class="focus:outline-none px-2 py-1 font-bowlby text-signup tracking-wider " :class="locale==='mm'?'font-extrabold':'add_stroke'">
                              {{messages.signup}}</button>
                      </div>
              </div>
          </div>
          <div class="w-full h-full relative items-center justify-center flex flex-col">
              <div class="h-full w-full overflow-hidden">
                  <div class="holder h-full w-full transform translate-y-full pt-20 p-4">
                      <div v-show="isAbout" class="about w-full h-full bg-white flex items-center flex-col border-2 border-gray-600">
                          <svg xmlns="http://www.w3.org/2000/svg" @click="hide()" class="self-end mt-1 mr-1 cursor-pointer w-12 text-gray-600 stroke-current" viewBox="0 0 24 24"><path fill="#6563ff" d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"/><path fill="#b2b1ff" d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"/></svg>
                      <div class="w-full h-full flex">
                          <div class="w-1/2 h-full flex items-center justify-center p-3">
                              <img :src="img_src+'/images/note_me_04.png'" class="w-full" alt="">
                          </div>
                          <div class="flex flex-col h-full items-center p-3 w-1/2">
                              <h2>{{messages.about}}</h2>
                              <ul class="flex flex-col h-4/6 justify-evenly list-disc">
                                  <li>
                                      <h1 class="font-bold">What is Note Me?</h1>
                                      <p>Note Me is a SaaS app in which you can
                                          create your own notes, schedule your tasks,
                                          let note me notify you with email or desktop
                                          notification browse your notes on any device's
                                          web browsers.</p>
                                  </li>
                                  <li>
                                      <h1 class="font-bold">How is Note Me created?</h1>
                                      <p>Note Me is created with Laravel PHP framework, Vue Js framework,TailWind CSS framework,
                                          and Editor js library, v-calendar library</p>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      </div>
                      <div v-show="isReadMe" class="read_me w-full h-full bg-white flex items-center flex-col border-2 border-gray-600">
                          <svg xmlns="http://www.w3.org/2000/svg" @click="hide()" class="self-end mt-1 mr-1 cursor-pointer w-12 text-gray-600 stroke-current" viewBox="0 0 24 24"><path fill="#6563ff" d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"/><path fill="#b2b1ff" d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"/></svg>
                          <div class="w-full h-full flex">
                              <div class="w-1/2 h-full flex items-center justify-center p-3">
                              </div>
                          </div>
                      </div>
                      <div v-show="isContact" class="contact_me w-full h-full bg-white flex items-center flex-col border-2 border-gray-600">
                          <svg xmlns="http://www.w3.org/2000/svg" @click="hide()" class="self-end mt-1 mr-1 cursor-pointer w-12 text-gray-600 stroke-current" viewBox="0 0 24 24"><path fill="#6563ff" d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"/><path fill="#b2b1ff" d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"/></svg>

                      </div>
                  </div>
              </div>
              <div class="w-full bottom-0 left-0 absolute flex justify-center items-center overflow-hidden">
              <div class="navigation w-9/12 flex h-1/6 py-4 justify-evenly font-poppins">
                <div class="w-3/12 bg-about px-2 flex items-center justify-center py-4 border-white  border-2"><span class="add_stroke_white stroke-current tracking-widest cursor-pointer" @click="About()">About</span></div>
                <div class="w-3/12 bg-read_me px-2 flex items-center justify-center py-4 border-white  border-2"><span class="add_stroke_white stroke-current tracking-widest cursor-pointer" @click="ReadMe()">Read Me</span></div>
                <div class="w-3/12 bg-contact_me px-2 flex items-center justify-center py-4 border-white  border-2"><span class="add_stroke_white stroke-current tracking-widest cursor-pointer" @click="ContactMe()">Contact Me</span></div>
            </div>
              </div>
          </div>
      </div>
</template>

<script>
import {GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls';
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { GlitchPass } from 'three/examples/jsm/postprocessing/GlitchPass.js';
import {BufferGeometryUtils} from 'three/examples/jsm/utils/BufferGeometryUtils';
let scene,renderer,obj,camera,container,clock,controls,composer;
export default {
    name: "landing-page",
    props:['img_src','encoded_messages','current_locale'],
    data(){
        return{
            checkbox:false,
            isLoading:true,
            isAbout:false,
            isReadMe:false,
            isContact:false,
            locale:this.current_locale,
            messages:JSON.parse(this.encoded_messages
            ),
        }
    },
    computed:{
        currentLocale(){
            return 'messages.'+this.locale;
        }
    },
    methods:{
        hide(){
            let el=this;
            let tl=gsap.timeline({ease:'back.out(.5)'});
            tl.to('.holder',{
                y:'100%',
                duration:.8,
                ease:'power1.out'
            })
            tl.to('.navigation',{
                y:'0%',
                duration:.7,
                onComplete:()=>{
                    el.isReadMe=false;
                    el.isAbout=false;
                    el.isContact=false;
                }
            });

        },
        show(){
            let tl=gsap.timeline({ease:'back.in(.5)'});
          tl.to('.navigation',{
              y:'100%',
              duration:.7,
          });
            tl.to('.holder',{
                y:'0%',
                duration:.8,
                ease:'power1.out'
            })
        },
        About(){
          this.isAbout=true;
          this.show();
        },
        ReadMe(){
          this.isReadMe=true;
          this.show();
        },
        ContactMe(){
            this.isContact=true;
            this.show();
        },
        ChangeLocale(){
              window.location.href=this.img_src+`/${this.locale}`
        },
        ChangeNight(){
            let intervalRewind;
            let video1=document.querySelector('#video1');
            let video2=document.querySelector('#video2');
            console.log(video1.duration)
            if(!this.checkbox) {
                let startSystemTime = new Date().getTime();
                let startVideoTime = video1.currentTime;
                video1.classList.remove('z-10')
                video2.classList.add('z-10')
                video2.classList.remove('z-0')
                video1.classList.add('z-0')
                video2.play();

            }else{
                if(!video2.classList.contains('z-0')){
                    video2.classList.remove('z-10')
                    video2.classList.add('z-0');
                }
                if(!video1.classList.contains('z-10')){
                    video1.classList.remove('z-0')
                    video1.classList.add('z-10');
                }

               video1.play();
            }

            // console.log(video);
            // if(!this.checkbox){
            //
            //     console.log(video.currentTime)
            // }else{
            //     video.play();
            //     console.log(video.currentTime)
            // }
            // console.log(video.currentTime)
        },
          _Req(){
              // controls.update();
              requestAnimationFrame( this._Req );
              // composer.render();
              // renderer.render( scene, camera );
          }
    },
    created(){
        clock=new THREE.Clock();
    },
    mounted(){
        console.log(this.messages,this.locale);
        console.log(this.img_src)
        let video1=document.getElementById('video2');
        let el=this;
        // container=document.querySelector('.animation').getBoundingClientRect();
      // scene=new THREE.Scene();
      // camera=new THREE.PerspectiveCamera(45,container.width/container.height,0.1,500);
      //   camera.position.set( 0, 0, 20 );
      // renderer=new THREE.WebGLRenderer({alpha:0, antialiased:true});
      // renderer.setClearColor(0x404040,0);
      // renderer.setSize(container.width,container.height);
      //   renderer.outputEncoding = THREE.sRGBEncoding;
      //   composer = new EffectComposer( renderer );
      //   document.querySelector('.animation').appendChild(renderer.domElement);
      //   const ambientLight = new THREE.AmbientLight( 0x404040, 0.05 );
      //   scene.add( ambientLight );
      //
      //   const pointLight = new THREE.PointLight( 0xffffff, 0.4 );
        // camera.add( pointLight );
        // scene.add( camera );
        // controls=new OrbitControls(camera,renderer.domElement);
        // controls.update();
        // let loader=new GLTFLoader();
        //  loader.load('/images/note_me_21thJan.glb',function(gltf){
        //      console.log(gltf);
        //      obj=gltf.scene;

             // for(let children of obj.children){
             //   if(children.type!=='Mesh')
             //   {
             //       scene.add(children);
             //   }
             //   else if(children.children.length!==0){
             //       for(let child of children.children){
             //           if(child.type!=='Mesh'){
             //               scene.add(child);
             //           }
             //       }
             //   }
             // }
        //      scene.add(obj);
        // });
        //  this._Req();
    }

}
</script>

<style scoped>
>>>input[type="checkbox"]{
    -webkit-appearance: none;
    display: none;
    visibility: hidden;
}
.check{
    position: relative;
    display: block;
    width:40px;
    height:20px;
    background: #092c3e;
    cursor: pointer;
    border-radius: 20px;
    overflow:hidden;
    transition:ease-in 0.3s;
}
input[type='checkbox']:checked ~ .check{
    background:#F3F3F3;
}
.check:before{
    content:'';
    position:absolute;
    top:2px;
    left:2px;
    background-color:#fff;
    width:16px;
    height:16px;
    border-radius: 50%;
    transition:0.5s;
    display: block;
    background-size: contain;
    background-image: url("/images/night.png");
}
input[type='checkbox']:checked ~ .check:before{
    transform: translateX(20px);
    right:2px;
    background-color:#092c3e;
    background-image: url("/images/sun_1.png");
}
.add_stroke{
    -webkit-text-stroke: 1px #404040;
}
.add_stroke_white{
    -webkit-text-stroke: 1px white;
}
</style>
