<template>
  <app-layout backID="2">
    <template v-slot:header_sec>
      <banner-content :pageData="pageData" />
    </template>
    <template v-slot:main>
      <section id="sec1">
        <div class="title_special">
          <div class="special_char">
            O
          </div>
          <h1>Caminho Lebaniego</h1>
        </div>
        <div class="paragraphs_slider">
          <p :class="pClass">
            {{ sliderParagraphs.content }}
          </p>
          <div class="controllers">
            <arrow :class="'back arrow '+pClass" @click="changeParagraph(-1)" />
            <arrow :class="'next arrow '+pClass" @click="changeParagraph(1)" />
          </div>
        </div>
      </section>
      <section id="sec2">
        <div :class="'img_container ' + img1Class">
          <img
            :src="'./images/pages/caminho/img' + sliderImages1.index + '.jpg'"
            alt=""
          />
        </div>
        <div class="asider">
          <div class="top">
            <h2>{{ sliderImages1.title }}</h2>
            <p>{{ sliderImages1.paragraph }}</p>
          </div>
          <div class="bottom">
            <div :class="'btn_3 '+img1Class" @click="changeImage(-1)">
              Anterior
            </div>
            <div :class="'btn_3 '+img1Class" @click="changeImage(1)">
              Próxima
            </div>
          </div>
        </div>
      </section>
    </template>
  </app-layout>
</template>
<script>
// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";
import BannerContent from "@/components/header/BannerContent.vue";
import Arrow from "@/components/SVGs/Arrow";

export default {
  name: "caminho",
  inject: ["URL_API"],
  data() {
    return {
      pClass: "",
      img1Class: "",
      sliderParagraphs: {
        content: "",
        index: 0,
        tam: 0,
      },
      sliderImages1: {
        title: "",
        paragraph: "",
        index: 0,
        tam: 0,
      },
    };
  },
  mounted() {
    // console.log(this.pageData["sliderImages1"]);
  },
  computed: {
    availableParagraphs() {
      this.sliderParagraphs.tam = this.pageData["sliderParagraphs"][1];
      if (this.sliderParagraphs.tam > 0) {
        this.sliderParagraphs.content = Object.values(
          this.pageData["sliderParagraphs"][0]
        )[this.sliderParagraphs.index];
      }
    },
    availableImages1() {
      this.sliderImages1.tam = this.pageData["sliderImages1"][1];
      if (this.sliderImages1.tam > 0) {
        this.sliderImages1.title = this.pageData["sliderImages1"][0][
          this.sliderImages1.index
        ].title;
        this.sliderImages1.paragraph = this.pageData["sliderImages1"][0][
          this.sliderImages1.index
        ].paragraph;
      }
    },
  },
  watch: {
    availableParagraphs() {},
    availableImages1() {},
  },
  methods: {
    changeParagraph(action) {
      this.pClass = "active";
      setTimeout(() => {
        var result = this.sliderParagraphs.index;
        result += action;
        this.sliderParagraphs.index +=
          result >= 0 ? (result < this.sliderParagraphs.tam ? action : 0) : 0;
        this.pClass = "";
      }, 850);
    },
    changeImage(action) {
      this.img1Class = "active";

      setTimeout(() => {
        var result = this.sliderImages1.index;
        result += action;
        this.sliderImages1.index +=
          result >= 0
            ? result < this.sliderImages1.tam
              ? action
              : -(this.sliderImages1.tam - 1)
            : this.sliderImages1.tam - 1;
       
      }, 300); 
      setTimeout(() => {
          this.img1Class = "";
      }, 600);
    },
  },
  created(){
    this.$store.commit('setTitle', "Caminho");
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
    Arrow,
  },
};
</script>

<style lang="scss" scoped>
#sec1 {
  .title_special {
    display: flex;
    align-items: baseline;
    gap: 20px;
    padding: 0 10vw;
    @include Drawed1;

    .special_char {
      background-color: $red;
      color: $white;
      font-size: 90px;
      padding: 10px 8px;
    }
    h1 {
      font-size: 40px;
      color: $white;
    }
  }
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

        &.active{
          pointer-events: none;
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
#sec2 {
  display: flex;
  gap: 5vw;
  margin-top: 8vw;

  .img_container {
    box-shadow: 0 0 10px 2px #000;
    position: relative;

    &::before {
      content: "";
      position: absolute;
      z-index: 100;
      top: 0;
      right: 0;
      bottom: 100%;
      left: 100%;

      background-color: $red;
    }
    &.active::before {
      animation: cornerTopRight 600ms ease 0ms 1 normal both;
    }

    img {
      width: 40vw;
      height: 30vw;
      object-fit: cover;
    }
  }
  .asider {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-right: 10vw;
    padding: 20px 0;

    .top {
      color: $white;
      display: flex;
      flex-direction: column;
      gap: 20px;

      h2 {
        @include Drawed1;
        font-size: 35px;

        &::first-letter {
          color: $red;
        }
      }
      p {
        text-indent: 1em;
      }
    }
    .bottom {
      display: flex;
      gap: 20px;

      .btn_3.active{
        pointer-events: none;
      }
    }
  }
}
</style>
