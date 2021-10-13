<template>
  <div :class="'wrapper f_' + alignment">
    <div
      :class="'img_container ' + img1Class"
      @touchstart="dragStart = $event.changedTouches[0].clientX"
      @touchend="draged($event.changedTouches[0].clientX)"
      @mousedown="dragStart = $event.x"
      @mouseup="draged($event.x)"
    >
      <img
        :class="{ hided: img - 1 !== this.index }"
        v-for="img in total"
        :key="img"
        :src="
          'http://192.168.0.12:8000/images/pages/caminho/slider/img' +
            (img - 1) +
            '.jpg'
        "
        alt=""
        draggable="false"
      />
    </div>
    <div class="asider flex_c">
      <div class="top flex_c">
        <h2 class="title1">{{ sliderImagesData[index].title }}</h2>
        <p>{{ sliderImagesData[index].paragraph }}</p>
      </div>
      <div class="bottom flex_r">
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
      dragStart: 0,
      dragAvailable: true,
      promiseRunning: false,
    };
  },
  methods: {
    draged(dragEnd) {
      if (!this.dragAvailable && Math.abs(this.dragStart - dragEnd) < 20)
        return;
      this.dragAvailable = false;
      if (this.dragStart > dragEnd) {
        this.changeImage(1);
      } else if (this.dragStart < dragEnd) {
        this.changeImage(-1);
      }
    },
    async changeImage(action) {
      if (this.promiseRunning) return;
      this.promiseRunning = true;
      return new Promise((resolve, reject) => {
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
          resolve();
        }, 600);
      }).then(() => {
        this.dragAvailable = true;
        this.promiseRunning = false;
      });
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
    justify-content: space-between;
    padding: 20px 0;

    .top {
      color: $white;
      gap: 20px;

      p {
        text-indent: 1em;
        text-align: justify;
      }
    }
    .bottom {
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
      .bottom {
        margin-top: 15px;
      }
    }
  }
}

@media (max-width: 600px) {
  .wrapper {
    flex-direction: column !important;

    .img_container {
      width: 80vw;
      height: 50vw;
      margin: auto;

      img {
        width: 80vw;
        height: 50vw;
      }
    }
    .asider {
      width: 80%;
      margin: auto;
      padding: 0;
    }
  }
}
</style>
