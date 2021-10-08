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
};
</script>

<style lang="scss" scoped>
.title_special {
  display: flex;
  align-items: baseline;
  padding: 0 10vw;
  @include Drawed1;
    font-size: 40px;

  &.broken_off{
      gap: 20px;
  }
  &.broken_on{
      gap: 4px;
  }

  .special_char {
    background-color: $red;
    color: $white;
    font-size: 2.1em;
    padding: 10px 8px;
  }
  h1 {
    color: $white;
  }
}


@media (max-width: 600px){
  .title_special{
    padding: 0 6vw;
    font-size: 34px;
  }
}



@media (max-width: 400px){
  .title_special{
    font-size: 28px;
  }
}
</style>
