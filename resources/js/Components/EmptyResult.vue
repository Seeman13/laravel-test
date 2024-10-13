<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  title: {
    type: String,
    default: 'You currently have no order'
  },
  titleButton: {
    type: String,
    default: 'reset'
  }
})
</script>

<template>
  <div class="flex flex-col items-center">
    <p class="mt-20 mb-20">{{ title }}</p>
    <Link
      :href="route('catalog')"
      class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
    >{{ titleButton }}</Link>
  </div>
</template>
