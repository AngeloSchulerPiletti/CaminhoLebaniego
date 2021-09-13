import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import Caminho from "@/views/Caminho.vue";
import Artigos from "@/views/Artigos.vue";
import Preparacao from "@/views/Preparacao.vue";
import Contato from "@/views/Contato.vue";
import Experiencia from "@/views/Experiencia.vue";

const routes = [
  {
    path: '/',
    name: 'inicio',
    component: Home
  },
  {
    path: '/caminho',
    name: 'caminho',
    component: Caminho
  },
  {
    path: '/preparacao',
    name: 'preparacao',
    component: Preparacao
  },
  {
    path: '/contato',
    name: 'contato',
    component: Contato
  },
  {
    path: '/artigos',
    name: 'artigos',
    component: Artigos
  },
  {
    path: '/experiencia',
    name: 'experiencia',
    component: Experiencia
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
