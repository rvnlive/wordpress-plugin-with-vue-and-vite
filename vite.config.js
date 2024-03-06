import {defineConfig} from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path'; // Make sure to import 'path'
import {fileURLToPath, URL} from 'url';

// https://vitejs.dev/config/
export default defineConfig({
  build: {
    outDir: path.resolve(__dirname, 'wordpress-plugin/dist'), // Specify the output directory
    rollupOptions: {
      output: {
        // Entry file name for the initial JavaScript file
        entryFileNames: 'assets/index.js',
        // Provide a pattern for chunk files to avoid conflicts, without hash for simplicity
        chunkFileNames: 'assets/[name].js',
        // Asset files (e.g., CSS, images) file naming pattern
        assetFileNames: 'assets/[name].[ext]',
      },
    }
  },
  plugins: [vue()],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
});
