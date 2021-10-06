<template>
  <div id="bannerContent">
    <div class="text_content">
      <h1>{{ pageData["title"] }}</h1>
      <p v-if="pageData['paragraph']">{{ pageData["paragraph"] }}</p>
    </div>
    <div class="double_arrow" v-if="hasScroll == 'on'" @click="scrollHeight">
      <tiny-arrow class="arrow" />
      <tiny-arrow class="arrow" />
    </div>
  </div>
</template>

<script>
import TinyArrow from "@/components/SVGs/TinyArrow";
import { scrollingTo, scrollToSec } from "@/modules/scrolling.js";

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
    margin-left: 10vw;
    margin-top: 5vw;
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
      margin-top: 18px;
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
</style>
