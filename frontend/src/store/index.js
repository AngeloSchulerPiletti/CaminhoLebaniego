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
      console.log(src);
      src != "" ? document.body.style.overflowY = "hidden" : document.body.style.overflowY = "auto";
      state.imgSrc = src;
    },
    checkIfHasScroll(state) {
      console.log("VueX commited");
      if (document.body.scrollHeight > window.innerHeight) {
        state.hasScroll = "on";
      console.log("result: on");
      } else {
        state.hasScroll = "off";
        console.log("result: off");
      }
    },
  },
  actions: {
  },
  modules: {
  }
})
