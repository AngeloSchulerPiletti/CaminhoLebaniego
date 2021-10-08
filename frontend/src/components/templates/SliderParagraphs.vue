<template>
  <div class="wrapper">
    <title-special
      class="slider_title"
      char="O"
      rest="Caminho Lebaniego"
      broken="off"
    />
    <div class="paragraphs_slider">
      <p
        :class="pClass"
        @touchstart="dragStart = $event.changedTouches[0].clientX"
        @touchend="draged($event.changedTouches[0].clientX)"
        @mousedown="dragStart = $event.x"
        @mouseup="draged($event.x)"
      >
        {{ sliderParagraphs[index] }}
      </p>
      <div class="controllers">
        <div
          class="backest_controller arrow_containers"
          @click="changeParagraphByValue(0)"
        >
          <arrow :class="'arrow ' + pClass" />
          <arrow :class="'arrow ' + pClass" />
        </div>
        <div class="simples">
          <arrow
            :class="'back arrow ' + pClass"
            @click="changeParagraphByIncrease(-1)"
          />
          <arrow
            :class="'next arrow toright ' + pClass"
            @click="changeParagraphByIncrease(1)"
          />
        </div>
        <!-- <div
          class="nextest_controller arrow_containers"
          @click="changeParagraphByValue(this.total - 1)"
        >
          <arrow :class="'arrow toright ' + pClass" />
          <arrow :class="'arrow toright ' + pClass" />
        </div> -->
      </div>
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
      dragStart: 0,
    };
  },
  watch: {
    index: {
      immediate: true,
      handler(newVal) {
        this.setEnabledAndDisabledArrow();
      },
    },
  },
  methods: {
    changeParagraphByValue(value) {
      if (value >= 0 && value < this.total && value != this.index) {
        this.increaseIndex(value, true);
      }
    },
    changeParagraphByIncrease(action) {
      let result = this.index + action;
      if (result >= 0 && result < this.total && result != this.index) {
        this.increaseIndex(action);
      }
    },
    draged(dragEnd) {
      if (Math.abs(this.dragStart - dragEnd) < 20) return;
      if (this.dragStart > dragEnd) {
        this.changeParagraphByIncrease(1);
      } else if (this.dragStart < dragEnd) {
        this.changeParagraphByIncrease(-1);
      }
    },
    setEnabledAndDisabledArrow(timeout = 0) {
      setTimeout(() => {
        var i = this.index;
        switch (i) {
          case 0:
            this.disableArrowByClassName("back");
            break;
          case this.total - 1:
            this.disableArrowByClassName("next");
            break;
          default:
            this.enableDisabledArrow();
            break;
        }
      }, timeout);
    },
    enableDisabledArrow() {
      if (this.$el.querySelector(".disabled")) {
        this.$el.querySelector(".disabled").classList.remove("disabled");
      }
    },
    disableArrowByClassName(className) {
      this.$el.querySelector("." + className).classList.add("disabled");
    },
    increaseIndex(increaser, nominal = false) {
      this.pClass = "active";

      setTimeout(() => {
        nominal ? (this.index = increaser) : (this.index += increaser);
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
      text-align: justify;
      cursor: default;
      user-select: none;

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

@media (max-width: 600px) {
  .wrapper {
    .slider_title {
      margin: 0 -4vw;
    }
    .paragraphs_slider {
      padding: 0 6vw;

      .controllers {
        margin-top: 20px;
      }
    }
  }
}
</style>
