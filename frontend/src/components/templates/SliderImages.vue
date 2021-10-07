<template>
  <div :class="'wrapper f_' + alignment">
    <div :class="'img_container ' + img1Class">
      <img
        :class="{ hided: img - 1 !== this.index }"
        v-for="img in total"
        :key="img"
        :src="
          'http://localhost:8000/images/pages/caminho/slider/img' +
            (img - 1) +
            '.jpg'
        "
        alt=""
      />
    </div>
    <div class="asider">
      <div class="top">
        <h2 class="title1">{{ sliderImagesData[index].title }}</h2>
        <p>{{ sliderImagesData[index].paragraph }}</p>
      </div>
      <div class="bottom">
        <div :class="'btn_3 ' + img1Class" @click="changeImage(-1)">
          Anterior
        </div>
        <div :class="'btn_3 ' + img1Class" @click="changeImage(1)">
          Próxima
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      img1Class: "",
      index: 0,
    };
  },
  methods: {
    changeImage(action) {
      this.img1Class = "active";

      setTimeout(() => {
        var result = this.index;
        result += action;
        this.index +=
          result >= 0
            ? result < this.total
              ? action
              : -(this.total - 1)
            : this.total - 1;
      }, 300);
      setTimeout(() => {
        this.img1Class = "";
      }, 600);
    },
  },
  props: {
    sliderImagesData: Object,
    total: Number,
    alignment: String,
  },
};
</script>

<style lang="scss" scoped>
.f_left {
  flex-direction: row;
  .asider {
    margin-right: 10vw;
  }
}
.f_right {
  flex-direction: row-reverse;
  .asider {
    margin-left: 10vw;
  }
}

.wrapper {
  display: flex;
  gap: 5vw;

  .img_container {
    box-shadow: 0 0 10px 2px #000;
    position: relative;
        width: 40vw;
        height: 30vw;

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

      &.hided {
        display: none;
      }
    }
  }
  .asider {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 20px 0;

    .top {
      color: $white;
      display: flex;
      flex-direction: column;
      gap: 20px;

      p {
        text-indent: 1em;
        text-align: justify;
      }
    }
    .bottom {
      display: flex;
      gap: 20px;

      .btn_3.active {
        pointer-events: none;
      }
    }
  }
}

@media (max-width: 800px) {
  .wrapper {
    .img_container {
      box-shadow: 0 0 12px 3px #000;
        width: 52vw;
        height: 38vw;

      img {
        width: 52vw;
        height: 38vw;
      }
    }
    .asider {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 20px 0;

      .top {
        color: $white;
        display: flex;
        flex-direction: column;
        gap: 20px;

        p {
          text-indent: 1em;
        }
      }
      .bottom {
        display: flex;
        gap: 20px;
        margin-top: 15px;

        .btn_3.active {
          pointer-events: none;
        }
      }
    }
  }
}
</style>
