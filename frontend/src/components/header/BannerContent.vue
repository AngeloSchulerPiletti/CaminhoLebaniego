<template>
  <div id="bannerContent">
    <div class="text_content">
      <h1>{{ pageData["title"] }}</h1>
      <p v-if="pageData['paragraph']">{{ pageData["paragraph"] }}</p>
    </div>
    <div class="double_arrow" v-if="hasArrow" @click="scrollHeight">
      <tiny-arrow class="arrow" />
      <tiny-arrow class="arrow" />
    </div>
  </div>
</template>

<script>
import TinyArrow from "@/components/SVGs/TinyArrow";
import { scrollingTo, scrollToSec } from "@/scripts/modules/scrolling.js";

export default {
  data() {
    return {
      hasScroll: "off",
    };
  },
  methods: {
    scrollHeight() {
      scrollingTo(window.innerHeight);
    },
  },
  computed: {
    checkHasScrollState() {
      return this.$store.state.hasScroll;
    },
  },
  watch: {
    checkHasScrollState: {
      immediate: true,
      handler(newval) {
        this.hasScroll = newval;
      },
    },
  },
  props: {
    pageData: Object,
    hasArrow: Boolean,
  },
  components: {
    TinyArrow,
  },
};
</script>

<style lang="scss" scoped>
#bannerContent {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  .text_content {
    margin: 5vw 10vw 0 10vw;
    padding: 4vw;
    width: fit-content;
    color: $white;
    background: radial-gradient(
      closest-side at 40%,
      rgba(0, 0, 0, 0.6) 30%,
      rgba(0, 0, 0, 0.4) 60%,
      rgba(0, 0, 0, 0.2) 75%,
      transparent
    );

    h1 {
      // @include Title1;
      @include Drawed1;
      font-size: 50px;
    }
    p {
      font-size: 18px;
      margin-top: 1em;
      @include Font1;
    }
  }
  .double_arrow {
    $arrow_width: 150px;
    display: flex;
    flex-direction: column;
    margin: auto;
    margin-bottom: 0;
    width: $arrow_width;
    height: $arrow_width;
    padding: $arrow_width/2;
    cursor: pointer;
    background: radial-gradient(
      closest-side at 40%,
      rgba(0, 0, 0, 0.6) 30%,
      rgba(0, 0, 0, 0.4) 60%,
      rgba(0, 0, 0, 0.2) 75%,
      transparent
    );

    position: relative;
    .arrow {
      position: absolute;
      fill: $red;
      width: $arrow_width;
      animation: movingY 800ms ease-in-out 0ms infinite alternate-reverse both;

      &:nth-child(2) {
        top: $arrow_width/3;
      }
    }
  }
}

@media (max-width: 500px) {
  #bannerContent {
    .text_content {
      margin: 6vh 10vw 0 10vw;

      h1 {
        font-size: 35px;
      }
      p {
        font-size: 14px;
      }
    }
  }
}

@media (max-width: 390px){
  #bannerContent {
    .text_content {
      margin: 6vh 6vw 0 6vw;

      h1 {
        font-size: 30px;
      }
      p {
        font-size: 14px;
      }
    }
  }
}
</style>
