import { defineConfig } from "vite";
import { fileURLToPath, URL } from "url"; //novo
import vue from "@vitejs/plugin-vue";

// https://vite.dev/config/
export default defineConfig({
    plugins: [vue()],
    build: {
        outDir: "../../../public/taskList", //para projetos laravel-api
    },
    base: "/taskList/",
    resolve: {
        alias: {
            "@": "/src",
            "@stores": "/src/stores",
        },
    },
});
