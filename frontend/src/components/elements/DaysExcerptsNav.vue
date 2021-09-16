<template>
  <div class="wrapper">
    <div class="top">
      <h2 class="title2">{{ title }}</h2>
      <p
        v-if="daysExcerptsData.observation"
        v-html="daysExcerptsData.observation"
      ></p>
    </div>
    <div class="controllers" v-if="total && total > 1">
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
      <div
        :class="'day_info ' + daysExcerptsData.content[index].trekData.class"
      >
        <div class="p_wrapper">
          <p
            v-for="(p, parIndex) in daysExcerptsData.content[index].paragraphs"
            :key="parIndex"
          >
            {{ p }}
          </p>
        </div>
        <div class="trek_info" v-if="daysExcerptsData.content[index].trekData.class == 'hasTrekData'">
          <p>
            Local de Partida:
            <span>{{ daysExcerptsData.content[index].trekData.from }}</span>
          </p>
          <p>
            Destino:
            <span>{{ daysExcerptsData.content[index].trekData.to }}</span>
          </p>
          <p>
            Distância:
            <span
              >{{ daysExcerptsData.content[index].trekData.distance }}Km</span
            >
          </p>
        </div>
      </div>
      <div class="img_colection" v-if="daysExcerptsData.imgsBasePath && daysExcerptsData.imgsBasePath != ''">
        <img
          :src="
            './images/pages'+daysExcerptsData.imgsBasePath+'day' +
              (index + 1) +
              '/img' +
              imgIndex +
              '.jpg'
          "
          v-for="imgIndex in Number(
            daysExcerptsData.content[index].totalImages
          )"
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

      var imgColection = this.$el.querySelector(".img_colection");
      imgColection.classList.add("active");
      setTimeout(() => {
        imgColection.classList.remove("active");
      }, 400);
    },
  },
  mounted() {
    this.lastActive = this.$el.querySelector("#day1");
  },
  props: {
    daysExcerptsData: Object,
    total: Number,
    title: String,
    imgsBasePath: String,
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

    p {
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

    .hasTrekData {
      display: grid;
      grid-template-columns: 7fr 3fr;
      gap: 5vw;
    }
    .day_info {
      padding: 0 5vw;
      .p_wrapper {
        display: flex;
        flex-direction: column;
        gap: 1em;

        p {
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

          span {
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

      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      position: relative;

      &::before,
      &::after {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        background-color: $red;

        transition: left 400ms, right 400ms;
      }
      &::before {
        left: 0;
        right: 100%;
      }
      &::after {
        left: 100%;
        right: 0;
      }

      &.active::before {
        right: 30%;
      }
      &.active::after {
        left: 30%;
      }
    }
  }
}
</style>
