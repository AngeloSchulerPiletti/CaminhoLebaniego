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
  min-width: 500px;
  max-width: 800px;
  margin: auto;

  &::v-deep() {
    color: $white;

    .simple_p {
      text-align: justify;
      text-indent: 1.2em;
      margin: 0.6em 0;
    }
    .img_container {
      position: relative;
      $img_padding: 10px;
      padding: $img_padding;

      &::before,
      &::after {
        position: absolute;
        content: "";
      }

      figcaption {
        @include Font2_I;
        font-size: 14px;
        margin-top: 3px;
      }

      img {
        object-fit: contain;
        width: 100%;
        height: 100%;
      }
      &.left {
        margin-right: auto;
      }
      &.center {
        margin: auto;
      }
      &.right {
        margin-left: auto;
      }

      &.small {
        width: 24%;
      }
      &.medium {
        width: 38%;
      }
      &.big {
        width: 50%;
      }

      &.left.style1 {
        &::before {
          @include pseudoStyle1(left, $img_padding);
        }
      }
      &.right.style1 {
        &::before {
          @include pseudoStyle1(right, $img_padding);
        }
      }

      &.left.style2 {
        &::before {
          @include pseudoStyle2(top, left);
        }
      }
      &.right.style2 {
        &::before {
          @include pseudoStyle2(top, right);
        }
      }
      &.left.style3 {
        &::before {
          @include pseudoStyle3(left, bottom, $img_padding);
        }
        &::after {
          @include pseudoStyle3(right, top, $img_padding);
        }
      }
      &.right.style3 {
        &::before {
          @include pseudoStyle3(right, bottom, $img_padding);
        }
        &::after {
          @include pseudoStyle3(left, top, $img_padding);
        }
      }
    }

    em {
      font-style: italic;
    }
    strong {
      font-weight: 800;
    }

    hr {
      background-color: $red;
      outline: 0 0 0 0;
      border: none;
      margin: 1vw 0;
      width: 50%;

      &.gorgeous {
        height: 2px;
      }
      &.tiny {
        height: 1px;
      }

      &.left {
        margin-right: auto;
      }
      &.center {
        margin: auto;
      }
      &.right {
        margin-left: auto;
      }
      &.all {
        width: 90%;
        margin: auto;
      }
    }

    h1 {
      margin: 0.2em 0;
      @include Drawed1;
      font-size: 54px;

      &::first-letter {
        color: $red;
        font-size: 1.25em;
      }
    }
    h2 {
      margin: 0.3em 0;
      @include Title2;
      font-size: 28px;
      position: relative;
      padding-left: 8px;

      &::before {
        position: absolute;
        content: "";
        border-left: 3px solid $red;
        left: 0;
        top: 0;
        bottom: 0;
      }
    }
    h3 {
      margin: 0.3em 0;
      @include Title3;
      font-size: 26px;
    }
    h4 {
      margin: 0.2em 0;
      @include Title3;
      font-size: 22px;
    }
    h5,
    h6 {
      margin: 0.2em 0;
      &::before {
        content: ">";
        color: $red;
        font-family: Arial, Helvetica, sans-serif;
        margin-left: 5px;
      }
    }
    h5 {
      @include Title3;
      font-size: 20px;
    }
    h6 {
      @include Title3_I;
      font-size: 18px;
    }

    ul {
      display: flex;
      flex-direction: column;
      gap: 4px;
      margin-left: 1.2em;

      li {
        @include Font1;
        position: relative;

        &::before {
          content: "-";
          margin-right: 6px;
          color: $red;
        }
      }
    }

    a {
      color: lighten($red, 5%);
      font-weight: 700;
      position: relative;

      transition: color 100ms;

      &::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        border-bottom: 1px solid $red;

        transition: right 200ms, left 200ms;
      }

      &:hover {
        color: $red;
        &::before {
          left: 50%;
          right: 50%;
        }
      }
    }

    .warn {
      @include observationPreset(100%);
      margin: 45px 0;
    }
    .quotes {
      @include observationPreset(100%);
      margin: 25px 0;
    }
  }
}

@media (max-width: 900px) {
  .article_wrapper {
    width: 80vw;

    &::v-deep() {
      .img_container {
        &.small {
          width: 30%;
        }
        &.medium {
          width: 45%;
        }
        &.big {
          width: 60%;
        }
      }

      h1 {
        font-size: 50px;
      }

      .warn {
        margin: 45px 0;
      }
      .quotes {
        margin: 25px 0;
      }
    }
  }
}

@media (max-width: 600px) {
  .article_wrapper {
    width: calc(100vw - 100px);
    min-width: 0;
    margin: auto;

    &::v-deep() {
      .simple_p {
        text-indent: 1.8em;
        font-size: 15px;
      }
      .img_container {
        &.small {
          width: 45%;
        }
        &.medium {
          width: 70%;
        }
        &.big {
          width: 100%;
        }
      }

      h1 {
        font-size: 38px;
      }
      h2 {
        margin: 0.45em 0;
        font-size: 25px;
        padding-left: 10px;
      }
      h3 {
        font-size: 22px;
      }
      h4 {
        margin: 0.3em 0;
        font-size: 20px;
      }
      h5,
      h6 {
        margin: 0.2em 0;
      }
      h5 {
        font-size: 20px;
      }
      h6 {
        font-size: 18px;
      }

      .warn {
        margin: 45px 0;
      }
      .quotes {
        margin: 25px 0;
      }
    }
  }
}
</style>
