<script lang="ts">
export default {
  name: 'Filter'
}
</script>

<script setup lang="ts">
import { onMounted } from 'vue'
import { InertiaForm, router, useForm } from '@inertiajs/vue3'
import { IForm } from '../interfaces'

const form: InertiaForm<IForm> = useForm<IForm>({
  brand: null,
  vendor_code: null,
  yearStart: null,
  yearEnd: null,
  engine: null,
  transmission: null,
  priceStart: null,
  priceEnd: null,
  q: null
})

const filter = async () => {
  console.log(form.data())
  router.visit('catalog', {
    data: <{}>form.data()
  })
}

onMounted(() => {
  const params = route().params
  form.brand = params.brand
  form.vendor_code = params.vendor_code
  form.yearStart = params.yearStart
  form.yearEnd = params.yearEnd
  form.engine = params.engine
  form.transmission = params.transmission
  form.priceStart = params.priceStart
  form.priceEnd = params.priceEnd
  form.q = params.q
})
</script>

<template>
  <form :action="route('catalog')" method="get" @submit.prevent="filter()">
    <div class="grid gap-12 mb-6 md:grid-cols-1">
      <label for="q" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
        </div>
        <input
          type="search"
          id="q"
          class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="поиск по всем параметрам"
          v-model="form.q"
        />
        <button
          type="submit"
          class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >search</button>
      </div>
    </div>
    <div class="grid gap-12 mb-3 md:grid-cols-1">
      <div>
        <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Бренд</label>
        <input
          type="text"
          id="brand"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="бренд"
          v-model="form.brand"
        />
      </div>
    </div>
    <div class="grid gap-12 mb-3 md:grid-cols-1">
      <div>
        <label for="vendor_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Модель автомобиля
        </label>
        <input
          type="text"
          id="vendor_code"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="модель автомобиля"
          v-model="form.vendor_code"
        />
      </div>
    </div>
    <div class="grid gap-12 mb-3 md:grid-cols-1">
      <div>
        <label for="engine" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Тип двигателя</label>
        <select
          id="engine"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.engine"
        >
          <option value="petrol">бензиновый</option>
          <option value="diesel">дизельный</option>
          <option value="hybrid">гибридный</option>
          <option value="electric">электрический</option>
        </select>
      </div>
    </div>
    <div class="grid gap-12 mb-3 md:grid-cols-1">
      <div>
        <label for="transmission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Привод</label>
        <select
          id="transmission"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.transmission"
        >
          <option value="0">передний</option>
          <option value="1">задний</option>
          <option value="null">полный</option>
        </select>
      </div>
    </div>
    <div class="grid gap-6 mb-3 md:grid-cols-2">
      <div>
        <label for="yearStart" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Год выпуска от:
        </label>
        <input
          type="number"
          id="yearStart"
          min="1900"
          max="2024"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="год выпуска от:"
          v-model="form.yearStart"
        />
      </div>
      <div>
        <label for="yearEnd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Год выпуска до:
        </label>
        <input
          type="number"
          id="yearEnd"
          min="1900"
          max="2024"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="год выпуска до:"
          v-model="form.yearEnd"
        />
      </div>
    </div>
    <div class="grid gap-6 mb-3 md:grid-cols-2">
      <div>
        <label for="priceStart" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Цена от:
        </label>
        <input
          type="number"
          id="priceStart"
          min="1"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="год выпуска от:"
          v-model="form.priceStart"
        />
      </div>
      <div>
        <label for="priceEnd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Цена до:
        </label>
        <input
          type="number"
          id="priceEnd"
          min="1"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="год выпуска до:"
          v-model="form.priceEnd"
        />
      </div>
    </div>
    <button
      type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
    >SEARCH</button>
    <a
      :href="route('catalog')"
      class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
    >RESET</a>
  </form>
</template>
