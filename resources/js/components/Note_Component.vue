<template>
    <div class="w-full h-full flex justify-evenly p-2 bg-white dark:bg-gray-800">
        <div  class="w-8/12 h-full flex flex-col p-4 border-2 border-gray-600 dark:border-gray-200  mt-2 " :style="{backgroundColor:custom_color}">
            <div class="w-full mb-1 flex items-center justify-evenly">
                <label class="w-9/12">
                    <input v-model.lazy="title" :placeholder="messages.title" id="step-1"
                           class="w-full focus:outline-none border-b-2 bg-transparent py-1 dark:text-gray-400">
                </label>
                <div class="p-2 bg-gray-400 ml-2" id="step-2">
                    <div class="color-picker" ></div>
                </div>

            </div>

            <div class="step-3 w-full p-2 overflow-auto dark:text-gray-400" id="editorjs"></div>
            <!--        <input type="hidden" value="{{csrf}}" name="_token" id="csrf_token">-->
        </div>
        <div class="w-3/12 flex flex-col h-full justify-between overflow-hidden">
        <div class="flex h-6/10 w-full flex-col mt-3 p-2 border-2 shadow-lg border-gray-600 dark:border-gray-200 overflow-hidden dark:bg-gray-700">
            <div class="flex items-center justify-around mb-2 py-3 w-full">
                <button class="bg-green-500 text-white focus:outline-none" :class="locale==='mm'?'p-1 py-2':'px-3 py-1 '" @click="save()"><span
                        v-text="note!==''?messages.Save:messages.Create" id="step-5"></span></button>
                <button v-if="note!==null" class="bg-dark-red text-white focus:outline-none" :class="locale==='mm'?'p-1 py-2':'px-3 py-1 '" v-show="note!==''" @click="deleteNote()"><span>{{ messages.Delete }}</span></button>
                <button class="text-sm text-indigo-600 dark:text-blue-100 font-semibold hover:text-indigo-500 px-2 h-8 focus:outline-none"
                        @click.stop="addDate" id="step-4">
                    + {{ messages.Add_Date }}
                </button>
            </div>
            <v-date-picker v-model="selected.date" updateValue>
                <template #default="{ inputValue, togglePopover, hidePopover }">
                    <div class="flex flex-wrap">
                        <button
                            v-for="(date, i) in dates"
                            :key="date.date.getTime()"
                            class="flex items-center bg-indigo-200 hover:bg-indigo-400 text-sm text-indigo-600 font-semibold h-8 px-2 m-1 rounded-lg border-2 border-transparent focus:border-indigo-600 focus:outline-none"
                            @click.prevent="updateValue(date);dateSelected($event, date, togglePopover);"
                            ref="button"
                        >
                            <!--                        v-show="dates.length!==null"-->
                            {{ date.date.toLocaleDateString() }}
                            <svg
                                class="w-4 h-4 text-gray-600 hover:text-indigo-600 ml-1 -mr-1"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                                @click.stop="removeDate(date, hidePopover)"
                            >
                                <path d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </template>
            </v-date-picker>
            <div class="fixed bg-blur top-0 left-0 w-full h-full z-10 flex items-center justify-center"
                 v-show="loading">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                     id="Layer_1" x="0px" y="0px" width="512px" height="512px"
                     class="w-10 h-10 animate-spin text-about fill-current" viewBox="0 0 512 512" xml:space="preserve"><path d="M479.8 226.1c-1.4-8.7-3.1-17.3-5.3-25.8-2.8-10.8-6.4-21.5-10.8-31.8-8.9-21.2-21.1-41-35.9-58.6-16-18.9-35.3-35.2-56.7-47.7C350 49.8 327 41 303 36.1c-12.4-2.5-24.9-4-37.6-4.1-9.9-.1-19.8.3-29.6 1.2-25.5 2.5-50.7 9.6-73.9 20.5-19.9 9.4-38.4 21.6-54.8 36.2-16.4 14.6-30.7 31.6-42.2 50.3-12.7 20.8-22.2 43.5-27.4 67.3-4.2 19-6.2 38.6-5.2 58.1.9 18.9 3.8 37.8 9.5 55.9 3.6 11.5 7.9 22.7 13.3 33.6 5.3 10.7 11.5 21 18.4 30.7 13.8 19.3 30.6 36.4 49.8 50.5 19.6 14.5 41.7 25.7 64.9 33.1 24.2 7.7 49.9 11.3 75.3 10.4 24.8-.8 49.4-5.6 72.6-14.5 22.3-8.6 43.2-20.9 61.5-36.3 9.2-7.8 17.4-16.6 25.1-25.9 7.8-9.4 14.8-19.3 20.6-30 5-9.2 9.2-18.8 12.8-28.5 1.8-4.8 3.5-9.6 4.9-14.6 1.5-5.3 2.6-10.8 3.6-16.2 1.5-8.5 2.1-17.3 1.3-25.9-.7 3.8-1.3 7.5-2.2 11.2-1.1 4.3-2.5 8.5-4.1 12.6-3.2 8.7-7.2 17.1-11 25.5-4.9 10.7-10.6 20.9-16.8 30.8-3.2 5.1-6.5 10.1-10.1 14.9-3.6 4.8-7.7 9.4-11.8 13.9-8.2 9.1-17.1 17.2-27 24.4-10.1 7.4-20.8 13.9-32.1 19.3-22.6 11-47.3 17.6-72.3 19.8-25.6 2.2-51.7-.3-76.3-7.6-23.4-6.9-45.6-18.1-65.1-32.8-18.9-14.3-35.3-31.9-48.2-51.8C75.4 347.8 66.1 324.9 61 301c-1.3-6.2-2.3-12.6-3-18.9-.6-5.4-1.1-10.9-1.3-16.4-.3-11.3.4-23 2.1-34.2 3.7-24.6 11.7-48.3 24.1-69.9 11-19.3 25.3-36.7 42.1-51.4 16.8-14.8 36-26.7 56.8-35.1 12-4.9 24.6-8.5 37.4-10.9 6.5-1.2 13-2.2 19.5-2.7 3.2-.3 6.3-.3 9.5-.6 1.3 0 2.6.1 3.9.1 21.7-.4 43.5 2.4 64.2 8.9 22.3 7 43.3 18.3 61.5 33 19.1 15.4 35 34.4 47 55.8 10.2 18.2 17.5 37.8 21.9 58.2 1 4.7 1.8 9.4 2.6 14.1.7 4.3 3.1 8.3 6.8 10.7 7.8 5.2 18.7 1.7 22.5-6.7 1.3-2.9 1.7-6 1.2-8.9z"/></svg>
            </div>
        </div>
            <div class="w-full"><img :src="url+'/images/note_me_coffee.png'" alt="" /></div>
        </div>
        <toast v-if="showToast" :message="error_message" :time="1" start @changeToast="HideToast"></toast>
    </div>
</template>

<script>
import Header from '@editorjs/header';
import '@simonwep/pickr/dist/themes/classic.min.css';
import Pickr from '@simonwep/pickr';
import DragDrop from 'editorjs-drag-drop';
import Alert from 'editorjs-alert';
import InlineImage from 'editorjs-inline-image';
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

let editor,pickr,intro;
export default {
    name: "Note_Component",
    props: ['errors', 'note', 'csrf', 'readonly', 'url','localization','locale'],
    data() {
        return {
            loading:false,
            dates: [],
            selected: {},
            title: this.note !== '' ? JSON.parse(this.note).title : '',
            content: '',
            custom_color: this.note !== '' ? JSON.parse(this.note).color : '#ffffff',
            showToast:false,
            error_message:'',
            messages:JSON.parse(this.localization),
        }
    },
    watch: {
        errors() {
            console.log(this.errors)
        },
    },
    computed: {},
    methods: {
        updateValue(value){
            console.log(value);
        },
        deleteNote(){
             if(confirm('Are you sure?')){
                 this.loading=true;
               axios.post('/delete/note',{
                   id: JSON.parse(this.note).id,
                   _token: this.csrf,
               }).then((res)=>{

              if(res.data==='Error'){
                  this.error_message= "Notes of whom you didn't belong to cannot be deleted"
                  this.showToast=true;
                  this.loading=false;
              } else {
                  window.location.href=res.data;
              }
               });
             }
        },
        HideToast(){
          this.showToast=false;
        },
        addDate() {
            this.dates.push({
                date: new Date(),
            });
            this.$nextTick(() => {
                const btn = this.$refs.button[this.$refs.button.length - 1];
                btn.click();
            });
        },
        removeDate(date, hide) {
            this.dates = this.dates.filter((d) => d !== date);
            hide();
        },
        dateSelected(e, date, toggle) {
            this.selected = date;
            toggle({ref: e.target});

        },
        changeCarbonToJsDate(a) {
            let date = a.split("T")[0].split('-')
            return new Date(date[0], date[1] - 1, date[2]);
        },
        changeJsToCarbon(a) {
            let day = a.getDate();
            let month = a.getMonth();
            let year = a.getFullYear();
            return `${year}-${month + 1}-${day}`;
        },
        watchAndChangeLocale(){
            let element=document.querySelector('.locale-intro');
            element.value=this.locale;
            document.querySelector('.locale-intro').addEventListener('change',function(){
                axios.post('/set/locale',{value:this.value}).then((res)=>{
                    console.log(res.data);
                    if(res.status === 200){
                        window.location.reload(false);
                    }
                })
            })
        },
        save() {
            if(this.title.trim().length ===0){
                this.error_message='Title cannot be empty!';
                    return this.showToast = true;

            }
            this.loading=true;
            editor.save().then((output) => {
                let carbon = [];
                for (let date of this.dates) {
                    carbon.push(this.changeJsToCarbon(date.date));
                }
                axios.post(`${this.url}/create_note`, {
                    id: this.note !== '' ? JSON.parse(this.note).id : 0,
                    _token: this.csrf,
                    title: this.title,
                    blocks: JSON.stringify(output.blocks),
                    color: this.custom_color,
                    schedules: carbon,
                }).then((res) => {
                    console.log(res)
                    if (res.status === 200) {
                        window.location = res.data.route;
                    }
                })
            })
        },
    },
    mounted() {
        this.watchAndChangeLocale();
        intro=new introJs().setOptions({
            tooltipClass:'customTooltip',
           steps:[
               {
                   title:'Welcome',
                   intro:'let me show you how to create note.'
               },
               {
                 element:document.querySelector('#step-1'),
                   intro:'Enter Title',
               },
               {
                   element:document.querySelector('#step-2'),
                   intro:'Pick any color you want.',
               },
               {
               element:document.querySelector('.step-3'),
                   title:"Now let's create some content",
                   intro:"Left-Click here and the \'+\' button will appear. Then clicking that button will show the \'tool box\' and hover each tool to know about it. Then click any tool and try making something awesome.",
               },
               {
               element:document.querySelector('#step-4'),
                   intro:'Add Date to schedule note.',
                   position:'left',
               },
               {
               element:document.querySelector('#step-5'),
                   title:'Final Step!!',
                   intro:"'Click the button and you've been successfully created a note.",
               }
           ]
        });
        if(localStorage.getItem('first-time-note-me')===null) {
            intro.start();
            localStorage.setItem('first-time-note-me','false');
        }
        if (this.note !== '') {
            for (let schedule of JSON.parse(this.note).schedules) {
                console.log(schedule)
                this.dates.push({date: this.changeCarbonToJsDate(schedule.created_at)});
            }
        }
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

        pickr.on('change', (color, source, instance) => {
            console.log('Event: "change"', color.toHEXA().toString());
            this.custom_color = color.toHEXA().toString();
        });
        editor = new EditorJS({
            holder: 'editorjs',
            readOnly: JSON.parse(this.readonly),
            onReady: () => {
                const undo = new Undo({editor});
                new DragDrop(editor);
                Scrollbar.init(document.querySelector('#editorjs'),{ damping: 0.06 });
            },
            data: {
                blocks: this.note !== '' ? JSON.parse(JSON.parse(this.note).content) : [],
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
                image: {
                    class: InlineImage,
                    inlineToolbar: true,
                    config: {
                        unsplash: {
                            appName: 'Note-Me',
                            clientId: 'lKXdaEBq6Kg1btoyhcXrWeUwfVE33rwo_bBsK5O8rhM'
                        }
                    }
                },
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

        });  console.log(editor)
        document.querySelector('.help').addEventListener('click',function(){
            intro.start();
        })
    }

}
</script>

<style scoped>
#editorjs {
    max-height: inherit !important;
}
#editorjs::-webkit-scrollbar{
    background:transparent;
}

/*.my-bg{*/
/*    background-color:{{color}};*/
/*}*/
</style>
