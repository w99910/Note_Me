<template>
    <div class="w-full h-full flex flex-col rounded-2xl p-4" v-bind:style="{backgroundColor:custom_color}">
        <div class="w-full flex items-center justify-between">
            <label class="w-full">
                <input v-model.lazy="title" placeholder="Enter Title" class="w-full focus:outline-none border-b-2 px-3 py-2">
            </label>
            <div class="p-2 bg-gray-400 ml-2"><div class="color-picker"></div></div>
            <div class="w-1/12 flex items-center justify-center mx-2 text-white"><button class="px-3 py-1 bg-green-500" @click="save()">Create</button></div>
        </div>
        <div class="w-full p-2 overflow-auto" id="editorjs"></div>
<!--        <input type="hidden" value="{{csrf}}" name="_token" id="csrf_token">-->
</div>
</template>

<script>
import Header from '@editorjs/header';
import '@simonwep/pickr/dist/themes/classic.min.css';
import Pickr from '@simonwep/pickr';
class MyHeader extends Header {
    render() {
        const extrawrapper = document.createElement('div');
        extrawrapper.classList.add('text-2xl');
        extrawrapper.classList.add('font-bold');
        extrawrapper.appendChild(this._element);

        return extrawrapper;
    }
}
let editor,pickr;
export default {
name: "Note_Component",
    props:['errors','note','csrf','readonly'],
    data(){
      return{
          title:this.note!==''?JSON.parse(this.note).title:'',
          content:'',
          custom_color:this.note!==''?JSON.parse(this.note).color:'#ffffff',
      }
    },
    watch:{
      errors(){
          console.log(this.errors)
      }
    },
    computed:{

    },
    methods:{

      save(){
        editor.save().then((output)=>
        {
           console.log(axios);
            axios.post('http://127.0.0.1:8000/create_note',{id:this.note!==''?JSON.parse(this.note).id:0,_token:this.csrf,title:this.title,blocks:JSON.stringify(output.blocks),color:this.custom_color}).then((res)=>{
                console.log(res)
                if(res.status===200){
                             window.location=res.data.route;
               }
            })
        })
      },
    },
    mounted(){
        pickr = Pickr.create({
            el: '.color-picker',
            theme: 'classic', // or 'monolith', or 'nano'
            default: this.custom_color,
            swatches: [
                'rgba(244, 67, 54, 1)',
                'rgba(233, 30, 99, 0.95)',
                'rgba(156, 39, 176, 0.9)',
                'rgba(103, 58, 183, 0.85)',
                'rgba(63, 81, 181, 0.8)',
                'rgba(33, 150, 243, 0.75)',
                'rgba(3, 169, 244, 0.7)',
                'rgba(0, 188, 212, 0.7)',
                'rgba(0, 150, 136, 0.75)',
                'rgba(76, 175, 80, 0.8)',
                'rgba(139, 195, 74, 0.85)',
                'rgba(205, 220, 57, 0.9)',
                'rgba(255, 235, 59, 0.95)',
                'rgba(255, 193, 7, 1)'
            ],

            components: {

                // Main components
                preview: true,
                opacity: true,
                hue: true,

                // Input / output Options
                interaction: {
                    hex: true,
                    rgba: true,
                    hsla: true,
                    hsva: true,
                    cmyk: true,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });

        pickr.on('show', (color, instance) => {
            this.custom_color= color.toHEXA().toString()
            }).on('change', (color, source, instance) => {
            console.log('Event: "change"', color.toHEXA().toString());
            this.custom_color= color.toHEXA().toString();
        });
        editor = new EditorJS({
            holder:'editorjs',
             readOnly:JSON.parse(this.readonly),
            onReady:()=>{
             const undo= new Undo({editor});
            },
            data:{
                blocks:this.note!==''?JSON.parse(JSON.parse(this.note).content):[],
            },
            tools: {

                Marker: {
                class: Marker,
                shortcut: 'CMD+SHIFT+M',
        },

                header: {
                    class: MyHeader,
                    config: {
                        placeholder: 'Enter a header',
                        levels: [2, 3, 4],
                        defaultLevel: 3
                    }
                },
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true,
                },
                list:{
                    class:list,
                    inlineToolbar: true,
                },
                underline: Underline,
                quote:{
                    class:quote
                },
                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                },
                linkTool: {
                    class: LinkTool,
                    config: {
                        endpoint: 'http://localhost:8008/', // Your backend endpoint for url data fetching
                    }
                },
                //***tool attaches doesn't support readOnly Mode**/
                // attaches: {
                //     class: AttachesTool,
                //     config: {
                //         endpoint: 'http://localhost:8008/uploadFile'
                //     }
                // },
                table: {
                    class: Table,
                },
                code: {
                    class:CodeTool,
                    config:{
                        placeholder:'Include your codes here'
                    }
                },
    },

        });
    }
}
</script>

<style scoped>
#editorjs{
    max-height: inherit !important;
}
    /*.my-bg{*/
    /*    background-color:{{color}};*/
    /*}*/
</style>
