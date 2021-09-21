import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { createHead } from '@vueuse/head'

const head = createHead()

createApp(App)
.use(store)
.use(head)
.use(router)
.use(VueAxios, axios)
.mount('#app')

