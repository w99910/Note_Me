<template>
    <div class="animation w-full h-full z-20 relative">
        <div class="nav-nav fixed px-4 py-4 sm:px-8 sm:py-5 top-0 left-0 h-16 z-30 flex items-center dark:bg-gray-700 bg-white justify-between  w-full border-b-2 border-gray-600 dark:border-gray-200">
            <div class="w-1/2 flex items-center">
                <h1 class="text-gray-100 dark:text-gray-100 stroke-1 font-bowlby add_stroke text-3xl">Note Me</h1>
            </div>
            <div class="w-5/12 flex justify-between items-center text-dark-black dark:text-gray-100">
                <div class="w-1/2 flex items-center justify-evenly">
                    <div class="flex items-center py-2">
                        <label class="flex items-center justify-center px-2 py-1">
                            <img :src="img_src+'/images/translate.png'" class="w-8 h-8" alt="translate">
                            <select class="locale-intro border-none focus:outline-none focus:ring-0 dark:bg-transparent"
                                    @change="ChangeLocale()" v-model="locale">
                                <option value="en" class="dark:text-dark-black">en</option>
                                <option value="mm" class="dark:text-dark-black">mm</option>
                                <option value="es" class="dark:text-dark-black">es</option>
                                <option value="jpn" class="dark:text-dark-black">jpn</option>
                            </select>
                        </label>
                    </div>
                    <label for="checkbox" class="flex">
                        <input id="checkbox" type="checkbox" value="false" @change="ChangeNight()" v-model="checkbox"/>
                        <span class="check"></span>
                    </label>
                </div>
                <div class="flex items-center justify-evenly" :class="[(locale==='mm'||locale==='jpn'?'text-md w-6/12':locale==='es'?'text-md w-7/12':'text-xl w-5/12')]">
                    <button
                        class="focus:outline-none px-2 py-1 font-bowlby tracking-wider text-login dark:text-gray-100 "
                        :class="locale==='mm'||locale==='jpn'?'font-extrabold':locale==='es'?'font-bold':'add_stroke'" @click="ShowLogin()">{{ messages.login }}
                    </button>
                    <button
                        class="focus:outline-none px-2 py-1 font-bowlby text-signup tracking-wider dark:text-gray-100 "
                        :class="locale==='mm'||locale==='jpn'?'font-extrabold':locale==='es'?'font-bold':'add_stroke'" @click="ShowSignUp()">
                        {{ messages.sign_up }}
                    </button>
                </div>
            </div>
        </div>
        <div class="w-full h-full relative items-center justify-center flex flex-col">
            <div class="h-full w-full overflow-hidden">
                <div class="tracking-wide leading-8 holder h-full w-full transform translate-y-full pt-20 p-4 dark:text-gray-100">
                    <div v-show="isAbout"
                         class="about w-full relative font-poppins  h-full bg-white dark:bg-gray-800 flex items-center flex-col border-2 border-gray-600 dark:border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="hide()"
                             class="z-10 self-end mt-1 mr-1 cursor-pointer w-12 text-gray-600 stroke-current"
                             viewBox="0 0 24 24">
                            <path fill="#6563ff"
                                  d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"/>
                            <path fill="#b2b1ff"
                                  d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"/>
                        </svg>
                       <about :messages="messages" :url="img_src"></about>
                    </div>
                    <div v-show="isReadMe"
                         class="read_me w-full h-full bg-white relative dark:bg-gray-800 flex items-center flex-col border-2 border-gray-600 dark:border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="hide()"
                             class=" z-10 self-end mt-1 mr-1 cursor-pointer w-12 text-gray-600 stroke-current"
                             viewBox="0 0 24 24">
                            <path fill="#6563ff"
                                  d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"/>
                            <path fill="#b2b1ff"
                                  d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"/>
                        </svg>
                        <read-me :locale="locale" :messages="messages"></read-me>
                    </div>
                    <div v-show="isContact"
                         class="contact_me relative w-full h-full bg-primary dark:bg-gray-800 flex items-center flex-col border-2 border-gray-600 dark:border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="hide()"
                             class="self-end mt-1 mr-1 cursor-pointer w-12 text-gray-600 stroke-current"
                             viewBox="0 0 24 24">
                            <path fill="#6563ff"
                                  d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"/>
                            <path fill="#b2b1ff"
                                  d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"/>
                        </svg>
                       <contact @showToast="showToastEvent" :messages="messages"></contact>
                        <div class="w-full tracking-wider h-20 font-poppins z-40 bg-white dark:bg-gray-900 absolute bottom-0 left-0 flex justify-center items-center">
                             <div class="w-7/12 h-full font-bold  flex justify-between items-center">
                                 <div class="flex items-center">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" width="6.82666in" height="6.82666in" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 6.82666 6.82666">
                                     <g id="Layer_x0020_1">

  <path class="fil0" d="M2.35128 1.74083l-0.647496 0 0 4.0725 3.41909 0 0 -4.8 -2.6916 0 0 0.647496c0,0.0441811 -0.0358189,0.08 -0.08,0.08zm-0.255657 1.66367l2.63542 0c0.0441811,0 0.08,0.0358189 0.08,0.08 0,0.0441811 -0.0358189,0.08 -0.08,0.08l-2.63542 0c-0.0441811,0 -0.08,-0.0358189 -0.08,-0.08 0,-0.0441811 0.0358189,-0.08 0.08,-0.08zm0 0.583343l2.63542 0c0.0441811,0 0.08,0.0358189 0.08,0.08 0,0.0441811 -0.0358189,0.08 -0.08,0.08l-2.63542 0c-0.0441811,0 -0.08,-0.0358189 -0.08,-0.08 0,-0.0441811 0.0358189,-0.08 0.08,-0.08zm0 0.583343l2.63542 0c0.0441811,0 0.08,0.0358189 0.08,0.08 0,0.0441811 -0.0358189,0.08 -0.08,0.08l-2.63542 0c-0.0441811,0 -0.08,-0.0358189 -0.08,-0.08 0,-0.0441811 0.0358189,-0.08 0.08,-0.08zm-0.08 0.663343c0,-0.0441811 0.0358189,-0.08 0.08,-0.08l1.34458 0c0.0441811,0 0.08,0.0358189 0.08,0.08 0,0.0441811 -0.0358189,0.08 -0.08,0.08l-1.34458 0c-0.0441811,0 -0.08,-0.0358189 -0.08,-0.08zm1.61 -3.45166c0,-0.102504 0.0415591,-0.195315 0.108736,-0.262492 0.067185,-0.0671772 0.159996,-0.108736 0.262492,-0.108736 0.102504,0 0.195315,0.0415591 0.262492,0.108736 0.0671772,0.0671772 0.108736,0.159988 0.108736,0.262492 0,0.102496 -0.0415591,0.195307 -0.108736,0.262492 -0.0671772,0.0671772 -0.159988,0.108736 -0.262492,0.108736 -0.102496,0 -0.195307,-0.0415591 -0.262492,-0.108736 -0.0671772,-0.067185 -0.108736,-0.159996 -0.108736,-0.262492zm-0.156921 0.895673c0.0234567,-0.142437 0.114602,-0.264016 0.242402,-0.328378 0.134047,0.207685 0.437469,0.207661 0.571512,-1.5748e-005 0.0646575,0.0325669 0.120469,0.0801811 0.162685,0.138134 0.040189,0.0551654 0.068122,0.119945 0.0797008,0.19026l-1.0563 0zm1.19718 0.13513l0 0zm-0.0615 -0.061752l-0.0483661 -0.0485669 1.1811e-005 -6.29921e-005 0.0483543 0.0486299z" style="fill: whitesmoke;"/>
                                         <path class="fil1" d="M5.12288 1.01333l-2.73847 0 -0.680622 0.680622 0 4.11938 3.41909 0 0 -4.8zm-2.7716 -0.16l2.8516 0c0.0441811,0 0.08,0.0358189 0.08,0.08l0 4.96c0,0.0441811 -0.0358189,0.08 -0.08,0.08l-3.57909 0c-0.0441811,0 -0.08,-0.0358189 -0.08,-0.08l0 -4.2325 3.93701e-006 0c0,-0.0204724 0.00780709,-0.0409488 0.0234291,-0.0565669l3.93701e-006 3.93701e-006 0.727157 -0.727157c0.0145039,-0.0146772 0.0346378,-0.0237756 0.0569016,-0.0237756z" style="fill: #0A93E2; fill-rule: nonzero;"/>
                                         <path class="fil1" d="M1.81691 1.58083l0.45437 0 0 -0.45437 -0.45437 0.45437zm0.53437 0.16l-0.727496 0 0 -3.93701e-006c-0.0204724,0 -0.0409488,-0.00781102 -0.0565669,-0.0234291 -0.0312402,-0.0312402 -0.0312402,-0.0818937 0,-0.113134l3.93701e-006 3.93701e-006 0.727157 -0.727157c0.0145039,-0.0146772 0.0346378,-0.0237756 0.0569016,-0.0237756 0.0441811,0 0.08,0.0358189 0.08,0.08l0 0.727496c0,0.0441811 -0.0358189,0.08 -0.08,0.08z" style="fill: #0A93E2; fill-rule: nonzero;"/>
                                         <path class="fil1" d="M4.27359 2.17384c0.121421,0.0406024 0.226224,0.118811 0.300449,0.220697 0.0734764,0.100843 0.116937,0.224465 0.116937,0.357386l0 0.00133071c0,0.0232795 -0.0096063,0.0445827 -0.0251496,0.0601417l0.00015748 0.00015748 -0.00011811 0.000114173 7.87402e-006 7.87402e-006c-0.000673228,0.000669291 -0.00135827,0.00131496 -0.00204724,0.00195669l-0.000834646 0.000771654 -0.000267717 0.000240157c-0.0151142,0.0136102 -0.035122,0.0219016 -0.0570433,0.0219016l-1.21768 0c-0.0235394,0 -0.0448701,-0.00955906 -0.0603031,-0.0249921l-3.93701e-006 3.93701e-006c-0.00523228,-0.00523228 -0.00958661,-0.0110118 -0.0130669,-0.0171535 -0.00757874,-0.0127244 -0.0119213,-0.0274921 -0.0119213,-0.0431496l0 -0.00133071c0,-0.132921 0.0434606,-0.256531 0.116937,-0.357374 0.0752402,-0.103268 0.181894,-0.182217 0.305429,-0.222331l0.024689 0.075937 -0.0247087 -0.0760906c0.0420236,-0.0136457 0.0871535,0.00935827 0.100799,0.0513819 0.000590551,0.00181496 0.0011063,0.00363386 0.00155906,0.00545669 0.0125394,0.033748 0.0350276,0.0628031 0.0639449,0.0836457 0.0294055,0.0211929 0.0658189,0.0336811 0.105484,0.0336811 0.0396693,0 0.0760945,-0.0124921 0.1055,-0.033689 0.0305472,-0.0220157 0.0539173,-0.0531969 0.0659646,-0.0894055l0.075626 0.025 -0.0759055 -0.0252598c0.0139488,-0.0419213 0.0592441,-0.0645945 0.101165,-0.0506457 0.00149213,0.000496063 0.00295669,0.00103543 0.00439764,0.00161024zm0.171701 0.314445c-0.0422165,-0.0579528 -0.0980276,-0.105567 -0.162685,-0.138134 -0.0231063,0.0357992 -0.0527126,0.0669528 -0.0871378,0.0917677 -0.0561417,0.0404646 -0.124768,0.064311 -0.198626,0.064311 -0.0738543,0 -0.142469,-0.0238425 -0.19861,-0.0643031 -0.0344252,-0.024811 -0.0640315,-0.0559606 -0.0871378,-0.0917598 -0.0646654,0.0325669 -0.120476,0.0801811 -0.162701,0.13813 -0.040189,0.0551614 -0.068122,0.119941 -0.0797008,0.190248l1.0563 0c-0.0115787,-0.070315 -0.0395118,-0.135094 -0.0797008,-0.19026zm0.159091 0.263638l-7.87402e-006 0 0.00130709 0.00131102 0 -3.93701e-006 -0.00129921 -0.00130709zm0.00132283 0.00133071l-3.93701e-006 0 0.00372047 0.00373622 -0.00371654 -0.00373622zm-0.00133071 -0.00133071l7.87402e-006 0 -0.0483622 -0.0486299 -1.1811e-005 6.29921e-005 0.0483661 0.0485669zm0.00133071 0.00133071l-2.3622e-005 -2.3622e-005 0 3.93701e-006 1.9685e-005 1.9685e-005 3.93701e-006 0z" style="fill: #0A93E2; fill-rule: nonzero;"/>
                                         <path class="fil1" d="M3.99685 1.41164c0.102504,0 0.195315,0.0415591 0.262492,0.108736 0.0671772,0.0671772 0.108736,0.159988 0.108736,0.262492 0,0.102496 -0.0415591,0.195307 -0.108736,0.262492 -0.0671772,0.0671772 -0.159988,0.108736 -0.262492,0.108736 -0.102496,0 -0.195307,-0.0415591 -0.262492,-0.108736 -0.0671772,-0.067185 -0.108736,-0.159996 -0.108736,-0.262492 0,-0.102504 0.0415591,-0.195315 0.108736,-0.262492 0.067185,-0.0671772 0.159996,-0.108736 0.262492,-0.108736zm0.149366 0.221862c-0.0382165,-0.0382165 -0.0910315,-0.0618622 -0.149366,-0.0618622 -0.0583307,0 -0.111146,0.0236457 -0.149366,0.0618622 -0.0382165,0.0382165 -0.0618622,0.0910315 -0.0618622,0.149366 0,0.0583307 0.0236457,0.111146 0.0618622,0.149366 0.0382205,0.0382165 0.0910354,0.0618622 0.149366,0.0618622 0.0583346,0 0.11115,-0.0236457 0.149366,-0.0618622 0.0382165,-0.0382205 0.0618622,-0.0910354 0.0618622,-0.149366 0,-0.0583346 -0.0236457,-0.11115 -0.0618622,-0.149366z" style="fill: #0A93E2; fill-rule: nonzero;"/>
                                         <path class="fil1" d="M2.09562 3.4045c-0.0441811,0 -0.08,0.0358189 -0.08,0.08 0,0.0441811 0.0358189,0.08 0.08,0.08l2.63542 0c0.0441811,0 0.08,-0.0358189 0.08,-0.08 0,-0.0441811 -0.0358189,-0.08 -0.08,-0.08l-2.63542 0z" style="fill: #0A93E2; fill-rule: nonzero;"/>
                                         <path class="fil1" d="M2.09562 3.98784c-0.0441811,0 -0.08,0.0358189 -0.08,0.08 0,0.0441811 0.0358189,0.08 0.08,0.08l2.63542 0c0.0441811,0 0.08,-0.0358189 0.08,-0.08 0,-0.0441811 -0.0358189,-0.08 -0.08,-0.08l-2.63542 0z" style="fill: #0A93E2; fill-rule: nonzero;"/>
                                         <path class="fil1" d="M2.09562 4.57119c-0.0441811,0 -0.08,0.0358189 -0.08,0.08 0,0.0441811 0.0358189,0.08 0.08,0.08l2.63542 0c0.0441811,0 0.08,-0.0358189 0.08,-0.08 0,-0.0441811 -0.0358189,-0.08 -0.08,-0.08l-2.63542 0z" style="fill: #0A93E2; fill-rule: nonzero;"/>
                                         <path class="fil1" d="M2.09562 5.15453c-0.0441811,0 -0.08,0.0358189 -0.08,0.08 0,0.0441811 0.0358189,0.08 0.08,0.08l1.34458 0c0.0441811,0 0.08,-0.0358189 0.08,-0.08 0,-0.0441811 -0.0358189,-0.08 -0.08,-0.08l-1.34458 0z" style="fill: #0A93E2; fill-rule: nonzero;"/>
                                         <polygon class="fil2" points="1.81691,1.58083 2.27128,1.58083 2.27128,1.12646 " style="fill: #C2E4F8;"/>
                                         <path class="fil2" d="M3.84748 1.6335c-0.0382165,0.0382165 -0.0618622,0.0910315 -0.0618622,0.149366 0,0.0583307 0.0236457,0.111146 0.0618622,0.149366 0.0382205,0.0382165 0.0910354,0.0618622 0.149366,0.0618622 0.0583346,0 0.11115,-0.0236457 0.149366,-0.0618622 0.0382165,-0.0382205 0.0618622,-0.0910354 0.0618622,-0.149366 0,-0.0583346 -0.0236457,-0.11115 -0.0618622,-0.149366 -0.0382165,-0.0382165 -0.0910315,-0.0618622 -0.149366,-0.0618622 -0.0583307,0 -0.111146,0.0236457 -0.149366,0.0618622z" style="fill: #C2E4F8;"/>
                                         <path class="fil2" d="M4.28261 2.35015c-0.134043,0.207677 -0.437465,0.207701 -0.571512,1.5748e-005 -0.127799,0.0643622 -0.218945,0.185941 -0.242402,0.328378l1.0563 0c-0.0115787,-0.070315 -0.0395118,-0.135094 -0.0797008,-0.19026 -0.0422165,-0.0579528 -0.0980276,-0.105567 -0.162685,-0.138134z" style="fill: #C2E4F8;"/>
 </g>
                                     <rect class="fil3" width="6.82666" height="6.82666" style="fill: none;"/>
                                 </svg>
                                     <a href="https://w99910.github.io/my_portfolio/" target="_blank" class="mx-1">My Portfolio</a>
                                 </div>
                                 <div class="flex items-center">
                                     <img alt="email" :src="img_src+'/images/email.png'" class="w-6 mx-1 h-6" >
                                       <a :href="'mailto:zawlintun@utycc.edu.mm'" class="ml-1">zawlintun@utycc.edu.mm/</a>
                                       <a href="mailto:zlintun001@gmail.com">zlintun001@gmail.com</a>
                                 </div>
                             </div>
                        </div>
                    </div>
                    <div v-show="isLogin"
                         class="contact_me w-full h-full bg-white dark:bg-gray-800 flex items-center flex-col border-2 border-gray-600 dark:border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="hide()"
                             class="self-end mt-1 mr-1 cursor-pointer w-12 text-gray-600 stroke-current"
                             viewBox="0 0 24 24">
                            <path fill="#6563ff"
                                  d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"/>
                            <path fill="#b2b1ff"
                                  d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"/>
                        </svg>
                        <login-form :messages="messages" @isChange="ChangeLogin" :csrf="csrf" :locale="locale"></login-form>
                    </div>
                    <div v-show="isSignUp"
                         class="contact_me w-full h-full bg-white flex dark:bg-gray-800 items-center flex-col border-2 border-gray-600 dark:border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="hide()"
                             class="self-end mt-1 mr-1 cursor-pointer w-12 text-gray-600 stroke-current"
                             viewBox="0 0 24 24">
                            <path fill="#6563ff"
                                  d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"/>
                            <path fill="#b2b1ff"
                                  d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"/>
                        </svg>
                        <signup-form :messages="messages" @isChange="ChangeSignUp" :csrf="csrf" :locale="locale"></signup-form>
                    </div>
                </div>
            </div>
            <div class="hide-bar w-full bottom-0 left-0 absolute flex justify-center items-center overflow-hidden">
                <div class="navigation w-9/12 flex h-24 sm:h-32 md:h-1/6 py-4 justify-evenly font-poppins">
                    <div class="w-3/12 bg-about px-2 flex items-center justify-center py-4 border-white  border-2"><span
                        class="add_stroke_white stroke-current tracking-widest cursor-pointer"
                        @click="About">{{ messages.about }}</span></div>
                    <div class="w-3/12 bg-read_me px-2 flex items-center justify-center py-4 border-white  border-2">
                        <span class="add_stroke_white stroke-current tracking-widest cursor-pointer" @click="ReadMe">{{ messages.read_me }}</span>
                    </div>
                    <div class="w-3/12 bg-contact_me px-2 flex items-center justify-center py-4 border-white  border-2">
                        <span class="add_stroke_white stroke-current tracking-widest cursor-pointer"
                              @click="ContactMe">{{ messages.contact_me }}</span></div>
                </div>
            </div>
        </div>
        <toast :time="1" :message="message" start v-if="showToast" @changeToast="changeToast"></toast>

    </div>
</template>

<script>
import {GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls';
import {EffectComposer} from 'three/examples/jsm/postprocessing/EffectComposer.js';
import {RenderPass} from 'three/examples/jsm/postprocessing/RenderPass.js';
import {GlitchPass} from 'three/examples/jsm/postprocessing/GlitchPass.js';
import {BufferGeometryUtils} from 'three/examples/jsm/utils/BufferGeometryUtils';
import introJs from 'intro.js';
import "intro.js/minified/introjs.min.css";
import Login_Form from "./Login_Form";
import SignUp_Form from "./SignUp_Form";
import About from "./small-components/About";
import Contact from "./small-components/Contact";
import ReadMe from "./small-components/ReadMe";
let scene, renderer, obj, camera, container, clock, controls, composer;
export default {
    name: "landing-page",
    components: {
        'login-form': Login_Form,
        'signup-form': SignUp_Form,
        'about':About,
        'read-me':ReadMe,
        'contact':Contact,
    },
    props: ['img_src', 'encoded_messages', 'current_locale', 'csrf'],
    data() {
        return {
            checkbox: false,
            isLoading: true,
            isAbout: false,
            isReadMe: false,
            isContact: false,
            isLogin: true,
            isSignUp: true,
            locale: this.current_locale,
            messages: JSON.parse(this.encoded_messages
            ),
            message:'',
            showToast:false,
        }
    },
    computed: {},
    methods: {
        changeToast(){
            this.showToast=false;
            console.log('changeToast')
        },
        showToastEvent(message){
          this.message=message;
          this.showToast=true;
        },
        hide() {
            document.querySelector('.hide-bar').classList.remove('w-0');
            document.querySelector('.hide-bar').classList.add('w-full');
            let el = this;
            let tl = gsap.timeline({ease: 'back.out(.5)'});
            tl.to('.holder', {
                y: '100%',
                duration: .8,
                ease: 'power1.out'
            })
            tl.to('.navigation', {
                y: '0%',
                duration: .6,
                onComplete: () => {
                    el.closeAll();
                    el.isLogin = false;
                    el.isSignUp = false;

                }
            });
        },
        ChangeLogin(value) {
            if (value) {
                console.log('change');
                this.isLogin = false;
            }
        },
        ChangeSignUp(value) {
            if (value) {
                console.log('change');
                this.isSignUp = false;
            }
        },
        show() {
            let tl = gsap.timeline({ease: 'back.in(.8)'});
            tl.to('.navigation', {
                y: '100%',
                duration: .6,
            });
            tl.to('.holder', {
                y: '0%',
                duration: .8,
                ease: 'power1.out',
                onComplete:function(){
                    document.querySelector('.hide-bar').classList.remove('w-full');
                    document.querySelector('.hide-bar').classList.add('w-0');
                }
            })
        },
        About() {
            this.isAbout = true;
            this.show();
        },
        ReadMe() {
            this.isReadMe = true;
            this.show();
        },
        ContactMe() {
            this.isContact = true;
            this.show();
        },
        async ShowLogin() {
            if (this.isSignUp || this.isLogin) {
                this.isSignUp = false;
                this.isLogin = true;
            } else if (this.isAbout || this.isReadMe || this.isContact) {
                this.closeAll();
                this.isLogin = true;
            } else {
                this.isLogin = true;
                this.show();
            }
        },
        closeAll() {
            this.isAbout = false;
            this.isReadMe = false;
            this.isContact = false;
        },
        async ShowSignUp() {
            if (this.isSignUp || this.isLogin) {
                this.isLogin = false;
                this.isSignUp = true;
            } else if (this.isAbout || this.isReadMe || this.isContact) {
                this.closeAll();
                this.isSignUp = true;
            } else {
                this.isSignUp = true;
                this.show();
            }
        },
        ChangeLocale() {
            // window.location.href=this.img_src+`/${this.locale}`
            axios.post('/set/locale', {value: this.locale}).then((res) => {
               // window.location.reload();
                this.messages = res.data;
            })
        },
        ChangeNight() {

            let video1 = document.querySelector('#video1');
            let video2 = document.querySelector('#video2');
            console.log(video1.duration)
            if (!this.checkbox) {
                video1.classList.remove('z-10')
                video2.classList.add('z-10')
                video2.classList.remove('z-0')
                video1.classList.add('z-0')
                video2.play();

            } else {
                if (!video2.classList.contains('z-0')) {
                    video2.classList.remove('z-10')
                    video2.classList.add('z-0');
                }
                if (!video1.classList.contains('z-10')) {
                    video1.classList.remove('z-0')
                    video1.classList.add('z-10');
                }

                video1.play();
            }
        },
        _Req() {
            // controls.update();
            requestAnimationFrame(this._Req);
            // composer.render();
            // renderer.render( scene, camera );
        }
    },
    created() {
        clock = new THREE.Clock();
    },
    mounted() {

    }

}
</script>

<style scoped>
>>> input[type="checkbox"] {
    -webkit-appearance: none;
    display: none;
    visibility: hidden;
}

.check {
    position: relative;
    display: block;
    width: 40px;
    height: 20px;
    background: #092c3e;
    cursor: pointer;
    border-radius: 20px;
    overflow: hidden;
    transition: ease-in 0.3s;
}

input[type='checkbox']:checked ~ .check {
    background: #F3F3F3;
}

.check:before {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    background-color: #F3F3F3;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    transition: 0.5s;
    display: block;
    background-size: contain;
    /*background-image: url("/images/night.png");*/
}

input[type='checkbox']:checked ~ .check:before {
    transform: translateX(20px);
    right: 2px;
    background-color: #092c3e;
    /*background-image: url("/images/sun_1.png");*/
}

.add_stroke {
    -webkit-text-stroke: 1px #404040;
}

.add_stroke_white {
    -webkit-text-stroke: 1px white;
}
</style>
