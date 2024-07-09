//  Configuration Vite

// import { defineConfig } from "vite";
// import VueDevTools from "vite-plugin-vue-devtools";
// import vue from "@vitejs/plugin-vue";
// import { fileURLToPath, URL } from "node:url";

// export default defineConfig({
// 	plugins: [VueDevTools(), vue()],
// 	resolve: {
// 		alias: {
// 			"@": fileURLToPath(new URL("./src", import.meta.url)),
// 			"@components": fileURLToPath(
// 				new URL("./src/components", import.meta.url)
// 			),
// 		},
// 	},
// });
import { defineConfig } from "vite";
import VueDevTools from "vite-plugin-vue-devtools";
import vue from "@vitejs/plugin-vue";
import { fileURLToPath, URL } from "node:url";

export default defineConfig({
	plugins: [VueDevTools(), vue()],
	resolve: {
		alias: {
			"@": fileURLToPath(new URL("./src", import.meta.url)),
			"@components": fileURLToPath(
				new URL("./src/components", import.meta.url)
			),
		},
	},
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


