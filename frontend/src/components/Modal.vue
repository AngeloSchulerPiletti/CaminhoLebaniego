<template>
  <transition name="fade">
    <aside v-if="show" id="great_modal" @click="closeModal">
      <div id="modal_container">
        <article
          id="markdown_article"
          v-if="modalPage != ''"
          v-html="modalPage"
        ></article>
        <div id="modal_options" v-if="modalOptions != {}">
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
      if (event.path.length <= 7) {
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
    overflow-y: auto;
    border-radius: 7px;
    max-height: 90vh;

    #markdown_article {
      background-color: $black;
      border-radius: 7px 7px 0px 0px;
      padding: 30px;
      max-height: 60vh;
      overflow-y: auto;

      @include articleStyle;
      
    }
    #modal_options {
      background-color: $gray3;
      padding: 20px;
      border-radius: 0px 0px 7px 7px;

      display: flex;
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
