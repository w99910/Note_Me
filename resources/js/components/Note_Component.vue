<template>
    <div class="w-full h-full flex flex-col rounded-2xl p-4 bg-white">
        <div class="w-full flex items-center justify-center">
            <label class="w-full">
                <input v-model.lazy="title" placeholder="Enter Title" class="w-full focus:outline-none border-b-2 px-3 py-2">
            </label>
            <div class="w-1/12 flex items-center justify-center mx-2 text-white"><button class="px-3 py-1 bg-green-500" @click="save()">Create</button></div>
        </div>
        <div class="w-full p-2 overflow-auto" id="editorjs"></div>
<!--        <input type="hidden" value="{{csrf}}" name="_token" id="csrf_token">-->
</div>
</template>

<script>
import Header from '@editorjs/header';
class MyHeader extends Header {
    render() {
        const extrawrapper = document.createElement('div');
        extrawrapper.classList.add('text-2xl');
        extrawrapper.classList.add('font-bold');
        extrawrapper.appendChild(this._element);

        return extrawrapper;
    }
}
let editor;
export default {
name: "Note_Component",
    props:['errors','note','csrf'],
    data(){
      return{
          title:this.note!==null?JSON.parse(this.note).title:'',
          content:'',
      }
    },
    watch:{
      errors(){
          console.log(this.errors)
      }
    },
    methods:{
      save(){
        editor.save().then((output)=>
        {
           console.log(axios);
            let tools;
            let configu=JSON.stringify({tools:editor.configuration.tools});
            console.log(configu);

            axios.post('create_note',{_token:this.csrf,title:this.title,blocks:JSON.stringify(output.blocks),config:configu}).then((res)=>{
                console.log(res)
                if(res.status===200){
                             window.location=res.data.route;
               }
            })
        })
      },
    },
    mounted(){

        editor = new EditorJS({
            holder:'editorjs',
            onReady:()=>{
             const undo= new Undo({editor});
            },
            data:{
                blocks:JSON.parse(JSON.parse(this.note).content),
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
                attaches: {
                    class: AttachesTool,
                    config: {
                        endpoint: 'http://localhost:8008/uploadFile'
                    }
                },
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

</style>
