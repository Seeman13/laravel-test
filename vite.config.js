import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  build: {
    target: 'esnext',
    // sourcemap: true
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
