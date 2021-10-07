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
import Admin from "@/layouts/Admin";
import CreateArticle from "@/views/admin/Features/CreateArticle";
import ChangePages from "@/views/admin/Features/ChangePages";
import ChangeArticles from "@/views/admin/Features/ChangeArticles";
import ArtigoShow from "@/views/ArtigoShow";
import ManageDraft from "@/views/admin/Features/ManageDraft";
import ManageTrash from "@/views/admin/Features/ManageTrash";
import SearchResult from "@/views/SearchResult";



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
    path: '/artigo',
    name: 'artigo_show',
    component: ArtigoShow,
    props: true,
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
  },
  {
    path: "/resultados-de-busca/:query",
    name: 'search_result',
    component: SearchResult,
    props: true,
    meta: { autoAxios: true },
  },
  {
    path: "/acesso",
    name: "login",
    component: Login,
    meta: { autoAxios: false },
    beforeEnter: (to, from, next) => {
      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        next('/');
      }
      else if (store.state.logged) {
        next("/area-do-administrador");
      }
      else {
        store.commit("setTitle", "Login");
        next();
      }
    },
  },
  {
    path: "/area-do-administrador/criar-artigo",
    alias: "/area-do-administrador",
    component: CreateArticle,
    name: "criar_artigos",
    props: true,
    meta: { autoAxios: false, mobileDenied: true},
  },
  {
    path: "/area-do-administrador/alterar-paginas",
    component: ChangePages,
    name: "alterar_paginas",
    meta: { autoAxios: false, mobileDenied: true},
  },
  {
    path: "/area-do-administrador/alterar-artigos",
    component: ChangeArticles,
    name: "alterar_artigos",
    meta: { autoAxios: false, mobileDenied: true},
  },
  {
    path: "/area-do-administrador/editar-artigo/:articleId",
    component: CreateArticle,
    name: "editar_artigo",
    meta: { autoAxios: false, mobileDenied: true},
    props: {editation: true},
  },
  {
    path: "/area-do-administrador/lixeira",
    component: ManageTrash,
    name: "trash",
    meta: { autoAxios: false, mobileDenied: true},
  },
  {
    path: "/area-do-administrador/rascunhos",
    component: ManageDraft,
    name: "drafts",
    meta: { autoAxios: false, mobileDenied: true},
  },


]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

import { apiRequestProtocol } from "@/service/api.js";

router.beforeEach(async to => {
  store.state.modalShow = false;
  store.state.hasScroll = "off";

  if (to.meta.autoAxios) {
    await apiRequestProtocol()
      .get(`content/${to.name}`)
      .then(response => {
        to.params.pageData = response.data
      })
      .catch(error => {
        router.push({ name: 'error404' })
        return false
      });
  }
  if(to.meta.mobileDenied){
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      router.push('/');
      return false;
    }
    else if (store.state.logged) {
      store.commit("setTitle", "Admin");
    }
    else {
      router.push('/acesso');
      return false;
    }
  }
}
);

router.afterEach((to, from) => {
  setTimeout(() => {
    store.commit('checkIfHasScroll');
  }, 0);
});

export default router
