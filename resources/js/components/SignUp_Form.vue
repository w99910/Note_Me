<template>
        <div class="w-full h-5/6 flex flex-col sm:flex-row justify-between items-center justify-center p-4 sm:px-10 sm:py-3 rounded-2xl relative">
            <div class="w-1/2 h-full relative" id="signUp-animation">
                <div class="top-0 left-0 bg-transparent text-center w-1/2 flex items-center bg-yellow-300 text-white p-2"><i class="fas fa-info-circle mx-2"></i><span class="stroke-current">Click On the div to drop meshes</span></div>

            </div>
            <div class="flex flex-col w-full mt-2 sm:mt-0 sm:w-5/12 text-dark-black h-full justify-center p-2 sm:p-10 rounded-2xl bg-white">
                <span class="text-xl font-bold">Let's Rock and Roll :D</span>
                <form :action="'/note_me_register'" method="post" class="w-full h-full">
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
                                <input id="email1" name="email1" class="text-gray-800 rounded-full focus:ring-0 border-none py-1 px-2 w-full" type="text" v-model="email" required>
                            </div>
                        </div>
                        <span class="text-red-500 w-full flex items-end justify-end sm:justify-center bottom-0 right-0" v-if="!isValidMail"><span>Please enter valid email.</span></span>
                    </div>
                    <div class="flex sm:mb-0 mb-1 relative justify-center flex-col items-center w-full h-1/4">
                        <div class="flex justify-start items-center w-full"><label for="password1" class="w-3/12 flex">Password:</label>
                            <div class="flex w-9/12 items-center justify-center rounded-full border pr-2 border-2">
                                <input id="password1" name="password1" class="text-gray-800 rounded-full focus:ring-0 border-none py-1 px-2 w-full" type="password" v-model="password" required>
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
</template>

<script>
import {GLTFLoader} from "three/examples/jsm/loaders/GLTFLoader";
import * as CANNON from 'cannon-es';
import {threeToCannon} from "three-to-cannon";
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls';

let scene1,camera1,renderer1,hemisphere_light1,obj1,container1,controls1,raycaster1,world1,clock1,mouse1,cubeBody1,step1=1 / 60,objs1=[],bodies1=[];

export default {
    name: "SignUp_Form",
    props:['csrf','locale'],
    data(){
        return {
            name:'',
            email:'',
            password:'',
            nameError:null,
            isValidMail:true,
            isValidPassword:true,
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
        isValidEmail(email){
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email.toLowerCase());
        },
        _Req1(){
            let dt=clock1.getDelta();
            renderer1.render(scene1,camera1);
            requestAnimationFrame(this._Req1);
            // controls.update();
            world1.step(step1)
            if(obj1!==undefined) {
                obj1.position.copy(cubeBody1.position)
                obj1.quaternion.copy(cubeBody1.quaternion);

            }
            if(objs1.length!==0) {
                for (let i = 0; i < objs1.length; i++) {
                    objs1[i].position.copy(bodies1[i].position);
                    objs1[i].quaternion.copy(bodies1[i].quaternion);
                }
            }

        },
    },
    created(){
        clock1=new THREE.Clock();
    },
    mounted(){
        container1=document.getElementById('signUp-animation');
        let width=container1.getBoundingClientRect().width;
        let height=container1.getBoundingClientRect().height;
        scene1=new THREE.Scene();
        // camera=new THREE.OrthographicCamera(width / - 1.5, width / 1.5, height / 1.5, height / - 1.5, 0.001, 1000);
        camera1=new THREE.PerspectiveCamera(45,width/height,0.01,1000);
        camera1.position.z=30;
        camera1.position.y=2;
        camera1.lookAt(0,2,0)

        renderer1=new THREE.WebGLRenderer({antialias:true,alpha:1});
        renderer1.setClearColor(0xffffff,1);
        renderer1.setSize(width,height);
        renderer1.outputEncoding = THREE.sRGBEncoding

        renderer1.shadowMap.enabled = true
        renderer1.shadowMap.type = THREE.PCFSoftShadowMap
        const light = new THREE.AmbientLight( 0x404040 ); // soft white light
        scene1.add( light );
        hemisphere_light1=new THREE.HemisphereLight(0xffffbb, 0x080820, 1);
        scene1.add(hemisphere_light1);
        // controls = new OrbitControls( camera, renderer.domElement );
        container1.appendChild(renderer1.domElement);
        raycaster1=new THREE.Raycaster();
        mouse1 = new THREE.Vector2();
        world1 = new CANNON.World()
        world1.gravity.set(0, -10, 0)

        // Floor
        const floorShape = new CANNON.Plane()
        const floorBody = new CANNON.Body({ mass: 0 })
        floorBody.addShape(floorShape)
        floorBody.quaternion.setFromEuler(-Math.PI / 2, 0, 0)
        world1.addBody(floorBody)

        let loader=new GLTFLoader();
        loader.load('/images/28thJan_Text.glb',function(gltf){
            obj1=gltf.scene;
            obj1.scale.addScalar(0.5)
            obj1.traverse((a)=>{
                a.castShadow=true;
                a.receiveShadow=true;
            })
            cubeBody1 = new CANNON.Body({ mass: 5 });
            const shape = threeToCannon(obj1);
            cubeBody1.addShape(shape);
            cubeBody1.position.z=19;
            cubeBody1.position.y=10;
            world1.addBody(cubeBody1)
            scene1.add(obj1);
        });
        loader.load('/images/28thJan_SignUp.glb',function(gltf){
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
            objs1.push(login);
            bodies1.push(cubeLogin);
            world1.addBody(cubeLogin)
            scene1.add(login);
        })
        // controls.update();
        let colors=[0x986060,0x343434,0xbaae3d,0x24d277,0x486bcf,0xd0343b];
        container1.addEventListener( 'click', (event)=>{
            const area=container1.getBoundingClientRect();
            mouse1.x = ( event.clientX / area.width ) * 2 - 1;
            mouse1.y = - ( event.clientY / area.height ) * 2 + 1;
            raycaster1.setFromCamera( mouse1, camera1 );
            let geometry = new THREE.BoxGeometry( 1, 1, 1 );
            let material = new THREE.MeshBasicMaterial( {color: colors[Math.floor(Math.random()*6)]} );
            let cube = new THREE.Mesh( geometry, material );
            let body=new CANNON.Body({mass:2});
            let shape=threeToCannon(cube);
            raycaster1.ray.at(camera1.position.z-obj1.position.z,cube.position);
            cube.position.y=10;
            body.addShape(shape);

            body.position.set(cube.position.x,cube.position.y,cube.position.z);
            objs1.push(cube);
            bodies1.push(body);
            world1.addBody(body);
            scene1.add( cube );
        }, false );

        this._Req1();
        this.$emit('isChange',true);
    }
}
</script>

<style scoped>

</style>
