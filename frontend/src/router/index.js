import { createRouter, createWebHistory } from 'vue-router';
import store from '../store'

/* ============= VIEWS ============== */
import Home from '@/views/Home.vue';
import Caminho from "@/views/Caminho.vue";
import Artigos from "@/views/Artigos.vue";
import Preparacao from "@/views/Preparacao.vue";
import Contato from "@/views/Contato.vue";
import Experiencia from "@/views/Experiencia.vue";
import Error404 from "@/views/error/Error404.vue";
import Login from "@/views/admin/Login.vue";
import Dashboard from "@/views/admin/Dashboard";
import CreateArticle from "@/views/admin/Features/CreateArticle";
import ChangePages from "@/views/admin/Features/ChangePages";



const routes = [
  {
    path: '/',
    name: 'inicio',
    component: Home,
    props: true,
    meta: {
      autoAxios: true,
    },
  },
  {
    path: '/caminho',
    name: 'caminho',
    component: Caminho,
    props: true,
    meta: { autoAxios: true },
  },
  {
    path: '/preparacao',
    name: 'preparacao',
    component: Preparacao,
    props: true,
    meta: { autoAxios: true },
  },
  {
    path: '/contato',
    name: 'contato',
    component: Contato,
    props: true,
    meta: { autoAxios: true },
  },
  {
    path: '/artigos',
    name: 'artigos',
    component: Artigos,
    props: true,
    meta: { autoAxios: true },
  },
  {
    path: '/experiencia',
    name: 'experiencia',
    component: Experiencia,
    props: true,
    meta: { autoAxios: true },
  },
  {
    path: "/error404",
    name: 'error404',
    component: Error404,
    props: true,
    meta: { autoAxios: false },
  },
  {
    path: "/acesso",
    name: "login",
    component: Login,
    meta: { autoAxios: false },
    beforeEnter: (to, from, next) => {
      if (store.state.logged) {
        next("/area-do-administrador");
      }
      else {
        next();
      }
    },
  },
  {
    path: "/area-do-administrador",
    component: Dashboard,
    children: [
      {
        path: "", 
        component: CreateArticle,
        name: "admin",
      },
      {path: "criar-artigo", component: CreateArticle,
      name: "criar_artigos",},
      {path: "alterar-paginas", component: ChangePages,
      name: "alterar_paginas",}
    ],
    meta: { autoAxios: false, },
    beforeEnter: (to, from, next) => {
      if (store.state.logged) {
        next();
      }
      else {
        next('/acesso');
      }
    },
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

import {apiRequestProtocol} from "@/service/api.js";

router.beforeEach(async to => {
  store.state.modalShow = false;
  store.state.hasScroll = "off";

  if (to.meta.autoAxios) {
    await apiRequestProtocol().get(`content/${to.name}`).then(response => {
      to.params.pageData = response.data
    }).catch(error => {
      router.push({ name: 'error404' })
      return false
    });
  }
}
);

router.afterEach((to, from) => {
  setTimeout(() => {
    store.commit('checkIfHasScroll');
  }, 0);
});

export default router
