import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from "path";
import tailwindcss from "tailwindcss";
export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/aff-fe/src/main.js',
        // 'resources/css/*',
      ],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }), tailwindcss()
  ],
  build: {
		rollupOptions: {
			output: {
				manualChunks(id) {
					if (id.includes('node_modules')) {
						return 'vendor';
					}
				}
			}
		},
		chunkSizeWarningLimit: 10000
	}
});

