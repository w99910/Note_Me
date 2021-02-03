<template>
         <div class="weather-intro-1 w-full h-full bg-about flex justify-evenly items-center border-2 border-gray-800 dark:border-gray-200">
             <Sky v-if="render" :condition="weather.condition" :color="weather.color" size="46" :key="forceKey" ref="skyIcon"></Sky>
             <div class="flex flex-col p-2 justify-center">
                  <div class="weather-intro-2 flex justify-between w-full">
                      <input class="ring-0 focus:ring-0 p-0 text-lg focus:outline-none add_stroke_white text-dark-black font-bowlby border-none w-36 bg-transparent" type="text" v-model="weather.city" />
                  </div>
                 <span class="add_stroke_white text-dark-black font-bowlby text-xl">{{weather.temperature}} °C</span>
                 <span class="add_stroke_white text-dark-black font-poppins text-md">{{ messages.today }}</span>
                 <span class="font-poppins font-bold text-white">{{ messages.feel_like }} {{weather.feels_like}} °C</span>

             </div>
         </div>
</template>

<script>
import Skycon from "vue-skycons";
let instance;
export default {
    name: "Weather",
    props:['messages'],
    components:{
      'Sky':Skycon,
    },
    data(){
      return{
          forceKey:0,
          render:false,
          weather:{
              condition:'',
              city:'',
              country:'',
              temperature:'',
              feels_like:'',
              time:'',
              color:'#ffffff',
          },
      }
    },
    methods:{
        calcTime(offset) {
            let d = new Date();

            let utc = d.getTime() + (d.getTimezoneOffset() * 60000);

            let nd = new Date(utc + (3600000*offset));

            return nd.toLocaleString();
        },
        formatWeather(value){
            let hour=(new Date()).getHours();
            // console.log(hour)
            switch (value){
                case 'clear sky':this.weather.color= hour<6||hour>17?'#d9ffa2':'#fffe6b';return hour<6||hour>17?'clear-night':'clear-day';
                case 'broken clouds':this.weather.color= hour<6||hour>17?'#a2fffc':'#d594ff'; return hour<6||hour>17?'partly-cloudy-night':'partly-cloudy-day';
                case 'overcast clouds':this.weather.color='#ff5b14';return 'cloudy';
                case 'few clouds':this.weather.color='#ffbdbd';return 'cloudy';
                case 'scattered clouds':this.weather.color='#ffa1a1';return 'cloudy';
                case 'rain':this.weather.color='#6ca4ff';return 'rain';
                case 'moderate rain':this.weather.color='#83aeff';return 'rain';
                case 'shower rain':this.weather.color='#5c21ff';return 'rain';
                case 'snow':this.weather.color='#ff8429';return 'snow';
                case 'windy':this.weather.color='#ff3b50';return 'wind';
                case 'thunderstorm':this.weather.color='#a72eff';return 'sleet';
                case 'mist':this.weather.color='#ffc971';return 'fog';

            }
        },
        convertToCelcius(value){
            return (value-273.15).toFixed(2);
        },
    },
    watch:{
      'weather.city':_.debounce(function(value){
          if(value.trim().length !== 0) {
              instance.post(`https://api.openweathermap.org/data/2.5/weather?q=${value}&appid=664fba826318ca0edd050c42118ac30a`).then((res) => {
                  console.log(res);
                  this.weather.city = res.data.name;
                  this.weather.temperature = this.convertToCelcius(res.data.main.temp);
                  this.weather.time = this.calcTime(res.data.timezone);
                  this.weather.feels_like = this.convertToCelcius(res.data.main.feels_like);
                  this.weather.country = res.data.sys.country;
                  this.weather.condition = this.formatWeather(res.data.weather[0].description);
                  this.render = true;
                  let item = localStorage.getItem('current_city');
                  if (item) {
                      localStorage.removeItem('current_city');
                      localStorage.setItem('current_city', value);
                  } else {
                      localStorage.setItem('current_city', value);
                  }
                  this.forceKey+= 1;
              })

          }
      },1500)
    },
    created(){
        let item=localStorage.getItem('current_city')
        this.weather.city=item!==null||undefined?item:'Mandalay';
        instance = axios.create();
        delete instance.defaults.headers.common['X-CSRF-TOKEN'];
        delete instance.defaults.headers.common['X-Requested-With'];
        instance.post(`https://api.openweathermap.org/data/2.5/weather?q=${this.weather.city}&appid=664fba826318ca0edd050c42118ac30a`).then((res)=>{
            // console.log(res);
            this.weather.city=res.data.name;
            this.weather.temperature=this.convertToCelcius(res.data.main.temp);
            this.weather.time=this.calcTime(res.data.timezone);
            this.weather.feels_like=this.convertToCelcius(res.data.main.feels_like);
            this.weather.country=res.data.sys.country;
            this.weather.condition=this.formatWeather(res.data.weather[0].description);
            this.render=true;
        })
    },
    mounted(){


    },
}
</script>

<style scoped>

</style>
