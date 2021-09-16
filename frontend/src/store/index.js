import { createStore } from 'vuex';

export default createStore({
  state: {
    modalShow: false,
    htmlMetaData: {
      titleTemplate: "%% | Caminho Lebaniego",
    },
    imgSrc: "",
  },
  mutations: {
    setTitle(state, addTitle) {
      document.title = state.htmlMetaData.titleTemplate.replace('%%', addTitle);
    },
    passingImgSrc(state, src){
      console.log(src);
      src != "" ? document.body.style.overflowY = "hidden" : document.body.style.overflowY = "auto";
     state.imgSrc = src;
    },
  },
  actions: {
  },
  modules: {
  }
})
