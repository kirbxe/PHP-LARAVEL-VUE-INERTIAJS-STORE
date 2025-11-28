<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import CarouselMainPage from '@/Components/CarouselMainPage.vue';
import Button from 'naive-ui/es/button/src/Button';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>

    <Head title="Welcome" />
    <header class="h-[64px] flex items-center px-8 border-b border-gray-100 bg-white">
        <div class="flex items-center gap-2 text-[20px]">
            <!-- Logo -->
            <ApplicationLogo class="h-12" />
            KirbeeShop
        </div>
        <nav v-if="canLogin" class="flex py-2 items-center gap-4 flex-1 justify-end rounded-xl ">
            <div class="bg-[#FF005A] rounded-lg flex gap-4 p-2 text-white">
                <Link v-if="$page.props.auth.user" :href="route('products.index')">
                Наш каталог
                </Link>

                <template v-else>
                    <Link :href="route('login')">
                    Войти
                    </Link>

                    <Link v-if="canRegister" :href="route('register')">
                    Зарегестрироваться
                    </Link>
                </template>
            </div>
        </nav>
    </header>
    <main class="flex flex-col my-5 mx-10 sm:my-10 sm:mx-20 md:mx-35 md:my-15">
        <div class="flex flex-col gap-y-5">
            <div class="flex items-center flex-col gap-5 xl:flex-row xl:justify-between">
                <div class="flex flex-col justify-center w-full md:w-1/2">
                    <div class="font-bold text-center text-[35px] ">
                        Выгоднее просто нет.
                    </div>
                    <div class="text-[20px] text-center">
                        <p>Найдем нужную вещь с любой точки мира — <br>и привезем в любую точку мира!</p>
                    </div>
                </div>
                <CarouselMainPage class="rounded-lg w-full"/>
            </div>
            <div class="flex justify-center">
                    <Button color="#FF005A" tag="a" :href = "route('products.index')" round size="large">Перейти в каталог</Button>
            </div>
        </div>   
    </main>
</template>
