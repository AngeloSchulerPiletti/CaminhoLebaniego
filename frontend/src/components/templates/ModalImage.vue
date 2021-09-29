<template>
  <transition name="fade">
    <div
      class="wrapper"
      v-if="$store.state.imgSrc != ''"
      @click="closeModal($event)"
    >
      <div class="img_container">
        <img :src="$store.state.imgSrc" alt="" />
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  methods: {
    closeModal(event) {
      if (event.target.className == "wrapper") {
        this.$store.commit("passingImgSrc", "");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 500ms ease;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.wrapper {
  background-color: #000000b0;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 10000;

  .img_container {
    width: fit-content;
    height: fit-content;
    box-shadow: 0 0 4vw 1vw $blackest;
    margin: 10vh auto;

    img {
      max-width: 80vw;
      max-height: 80vh;
      object-fit: contain;
    }
  }
}
</style>
