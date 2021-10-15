<template>
  <app-layout backID="2">
    <template v-slot:header_sec>
      <banner-content :hasArrow="true" :pageData="pageData" />
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
          alignment="left"
        />
      </section>
      <section id="sec3">
        <map-component />
      </section>
      <section id="sec4">
        <days-excerpts-nav
          :daysExcerptsData="pageData.dailyExcerpts[0]"
          :total="pageData.dailyExcerpts[1]"
          title="Trechos"
        />
      </section>
      <!-- <section id="sec4">
        <div class="top">
          <h3 class="title1">Observação</h3>
        </div>
        <observation
          :paragraphs="pageData.observations[0][0].paragraphs"
          :type="pageData.observations[0][0].type"
        />
      </section> -->
      <section id="sec5">
        <days-excerpts-nav
          :daysExcerptsData="pageData.trekObservations[0]"
          :total="pageData.trekObservations[1]"
          title="As Setas do Caminho"
        />
      </section>
    </template>
  </app-layout>
</template>
<script>
// @ is an alias to /src
import AppLayout from "@/views/layouts/Public.vue";
import BannerContent from "@/components/Header/BannerContent.vue";
import SliderParagraphs from "@/components/SliderParagraphs";
import SliderImages from "@/components/SliderImages";
import DaysExcerptsNav from "@/components/DaysExcerptsNav";
import Observation from "@/components/Observation";
import MapComponent from "@/components/MapComponent";

export default {
  name: "caminho",
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
    MapComponent,
  },
};
</script>

<style lang="scss" scoped>
#sec2 {
  margin-top: 170px;
}
#sec3 {
  margin-top: 120px;
}
#sec4 {
  margin-top: 120px;
}
#sec5 {
  margin-top: 170px;
}
</style>
