<template>
  <div class="wrapper">
    <title-special char="O" rest="Caminho Lebaniego" broken="off" />
    <div class="paragraphs_slider">
      <div class="controllers">
        <div
          class="backest_controller arrow_containers"
          @click="changeParagraphByValue(0)"
        >
          <arrow :class="'backest arrow ' + pClass" />
          <arrow :class="'backest arrow ' + pClass" />
        </div>
        <div class="simples">
          <arrow
            :class="'back arrow disabled ' + pClass"
            @click="changeParagraphByIncrease(-1)"
          />
          <arrow
            :class="'next arrow toright ' + pClass"
            @click="changeParagraphByIncrease(1)"
          />
        </div>
        <div
          class="nextest_controller arrow_containers"
          @click="changeParagraphByValue(this.total - 1)"
        >
          <arrow :class="'nextest arrow toright ' + pClass" />
          <arrow :class="'nextest arrow toright ' + pClass" />
        </div>
      </div>
      <p :class="pClass">
        {{ sliderParagraphs[index] }}
      </p>
    </div>
  </div>
</template>

<script>
import Arrow from "@/components/SVGs/Arrow";
import TitleSpecial from "@/components/elements/TitleSpecial.vue";

export default {
  data() {
    return {
      pClass: "",
      index: 0,
    };
  },
  methods: {
    changeParagraphByValue(value) {
      if (value >= 0 && value < this.total) {
        this.pClass = "active";

        setTimeout(() => {
          this.index = value;
          this.pClass = "";
        }, 450);
      }
      setTimeout(() => {
        switch (value) {
          case 0:
            this.enableDisabledArrow();
            this.disableArrowByClassName("back");
            break;
          case this.total - 1:
            this.enableDisabledArrow();
            this.disableArrowByClassName("next");
            console.log("disabling next");
            break;
          default:
            break;
        }
      }, 450);
    },
    changeParagraphByIncrease(action) {
      console.log("called this");
      var result = this.index;
      result += action;

      if (result >= 0 && result < this.total) {
        this.increaseIndex(action);
      }

      setTimeout(() => {
        if (result > 0 && result < this.total) {
          this.enableDisabledArrow();
        }

        result == 0 ? this.disableArrowByClassName("back") : null;
        result == this.total - 1 ? this.disableArrowByClassName("next") : null;
      }, 450);
    },
    enableDisabledArrow() {
      if (this.$el.querySelector(".disabled")) {
        this.$el.querySelector(".disabled").classList.remove("disabled");
      }
    },
    disableArrowByClassName(className) {
      this.$el.querySelector("." + className).classList.add("disabled");
    },
    increaseIndex(increaser) {
      this.pClass = "active";

      setTimeout(() => {
        this.index += increaser;
        this.pClass = "";
      }, 450);
    },
  },
  props: {
    sliderParagraphs: Object,
    total: Number,
  },
  components: {
    Arrow,
    TitleSpecial,
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  .paragraphs_slider {
    padding: 0 10vw;
    margin: auto;

    p {
      margin-top: 2vw;
      position: relative;
      color: $white;
      padding: 10px 20px;
      display: flex;
      align-items: center;

      &::before {
        content: "";
        position: absolute;
        height: 100%;
        left: 0;
        right: 100%;
        background-color: $red;
        border-left: 3px solid $red;

        transition: right 220ms ease;
      }
      &.active::before {
        left: 0;
        right: 0;
      }
    }

    .controllers {
      margin-top: 1vw;
      display: flex;
      gap: 10px;
      justify-content: space-between;

      &:deep(.arrow) {
        cursor: pointer;
        width: 28px;
        height: 28px;

        &.active {
          pointer-events: none;
          opacity: 0.3;
        }
        &.disabled {
          opacity: 0.3;
          cursor: default;
        }
        &.toright {
          transform: scaleX(-1);
        }

        path {
          fill: $white;
        }
        transition: transform 300ms;

        &.back:hover {
          transform: scale(1.1);
        }
        &.next:hover {
          transform: scaleX(-1) scale(1.1);
        }
      }

      .arrow_containers {
        transition: transform 300ms;
        &:hover {
          transform: scale(1.1);
        }
      }
      .backest_controller {
        .arrow:nth-child(2) {
          transform: translateX(-50%);
        }
      }
      .nextest_controller {
        .arrow:nth-child(2) {
          transform: translateX(-50%) scaleX(-1);
        }
      }
    }
  }
}
</style>
