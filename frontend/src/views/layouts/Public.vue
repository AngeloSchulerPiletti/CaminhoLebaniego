<template>
  <transition name="fade">
    <div id="website_container" v-if="show">
      <bags-handle/>
      <great-modal
        :modalPage="modal['html']"
        :modalOptions="modal['options']"
      />
      <search-modal />
      <modal-image />
      <header-banner :backID="backID" :isArticle="isArticle">
        <template v-slot:header_sec><slot name="header_sec"></slot></template>
      </header-banner>
      <div v-if="backID != 0" class="mainFooterWrapper flex_c">
        <main>
          <slot name="main"></slot>
        </main>
        <footer-component />
      </div>
    </div>
  </transition>
</template>

<script>
import Header from "@/components/Header/Header";
import Modal from "@/components/Modal";
import Footer from "@/components/Footer";
import ModalImage from "@/components/ModalImage";
import SearchModal from "@/components/SearchModal";
import HeaderBanner from "@/components/Header/HeaderBanner.vue";
import BagsHandle from "@/components/BagsHandle";

export default {
  data() {
    return {
      show: false,
      modal: {
        html: "",
        options: {},
      },
    };
  },
  mounted() {
    this.show = true;
    if (typeof this.modalContent == "object") {
      this.modal.html =
        typeof this.modalContent[0] == "string" ? this.modalContent[0] : "";
      this.modal.options =
        typeof this.modalContent[1] == "object" ? this.modalContent[1] : {};
    }
  },
  props: {
    backID: String,
    modalContent: Object,
    isArticle: Boolean,
  },
  components: {
    "header-component": Header,
    "great-modal": Modal,
    "footer-component": Footer,
    ModalImage,
    SearchModal,
    HeaderBanner,
    BagsHandle,
  },
};
</script>

<style lang="scss">
.fade-enter-active,
.fade-leave-active {
  transition: opacity 700ms ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.mainFooterWrapper {
  gap: 15vw;
}
</style>
