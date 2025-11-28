 <script>

export default{

props:{

    input: Object,
    searchValue: string

}


}

    
</script>

<template>
    <div class="flex justify-center">
                <input @input="props.input" v-bind="searchValue"
                    class="w-full sm:w-[500px] border-[#B4B4B4] rounded-xl focus:ring-0 focus:border-[#FF005A] focus:border-[2px] transition-all "
                    name="searchInput" placeholder="Поиск...">
            </div>
</template> 
