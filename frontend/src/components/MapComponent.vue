<template>
  <div class="wrapper">
    <h6
      v-if="width < 550"
      class="title4"
    >
      Vire o dispositivo para vizualizar melhor
    </h6>
    <div class="img_wrapper">
      <img
        :src="`${$store.state.urlApiBase}images/pages/caminho/map/mapa1.jpg`"
      />
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      width: window.innerWidth,
    }
  },
  mounted(){
    this.$nextTick(()=>{
      window.addEventListener('resize', ()=>{this.width = window.innerWidth});
    });
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
    margin: auto;
    width: fit-content;
  h6 {
    font-size: 9px;
    font-weight: 300;
    margin-bottom: 8px;
  }

  .img_wrapper {
    border: 1px solid $red;
    padding: 6px 6px 4px 6px;
    box-shadow: 0px 0px 16px 4px #000;

    img {
      width: 80vw;
      max-width: 900px;
    }
  }
}
</style>
