import { createStore } from 'vuex';

export default createStore({
  state: {
    modalShow: false,
    htmlMetaData: {
    titleTemplate: "%% | Caminho Lebaniego",
    }
  },
  mutations: {
    setTitle(state, addTitle) {
      document.title = state.htmlMetaData.titleTemplate.replace('%%', addTitle);
    },
  },
  actions: {
  },
  modules: {
  }
})
