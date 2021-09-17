<template>
  <div :class="'title_special broken_'+broken">
    <div class="special_char">
      {{ char }}
    </div>
    <h1>{{ rest }}</h1>
  </div>
</template>

<script>
export default {
  props: {
    char: String,
    rest: String,
    broken: String,
  },
  mounted(){
    //   console.log(this.char, this.rest);
  }
};
</script>

<style lang="scss" scoped>
.title_special {
  display: flex;
  align-items: baseline;
  padding: 0 10vw;
  @include Drawed1;

  &.broken_off{
      gap: 20px;
  }
  &.broken_on{
      gap: 4px;
  }

  .special_char {
    background-color: $red;
    color: $white;
    font-size: 90px;
    padding: 10px 8px;
  }
  h1 {
    font-size: 40px;
    color: $white;
  }
}
</style>
