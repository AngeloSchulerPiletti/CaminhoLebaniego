<template>
  <div class="wrapper flex_c">
    <div class="top flex_c">
      <h2 class="title2">{{ title }}</h2>
      <p
        v-if="daysExcerptsData.observation"
        v-html="daysExcerptsData.observation"
      ></p>
    </div>
    <div class="controllers flex_r" v-if="total && total > 1">
      <div
        :id="'day' + day"
        v-for="day in total"
        :key="day"
        :class="(day == 1 ? 'active' : '') + ' hover2 selector2'"
        @click="changeDailyExcerpt(day, $event)"
      >
        <span class="number">{{ day }}</span>dia
      </div>
    </div>
    <div class="content_wrapper flex_c">
      <div
        :class="'day_info ' + daysExcerptsData.content[index].trekData.class"
      >
        <div class="text_wrapper flex_c">
          <h3 class="title3-1" v-if="daysExcerptsData.content[index].title">
            {{ daysExcerptsData.content[index].title }}
          </h3>
          <p
            v-for="(p, parIndex) in daysExcerptsData.content[index].paragraphs"
            :key="parIndex"
          >
            {{ p }}
          </p>
        </div>
        <div
          class="trek_info flex_c"
          v-if="daysExcerptsData.content[index].trekData.class == 'hasTrekData'"
        >
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
      <div
        class="img_colection"
        v-if="
          daysExcerptsData.imgsBasePath && daysExcerptsData.imgsBasePath != ''
        "
      >
        <img
          :src="`${$store.state.urlApiBase}images/pages${daysExcerptsData.imgsBasePath}day${(index + 1)}/img${imgIndex}.jpg`"
          v-for="imgIndex in Number(
            daysExcerptsData.content[index].totalImages
          )"
          :key="imgIndex"
          :id="'img' + imgIndex"
          alt=""
          @click="showImg(imgIndex)"
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
    showImg(imgIndex) {
      var img = this.$el.querySelector("#img" + imgIndex);
      this.$store.commit("passingImgSrc", img.getAttribute("src"));
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
  gap: 2vw;

  .top {
    padding: 0 10vw;
    gap: 10px;

    p {
      color: $white;
      font-size: 18px;
      @include Font0;
      text-align: justify;
    }
  }
  .controllers {
    justify-content: space-around;
    padding: 8px 10vw;
    border-top: 2px solid $red;
    border-bottom: 2px solid $red;
    box-shadow: 0 0 18px 0px #000;
    margin-bottom: 2vw;

    .number{
      font-size: 2em;
    }
  }
  .content_wrapper {
    gap: 8vw;

    .hasTrekData {
      display: grid;
      grid-template-columns: 7fr 3fr;
      gap: 5vw;
    }
    .day_info {
      padding: 0 5vw;

      .text_wrapper {
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
        height: fit-content;
        gap: 5px;

        p {
          color: $black;
          font-size: 1.1em;
          @include Font0;
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
        -o-object-fit: cover;
        cursor: pointer;
        transition: opacity 400ms;

        &:hover {
          opacity: 0.5;
        }
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

@media (max-width: 900px) {
  .wrapper {
    gap: 50px;

    .top {
      gap: 18px;

      p {
        font-size: 16px;
      }
    }
    .content_wrapper {
      .hasTrekData {
        grid-template-columns: 9fr 4fr;
      }
      .day_info {
        .text_wrapper {
          p {
            text-indent: 2em;
          }
        }
        .trek_info {
          padding: 15px;
          gap: 7px;

          p {
            font-size: 0.9em;
          }
        }
      }
      .img_colection {
        grid-template-columns: 1fr 1fr;
        gap: 3vw;
      }
    }
  }
}

@media (max-width: 600px) {
  .wrapper {
    .top {
      p {
        font-size: 15px;
      }
    }
    .controllers {
      .hover2 {
        font-size: 25px;
      }
    }
    .content_wrapper {
      .hasTrekData {
        grid-template-columns: auto;
      }
      .day_info {
        padding: 0 38px;
        .trek_info {
          background-color: transparent;
          border: 1px solid $red;
          p {
            color: $white;
            font-size: 1em;
          }
        }
      }
      .img_colection {
        grid-template-columns: 90%;
        justify-content: center;
        gap: 20px;
      }
    }
  }
}

@media (max-width: 400px) {
  .wrapper {
    .controllers {
      padding: 8px 20px;
      .hover2 {
        font-size: 22px;
      }
    }
  }
}
</style>
