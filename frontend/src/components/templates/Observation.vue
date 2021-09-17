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
    width: 80vw;
    margin: auto;
    display: flex;
    flex-direction: column;
    gap: 0.5em;
    padding: 16px 30px;

    position: relative;

    p{
        text-indent: 1.5em;
        color: $white;
        font-size: 15px;
        text-align: justify;
    }

    &.note{
        border: 2px solid $red;
        
        &::after{
            content: "!";
            font-size: 30px;
            height: 30px;
            width: 30px;
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 900;
            color: $red;
            position: absolute;
            right: 50px;
            top: 0;
            transform: translateY(-65%);
            background-color: $white;
            border-radius: 100%;
        }
    }

}
</style>