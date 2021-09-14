<template>
  <header>
    <div id="logo_container">
      <router-link to="/">
        <header-logo />
      </router-link>
    </div>
    <nav id="header_nav">
      <ul>
        <router-link to="/caminho"><li>O Caminho</li></router-link>
        <router-link to="/preparacao"><li>Preparação</li></router-link>
        <router-link to="/experiencia"><li>Experiência</li></router-link>
        <router-link to="/artigos"><li>Artigos</li></router-link>
        <router-link to="/contato"><li>Contato</li></router-link>
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

      a.router-link-active {
        li::before {
          content: "";
          position: absolute;
          bottom: -5px;
          left: 0%;
          right: 0%;
          border-bottom: 1px solid $red;
        }
      }

      li {
        height: 100%;
        padding-top: $pad_top;
        display: flex;
        align-items: center;
        color: $white;
        @include Font1;

        position: relative;

        &::before{
          content: "";
          position: absolute;
          left: 50%;
          right: 50%;
          bottom: -5px;
          border-bottom: 1px solid transparent;

          transition: right 300ms, left 300ms;
        }
        &:hover::before{
          left: 0%;
          right: 0%;
          border-bottom: 1px solid $red;
        }
      }
    }
  }
}
</style>
