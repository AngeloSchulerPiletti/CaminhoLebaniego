<template>
  <div>
    <div v-if="$store.state.logged" id="admin_header">
      <p>
        Bem vindo, {{ $store.state.sessionData.user.name }}. Você é admin e está
        logado!
      </p>
      <p @click="$router.push('/area-do-administrador')">
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
          <router-link to="/caminho"
            ><li class="hover1">O Caminho</li></router-link
          >
          <router-link to="/preparacao"
            ><li class="hover1">Preparação</li></router-link
          >
          <router-link to="/experiencia"
            ><li class="hover1">Experiência</li></router-link
          >
          <router-link to="/artigos"
            ><li class="hover1">Artigos</li></router-link
          >
          <router-link to="/contato"
            ><li class="hover1">Contato</li></router-link
          >
        </ul>
        <div class="search_btn" @click="$store.state.searchModalShow = true">
          <search-icon />
        </div>
      </nav>
    </header>
  </div>
</template>

<script>
import HeaderLogo from "@/components/SVGs/HeaderLogo.vue";
import SearchIcon from "@/components/SVGs/SearchIcon";

export default {
  components: {
    HeaderLogo,
    SearchIcon,
  },
};
</script>

<style lang="scss" scoped>
#admin_header {
  background-color: $red;
  color: $white;
  display: flex;
  justify-content: space-between;
  padding: 3px 12px;

  p:nth-child(2) {
    text-decoration: underline;
    cursor: pointer;
  }
}

$pad_top: 1vw;
header {
  display: grid;
  grid-template-columns: 5fr 14fr;
  gap: 5vw;

  padding: 0 6vw 5vw 10vw;

  background: linear-gradient(180deg, #000000e0 40%, #00000000);

  #logo_container {
    @include headerLogo($pad_top);
  }
  nav {
    display: flex;
    align-items: center;
    gap: 6vw;

    ul {
      flex-grow: 1;
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
    .search_btn {
      height: 30px;
      width: 30px;
      cursor: pointer;

      svg {
        height: 100%;
        border-bottom: 1px solid transparent;
        padding: 4px;
        transition: border-bottom 300ms;

        &:deep() {
          path {
            fill: $white;
            transition: fill 500ms;
          }
        }
      }

      &:hover {
        svg {
          border-bottom: 1px solid $red;

          &:deep(path) {
            fill: $red;
          }
        }
      }
    }
  }
}





@media (max-width: 900px) {
  #admin_header {
  padding: 8px 15px;
  font-size: 20px;
}

$pad_top: 2vw;
header {
  grid-template-columns: 4fr 7fr;
  gap: 5vw;

  padding: 0 4vw 6vw 6vw;

  #logo_container {
    @include headerLogo($pad_top);
  }
  nav {
    ul {
      li {
        padding-top: $pad_top;
      }
    }
    .search_btn {
      position: fixed;
      z-index: 1000;
      top: 45vh;
      left: 0;
      padding: 8px;
      border-top-right-radius: 50%;
      border-bottom-right-radius: 50%;
      background-color: $red;
      box-shadow: 0 0 10px #000;
      transition: opacity 200ms;

      svg {
        padding: 0px;
        border-bottom: 0px;
        transition: none;
      }

      &:hover {
        opacity: 0.6;
        svg {
          border-bottom: 0px;

          &:deep(path) {
            fill: $white;
          }
        }
      }
    }
  }
}
}
</style>
