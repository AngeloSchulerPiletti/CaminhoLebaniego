import { createStore } from 'vuex';
import createPersistedState from "vuex-persistedstate";

export default createStore({
  state: {
    urlBase: "http://127.0.0.1:8000/",
    modalShow: false,
    htmlMetaData: {
      titleTemplate: "%% | Caminho Lebaniego",
    },
    imgSrc: "",
    hasScroll: "off",
    sessionData:{
      user: undefined,
      token: undefined,
    },
    logged: false,
  },
  mutations: {
    setTitle(state, addTitle) {
      document.title = state.htmlMetaData.titleTemplate.replace('%%', addTitle);
    },
    passingImgSrc(state, src) {
      src != "" ? document.body.style.overflowY = "hidden" : document.body.style.overflowY = "auto";
      state.imgSrc = src;
    },
    checkIfHasScroll(state) {
      if (document.body.scrollHeight > window.innerHeight) {
        state.hasScroll = "on";
      } else {
        state.hasScroll = "off";
      }
    },
    setSessionData(state, sessionData){
      state.sessionData.user = sessionData.user;
      state.sessionData.token = sessionData.token;
      state.logged = sessionData.logged;
    },
  },
  actions: {
  },
  modules: {
  },
  plugins: [createPersistedState()],
})
