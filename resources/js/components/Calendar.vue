<template>
    <div class="w-full bg-white p-2 dark:bg-gray-800 h-full flex items-center justify-around">
        <div class="w-full sm:w-7/12 h-full flex items-center justify-center">
        <v-calendar disable-page-swipe :attributes="custom_Attr" is-expanded :is-dark="dark" :masks="masks" class="custom-calendar w-full">
         <template v-slot:day-content="{ day, attributes }">
             <div class="flex flex-col h-full z-10 overflow-hidden">
                 <span class="day-label text-sm text-gray-900 dark:text-gray-200">{{ day.day }}</span>
                 <div class="flex-grow overflow-y-auto overflow-x-auto">
                     <p
                         v-for="attr in attributes"
                         class="text-xs dark:text-gray-200 leading-tight rounded-sm p-1 mt-0 mb-1"
                         :class="attr.customData.class"
                         :style="{background:attr.customData.style}"
                     >
                         {{ attr.customData.title }}
                     </p>
                 </div>
             </div>
         </template>
     </v-calendar>
        </div>
        <div class="sm:w-4/12 h-full flex flex-col border-2 border-gray-600 dark:border-gray-200 p-1 overflow-hidden">
            <div class="grid grid-rows-6 gap-2 w-full h-5/10 overflow-auto" id="schedules_container">
            <div class="text-dark-black row-span-1 dark:text-gray-100 border border-gray-600 dark:border-gray-200 flex justify-between items-center p-1 cursor-pointer" :class="selected_note.id===schedule.id?'bg-primary dark:bg-gray-500':''" @click="select(schedule)" v-for="schedule in schedules" v-if="schedules.length!==0">
                   <div :style="{background:schedule.note.color}" class="w-4 h-full"></div>
                    <div>{{schedule.note.title}}</div>
                 <div>{{schedule.created_at}}</div>
                <a :href="url+'/note/'+schedule.note.id" class="px-2 py-1 bg-dark-yellow dark:bg-yellow-500">Edit</a>
             </div>
            </div>
            <div class="flex w-full items-center flex-1 dark:text-gray-100 bg-primary relative overflow-hidden px-2 py-1 dark:bg-gray-700" id="editor_container">

            </div>
        </div>
        <toast time="1" message="hello" ref="toast"></toast>
    </div>
</template>

<script>

import Header from '@editorjs/header';
import '@simonwep/pickr/dist/themes/classic.min.css';
import Alert from 'editorjs-alert';
import Scrollbar from 'smooth-scrollbar';

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
    name: "Calendar",
    props:['url'],
    data(){
        const month = new Date().getMonth();
        const year = new Date().getFullYear();
          return {
              height:'60px',
              dark:false,
              masks: {
                  weekdays: 'WWW',
              },
              custom_Attr:[],
              attributes: this.custom_Attr,
              schedules:[],
              selected_note:{},
          }
    },
    methods:{
        select(schedule){
          this.selected_note=schedule;
          console.log(editor);
            // editor.configuration.data.blocks=JSON.parse(this.selected_note.note.content);
               editor.render({
                   blocks:JSON.parse(this.selected_note.note.content)
               });
        },
        changeCarbonToJsDate(a){
            let date=a.split("T")[0].split('-')
               return new Date(date[0],date[1]-1,date[2]);
        },
      getNotes(){
          axios.post(`/user/notes`).then((res)=>{
              if(res.data['error']){
                     this.$refs.toast.message=res.data['error'];
                     this.$refs.toast.start=true;
                 }
                 else{
                     for(let [i,a] of res.data['schedules'].entries()){
                         if(a.note!==null) {
                             this.schedules.push(a);
                             let date = a.created_at.split("T")[0].split('-')
                             console.log(a.note.color)
                             this.custom_Attr.push({
                                 key: i,
                                 customData: {
                                     title: a.note.title,
                                     class: 'text-white',
                                     style: a.note.color,
                                 },
                                 dates: new Date(date[0], date[1] - 1, date[2]),

                             })

                         }
                     }
                  console.log(this.schedules)
                 }
          })
      }
    },
    created(){
        if (localStorage.theme_noteme === 'dark'||localStorage.theme_noteme !== undefined) {
            this.dark=true;
        }
    },
    mounted(){
        let el=this;
        document.querySelector('#checkbox').addEventListener('change',function(value){
            if(this.checked){
                el.dark=true;
            }else{
                el.dark=false;
            }
        });

        this.getNotes();
        console.log(this.selected_note.value)
        editor=new EditorJS({
            holder: 'editor_container',
            readOnly: true,
            onReady: () => {
                Scrollbar.init(document.querySelector('#editor_container'),{ damping: 0.06 });
            },
            data: {
                blocks: this.selected_note.content !== undefined ? this.selected_note.content : [],
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
                list: {
                    class: list,
                    inlineToolbar: true,
                },
                underline: Underline,
                quote: {
                    class: quote
                },
                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                },
                // image: {
                //     class: InlineImage,
                //     inlineToolbar: false,
                //     config: {
                //         unsplash: {
                //             appName: 'Note-Me',
                //             clientId: 'lKXdaEBq6Kg1btoyhcXrWeUwfVE33rwo_bBsK5O8rhM'
                //         }
                //     }
                // },
                table: {
                    class: Table,
                },
                code: {
                    class: CodeTool,
                    config: {
                        placeholder: 'Include your codes here'
                    }
                },
                alert: {
                    class: Alert,
                    inlineToolbar: true,
                    shortcut: 'CMD+SHIFT+A',
                    config: {
                        defaultType: 'primary',
                        messagePlaceholder: 'Enter something',
                    },
                },
                hyperlink: {
                    class: Hyperlink,
                    config: {
                        shortcut: 'CMD+L',
                        target: '_blank',
                        rel: 'nofollow',
                        availableTargets: ['_blank', '_self'],
                        availableRels: ['author', 'noreferrer'],
                        validate: false,
                    }
                },
            },

        })

    },

}
</script>

<style scoped>
>>>.vc-day{
    height: 60px !important;
}
>>>::-webkit-scrollbar{
    width:0px;
}
>>>::-webkit-scrollbar-track{
       display:none;
}
>>>.vc-container{
    border:2px solid #b5b5b5 !important;
}
#checkbox:checked ~ >>>.vc-container{
    border:2px solid #f3f3f3 !important;
}
>>>.vc-day {
    border: 1px solid #b5b5b5 !important;
}
input#checkbox:checked ~ >>>.vc-day{
    border:1px solid #f3f3f3 !important;
}
</style>
