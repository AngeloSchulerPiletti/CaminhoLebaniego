<template>
  <div id="website_container">
    <div id="pic_background" :class="'background back-' + backID">
      <header-component />
      <section>
        <slot name="header_sec"></slot>
      </section>
    </div>
    <div v-if="backID != 0">
      <main>
        <slot name="main"></slot>
      </main>
      <footer>Footer</footer>
    </div>
  </div>
</template>

<script>
import Header from "@/components/Header";
export default {
  data() {
    return {
      //
    };
  },
  props: {
    backID: String,
  },
  components: {
    "header-component": Header,
  },
};
</script>

<style lang="scss">
@font-face {
    font-family: MonAmour;
    src: url('../assets/fonts/MonAmour.ttf');
}


#pic_background{
  width: 100%;
  height: 100vh;
  max-height: 80vw;
}
.background{
  background-size: cover;
  background-position-y: bottom;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-0{
  background-image: url('../assets/images/template/walkerman.jpg');
}
.back-1{
  background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url("../assets/images/template/santiago.jpg");
  background-size: cover;
  background-position-y: bottom;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-2{
  background-image: url("../assets/images/template/equipment.jpg");
}
.back-3{
background-image: url("../assets/images/template/writter.jpg");
  background-position-y: 80%;
}
.back-4{
background-image: url("../assets/images/template/trekkingman.jpg");
  background-position-y: top;
}
.back-5{
background-image: url("../assets/images/template/mail.jpg");
  background-position-y: top;
}
</style>
