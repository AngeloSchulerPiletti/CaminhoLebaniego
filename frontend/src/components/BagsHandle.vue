<template>
  <div
    class="wrapper"
    v-if="errorsToShow.length > 0 || messagesToShow.length > 0"
  >
    <div
      class="errors card"
      v-for="(err, index) in errorsToShow"
      :key="index"
      data-anim="none"
    >
      <p>{{ err }}</p>
    </div>
    <div
      class="messages card"
      v-for="(mes, i) in messagesToShow"
      :key="i"
      data-anim="none"
    >
      <p>{{ mes }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errorsToShow: [],
      messagesToShow: [],
    };
  },
  computed: {
    errors() {
      return this.$store.state.bags.errors;
    },
    messages() {
      return this.$store.state.bags.messages;
    },
  },
  watch: {
    errors: {
      immediate: false,
      handler(newErrors) {
        this.errorsToShow = newErrors;
        setTimeout(() => {
          var cards = this.$el.querySelectorAll(".errors");
          this.settingTimeoutCard(cards, 500, 'errorsToShow');
        }, 0);
      },
    },
    messages: {
      immediate: false,
      handler(newMessages) {
        this.messagesToShow = newMessages;
        setTimeout(() => {
          var cards = this.$el.querySelectorAll(".messages");
          this.settingTimeoutCard(cards, 500, 'messagesToShow');
        }, 10);
      },
    },
  },
  methods: {
    settingTimeoutCard(cards, time, type) {
      for (let i = 0; i < cards.length; i++) {
        setTimeout(() => {
          cards[i].dataset.anim = "on";
          setTimeout(() => {
            cards[i].dataset.anim = "off";
            if (i + 1 == cards.length)
              setTimeout(() => {
                this[type] = [];
              }, time);
          }, time * 12);
        }, time * (i + 1));
      }
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

  .card {
    background: linear-gradient(60deg, #fffffff0 20%, #ffffffc0);
    padding: 8px 20px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    box-shadow: 0 0 10px #000;
    max-width: 30vw;

    &.errors {
      border-left: 5px solid $red;
    }
    &.messages {
      border-left: 5px solid #417e0f;
    }

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
