import { createRouter, createWebHistory } from 'vue-router';
import store from '../store'
import axios from "axios";
import Home from '@/views/Home.vue';
import Caminho from "@/views/Caminho.vue";
import Artigos from "@/views/Artigos.vue";
import Preparacao from "@/views/Preparacao.vue";
import Contato from "@/views/Contato.vue";
import Experiencia from "@/views/Experiencia.vue";
import Error404 from "@/views/error/Error404.vue";



const routes = [
  {
    path: '/',
    name: 'inicio',
    component: Home,
    props: true,
    meta: {autoAxios: true},
  },
  {
    path: '/caminho',
    name: 'caminho',
    component: Caminho,
    props: true,
    meta: {autoAxios: true},
  },
  {
    path: '/preparacao',
    name: 'preparacao',
    component: Preparacao,
    props: true,
    meta: {autoAxios: true},
  },
  {
    path: '/contato',
    name: 'contato',
    component: Contato,
    props: true,
    meta: {autoAxios: true},
  },
  {
    path: '/artigos',
    name: 'artigos',
    component: Artigos,
    props: true,
    meta: {autoAxios: true},
  },
  {
    path: '/experiencia',
    name: 'experiencia',
    component: Experiencia,
    props: true,
    meta: {autoAxios: true},
  },
  {
    path: "/error404",
    name: 'error404',
    component: Error404,
    props: true,
    meta: {autoAxios: false},
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

const URL_API = "http://127.0.0.1:8000/api/";

router.beforeEach(async to => {
  store.state.modalShow = false;
  if(to.meta.autoAxios){
  await axios.get(`${URL_API}content/${to.name}`).then(response => {
    to.params.pageData = response.data
  }).catch( error => {
    router.push({name: 'error404'})
    return false
  });
  }
}
)

export default router
