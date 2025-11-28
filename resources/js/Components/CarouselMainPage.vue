<script setup >
import {NCarousel} from 'naive-ui';
</script>
<template>
  <n-carousel show-arrow >

    <img
      class="carousel-img"
      src="https://superstep.ru/upload/resize_cache/iblock/b81/hxki8an7r81q26ej80jeneckzr8bvlf0/1296_618_1/1297x620%20deskt%20_TNF%20.jpg"
    >
    <img
      class="carousel-img"
      src="../../../public/img/arcteryx.jpg"
    >
  </n-carousel>
</template>

<style scoped>
.carousel-img {
  width: 100%;
  height: 500px;
  object-fit: cover;

}
</style>