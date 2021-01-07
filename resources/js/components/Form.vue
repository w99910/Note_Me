<template>
<div class="w-full min-h-screen flex items-center justify-center fixed top-0 left-0 bg-transparent_bg" v-show="show">
    <div class="relative w-1/2 flex flex-col h-4/5 pt-10 bg-white"><button class="absolute top-0 right-0 submit_button" @click="toggle">-</button>
    <input type="text" class="focus:outline-none rounded-full px-3 py-2 border-none" placeholder="Title"/>
    <textarea class="my-10 h-full border-none resize-none" placeholder="Content"></textarea>
    <button class="submit_button" @click="save">Create</button>
    <div class="boxing">asdfs</div>
    <div class="append"></div>
    </div>
</div>
</template>

<script>
export default {
    name: "form-component",
    data() {
        return {
            hey: 'hello',
            show:false,
        }
    },
    methods: {
        toggle(){
           this.show= !this.show;
        } ,
        bold() {

            // let container=document.querySelector('.inline-box')


            let text = window.getSelection();
            let inline_container = document.querySelector('.box')

            let container = text.getRangeAt(0).commonAncestorContainer.parentElement;
            let c_text = container.innerText;
            // console.log(text.getRangeAt(0).commonAncestorContainer.parentNode);
            // console.log(container);
            if (window.getSelection().toString().length > 0 && text.getRangeAt(0).commonAncestorContainer.parentNode === container) {
                // let container1=document.createElement('span');

                container.innerHTML = '<span>' + c_text.substring(0, text.getRangeAt(0).startOffset) + "</span>" + "<strong>" + text.toString() + "</strong>" + "<span>" + c_text.substring(text.getRangeAt(0).endOffset, c_text.length) + "</span>";

                // container.innerHTML = "<p class='inline-box'>" + c_text.substring(0, text.getRangeAt(0).startOffset) + "<strong>" + text.toString() + "</strong>" + c_text.substring(text.getRangeAt(0).endOffset, c_text.length) + "</p>";
                // container.replaceWith(container1);
                console.log(container)
            } else {
                alert('Please selected within the div')
            }
            // console.log(
            //    (window.getSelection().toString().length>0)?text.getRangeAt(0).commonAncestorContainer.parentNode===container:'');
        },
        save(){
            let container=document.querySelector('.boxing');
            console.log(container.outerHTML.toString());
          axios.post('/store',{string:container.outerHTML.toString()}).then((response)=>{
              let data=response.data;
              console.log(data.string)

              document.querySelector('.append').innerHTML=data.string;
          });
        },
        uppercase() {
            // let c_text=container.innerText;
            let text = window.getSelection();
            let inline_container = document.querySelector('.box')
            let container = text.getRangeAt(0).commonAncestorContainer.parentElement;
            console.log(window.getComputedStyle(container).getPropertyValue('font-size'))
            let c_text = container.innerText;
            if (window.getSelection().toString().length > 0 && text.getRangeAt(0).commonAncestorContainer.parentNode === container) {

                // let container1=document.createElement('span');
                // container1.classList.add('box');
                container.innerHTML = '<span>' + c_text.substring(0, text.getRangeAt(0).startOffset) + "</span>" + "<span class='uppercase'>" + text.toString() + "</span>" + "<span>" + c_text.substring(text.getRangeAt(0).endOffset, c_text.length) + "</span>";
                console.log(container)
                // console.log(container1)
                // container.replaceWith(container1);
                // console.log('after',inline_container)
            } else {
                alert('Please selected within the div')
            }
        }
    }
}
</script>

<style scoped>

</style>
