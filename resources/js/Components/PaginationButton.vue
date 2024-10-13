<script setup lang="ts">
import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue'

withDefaults(defineProps<{
  routeName?: string
  page: number
  total: number
  loading: boolean
}>(), {
  routeName: 'catalog',
  loading: false
})
</script>

<template>
  <a
    :href="route(routeName, { ...route().params, _query: { page } })"
    :class="{ 'loading' : loading }"
    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
  >
    <span>show more {{ total }} items</span>
    <scale-loader v-if="loading" :loading="loading" :color="'#fff'" :height="'25px'" :margin="'5px'"></scale-loader>
  </a>
</template>

<style scoped>
a {
  position: relative;
}
a.loading, a.loading * {
  cursor: default !important;
}
a.loading span {
  opacity: 0;
  -webkit-transition: opacity .3s;
  -o-transition: opacity .3s;
  transition: opacity .3s;
}
a.loading:hover {
  background: #5a5a59 !important;
}
.v-spinner {
  position: absolute;
  top: 0;
  left: 40%;
}
</style>
