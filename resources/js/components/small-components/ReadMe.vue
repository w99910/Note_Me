<template>
    <div class="w-10/12 absolute top-0 dark:text-gray-200 leading-7 tracking-wide h-full font-poppins flex flex-col justify-evenly">
         <h1 class="font-bowlby self-center text-xl text-dark-yellow" :class="locale=='jpn'?'':'add_stroke'">{{messages.read_me}}</h1>
        <div class="read-me-content flex flex-col px-2">
             <p class="text-lg font-bold my-1">{{ messages.What_can_you_expect_from_Note_Me }}</p>
            <ul class="list-disc">
                <li class="my-1">
                    {{ messages.read_list_1 }}
                </li>
                <li class="my-1">
                    {{messages.read_list_2}}
                </li>
                <li class="my-1">
                {{ messages.read_list_3 }}
                </li>
                <li class="my-1">
                    <div class="flex flex-col">
                       <h1> {{ messages.read_list_4 }}  </h1>
                        <ul>
                            <li>
                                - {{ messages.read_service_1 }}
                            </li>
                            <li>- {{ messages.read_service_2 }} </li>
                            <li>-{{ messages.read_service_3 }}</li>
                            <li>- {{ messages.read_service_4 }}</li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div>
           {{ messages.open_source }}
        </div>
        <div>
            {{ messages.repository_link }} <a class="font-bold underline" target="_blank" href="https://github.com/w99910/Note_Me">here</a>
            {{ messages.star }}
        </div>
        <span class="font-bold">
            {{ messages.cheers }}
        </span>
        <span class="font-bold text-dark-yellow italic">
            {{ messages.Note_that }}
        </span>
    </div>
</template>

<script>
export default {
    props:['messages','locale'],
    name: "ReadMe"
}
</script>

<style scoped>

</style>
