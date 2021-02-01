<template>
    <div class="w-full h-full flex">
        <div class="w-1/2 h-full flex items-center justify-center p-3">
            <img :src="url+'/images/note_me_04.png'" class="w-full" alt="">
        </div>
        <div class="flex flex-col h-full items-center p-3 w-1/2">
            <h2 class="text-about text-xl">{{ messages.about }}</h2>
            <ul class="flex flex-col h-4/6 justify-evenly list-disc">
                <li>
                    <h1 class="font-bold">What is Note Me?</h1>
                    <p>Note Me is a SaaS app in which you can
                        create your own notes, schedule your tasks,
                        let note me notify you with email or desktop
                        notification browse your notes on any device's
                        web browsers.</p>
                </li>
                <li>
                    <h1 class="font-bold">How is Note Me created?</h1>
                    <p>Note Me is created with Laravel PHP framework, Vue Js framework,TailWind CSS
                        framework,
                        and Editor js library, v-calendar library, three js.</p>
                </li>
                <li>
                    <h1 class="font-bold">Why is Note Me created?</h1>
                    <p>
                        - To make everyone complete their daily tasks easily by planning or arranging with Note Me.
                    </p>
                    <p>
                        - To be completely free Note-Maker Website.
                    </p>

                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
name: "About",
    props:['messages','url']

}
</script>

<style scoped>

</style>
