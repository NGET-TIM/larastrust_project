<template>
  <Splide :options="{ rewind: true }" aria-label="My Favorite Images">
    <SplideSlide>
      <img :src="'/upload/images/slide/Programming-Languages104.jpg'" alt="Sample 1">
    </SplideSlide>
    <SplideSlide>
      <img :src="'/upload/images/slide/maxresdefault.jpg'" alt="Sample 2">
    </SplideSlide>
  </Splide>
</template>


<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';

export default {
  components: {
    Splide,
    SplideSlide,
  },
  setup() {
    const options = {
        pauseOnFocus: true,
        rewind: true,
        gap: '1rem',
        autoplay: true,
        height  : '5rem',
    };

    return { options };
  },
};

</script>
