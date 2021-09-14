<template>
  <transition name="fade">
    <div id="website_container" v-if="show">
      <great-modal
        :modalPage="modal['html']"
        :modalOptions="modal['options']"
      />
      <div id="pic_background" :class="'background back-' + backID">
        <header-component />
        <section id="header_content">
          <slot name="header_sec"></slot>
        </section>
      </div>
      <div v-if="backID != 0">
        <main>
          <slot name="main"></slot>
        </main>
        <footer>Footer</footer>
      </div>
    </div>
  </transition>
</template>

<script>
import Header from "@/components/Header";
import Modal from "@/components/Modal";

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
  },
  components: {
    "header-component": Header,
    "great-modal": Modal,
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
#pic_background {
  width: 100%;
  height: 100vh;
  max-height: 80vw;

  display: flex;
  flex-direction: column;
}
.background {
  background-size: cover;
  background-position-y: bottom;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-0 {
  background-image: url("../assets/images/template/walkerman.jpg");
}
.back-1 {
  background-image: url("../assets/images/template/equipment.jpg");
}
.back-2 {
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
    url("../assets/images/template/santiago.jpg");
  background-size: cover;
  background-position-y: 70%;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-3 {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
    url("../assets/images/template/trekkingman.jpg");
  background-size: cover;
  background-position-y: top;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-4 {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
    url("../assets/images/template/writter.jpg");
  background-size: cover;
  background-position-y: 80%;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-5 {
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
    url("../assets/images/template/mail.jpg");
  background-size: cover;
  background-position-y: top;
  background-position-x: center;
  background-repeat: no-repeat;
}

#header_content {
  position: relative;
  flex-grow: 1;
}
</style>
