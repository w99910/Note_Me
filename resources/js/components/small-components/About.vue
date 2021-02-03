<template>
    <div class="w-full h-full flex absolute top-0 left-0">
        <div class="w-1/2 h-full flex items-center justify-center p-3">
            <img :src="url+'/images/note_me_04.png'" class="w-full" alt="">
        </div>
        <div class="flex flex-col h-full justify-center items-center p-3 w-1/2">
            <h2 class="text-about text-xl mb-2 sm:mb-5 font-bold">{{ messages.about }}</h2>
            <ul class="flex flex-col h-4/6 justify-evenly list-disc">
                <li>
                    <h1 class="font-bold">{{ messages.What_is_Note_Me }}</h1>
                    <p>{{ messages.what_list_1}}</p>
                </li>
                <li>
                    <h1 class="font-bold">{{ messages.How_is_Note_Me_created }}</h1>
                    <p>{{
                            messages.what_list_2
                        }}</p>
                </li>
                <li>
                    <h1 class="font-bold">{{ messages.Why_is_Note_Me_created }}</h1>
                    <p>
                        - {{ messages.expect_list_1}}
                    </p>
                    <p>
                        - {{ messages.expect_list_2 }}
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
