<template>
    <div class="w-full h-5/6 flex flex-col sm:flex-row justify-between items-center justify-center p-4 sm:px-10 sm:py-3 relative">
        <div class="w-1/2 h-full relative" id="animation_text">
            <div class="top-0 left-0 bg-transparent text-center w-1/2 flex items-center bg-yellow-300 text-white p-2"><i class="fas fa-info-circle mx-2"></i><span class="stroke-current">Click On the div to drop meshes</span></div>
        </div>
        <div class="flex flex-col w-full mt-2 sm:mt-0 sm:w-5/12 text-dark-black h-full justify-center p-2 sm:p-10 rounded-2xl bg-white">
            <span class="text-xl font-bold">Let's Rock and Roll :D</span>
            <form :action="'/note_me_login'" method="post" class="w-full h-full">
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
                    <label for="checkbox" class="flex">Remember Me?
                    </label>
                    <input id="checkbox" name="remember" class="ml-3 focus:outline-none bg-gray-100" type="checkbox" v-model="remember"/>

                </div>
                <div class="w-full flex items-center justify-end mt-1 sm:mt-4">
                    <button class="focus:outline-none text-center text-white rounded-full px-5 py-2 w-9/12 sm:w-full self-end" type="submit" style="background: #658795;" :disabled="!isDisable">Login</button>
                    </div>
            </form>
        </div>

    </div>
</template>

<script>
let scene,camera,renderer,hemisphere_light,obj,container,controls,raycaster,world,clock,mouse,cubeBody,step=1 / 60,objs=[],bodies=[];
import {GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls';
import * as CANNON from 'cannon-es';
import { threeToCannon } from 'three-to-cannon';
export default {
name: "Login_Form",
    props:['csrf','locale'],
    data(){
        return {
            email:'',
            password:'',
            isValidMail:true,
            isValidPassword:true,
            remember:false,
        }
    },
    computed:{
        isDisable(){
            return this.ValidateForms(this.email,this.password);
        }
    },
    watch:{
        email(){
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
        ValidateForms(email,password){
            return this.isValidEmail(email)&&password.trim().length!==0;
        },

        isValidEmail(email){
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email.toLowerCase());
        },
        _Req(){
            let dt=clock.getDelta();
            renderer.render(scene,camera);
            requestAnimationFrame(this._Req);
            // controls.update();
            world.step(step)
            if(obj!==undefined) {
                obj.position.copy(cubeBody.position)
                obj.quaternion.copy(cubeBody.quaternion);

            }
            if(objs.length!==0) {
                for (let i = 0; i < objs.length; i++) {
                    objs[i].position.copy(bodies[i].position);
                    objs[i].quaternion.copy(bodies[i].quaternion);
                }
            }

        }
    },
    created(){
    clock=new THREE.Clock();
    },
    mounted(){
        container=document.getElementById('animation_text');
        let width=container.getBoundingClientRect().width;
        let height=container.getBoundingClientRect().height;
        scene=new THREE.Scene();
        // camera=new THREE.OrthographicCamera(width / - 1.5, width / 1.5, height / 1.5, height / - 1.5, 0.001, 1000);
        camera=new THREE.PerspectiveCamera(45,width/height,0.01,1000);
        camera.position.z=30;
        camera.position.y=2;
        camera.lookAt(0,1,0)

        renderer=new THREE.WebGLRenderer({antialias:true,alpha:1});
        renderer.setClearColor(0xffffff,1);
        renderer.setSize(width,height);
        renderer.outputEncoding = THREE.sRGBEncoding

        renderer.shadowMap.enabled = true
        renderer.shadowMap.type = THREE.PCFSoftShadowMap
        const light = new THREE.AmbientLight( 0x404040 ); // soft white light
        scene.add( light );
        hemisphere_light=new THREE.HemisphereLight(0xffffbb, 0x080820, 1);
        scene.add(hemisphere_light);
        // controls = new OrbitControls( camera, renderer.domElement );
        container.appendChild(renderer.domElement);
        raycaster=new THREE.Raycaster();
        mouse = new THREE.Vector2();
        world = new CANNON.World()
        world.gravity.set(0, -10, 0)

        // Floor
        const floorShape = new CANNON.Plane()
        const floorBody = new CANNON.Body({ mass: 0 })
        floorBody.addShape(floorShape)
        floorBody.quaternion.setFromEuler(-Math.PI / 2, 0, 0)
        world.addBody(floorBody)

        let loader=new GLTFLoader();
        loader.load('/images/28thJan_Text.glb',function(gltf){
           obj=gltf.scene;
           obj.scale.addScalar(0.5)
           obj.traverse((a)=>{
               a.castShadow=true;
               a.receiveShadow=true;
           })
            cubeBody = new CANNON.Body({ mass: 5 });
            const shape = threeToCannon(obj);
            cubeBody.addShape(shape);
            cubeBody.position.z=19;
            cubeBody.position.y=10;
            world.addBody(cubeBody)
           scene.add(obj);
        });
        loader.load('/images/28thJan_Login.glb',function(gltf){
           let login=gltf.scene;
            // login.scale.addScalar(0.5)
            login.traverse((a)=>{
                a.castShadow=true;
                a.receiveShadow=true;
            })
            let cubeLogin = new CANNON.Body({ mass: 5 });
            const shape_login = threeToCannon(login);
            cubeLogin.addShape(shape_login);
            cubeLogin.position.z=21.5;
            cubeLogin.position.y=10;
            objs.push(login);
            bodies.push(cubeLogin);
            world.addBody(cubeLogin)
            scene.add(login);
        })
        // controls.update();
        let colors=[0x986060,0x343434,0xbaae3d,0x24d277,0x486bcf,0xd0343b];
        container.addEventListener( 'click', (event)=>{
            const area=container.getBoundingClientRect();
            mouse.x = ( event.clientX / area.width ) * 2 - 1;
            mouse.y = - ( event.clientY / area.height ) * 2 + 1;
            raycaster.setFromCamera( mouse, camera );
            let geometry = new THREE.BoxGeometry( 1, 1, 1 );
            let material = new THREE.MeshBasicMaterial( {color: colors[Math.floor(Math.random()*6)]} );
            let cube = new THREE.Mesh( geometry, material );
            let body=new CANNON.Body({mass:2});
            let shape=threeToCannon(cube);
            raycaster.ray.at(camera.position.z-obj.position.z,cube.position);
            cube.position.y=10;
            body.addShape(shape);

            body.position.set(cube.position.x,cube.position.y,cube.position.z);
            objs.push(cube);
            bodies.push(body);
            world.addBody(body);
            scene.add( cube );
        }, false );

        this._Req();
            this.$emit('isChange',true);

    }
}
</script>

<style scoped>
       >>>input[type="checkbox"]{
           display:block !important;
           visibility: visible !important;
       }
</style>
