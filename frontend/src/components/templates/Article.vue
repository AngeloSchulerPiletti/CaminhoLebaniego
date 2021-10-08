<template>
  <article class="article_wrapper" v-html="article"></article>
</template>

<script>
export default {
  watch: {
    article(newval) {
      setTimeout(() => {
        var imgs = this.$el.querySelectorAll("img");
        for (let i = 0; i < imgs.length; i++) {
          imgs[
            i
          ].src = `${this.$store.state.urlApiBase}${this.imgs_path}/${this.imgs_names[i]}`;
        }
      }, 0);
    },
  },
  props: {
    article: String,
    imgs_path: String,
    imgs_names: Object,
  },
};
</script>

<style lang="scss" scoped>
.article_wrapper {
  width: 50vw;
  @include articleStyle;
}

@media (max-width: 900px) {
  .article_wrapper {
    width: 80vw;
  }
}

@media (max-width: 600px) {
  .article_wrapper {
    width: calc(100vw - 100px);
  }
}
</style>
