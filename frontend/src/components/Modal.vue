<template>
  <transition name="fade">
    <aside v-if="show" id="great_modal" @click="closeModal">
      <div id="modal_container">
        <article-component :article="modalPage" />
        <!-- <article
          id="markdown_article"
          v-if="modalPage != ''"
          v-html="modalPage"
        ></article> -->
        <div id="modal_options" class="flex_r" v-if="modalOptions != {}">
          <router-link
            v-for="(route, name) in modalOptions"
            :key="name"
            :to="route"
          >
            <div class="btn_2">
              {{ name }}
            </div>
          </router-link>
        </div>
      </div>
    </aside>
  </transition>
</template>

<script>
import Article from "./templates/Article.vue";

export default {
  data() {
    return {
      show: false,
    };
  },
  computed: {
    modalState() {
      this.show = this.$store.state.modalShow;
    },
  },
  methods: {
    closeModal(event) {
      if (event.target.id == "great_modal") {
        this.$store.state.modalShow = false;
      }
    },
  },
  watch: {
    modalState() {},
  },
  props: {
    modalPage: String,
    modalOptions: Object,
  },
  components: { "article-component": Article },
};
</script>

<style lang="scss" scoped>
#great_modal {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 100000;
  background-color: #000000a0;

  #modal_container {
    margin: 10vh 10vw 0 10vw;
    border-radius: 7px;
    max-height: 90vh;
    overflow: hidden;

    &:deep(article) {
      background-color: $black;
      border-radius: 7px 7px 0px 0px;
      padding: 30px;
      max-height: 60vh;
      overflow-y: auto;
      width: auto;

      &::-webkit-scrollbar {
        width: 10px;
      }
      /* Track */
      &::-webkit-scrollbar-track {
        background: #1d1d1d;
      }
      /* Handle */
      &::-webkit-scrollbar-thumb {
        background: darken($red, 3%);
      }
      /* Handle on hover */
      &::-webkit-scrollbar-thumb:hover {
        background: darken($red, 10%);
      }
    }
    #modal_options {
      background-color: $gray3;
      padding: 20px;
      border-radius: 0px 0px 7px 7px;

      justify-content: space-between;
      align-items: center;
    }
  }
}

@media (max-width: 600px) {
  #great_modal {
    background-color: #000000c0;

    #modal_container {
      margin: 10vh 30px 0 30px;
      max-height: 90vh;
    }
  }
}

@media (max-width: 400px) {
  #great_modal {
    background-color: #000000d0;

    #modal_container {
      &:deep(article) {
      &::-webkit-scrollbar {
        width: 5px;
      }
      }
      #markdown_article {
        padding: 20px;
      }
      #modal_options {
        padding: 16px;
      }
    }
  }
}

/*+------------------------------------+
  |             TRANSITIONS            |
  +------------------------------------+*/
.fade-enter-active,
.fade-leave-active {
  transition: opacity 300ms;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
