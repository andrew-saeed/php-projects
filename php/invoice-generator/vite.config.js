import path from 'path'
import fs from 'fs'
import { defineConfig } from 'vite'

const ROOT = path.resolve('')
const BASE = __dirname.replace(ROOT, '')

export default defineConfig({
  base: BASE,
  server: {
    port: 4200
  },
  build: {
    manifest: 'manifest.json',
    assetsDir: '.',
    outDir: `public/dist`,
    emptyOutDir: true,
    sourcemap: true,
    rollupOptions: {
      input: [
        'resources/js/index.js',
        'resources/css/index.scss',
      ],
      output: {
        entryFileNames: '[hash].js',
        assetFileNames: '[hash].[ext]',
      },
      external: (id) => id.includes('index.php')
    },
  },
  plugins: [
    {
      name: 'php',
      handleHotUpdate({ file, server }) {
        if (file.endsWith('.twig')) {
          server.ws.send({ type: 'full-reload' });
        }
      },
      closeBundle() {
        const file = path.resolve(BASE, 'public/dist', 'index.php');
        if (fs.existsSync(file)) fs.unlinkSync(file)
      }
    },
  ],
})