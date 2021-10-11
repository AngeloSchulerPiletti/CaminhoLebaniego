<template>
  <transition name="fade">
    <section class="wrapper" id="search_modal" v-if="show" @click="closeModal($event)">
      <div class="content_container">
        <h2 class="title4-1">Procurar artigos</h2>
        <div class="searcher">
          <input
            type="text"
            name="search"
            id="search_field"
            placeholder="Ex: Caminho do Norte"
            v-model="query"
            autocomplete="off"
          />
          <div class="btn_2" @click="searchFor(query)">
            buscar
          </div>
        </div>
      </div>
    </section>
  </transition>
</template>

<script>
import SearchIcon from "@/components/SVGs/SearchIcon.vue";

export default {
  data() {
    return {
      show: false,
      query: null,
    };
  },
  computed: {
    modalState() {
      this.show = this.$store.state.searchModalShow;
      return this.show;
    },
  },
  methods: {
    closeModal(event = null) {
      if (!event || event.target.id == "search_modal") {
        this.$store.state.searchModalShow = false;
      }
    },
    searchFor(query) {
      if (query) {
        this.closeModal();
        this.$router.push({ name: "search_result", params: { query: query } });
      }
    },
  },
  watch: {
    modalState(newval) {
      newval
        ? (document.body.style.overflowY = "hidden")
        : (document.body.style.overflowY = "auto");
    },
  },
  components: { SearchIcon },
};
</script>

<style lang="scss" scoped>
.wrapper {
  position: fixed;
  background-color: #000000d0;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 100000;

  display: flex;
  align-items: center;

  .content_container {
    background-color: $white;
    border-radius: 10px;
    width: fit-content;
    padding: 20px 30px;
    margin: 0 auto;
    box-shadow: 0 0 6vw 2vw #000;

    display: flex;
    flex-direction: column;
    transform: translateY(-50%);
    gap: 1.5vw;

    .searcher {
      display: flex;
      align-items: center;
      gap: 2vw;

      input {
        @include Font0;
        border-bottom: 1px solid $red;
        font-size: 16px;
        width: 30vw;
        padding: 0.7em 0.7em 0.3em 0.7em;
      }
    }
  }
}

@media (max-width: 900px) {
  .wrapper {
    .content_container {
      border-radius: 7px;

      .searcher {
        display: flex;
        align-items: center;
        gap: 2vw;

        input {
          border-bottom: 1px solid $red;
          font-size: 18px;
          width: 50vw;
        }
      }
    }
  }
}

@media (max-width: 600px) {
  .wrapper {
    .content_container {
      padding: 16px 22px;
      h2 {
        font-size: 24px;
      }
      .searcher {
        gap: 26px;

        input {
          font-size: 18px;
          width: 45vw;
          padding: 4px;
        }
        div {
          font-size: 13px;
          padding: 7px 15px;
        }
      }
    }
  }
}

@media (max-width: 460px) {
  .wrapper {
    .content_container {
      padding: 16px 22px;
      gap: 24px;
      width: 75vw;

      .searcher {
        gap: 10px;
        flex-direction: column;
        align-items: flex-start;

        input {
          font-size: 16px;
          padding: 4px;
          width: 100%;
        }
        div {
          font-size: 13px;
          padding: 7px 15px;
          align-self: flex-end;
        }
      }
    }
  }
}

/*+------------------------------------+
  |             TRANSITIONS            |
  +------------------------------------+*/
.fade-enter-active,
.fade-leave-active {
  transition: opacity 300ms;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
