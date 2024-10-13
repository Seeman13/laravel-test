import { computed } from 'vue'

export default (price)=> computed(() =>
  new Intl.NumberFormat('ru-Ru', { style: 'currency', currency: 'RUB' }).format(price)
)
