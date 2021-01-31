<template>
    <div class="w-full h-full flex justify-evenly p-2 bg-white dark:bg-secondary">
        <div class="w-8/12 h-full flex flex-col p-4 border-2 border-gray-600  mt-2 " :style="{backgroundColor:custom_color}">
            <div class="w-full mb-1 flex items-center justify-evenly">
                <label class="w-9/12">
                    <input v-model.lazy="title" placeholder="Enter Awesome Title"
                           class="w-full focus:outline-none border-b-2 bg-transparent py-1 ">
                </label>
                <div class="p-2 bg-gray-400 ml-2">
                    <div class="color-picker"></div>
                </div>

            </div>

            <div class="w-full p-2 overflow-auto" id="editorjs"></div>
            <!--        <input type="hidden" value="{{csrf}}" name="_token" id="csrf_token">-->
        </div>
        <div class="w-3/12 flex h-5/10 flex-col mt-3 p-2 border-l-2 border-b-2 border-gray-600">
            <div class="flex items-center justify-between mb-2 py-3 w-full">
                <button class="px-3 py-1 bg-green-500 text-white focus:outline-none" @click="save()"><span
                        v-text="note!==''?'Save':'Create'"></span></button>
                <button v-if="note!==null" class="px-3 py-1 bg-dark-red text-white focus:outline-none" @click="deleteNote()"><span>Delete</span></button>
                <button class="text-sm text-indigo-600 dark:text-blue-100 font-semibold hover:text-indigo-500 px-2 h-8 focus:outline-none"
                        @click.stop="addDate">
                    + Add Date
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

let editor, pickr;
export default {
    name: "Note_Component",
    props: ['errors', 'note', 'csrf', 'readonly', 'url'],
    data() {
        return {
            dates: [],
            selected: {},
            title: this.note !== '' ? JSON.parse(this.note).title : '',
            content: '',
            custom_color: this.note !== '' ? JSON.parse(this.note).color : '#ffffff',
            showToast:false,
            error_message:'',
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
               axios.post('/delete/note',{
                   id: JSON.parse(this.note).id,
                   _token: this.csrf,
               }).then((res)=>{
              console.log(res);
              if(res.data==='Error'){
                  this.error_message= "Notes of whom you didn't belong to cannot be deleted"
                  this.showToast=true;
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
        save() {
            if(this.title.trim().length ===0){
                this.error_message='Title cannot be empty!';
                    return this.showToast = true;

            }
            editor.save().then((output) => {
                let carbon = [];
                for (let date of this.dates) {
                    carbon.push(this.changeJsToCarbon(date.date));
                }
                console.log(carbon);
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
        console.log(this.url);
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

        });
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
