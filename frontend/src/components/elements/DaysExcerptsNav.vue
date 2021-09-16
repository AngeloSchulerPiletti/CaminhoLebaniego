<template>
  <div class="wrapper">
    <div class="top">
      <h2 class="title2">Trechos</h2>
      <p>Para fazer o trecho entre San Vicente de La Barquera a Santo Toribio de Liébana, o Guia distribuído pelo Governo da Cantabria sugere<span class="highlighter1"> 3 ou 5 etapas</span> (dias). Mas na verdade, cada um define seu ritmo. Eu fiz esse trajeto em <span class="highlighter1">quatro dias</span>:</p>
    </div>
    <div class="controllers">
      <div
        :id="'day' + day"
        v-for="day in total"
        :key="day"
        :class="(day == 1 ? 'active' : '') + ' hover2 selector2'"
        @click="changeDailyExcerpt(day, $event)"
      >
        {{ day }}dia
      </div>
    </div>
    <div class="content_wrapper">
      <div class="day_info">
        <div class="p_wrapper">
          <p
            v-for="(p, parIndex) in daysExcerptsData[index].paragraphs"
            :key="parIndex"
          >
            {{ p }}
          </p>
        </div>
        <div class="trek_info">
          <p>Local de Partida: <span>{{ daysExcerptsData[index].from }}</span></p>
          <p>Destino: <span>{{ daysExcerptsData[index].to }}</span></p>
          <p>Distância: <span>{{ daysExcerptsData[index].distance }}Km</span></p>
        </div>
      </div>
      <div class="img_colection">
        <img
          :src="
            './images/pages/caminho/excerpts/day' +
              (index + 1) +
              '/img' +
              imgIndex +
              '.jpg'
          "
          v-for="imgIndex in Number(daysExcerptsData[index].totalImages)"
          :key="imgIndex"
          alt=""
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      index: 0,
      lastActive: false,
    };
  },
  methods: {
    changeDailyExcerpt(day, event) {
      var lastOne = this.lastActive;
      lastOne ? lastOne.classList.remove("active") : false;

      this.lastActive = event.target;
      event.target.classList.add("active");
      this.index = day - 1;

      var imgColection = this.$el.querySelector('.img_colection');
      imgColection.classList.add('active');
      setTimeout(() => {
        imgColection.classList.remove('active');
      }, 400);
    },
  },
  mounted() {
    this.lastActive = this.$el.querySelector("#day1");
  },
  props: {
    daysExcerptsData: Object,
    total: Number,
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  display: flex;
  flex-direction: column;
  gap: 2vw;

  .top {
      padding: 0 10vw;
      display: flex;
      flex-direction: column;
        gap: 10px;

      p{
          color: $white;
          font-size: 18px;
          @include Font0;
      }
  }
  .controllers {
    display: flex;
    justify-content: space-around;
    padding: 5px 10vw;
    border-top: 2px solid $red;
    border-bottom: 2px solid $red;
        box-shadow: 0 0 18px 0px #000;
        margin-bottom: 2vw;
  }
  .content_wrapper {
      display: flex;
      flex-direction: column;
      gap: 8vw;

    .day_info {
      padding: 0 5vw;
      display: grid;
      grid-template-columns: 7fr 3fr;
      gap: 5vw;

      .p_wrapper {
          display: flex;
          flex-direction: column;
          gap: 1em;

          p{
              color: $white;
              text-indent: 1em;
              text-align: justify;
          }
      }
      .trek_info {
          background-color: $white;
          padding: 20px;
        box-shadow: 0 0 12px 3px #000;
        display: flex;
        flex-direction: column;
        height: fit-content;
        gap: 5px;

        p {
            color: $black;
            font-size: 1.1em;
            @include Font0;

            span{
                // color: $white;
                // font-size: 1.25em;
            }
        }
      }
    }
    .img_colection {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 2vw;
        padding: 0 6.5vw;

        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        position: relative;

        &::before, &::after{
          content: "";
          position: absolute;
          top: 0;
          bottom: 0;
          background-color: $red;
        
          transition: left 400ms, right 400ms;
        }
        &::before{
          left: 0;
          right: 100%;
        }
        &::after{
          left: 100%;
          right: 0;
        }

        &.active::before{
          right: 30%;
        }
        &.active::after{
          left: 30%;
        }
        
    }
  }
}
</style>
