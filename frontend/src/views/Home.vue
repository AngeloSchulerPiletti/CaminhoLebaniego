<template>
  <app-layout backID="0" :modalContent="pageData['modal']">
    <template v-slot:header_sec>
      <banner-content :pageData="pageData" />
      <div id="actions" class="flex_r">
        <div class="btn_1" @click="$store.state.modalShow = true">
          História do Caminho
        </div>
        <!-- <router-link to="/caminho">
          <div class="btn_1">
            Primeiros Passos
          </div>
        </router-link> -->
      </div>
    </template>
  </app-layout>
</template>

<script>
// @ is an alias to /src
import AppLayout from "@/views/layouts/Public.vue";
import BannerContent from "@/components/Header/BannerContent.vue";

export default {
  name: "inicio",
  methods: {},
  created() {
    this.$store.commit("setTitle", "Início");
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
  },
};
</script>

<style lang="scss" scoped>
#actions {
  position: absolute;
  bottom: 16%;
  right: 0;
  left: 0;
  padding: 0 10vw 0 10vw;

  justify-content: space-between;
}

@media (max-width: 700px) {
  #actions {
    flex-direction: column;
    align-items: center;
    gap: 5vw;
  }
}
</style>
