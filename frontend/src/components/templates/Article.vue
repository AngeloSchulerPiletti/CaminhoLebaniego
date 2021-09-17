<template>
  <article class="article_wrapper" v-html="article"></article>
</template>

<script>
export default {
  props: {
    article: String,
  },
};
</script>

<style lang="scss" scoped>
.article_wrapper {
  width: 80vw;
  margin: auto;

  &::v-deep() {
    .simple_p {
      color: $white;
      text-align: justify;
      text-indent: 1.2em;
      margin: 0.6em 0;
    }
    .img_container {
        position: relative;
        $img_padding: 10px;
        padding: $img_padding;

        &::before, &::after{
            position:absolute;
            content: "";
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
          &::before{
              @include pseudoStyle1(left, $img_padding);
          }
      }
      &.right.style1{
          &::before{
              @include pseudoStyle1(right, $img_padding);
          }
      }
      &.left.style2 {
          &::before{
              @include pseudoStyle2(top, left);
          }
      }
      &.right.style2{
          &::before{
              @include pseudoStyle2(top, right);
          }
      }
      &.left.style3 {
          &::before{
              @include pseudoStyle3(left, bottom, $img_padding);
          }
          &::after{
              @include pseudoStyle3(right, top, $img_padding);
          }
      }
      &.right.style3{
          &::before{
              @include pseudoStyle3(right, bottom, $img_padding);
          }
          &::after{
              @include pseudoStyle3(left, top, $img_padding);
          }
      }

    }

    em{
        font-style: italic;
    }
    strong{
        font-weight: 800;
        
    }

    hr{
        background-color: $red;
        height: 1px;
        outline: 0 0 0 0;
        border: none;
        margin: 1vw 0;
    }
  }
}
</style>
