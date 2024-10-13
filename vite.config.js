import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  build: {
    target: 'esnext',
    // sourcemap: true
  },
  server: {
    port: 8080
  },
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      ssr: 'resources/js/ssr.js',
      refresh: true
    }),
    vue({
      template: {
        compilerOptions: { // ts config

        },
        transformAssetUrls: {
          base: null,
          includeAbsolute: false
        }
      }
    })
  ]
})
