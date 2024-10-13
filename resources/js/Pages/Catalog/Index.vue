<script lang="ts">
export default {
  name: 'Catalog',
}
</script>

<script setup lang="ts">
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import { IData } from '../../interfaces'
import toPrice from './../../toPrice.js'
import EmptyResult from '../../Components/EmptyResult.vue'
import Filter from '../../Components/Filter.vue'
import PaginationButton from '../../Components/PaginationButton.vue'

const props = defineProps<{
  cars: IData,
  notice: string
}>()

const page = ref(2)
const loading = ref(false)

const showMore = async () => {
  if (!loading.value) {
    loading.value = true
    try {
      const { data } = await axios.get(route('catalog', { ...route().params, _query: { page: page.value } }))
      Array.prototype.push.apply(props.cars.items, data.items)
      props.cars.total_last_items = data.total_last_items
      page.value++
    } catch (error) {
      throw error
    } finally {
      loading.value = false
    }
  }
}
</script>

<template>
  <div class="container mx-auto">
    <div v-if="cars.items.length" class="flex flex-row mt-4">
      <div class="basis-1/4 mr-4">
        <Filter />
      </div>
      <div class="basis-3/4 mb-12">
        <div class="grid grid-cols-4 gap-4">
          <div
            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
            v-for="(item, index) of cars.items" :key="index"
          >
            <a href="#">
              <img
                class="rounded-t-lg"
                :src="`/storage/images/cars/${item.id}/${item.photo.image}`"
                :alt="item.vendor_code"
              >
            </a>
            <div class="p-5">
              <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                  {{ item.vendor_code }}
                </h5>
              </a>
                <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                  <p><strong>Бренд:</strong> {{ item.brand.name }}</p>
                  <p><strong>Модель автомобиля:</strong> {{ item.vendor_code }}</p>
                  <p><strong>Год выпуска:</strong> {{ item.release }}</p>
                  <p><strong>Тип двигателя:</strong> {{ item.engine }}</p>
                  <p><strong>Тип привода:</strong> {{ item.transmission }}</p>
                  <p><strong>Цена:</strong> {{ toPrice(item.price).value }}</p>
                </div>
                <div>
                  <a
                    href="#"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                  </a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="cars.items.length" class="flex flex-row justify-end mb-10">
        <pagination-button
          v-if="cars.total_last_items > 0"
          :page="page"
          :total="cars.total_last_items"
          :loading="loading"
          @click.prevent="showMore"
        />
      <select
        v-if="cars.links.length > 24"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mr-2"
        style="height: 40px"
        @change="router.visit(`/catalog?perPage=${$event.target.value}`)"
      >
        <option value="10" :selected="route().params.perPage == 10">10</option>
        <option value="20" :selected="route().params.perPage == 20">20</option>
        <option value="" :selected="!route().params.perPage">24</option>
        <option value="50" :selected="route().params.perPage == 50">50</option>
      </select>
      <nav v-if="cars.links.length > 3">
        <ul class="flex items-center -space-x-px h-10 text-base">
          <li v-for="(link, index) in cars.links" :key="index">
            <Link
              v-if="!link.active && link.url !== null"
              :href="link.url"
              v-html="link.label"
              class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            ></Link>
            <span
              v-else
              v-html="link.label"
              class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
            ></span>
          </li>
        </ul>
      </nav>
    </div>
    <empty-result v-if="!cars.items.length" :title="notice" :title-button="'reset filter'" />
  </div>
</template>
