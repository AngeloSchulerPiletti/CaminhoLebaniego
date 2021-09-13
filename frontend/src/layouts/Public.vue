<template>
  <div id="website_container">
    <div id="pic_background" :class="'background back-' + backID">
      <header-component/>
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
  props:{
      backID: String,
  },
  components:{
    'header-component': Header,
  },
}
</script>

<style lang="scss">
#website_container{

}
#pic_background{
  width: 100vw;
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
</style>