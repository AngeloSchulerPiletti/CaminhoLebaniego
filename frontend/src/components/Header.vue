<template>
  <header>
    <div id="logo_container">
      <router-link to="/">
        <header-logo />
      </router-link>
    </div>
    <nav>
      <ul>
        <li><router-link to="/preparacao">Preparação</router-link></li>
        <li><router-link to="/caminho">O Caminho</router-link></li>
        <li><router-link to="/autor">Experiência</router-link></li>
        <li><router-link to="/artigos">Artigos</router-link></li>
        <li><router-link to="/contato">Contato</router-link></li>
      </ul>
    </nav>
  </header>
</template>

<script>
import HeaderLogo from "@/components/SVGs/HeaderLogo.vue";
export default {
  components: {
    HeaderLogo,
  },
};
</script>

<style lang="scss" scoped>
$pad_top: 1vw;

header {
  display: grid;
  grid-template-columns: 4fr 9fr;
  gap: 5vw;

  padding: 0 10vw 5vw 10vw;
  margin: auto;

  background: linear-gradient(180deg, #000000e0 40%, #00000000);

  #logo_container {
    padding-top: $pad_top;
    // border-top: 2px solid $white;
  }
  nav {
    ul {
      display: flex;
      align-items: center;
      justify-content: space-around;
      height: 100%;

      li {
        height: 100%;
        padding-top: $pad_top;
        display: flex;
        align-items: center;

        a {
          color: $white;
          @include Font1;
        }
      }
    }
  }
}
</style>
