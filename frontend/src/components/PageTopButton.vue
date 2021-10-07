<template>
  <div class="wrapper button" @click="goUp">
    <arrow-up />
  </div>
</template>

<script>
import ArrowUp from "@/components/SVGs/ArrowUp.vue";
import { scrollingTo } from "@/modules/scrolling.js";

export default {
  components: { ArrowUp },
  methods: {
    goUp() {
      scrollingTo(0);
    },
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  position: fixed;
  left: 5vw;
  bottom: 10vh;
  z-index: 10000;

  &.button {
    border-radius: 50%;
    background-color: $red;
    box-shadow: 0 0 15px #000;
    padding: 5px;
    width: 30px;
    height: 30px;
    cursor: pointer;

    transition: box-shadow 200ms, opacity 300ms;

    &:deep() {
      svg {
        width: 100%;
        height: 100%;
        path {
          fill: $white;
        }
      }
    }

    &:hover{
        box-shadow: 0;
        opacity: 0.7;
    }
  }
}


@media (max-width: 900px){
  .wrapper {
  left: 0;

  &.button {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    padding: 8px;

    transition: box-shadow 200ms, opacity 300ms;

    &:deep() {
      svg {
        width: 100%;
        height: 100%;
        path {
          fill: $white;
        }
      }
    }

    &:hover{
        box-shadow: 0;
        opacity: 0.7;
    }
  }
}
}

@media (max-width: 600px){
  .wrapper{
    &.button{
      width: 24px;
      height: 24px;
    }
  }
}
</style>
