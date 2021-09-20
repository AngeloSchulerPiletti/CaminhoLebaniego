import { createStore } from 'vuex';

export default createStore({
  state: {
    modalShow: false,
    htmlMetaData: {
      titleTemplate: "%% | Caminho Lebaniego",
    },
    imgSrc: "",
    hasScroll: "off",
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
  },
  actions: {
  },
  modules: {
  }
})
