<template>
  <app-layout backID="2">
    <template v-slot:header_sec>
      <banner-content :pageData="pageData" />
    </template>
    <template v-slot:main>
      <section id="sec1">
        <slider-paragraphs
          :sliderParagraphs="pageData.sliderParagraphs[0]"
          :total="pageData.sliderParagraphs[1]"
        />
      </section>
      <section id="sec2">
        <slider-images
          :sliderImagesData="pageData.sliderImages1[0]"
          :total="pageData.sliderImages1[1]"
        />
      </section>
      <section id="sec3">
        <days-excerpts-nav
          :daysExcerptsData="pageData.dailyExcerpts[0]"
          :total="pageData.dailyExcerpts[1]"
        />
      </section>
      <section id="sec4">
        <div class="top">
          <h3 class="title1">Observação</h3>
        </div>
        <observation
          :paragraphs="pageData.observations[0][0].paragraphs"
          :type="pageData.observations[0][0].type"
        />
      </section>
    </template>
  </app-layout>
</template>
<script>
// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";
import BannerContent from "@/components/header/BannerContent.vue";
import SliderParagraphs from "@/components/elements/SliderParagraphs";
import SliderImages from "@/components/elements/SliderImages";
import DaysExcerptsNav from "@/components/elements/DaysExcerptsNav";
import Observation from "@/components/elements/Observation";
import ErrorSection from "@/components/elements/errors/ErrorSection";

export default {
  name: "caminho",
  inject: ["URL_API"],
  data() {
    return {};
  },
  mounted() {
    // this.setActivedDay();
  },
  methods: {},
  created() {
    this.$store.commit("setTitle", "Caminho");
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
    SliderParagraphs,
    SliderImages,
    DaysExcerptsNav,
    Observation,
    ErrorSection,
  },
};
</script>

<style lang="scss" scoped>
#sec1 {
}
#sec2 {
  margin-top: 8vw;
}
#sec3 {
  margin-top: 9vw;
}
#sec4{
  margin-top: 10vw;

  .top{
    padding-left: 10vw;
    margin-bottom: 1vw;
  }
}
</style>
