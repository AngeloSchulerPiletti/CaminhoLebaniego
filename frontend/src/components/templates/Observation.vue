<template>
  <div :class="'wrapper '+type" v-if="type && type != ''">
          <p v-for="(p, i) in paragraphs" :key="i">
              {{p}}
          </p>
  </div>
</template>

<script>
export default {
    props:{
        paragraphs: Object,
        type: String,
    },
}
</script>

<style lang="scss" scoped>
.wrapper{
    @include observationPreset(80vw);
    
}
</style>