<template>
  <div :id="backType+'background'" :class="'flex_c background back-' + backID">
    <header-component />
    <section id="header_content">
      <slot name="header_sec"></slot>
    </section>
  </div>
</template>

<script>
import Header from "@/components/Header/Header.vue";

export default {
    data(){
        return{
            backType: "pic_",
        }
    },
    computed:{
        checkIsArticle(){
            return this.isArticle;
        },
    },
    watch: {
        checkIsArticle: {
            immediate: true,
            handler(newval){
                this.backType = newval ? "article_" : "pic_"; 
            },
        }
    },
  props: {
    backID: String,
    isArticle: Boolean,
  },
  components: {
    "header-component": Header,
  },
};
</script>

<style lang="scss" scoped>
#pic_background {
  width: 100%;
  height: 100vh;

  z-index: 100;
  position: relative;
  box-shadow: 0 0 10px 4px #000;

  #header_content {
    position: relative;
    flex-grow: 1;
  }
}
#article_background{
    background-color: transparent;
}
.background {
  background-size: cover;
  background-position-y: bottom;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-0 {
  background-image: url("../../assets/images/template/walkerman.jpg");
  overflow-y: hidden;
}
.back-1 {
  background-image: url("../../assets/images/template/equipment.jpg");
  background-position-x: left;
}
.back-2 {
  background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
    url("../../assets/images/template/SantoToribio.jpg");
  background-size: cover;
  background-position-y: 30%;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-3 {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
    url("../../assets/images/template/trekkingman.jpg");
  background-size: cover;
  background-position-y: top;
  background-position-x: center;
  background-repeat: no-repeat;
}
.back-4 {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
    url("../../assets/images/template/writter.jpg");
  background-size: cover;
  background-position-y: 80%;
  background-position-x: 28%;
  background-repeat: no-repeat;
}
.back-5 {
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
    url("../../assets/images/template/mail.jpg");
  background-size: cover;
  background-position-y: top;
  background-position-x: 40%;
  background-repeat: no-repeat;
}
</style>
