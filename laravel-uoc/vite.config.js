import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/styles.css',
                'resources/css/sidebars.css',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', 
        port: 5173, 
        hmr: {
            host: 'dev2.aidea.cat', // Dominio que quieres usar
            protocol: 'https', // O 'http' si no usas SSL
        },
    },
    resolve: {
        alias: {
            sweetalert2: 'node_modules/sweetalert2/dist/sweetalert2.min.js', 
            '@': '/resources',// Alias para importar SweetAlert2 fácilmente
        },
    },
    build: {
        rollupOptions: {
            input: {
                main: 'resources/js/app.js', // Punto de entrada principal
            },
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name.endsWith('.png')) {
                        return 'assets/images/[name][extname]'; // Copia imágenes a build/assets/images
                    }
                    return 'assets/[name]-[hash][extname]'; // Para otros assets
                },
            },
        },
    },
});
