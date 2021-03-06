import { createStore } from 'vuex';
import createPersistedState from "vuex-persistedstate";

export default createStore({
  state: {
    urlApiBase: "https://caminholebaniego.com.br/api-access/",
    // urlApiBase: "http://192.168.0.12:8000/api-access/",
    urlAppBase: "caminholebaniego.com.br",
    modalShow: false,
    searchModalShow: false,
    htmlMetaData: {
      titleTemplate: "%% | Caminho Lebaniego",
    },
    imgSrc: "",
    hasScroll: "off",
    sessionData: {
      user: undefined,
      token: undefined,
    },
    bags: {
      errors: [],
      messages: [],
    },
    logged: false,
  },
  mutations: {
    setErrors(state, errors) {
      var actualTitle = document.title;
      document.title = state.htmlMetaData.titleTemplate.replace('%%', 'Ops!');
      setTimeout(() => {
        document.title = actualTitle;
      }, 2000);
      state.bags.errors = errors;
    },
    setMessages(state, messages) {
      var actualTitle = document.title;
      document.title = state.htmlMetaData.titleTemplate.replace('%%', 'Sucesso!');
      setTimeout(() => {
        document.title = actualTitle;
      }, 2000);
      state.bags.messages = messages;
    },
    cleanBag(state, bag){
      state.bags[bag] = [];
    },
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
    setSessionData(state, sessionData) {
      state.sessionData.user = sessionData.user;
      state.sessionData.token = sessionData.token;
      state.logged = sessionData.logged;
    },
  },
  actions: {
  },
  modules: {
  },
  plugins: [
    createPersistedState({
      storage: window.sessionStorage,
    }),
  ],
})
