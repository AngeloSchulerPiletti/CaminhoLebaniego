<template>
  <div class="wrapper">
    <title-special char="O" rest="Caminho Lebaniego" broken="off" />
    <div class="paragraphs_slider">
      <p :class="pClass">
        {{ sliderParagraphs[index] }}
      </p>
      <div class="controllers">
        <arrow
          :class="'back arrow disabled ' + pClass"
          @click="changeParagraph(-1)"
        />
        <arrow :class="'next arrow ' + pClass" @click="changeParagraph(1)" />
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
    };
  },
  methods: {
    changeParagraph(action) {
      var result = this.index;
      result += action;
      console.log('result: '+result+' & '+'total: '+this.total);

      if (result >= 0 && result < this.total) {
        this.pClass = "active";

        setTimeout(() => {
          this.index += action;
          this.pClass = "";
        }, 850);
      }

      setTimeout(() => {
        if (result > 0 && result < this.total) {

          var arrows = this.$el.querySelectorAll(".arrow");
          arrows.forEach((el) => {
            if (el.classList.contains("disabled")) {
              el.classList.remove("disabled");
            }
          });

        } 
        if (result == 0) {
          this.$el.querySelector(".back").classList.add("disabled");
        }
        if(result == this.total - 1){
          this.$el.querySelector(".next").classList.add("disabled");
        }
      }, 870);
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

        transition: right 500ms ease;
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
      justify-content: flex-end;

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

        path {
          fill: $white;
        }

        transition: transform 300ms;
      }
      &:deep(.back):hover {
        transform: scale(1.1);
      }
      &:deep(.next):hover {
        transform: scale(1.1) scaleX(-1);
      }
      // .back{

      // }
      .next {
        transform: scale(1) scaleX(-1);
      }
    }
  }
}
</style>
