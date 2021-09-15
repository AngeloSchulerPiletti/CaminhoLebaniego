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
            {{sliderParagraphs.content}}
          </p>
          <div class="controllers">
            <arrow class="back arrow" @click="changeParagraph(-1)"/>
            <arrow class="next arrow" @click="changeParagraph(1)"/>
          </div>
        </div>
      </section>
      <section id="sec2">
        <div>
          <img :src="'/src/assets/images/pages/caminho/img'+sliderImages1.imgIndex+'.jpg'" alt="">
        </div>
        <div>
          <div>
            <h2>sliderImages1.title</h2>
            <p>sliderImages1.paragraph</p>
          </div>
          <div>
            <div class="btn_3">
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
  data(){
    return{
      pClass:"",
      sliderParagraphs: {
        content: "",
        index: 0,
        tam: 0,
      },
      sliderImages1:{
        imgIndex: "",
        title: "",
        paragraph: "",
      },
    }
  },
  computed:{
    availableParagraphs(){
      this.sliderParagraphs.tam = Object.values(this.pageData['sliderParagraphs']).length;
      if (this.sliderParagraphs.tam > 0) {
        this.sliderParagraphs.content = Object.values(this.pageData['sliderParagraphs'])[this.sliderParagraphs.index];
      }
    }
  },
  watch: {
    availableParagraphs(){},
  },
  methods: {
    changeParagraph(action){
      this.pClass = "active";
      setTimeout(() => {
        var result = this.sliderParagraphs.index;
        result += action;
        this.sliderParagraphs.index += (result >= 0) ? (result < this.sliderParagraphs.tam ? action : 0) : 0;
        this.pClass = "";
      }, 850);  
    }
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
    width: 100%;
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
  .paragraphs_slider{
    padding: 0 10vw;
    margin: auto;

    p{
    margin-top: 2vw;
      position: relative;
      @include Font1;
      font-size: 16px;
      color: $white;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      line-height: 1.45em;

      &::before{
        content: "";
        position: absolute;
        height: 100%;
        left: 0;
        right: 100%;
        background-color: $red;
        border-left: 3px solid $red;

        transition: right 500ms ease;
      }
      &.active::before{
        left: 0;
        right: 0;
      }
    }
    .controllers{
      margin-top: 1vw;
      display: flex;
      gap: 10px;
      justify-content: flex-end;

      &:deep(.arrow){
        cursor: pointer;
        width: 28px;
        height: 28px;
        path{
          fill: $white;
        }

        transition: transform 300ms;
      }
      &:deep(.back):hover{
        transform: scale(1.1);
      }
      &:deep(.next):hover{
        transform: scale(1.1) scaleX(-1);
      }
      // .back{

      // }
      .next{
        transform: scale(1) scaleX(-1);
      }
    }
  }
}
</style>
