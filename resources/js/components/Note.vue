<template>
<div class="">
    <button class="submit_button" @click="click">+</button>
    <form_component ref="form_component"></form_component>
</div>
</template>

<script>
import form_component from './Form';
export default {
    components:{form_component},
name: "Note",
    methods:{
        click:function(){
            this.$refs.form_component.toggle();
        }

    }
}
</script>

<style scoped>

</style>
