    <script setup>
    import { Head, usePage, Link } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { computed } from 'vue';
    import PlusProductButton from '@/ui/PlusProductButton.vue';
    import MinusProductButton from '@/ui/MinusProductButton.vue';
    const props = defineProps(
        {
            items: Object,
            totalSum: Object
        })

    const countCart = computed(() => {

        return usePage().props.cart_count;

    })
</script>

    <template>

        <Head :title="Cart" />
        <AuthenticatedLayout>
            <div class="mx-4 my-5 flex justify-center lg:mx-24 gap-10 overscroll-none">
                <div class="flex-1 overscroll-none">
                    <div class="flex gap-3 items-center mb-3 ">
                        <h1 class="text-[30px]">Корзина</h1> <span v-if="countCart > 0"
                            class="text-gray-400 text-[18px]">{{countCart }} товаров </span>
                    </div>
                    <div class="flex flex-col gap-3 p-3 rounded-xl  overflow-y-auto"
                        style="overscroll-behavior: none; -webkit-overflow-scrolling: touch; scrollbar-width: none; -ms-overflow-style: none;">
                        <div v-for="item in props.items" class="flex gap-4 rounded-lg shadow-md w-full p-2 bg-gray-100">
                            <div class="w-[150px] h-[150px]">
                                <img class="w-full h-full rounded-lg" :src="item.product.path_picture" alt="">
                            </div>
                            <div class="flex flex-1 justify-between">
                                <div class="flex  gap-3 flex-col">
                                    <div class="flex flex-col">
                                        <div class="text-[25px]">
                                            {{ item.product.name }}
                                        </div>
                                        <div class="text-[18px]">
                                            Бренд: {{ item.product.brand.name }}
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div>
                                            <Link as="button" class="p-1 transition-all hover:bg-[#b30643] rounded-lg bg-[#FF005A] text-white" method="delete"
                                                :href="route('delete.cartItem', item.id)">
                                            Удалить
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex items-center gap-1">
                                        <MinusProductButton :href="route('cart.updateQuantity', [item.id, 'decrement'])" />
                                        <div class="flex text-[20px]">
                                            {{ item.quantity }}
                                        </div>
                                        <PlusProductButton
                                            :href="route('cart.updateQuantity', [item.id, 'increment'])" />
                                    </div>
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col shadow-md   border w-[400px] rounded-lg  bg-gray-100 mt-16">
                    <div class="flex w-full rounded-t-lg p-2 items-center justify-center h-[50px] text-white bg-[#FF005A]">
                        <h1 class="text-[25px]">Условия заказа: </h1>
                        
                    </div>
                    <div class="flex flex-col justify-between h-full p-5">
                        <p class="font-bold">Итого к заказу: {{ totalSum }}$ </p>
                        <Link 
                        as="button"
                        class="bg-[#FF005A] transition-all text-white  hover:bg-white hover:text-black h-[50px] rounded-lg"
                        >
                        Оформить заказ
                        </Link>
                    </div>
                </div>

            </div>

        </AuthenticatedLayout>
    </template>
