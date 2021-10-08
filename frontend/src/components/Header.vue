<template>
  <div>
    <div :class="`backwall ${menuState}_backwall`" @click="openMenu"></div>
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
      <div
        id="logo_container"
        :class="$route.name == 'artigo_show' ? 'red' : 'black'"
      >
        <router-link to="/">
          <header-logo />
        </router-link>
      </div>
      <nav id="header_nav" :class="`${menuState}_menu`">
        <ul>
          <router-link to="/caminho"><li>O Caminho</li></router-link>
          <router-link to="/preparacao"><li>Preparação</li></router-link>
          <router-link to="/experiencia"><li>Experiência</li></router-link>
          <router-link to="/artigos"><li>Artigos</li></router-link>
          <router-link to="/contato"><li>Contato</li></router-link>
          <div id="header_menu" @click="openMenu" :class="menuState">
            <menu-icon :menuState="menuState" />
          </div>
        </ul>
        <div class="search_btn" @click="$store.state.searchModalShow = true">
          <search-icon />
        </div>
      </nav>
    </header>
    <div class="search_btn-mobile" @click="$store.state.searchModalShow = true">
      <search-icon />
    </div>
  </div>
</template>

<script>
import HeaderLogo from "@/components/SVGs/HeaderLogo.vue";
import SearchIcon from "@/components/SVGs/SearchIcon";
import MenuIcon from "@/components/SVGs/MenuIcon";

export default {
  data() {
    return {
      menuState: null,
    };
  },
  methods: {
    openMenu() {
      this.menuState = this.menuState == "open" ? "close" : "open";
    },
  },
  components: {
    HeaderLogo,
    SearchIcon,
    MenuIcon,
  },
};
</script>

<style lang="scss" scoped>
.backwall {
  display: none;
}

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
  #header_nav {
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

        cursor: pointer;

        &::before {
          content: "";
          position: absolute;
          left: 50%;
          right: 50%;
          bottom: -5px;
          border-bottom: 1px solid transparent;

          transition: right 300ms, left 300ms;
        }
        &:hover::before {
          left: 0%;
          right: 0%;
          border-bottom: 1px solid $red;
        }
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
  #header_menu {
    display: none;
  }
}
.search_btn-mobile {
  display: none;
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
      padding-top: $pad_top !important;
    }
    #header_nav {
      ul {
        li {
          padding-top: $pad_top;
        }
      }
      .search_btn {
        display: none;
      }
    }
  }
  .search_btn-mobile {
    display: block;
    position: fixed;
    height: 30px;
    width: 30px;
    z-index: 1000;
    top: 45vh;
    left: 0;
    padding: 8px;
    border-top-right-radius: 50%;
    border-bottom-right-radius: 50%;
    background-color: $red;
    box-shadow: 0 0 10px #000;
    cursor: pointer;

    transition: opacity 200ms;

    svg {
      padding: 0px;
      border-bottom: 0px;
      transition: none;

      &:deep(path) {
        fill: $white;
      }
    }

    &:hover {
      opacity: 0.6;
    }
  }
}

@media (max-width: 760px) {
  .backwall {
    position: fixed;
    background-color: #000;
    z-index: 10000;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    opacity: 0;
  }
  .open_backwall {
    display: block;
    opacity: 0.4;
  }

  $pad_top: 2vw;

  header {
    display: block;

    padding: 0 4vw 6vw 6vw;
    background: transparent;

    #logo_container {
      box-shadow: 0 0 20px #000;
      padding: 6px;
      padding-top: $pad_top !important;
      width: 40%;

      &.black {
        background-color: #000;
      }
      &.red {
        background-color: $red;
      }
    }
    #header_nav {
      position: fixed;
      z-index: 10000;
      top: 0;
      right: 0;
      bottom: 0;
      width: 40vw;
      transform: translateX(100%);

      &.close_menu ul {
        transform: translateX(0);
      }
      &.open_menu ul {
        transform: translateX(-100%);
      }
      ul {
        transition: transform 400ms ease-in-out;

        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        background-color: $black;
        transform: translateX(0);
        box-shadow: 0 0 10px #000;

        transform-style: preserve-3d;

        a {
          width: 100%;
          display: inline-block;
          padding: 10px 8px 10px 14px;

          &:nth-child(1) {
            margin-top: 40px;
            border-top: 1px solid $red;
          }

          position: relative;

          &::before {
            content: "";
            position: absolute;
            border-bottom: 1px solid $red;
            width: 100%;
            left: 0;
            right: 0;
            bottom: 0;

            transition: none;
          }
          &::after {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;

            transition: border-left 100ms;
          }
          &:hover::after {
            border-left: 6px solid $red;
          }

          &.router-link-active {
            &::after {
              border-bottom: 0px;
              border-left: 3px solid $red;
            }
            li::before {
              content: none;
            }
          }
        }
        li {
          color: $white;
          font-size: 20px;
          position: relative;
          padding: 0;

          &::before {
            content: none;
          }
        }

        position: relative;

        #header_menu {
          display: block;
          position: absolute;
          left: 0;
          top: 30vh;
          width: calc(30px + 5px);
          height: calc(30px + 5px);
          background-color: $red;
          border-top-left-radius: 50%;
          border-bottom-left-radius: 50%;
          padding: 5px;
          cursor: pointer;
          z-index: 10000;
          box-shadow: 0 0 5px #000;
          transform: translateX(-100%) translateZ(-1px);

          transition: opacity 300ms, box-shadow 200ms;

          &:hover {
            opacity: 0.7;
            box-shadow: 0;
          }

          &:deep() {
            path {
              fill: $white;
            }
          }
        }
      }

      .search_btn {
        z-index: 1000;
        top: 45vh;
        left: 0;
        transform: translateX(calc(-100vw + 15px));
      }
    }
  }
}

@media (max-width: 600px) {
  header {
    #logo_container {
      padding: 8px;
      padding-top: 10px !important;
      width: 60%;
    }
    #header_nav {
      width: 50vw;

      ul {
        a {
          padding: 12px 8px 12px 18px;
        }
        #header_menu {
          width: 24px;
          height: 24px;
        }
      }
      .search_btn {
        width: 24px;
        height: 24px;
      }
    }
  }
  .search_btn-mobile {
    width: 24px;
    height: 24px;
  }
}
</style>
