<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import BackButton from '@/Components/BackButton.vue';
import { ref } from 'vue';




const props = defineProps(
    {
        product: Object,
        brands: Object
    }
)
console.log(props.brands)
console.log(props.product)


const form = useForm({

    name: props.product.name,
    size: props.product.size,
    description: props.product.description,
    brand_id: props.product.brand_id,
    price: props.product.price,
    path_picture: props.product.path_picture

})



function submit() {
    form.put(route('product.update', props.product.id), {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Товар успешно обновлен!')
        },
        onError: (errors) => {

            console.log('Произошла ошибка', errors);
        }

    })
}

</script>

<template>

    <Head title="EditProductPage" />
    <AuthenticatedLayout>
        <div class="flex flex-col gap-[25px] my-5 mx-10 sm:my-10 sm:mx-20 xl:mx-[200px] xl:my-[50px]">
            <div class="flex justify-between">
                <BackButton :href="route('product.show', props.product.id)" />
            </div>
            <div class="flex flex-col mx-5 my-5 justify-center items-center">
                <div class="flex text-[25px] ">
                    Изменение товара
                </div>
                <div class="flex justify-center">
                    <form class="flex flex-col gap-2" @submit.prevent="submit">
                        <label for="">Имя товара: </label>
                        <input type="text" v-model="form.name">
                        <label for="">Размер товара: </label>
                        <input type="text" v-model="form.size">
                        <label for="">Описание товара: </label>
                        <textarea class="inline-flex resize-none min-h-min" type="text" v-model="form.description"></textarea>
                        <label for="">Цена товара: </label>
                        <input type="text" v-model="form.price">
                         <select v-model="form.brand_id" name="" id="">
                            <option value="">Выберите бренд</option>
                            <option v-for="brand in props.brands" :key="brand.id" :value="brand.id">
                                {{ brand.name }}
                            </option>
                        </select> 
                        <input class="border p-3 rounded-lg font-bold text-[17px] border-black cursor-pointer" type="submit" value="Сохранить изменения">
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
