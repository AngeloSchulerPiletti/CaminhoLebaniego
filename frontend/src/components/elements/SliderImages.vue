<template>
  <div class="wrapper">
    <div :class="'img_container ' + img1Class">
      <img
        :src="
          './images/pages/caminho/slider/img' + index + '.jpg'
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
    data(){
        return{
            img1Class: "",
            index: 0,
        }
    },
    props:{
        sliderImagesData: Object,
        total: Number,
    },
    methods:{
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
    }
};
</script>

<style lang="scss" scoped>
.wrapper {
  display: flex;
  gap: 5vw;

  .img_container {
    box-shadow: 0 0 10px 2px #000;
    position: relative;

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
    }
  }
  .asider {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-right: 10vw;
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

      .btn_3.active {
        pointer-events: none;
      }
    }
  }
}
</style>
