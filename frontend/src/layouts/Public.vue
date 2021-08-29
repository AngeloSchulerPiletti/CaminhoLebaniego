<template>
  <div>
    <div id="pic_background" :class="'background-' + backID">
      <header>Aqui é o header</header>
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
export default {
  data() {
    return {
      //
    };
  },
  props:{
      backID: String,
  }
}
</script>

<style>

</style>