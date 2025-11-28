<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CartButton from '@/ui/CartButton.vue';
import PopUpContainer from '@/Components/PopUpContainer.vue';

const confirmDelete = (event) => {
    if (!confirm('Вы точно хотите удалить эту карточку?')) {

        event.preventDefault()

    }
}
const props = defineProps(
    { products: Object }
)

console.log('Products from Laravel:', props.products)
// console.log('Type of products:', typeof props.products)


const searchQuery = ref('');

const searchHandle = () => {
    // console.log('Search value: ' + searchQuery.value);
}

const filteredProductsToName = computed(() => {

    const productsArr = Object.values(props.products.data);
    const query = searchQuery.value.toLowerCase().trim();

    if (!query) {

        return productsArr;
    }

    return productsArr.filter(product => {
        return product.name.toLowerCase().includes(query)
    });

});

const filteredProductsToBrands = computed(() => {

    const productsArr = Object.values(props.products.data);

    const query = searchQuery.value.toLowerCase().trim();
    if (!query) {
        return productsArr;
    }

    return productsArr.filter(product => {

        return product.brand.name.toLowerCase().includes(query) ||
            product.name.toLowerCase().includes(query);
    });
})

const pageKey = computed(() => props.products.current_page);


</script>

<template>

    <Head title="CatalogProduct" />
    <PopUpContainer />
    <AuthenticatedLayout>
        <div class="flex flex-col  gap-[50px] my-5 mx-10 sm:my-10 sm:mx-20 md:mx-35 md:my-15" :key="pageKey">
            <div class="flex justify-center">
                <input @input="searchHandle" v-model="searchQuery"
                    class="w-full sm:w-[500px] border-[#B4B4B4] rounded-xl focus:ring-0 focus:border-[#FF005A] focus:border-[2px] transition-all "
                    name="searchInput" placeholder="Поиск...">
            </div>
            <div class="flex flex-col">
                <div
                    class="w-full py-10 px-10 flex flex-wrap justify-center md:justify-start rounded-xl border gap-[10px]  ">
                    <div v-for="product in filteredProductsToBrands" :key="product.id"
                        class="flex flex-col justify-between shadow-xl rounded-xl  w-[200px] h-[400px]">
                        <div class="w-full h-1/2 rounded-xl">
                            <img :src="product.path_picture" alt="">
                        </div>
                        <div class="px-[15px] py-[30px] flex flex-col ">
                            <Link class="font-bold  my-1 text-[18px] text-center hover:text-[#FF005A] "
                                :href="route('product.show', product.id)">
                            {{ product.name }} {{ product.brand.name }}
                            </Link>
                            <!-- <div class="flex flex-col my-3">
                                                <span>Размер: <strong>{{ product.size }}</strong></span>
                                                <span>Цена: <strong>{{ product.price }} $</strong></span>
                                                </div> -->
                            <div class="flex w-full justify-end items-end">
                                <CartButton class="w-full flex justify-center" method="POST"
                                    :href="route('cart.add', product.id)" />
                            </div>

                        </div>

                    </div>

                </div>
                <div class="inline-flex items-center flex-col mt-5">
                    <div class="flex flex-col items-center shadow-lg border p-2 rounded-lg">
                        <div class="flex text-[18px]">{{ props.products.current_page }} из {{ props.products.last_page
                            }}</div>
                        <div class="flex justify-center gap-6 ">
                            <Link as="button"
                                class="bg-[#FF005A] font-bold transition-all text-white p-1 rounded-lg hover:bg-white hover:text-black hover:border"
                                v-if="props.products.prev_page_url" :href="props.products.prev_page_url">Предыдущая
                            страница</Link>

                            <Link as="button"
                                class="bg-[#FF005A] font-bold transition-all text-white p-1 rounded-lg hover:bg-white hover:text-black hover:border"
                                v-if="props.products.next_page_url" :href="props.products.next_page_url">Следующая
                            страница</Link>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>

</template>

<style scoped></style>