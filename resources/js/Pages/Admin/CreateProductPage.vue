<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm} from '@inertiajs/vue3';
import BackButton from '@/Components/BackButton.vue';
import { ref } from 'vue';
import InputLabel from '../../Components/InputLabel.vue';
import PopUpContainer from '@/Components/PopUpContainer.vue';


const props = defineProps(
    {
        brands: Object
    }
)


const form = useForm({

    name: '',
    size: '',
    description: '',
    price: '',
    path_picture: null,
    brand_id: null

})

const fileSelected = ref('');

const handleFileSelect = (event) => {

    const file = event.target.files[0];

    if (file) {
        form.path_picture = file;

        if (fileSelected.value) {

            URL.revokeObjectURL(fileSelected.value)

        }

        fileSelected.value = URL.createObjectURL(file);
    } else {
        if (fileSelected.value) {

            URL.revokeObjectURL(fileSelected.value)

        }
        fileSelected.value = '';
        form.path_picture = null;

    }
};



const fileInput = ref(null);
const handleDivClick = () => {
    if (!fileSelected.value) {
        fileInput.value.click();
    }
}



function submit() {
    console.log('FORM SUBMITTED!');
    console.log('File:', form.path_picture);
    
    if (!form.path_picture) {
        alert('Пожалуйста, загрузите фото товара!!')
        return;
    }

    form.post(route('admin.createProduct'), {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Товар успешно создан!');
            form.reset();
            fileSelected.value = '';
        },
        onError: (errors) => {
            console.log('Произошла ошибка: ', errors);
        }
    });
}
</script>
<template>

    <Head title="CreateProductPage" />
    <PopUpContainer />
    <AuthenticatedLayout>
        <div class="flex flex-col gap-[25px] my-5 mx-10 sm:my-10 sm:mx-20 xl:mx-[200px] xl:my-[50px]">
            <div class="flex justify-between">
                <BackButton :href="route('admin.adminpanel')" />
            </div>
            <div class="flex flex-col mx-5 my-5 justify-center items-center">
                <div class="flex text-[25px] ">
                    Создание товара
                </div>
                <div class="flex justify-center">
                    <form class="flex flex-col gap-2" @submit.prevent="submit" enctype="multipart/form-data">
                        <label for="">Имя товара: </label>
                        <input v-model="form.name" type="text">
                        <label for="">Размер товара: </label>
                        <input v-model="form.size" type="text">
                        <label for="">Описание товара: </label>
                        <textarea v-model="form.description" class="inline-flex resize-none min-h-min"
                            type="text"></textarea>
                        <label for="">Цена товара: </label>
                        <input v-model.number="form.price" type="text">
                        <select v-model="form.brand_id" name="" id="">
                            <option value="" selected>Выберите бренд</option>
                            <option v-for="brand in props.brands" :key="brand.id" :value="brand.id">
                                {{ brand.name }}
                            </option>
                        </select>
                        <div class="flex flex-col  w-full h-[300px] max-h-[300px] p-2 rounded-lg items-center border-[6px] border-dashed transition-all cursor-pointer overflow-hidden"
                            :class="fileSelected ? 'border-green-400 bg-green-100' : 'border-gray-300 bg-slate-100 hover:bg-slate-200 '"
                            @click="handleDivClick">
                            <InputLabel for="path_picture" value="Фото товара" />
                            <div v-if="fileSelected" class="w-full flex flex-col items-center ">
                                <div class="flex justify-end w-full">
                                    <button @click.stop="fileSelected = ''; form.path_picture = null;"><svg width="24"
                                            height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10" fill="#FF005A" />
                                            <path d="M15 9L9 15" stroke="white" stroke-width="2"
                                                stroke-linecap="round" />
                                            <path d="M9 9L15 15" stroke="white" stroke-width="2"
                                                stroke-linecap="round" />
                                        </svg></button>
                                </div>
                                <div class="flex-1 flex items-center justify-center overflow-hidden">
                                    <img class="max-h-full max-w-full object-contain" :src="fileSelected"
                                        alt="currentPicture">
                                </div>
                            </div>
                            <div v-else class="flex flex-col items-center w-full h-full justify-center">
                                <svg class="w-12 h-12 mb-3 text-[#FF005A]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="text-gray-400">Нажмите, чтобы загрузить фото</p>
                            </div>
                            <input type="file" class="hidden" ref="fileInput" accept="image/*"
                                @change="handleFileSelect">

                        </div>
                        <button type="submit"
                            class="border p-3 rounded-lg font-bold text-[17px] border-black cursor-pointer"
                            :disabled="form.processing">
                            Создать продукт
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
