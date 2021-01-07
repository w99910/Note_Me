<template>
<div>Hello This is Test 1 {{hello}} Seems</div>
</template>

<script>
export default {
    name: "Test",
    data(){
        return {
            hello: 'what',
        }
    },
    created(){
      alert('created');
    },
    mounted(){
        alert('mounted');
    }
}
</script>

<style scoped>

</style>
