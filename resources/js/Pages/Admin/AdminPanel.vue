<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PopUpContainer from '@/Components/PopUpContainer.vue';
import { computed, ref } from 'vue';

const props = defineProps(
    {
        brands: Object
    }
)

const searchQuery = ref('');

const filteredtoNameBrands = computed(() => {
    const brandArr = Object.values(props.brands);
    const query = searchQuery.value.toLowerCase().trim();
    if (!query) {

        return brandArr;

    }
    return brandArr.filter((brand) => {
        return brand.name.toLowerCase().trim().includes(query);
    })
})


const form = useForm({
    name: null
});

const submit = () => {

    form.post(route('admin.createBrand'), {
        preserveScroll: true,
    });

}




</script>

<template>

    <Head title="AdminPanel" />
    <PopUpContainer />
    <AuthenticatedLayout>
        <div class="flex flex-col gap-[25px] my-5 mx-10 sm:my-10 sm:mx-20 xl:mx-[200px] xl:my-[50px]">
            <div class="flex flex-col mx-5 my-5 justify-center items-center">
                <div class="flex text-[25px] ">
                    Админ-панель
                </div>
                <div class="flex flex-col  px-5 w-full items-center mt-5">
                    <div class="flex flex-col items-center  mt-2 gap-14 lg:flex-row lg:justify-center lg:items-start lg:gap-32 ">
                        <div class="flex justify-center flex-col gap-5 w-[350px]">
                            <div class="flex flex-col items-center border p-3 rounded-lg">
                                <div class="text-[18px]">
                                    Создать новый продукт:
                                </div>
                                <div>
                                    <Link
                                        class="bg-[#FF005A] text-white p-2 rounded-lg border border-transparent hover:bg-white hover:text-black transition-all hover:border-black"
                                        as="button" :href="route('admin.createProductPage')">Создать</Link>
                                </div>
                            </div>
                            <div class="flex flex-col items-center border p-3 rounded-lg">
                                <div class="text-[18px]">
                                    Создать новый бренд:
                                </div>
                                <form @submit.prevent="submit">
                                    <div class="flex">
                                        <input v-model="form.name" class="w-full my-3 rounded-lg"
                                            placeholder="Введите название бренда" type="text">
                                    </div>
                                    <button
                                        class="bg-[#FF005A] w-full text-white p-2 rounded-lg border border-transparent hover:bg-white hover:text-black transition-all hover:border-black"
                                        type="submit">Создать</button>

                                </form>
                            </div>
                        </div>
                        <div class="flex flex-col border p-5 w-[350px] items-center gap-5  mx-2 rounded-lg">
                            <div class="flex flex-col w-full">
                                <div class="text-[18px] text-center ">
                                    Удалить бренд:
                                </div>
                                <div class="flex ">
                                    <input v-model="searchQuery" class="w-full my-3 rounded-lg" placeholder="Поиск..."
                                        type="text">

                                </div>
                                <div
                                    class="flex flex-col border gap-2 rounded-lg w-full p-3  overflow-y-auto h-[400px]">
                                    <div v-if="props.brands != null" v-for="brand in filteredtoNameBrands"
                                        :key="brand.id"
                                        class="border border-black rounded-lg w-full p-1 flex justify-between items-center">
                                        <div class="">
                                            {{ brand.name }}
                                        </div>
                                        <Link as="button" :href="route('admin.deleteBrand', brand.id)"
                                            class="bg-[#FF005A] text-white p-2 rounded-lg border border-transparent hover:bg-white hover:text-black transition-all hover:border-black "
                                            method="delete">
                                        Удалить
                                        </Link>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <Link as="button" :href="route('admin.deleteAllBrand')"
                                            class="bg-[#FF005A] w-full m-2  text-white p-2 rounded-lg border border-transparent hover:bg-white hover:text-black transition-all hover:border-black "
                                            method="post">
                                        Удалить все бренды
                                        </Link>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
