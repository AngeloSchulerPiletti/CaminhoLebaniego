<template>
  <transition name="fade">
    <div class="back_view" v-if="show" @click="closeModal($event)">
      <div class="container">
        <div class="top">
          <h3 class="title4-1">{{ title }}</h3>
        </div>
        <div v-if="paragraphs" v-html="paragraphs" class="main"></div>
      </div>
    </div>
  </transition>
</template>

<script>
import { apiRequestProtocol } from "@/service/api.js";

export default {
  data() {
    return {
      title: "Carregando...",
      paragraphs: null,
      show: false,
    };
  },
  computed: {
    whichInfoCall() {
      return this.whichInfo;
    },
  },
  watch: {
    whichInfoCall(newval) {
      if (newval && newval != "") {
        this.show = true;
        this.getInfo(newval);
        document.body.style.overflowY = "hidden";
      }
    },
  },
  methods: {
    getInfo(which) {
      if (which && which != "") {
        apiRequestProtocol(this.$store.state.sessionData.token)
          .post(`admin-information/article/${which}`)
          .then((response) => {
            this.title = response.data.infoModal.title;
            this.paragraphs = response.data.infoModal.paragraphs;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    closeModal(event = null) {
      if (!event || event.path.length <= 8) {
        this.show = false;
        this.$emit("modalClosed");
        document.body.style.overflowY = "auto";
        this.paragraphs = null;
        this.title = "Carregando...";
      }
    },
  },
  props: {
    whichInfo: String,
  },
};
</script>

<style lang="scss" scoped>
.back_view {
  position: fixed;
  z-index: 10000;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: #000000d0;

  .container {
    width: 80%;
    max-height: 80vh;
    margin: 10vh auto;
    background-color: $white;
    box-shadow: 0 0 10px 5px #000;
    border-top-left-radius: 20px;
    border-bottom-right-radius: 20px;
    padding: 2vw;

    .top {
      padding-bottom: 1vw;
      margin-bottom: 2vw;
      position: relative;

      &::before,
      &::after {
        content: "";
        position: absolute;
        bottom: 0;
        border-bottom: 2px solid $red;
      }
      &::before {
        left: 0;
        width: 25%;
      }
      &::after{
          left: 26%;
          width: 2%;
      }
    }
    .main {
      overflow-y: auto;

      &:deep() {
        p {
          @include Font0;
          font-size: 15px;
        }
      }
    }
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 450ms;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
