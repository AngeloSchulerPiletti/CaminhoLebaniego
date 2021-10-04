<template>
  <div class="wrapper" v-if="errorsToShow.length > 0">
    <div
      class="err_card"
      v-for="(err, index) in errorsToShow"
      :key="index"
      data-anim="none"
    >
      <p>{{ err }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errorsToShow: [],
    };
  },
  computed: {
    errors() {
      return this.$store.state.errors;
    },
  },
  watch: {
    errors: {
      immediate: false,
      handler(newval) {
        this.errorsToShow = newval;

        setTimeout(() => {
          var cards = this.$el.querySelectorAll(".err_card");
          const time = 500;

          for (let i = 0; i < cards.length; i++) {
            setTimeout(() => {
              cards[i].dataset.anim = "on";
              setTimeout(() => {
                cards[i].dataset.anim = "off";
                if (i + 1 == cards.length) this.errorsToShow = [];
              }, time * 12);
            }, time * (i + 1));
          }
        }, 0);
      },
    },
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  position: fixed;
  z-index: 100000;
  top: 18vh;
  left: 0;
  display: flex;
  flex-direction: column;
  gap: 1vw;

  .err_card {
    background: linear-gradient(60deg, #fffffff0 20%, #ffffffc0);
    padding: 8px 20px;
    border-left: 5px solid $red;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    box-shadow: 0 0 10px #000;

    p {
      @include Font0;
      font-size: 14px;
    }
  }

  [data-anim] {
    transition: transform 400ms ease;
  }
  [data-anim="none"] {
    transform: translateX(-100%);
  }
  [data-anim="on"] {
    transform: translateX(0);
  }
  [data-anim="off"] {
    transform: translateX(-100%);
  }
}
</style>
