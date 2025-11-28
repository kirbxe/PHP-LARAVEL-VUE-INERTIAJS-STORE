<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import BackButton from '@/Components/BackButton.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import PopUpContainer from '@/Components/PopUpContainer.vue';
import AccordionItem from '@/Components/AccordionItem.vue';
import CartButton from '@/ui/CartButton.vue';




const props = defineProps(
    {
        product: Object
    }
)

</script>

<template>

    <Head title="ProductPage" />
    <PopUpContainer />
    <AuthenticatedLayout>
        <div class="flex flex-col gap-[50px] my-5 mx-10 sm:my-10 sm:mx-20 xl:mx-[200px] xl:my-[50px]">
            <div class="flex justify-between">
                <BackButton :href="route('products.index')" />
                <div v-if="$page.props.auth.user.is_admin === true">
                    <div class="relative ms-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-[18px] font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                        Админ-действия
                                        <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>
                            <template #content>
                                <DropdownLink as="button" :href="route('product.editPage', props.product.id)">
                                    Изменить
                                </DropdownLink>
                                <DropdownLink :href="route('deleteProduct.adminpanel', props.product.id)" as="button"
                                    method="delete">
                                    Удалить
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center sm:flex-row sm:items-start mx-5 my-5 gap-5">
                <img :src="'/' + props.product.path_picture" class="w-full sm:w-1/2 rounded-xl drop-shadow-md" />
                <div class="flex flex-col w-full sm:w-1/2 lg:py-5 lg:px-10">
                    <div class="flex justify-center text-[25px] font-bold lg:text-[30px]">
                        {{ props.product.name }} {{ props.product.brand.name }}
                    </div>
                    <div class="flex flex-col">
                        <hr>
                        <div class="text-[35px] font-bold m-1 flex ">
                            {{ props.product.price }} $
                        </div>
                        <div class="">
                            <CartButton class="w-full flex justify-center" method="post"
                                :href="route('cart.add', props.product.id)" />
                        </div>

                    </div>
                    <div class="flex flex-col mt-5 ">
                        <AccordionItem title="Описание">
                            <div class="text-[18px]">
                                {{ props.product.description }}
                            </div>

                        </AccordionItem>
                        <AccordionItem title="Условия доставки">
                            <div class="text-gray-400 text-[15px] flex flex-col items-center">
                                <p>Оплата на сайте осуществляется с помощью: <br></p>
                                <ul class="mt-2">
                                    <li> - Банковских карт VISA / MasterCard / МИР </li>
                                    <li> - Долями | Оплата покупок частями</li>
                                    <li> - Сплит и Яндекс Пей</li>
                                    <li> - Подели (рассрочка)</li>
                                </ul>
                                <p class="mt-2">
                                    Информация о наличии товара является предварительной и будет уточнена нашим онлайн-менеджером в течение 24 часов после оформления заказа. В случае отсутствия товара, возврат денежных средств будет оформлен на вашу карту в первые сутки после совершения заказа 
                                </p>
                            </div>
                        </AccordionItem>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
