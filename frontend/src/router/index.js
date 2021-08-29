import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import Caminho from "@/views/Caminho.vue";
import Artigos from "@/views/Artigos.vue";
import Preparacao from "@/views/Preparacao.vue";
import Contato from "@/views/Contato.vue";
import Autor from "@/views/Autor.vue";

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/caminho',
    name: 'Caminho',
    component: Caminho
  },
  {
    path: '/preparacao',
    name: 'Preparacao',
    component: Preparacao
  },
  {
    path: '/contato',
    name: 'Contato',
    component: Contato
  },
  {
    path: '/artigos',
    name: 'Artigos',
    component: Artigos
  },
  {
    path: '/autor',
    name: 'Autor',
    component: Autor
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
