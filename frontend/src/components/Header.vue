<template>
<div>
    <div v-if="$store.state.logged" id="admin_header">
      <p>
      Bem vindo, {{$store.state.sessionData.user.name}}. Você é admin e está logado!
      </p>
      <p @click="$router.push({name: 'admin'})">
        Ir para a área do admin
      </p>
    </div>
  <header>
    <div id="logo_container">
      <router-link to="/">
        <header-logo />
      </router-link>
    </div>
    <nav id="header_nav">
      <ul>
        <router-link to="/caminho"><li class="hover1">O Caminho</li></router-link>
        <router-link to="/preparacao"><li class="hover1">Preparação</li></router-link>
        <router-link to="/experiencia"><li class="hover1">Experiência</li></router-link>
        <router-link to="/artigos"><li class="hover1">Artigos</li></router-link>
        <router-link to="/contato"><li class="hover1">Contato</li></router-link>
      </ul>
    </nav>
  </header>

</div>
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
#admin_header{
  background-color: $red;
  color: $white;
  display: flex;
  justify-content: space-between;
  padding: 3px 12px;

  p:nth-child(2){
    text-decoration: underline;
    cursor: pointer;
  }
}

$pad_top: 1vw;
header {
  display: grid;
  grid-template-columns: 4fr 9fr;
  gap: 5vw;

  padding: 0 10vw 5vw 10vw;

  background: linear-gradient(180deg, #000000e0 40%, #00000000);

  #logo_container {
    @include headerLogo($pad_top);
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
      }
    }
  }
}
</style>
