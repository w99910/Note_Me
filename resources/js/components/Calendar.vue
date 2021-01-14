<template>
    <div class="w-full bg-white p-2 rounded-2xl h-full flex items-center justify-center">
        <div class="w-full sm:w-8/12 h-full flex items-start justify-center">
        <v-calendar disable-page-swipe :attributes="custom_Attr" is-expanded :is-dark="dark" :masks="masks" class="custom-calendar w-full">
         <template v-slot:day-content="{ day, attributes }">
             <div class="flex flex-col h-full z-10 overflow-hidden">
                 <span class="day-label text-sm text-gray-900">{{ day.day }}</span>
                 <div class="flex-grow overflow-y-auto overflow-x-auto">
                     <p
                         v-for="attr in attributes"
                         class="text-xs leading-tight rounded-sm p-1 mt-0 mb-1"
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
        <toast time="1" message="hello" ref="toast"></toast>
    </div>
</template>

<script>
export default {
    name: "Calendar",
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
                  // {
                  //     key: 1,
                  //     customData: {
                  //         title: 'Lunch with mom.',
                  //         class: 'bg-red-600 text-white',
                  //     },
                  //     dates: [new Date(year, month+1, 1),
                  //         new Date(year, month, 1),
                  //         new Date(year, month+3, 1)],
                  // },
                  // {
                  //     key: 2,
                  //     customData: {
                  //         title: 'Take Noah to basketball practice',
                  //         class: 'bg-blue-500 text-white',
                  //     },
                  //     dates: new Date(year, month+1, 2),
                  // },
                  // {
                  //     key: 3,
                  //     customData: {
                  //         title: "Noah's basketball game.",
                  //         class: 'bg-blue-500 text-white',
                  //     },
                  //     dates: new Date(year, month+1, 5),
                  // },
                  // {
                  //     key: 4,
                  //     customData: {
                  //         title: 'Take car to the shop',
                  //         class: 'bg-indigo-500 text-white',
                  //     },
                  //     dates: new Date(year, month+1, 5),
                  // },
                  // {
                  //     key: 4,
                  //     customData: {
                  //         title: 'Meeting with new client.',
                  //         class: 'bg-teal-500 text-white',
                  //     },
                  //     dates: new Date(year, month+1, 7),
                  // },
                  // {
                  //     key: 5,
                  //     customData: {
                  //         title: "Mia's gymnastics practice.",
                  //         class: 'bg-pink-500 text-white',
                  //     },
                  //     dates: new Date(year, month+1, 11),
                  // },
                  // {
                  //     key: 6,
                  //     customData: {
                  //         title: 'Cookout with friends.',
                  //         class: 'bg-orange-500 text-white',
                  //     },
                  //     dates: { months: 5, ordinalWeekdays: { 2: 1 } },
                  // },
                  // {
                  //     key: 7,
                  //     customData: {
                  //         title: "Mia's gymnastics recital.",
                  //         class: 'bg-pink-500 text-white',
                  //     },
                  //     dates: new Date(year, month, 22),
                  // },
                  // {
                  //     key: 8,
                  //     customData: {
                  //         title: 'Visit great grandma.',
                  //         class: 'bg-red-600 text-white',
                  //     },
                  //     dates: new Date(year, month, 25),
                  // },


          }
    },
    methods:{
        changeCarbonToJsDate(a){
            let date=a.split("T")[0].split('-')
               return new Date(date[0],date[1]-1,date[2]);
        },
      getNotes(){
          axios.post(`/user/notes`).then((res)=>{
              console.log(res.data)
                 if(res.data['error']){
                     this.$refs.toast.message=res.data['error'];
                     this.$refs.toast.start=true;
                 }
                 else{
                     for(let [i,a] of res.data['schedules'].entries()){
                          let date=a.created_at.split("T")[0].split('-')
                         console.log(a.note.color)
                           this.custom_Attr.push({
                               key:i,
                               customData:{
                                   title:a.note.title,
                                   class: 'text-white',
                                   style:a.note.color,
                               },
                               dates:new Date(date[0],date[1]-1,date[2]),
                           })
                         console.log(this.custom_Attr)
                     }
                 }
          })
      }
    },
    mounted(){
           this.getNotes();
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
</style>
