import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueMeta from 'vue-meta'

createApp(App)
.provide('URL_API', "http://127.0.0.1:8000/api/")
.use(store)
.use(VueMeta, {
    keyName: 'htmlMetaInfo',
})
.use(router)
.use(VueAxios, axios)
.mount('#app')

