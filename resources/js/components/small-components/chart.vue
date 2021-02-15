<template>
<div class="w-full h-full p-1 flex items-center border-2 border-gray-600 dark:bg-gray-800 dark:border-gray-200" id="chart-container">

</div>
</template>

<script>
let chart;
export default {
    name: "chart",
    data(){
      return{
           data:[],
          check:false,
      }
    },
    methods:{
      async getData(){
          return await axios.post('/get/notes_data').then(async(res)=>{
                 let data= await this.ProcessData(res.data);
                 return data;
          });
      },
        async Chart(){
          if(await this.getData()){
              console.log(this.check);
              Highcharts.chart('chart-container',{
                  chart: {
                      plotBackgroundColor: null,
                      plotBorderWidth: null,
                      plotShadow: false,
                      type: 'pie',
                      backgroundColor:this.check?'transparent':'#ffffff',
                  },
                  title:{
                      text:'Your notes Review',
                      style: {
                          color: this.check?'#F3F3F3':'#1c1c1c',   //#666666
                      }
                  },
                  tooltip: {
                      pointFormat: "{series.name}: <b>{point.y} </b>",
                      valueSuffix: " notes",
                  },
                  accessibility: {

                  },
                  legend:{
                    itemStyle:{
                        color: this.check?'#F3F3F3':'#1c1c1c',
                    }
                  },
                  yAxis: {
                      title: {
                          style: {
                              color: this.check?'#F3F3F3':'#1c1c1c', //#666666
                          }
                      }
                  },
                  plotOptions: {
                      pie: {
                          allowPointSelect: true,
                          cursor: 'pointer',
                          dataLabels: {
                              enabled: false
                          },
                          showInLegend: true
                      }
                  },
                  series: [{
                      name: '',
                      colorByPoint: true,
                      data: this.data,
                  }]
              })
          }
        },
        ProcessData(data){
                 let keys=Object.keys(data);
                 for(let i of keys){
                     this.data.push({name:i,y:data[i]});
                 }
                 return 'finish';
        },
        toggleDark(){
          console.log('check')
            document.querySelector('#checkbox').addEventListener('change',function(value){

                if(this.checked){
                    Highcharts.charts.forEach((chart) => {
                        console.log(chart)
                        chart.update({
                            chart: {
                                backgroundColor: 'transparent',
                            },
                            title: {
                                style: {
                                    color: '#F3F3F3',   //#666666
                                }
                            },
                            legend: {
                                itemStyle: {
                                    color: '#F3F3F3', //#333333
                                }
                            },
                            yAxis: {
                                title: {
                                    style: {
                                        color: '#F3F3F3' //#666666
                                    }
                                }
                            },
                            xAxis: {
                                labels: {
                                    style: {
                                        color: '#F3F3F3', //#666666
                                    }
                                },
                            }
                        })
                        chart.redraw(false);
                    }, false);
                }else{
                    Highcharts.charts.forEach((chart) => {
                        chart.update({
                            chart: {
                                backgroundColor: '#ffffff',
                            },
                            title: {
                                style: {
                                    color: '#1c1c1c',   //#666666
                                }
                            },
                            legend: {
                                itemStyle: {
                                    color: '#333333', //#333333
                                }
                            },
                            yAxis: {
                                title: {
                                    style: {
                                        color: '#1c1c1c' //#666666
                                    }
                                }
                            },
                            xAxis: {
                                labels: {
                                    style: {
                                        color: '#1c1c1c', //#666666
                                    }
                                },
                            }
                        })
                        chart.redraw(false);
                    }, false);
                }
            });
        },
    },
    created(){

    },
    mounted(){

        this.check=document.querySelector('#checkbox').value;
        console.log(this.check)
         this.Chart();
        this.toggleDark();
    }
}
</script>

<style scoped>

</style>
