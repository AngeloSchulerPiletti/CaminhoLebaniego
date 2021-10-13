<template>
  <aside class="bottomnav_wrapper flex_r">
    <div class="btn flex_r" @click="showOptions()">
      <menu-icon />
    </div>
    <nav class="flex_r">
      <div
      class="btn_4"
        @click="goTo(location.name)"
        v-for="(location, index) in locations"
        :key="index"
      >
        {{ location.button }}
      </div>
    </nav>
  </aside>
</template>

<script>
import MenuIcon from "@/components/SVGs/MenuIcon";

export default {
  methods: {
    goTo(location_name) {
      this.$router.push({ name: location_name });
    },
    showOptions() {
        var aside = this.$el;

      if (aside.classList.contains("show")) {
        aside.classList.remove("show");
      } else {
        aside.classList.add("show");
      }
    },
  },
  components: {
    MenuIcon,
  },
  props: {
    locations: Array,
  },
};
</script>

<style lang="scss" scoped>

aside {
  position: fixed;
  right: 0;
  bottom: 15vh;
  transform: translateX(100%);

  align-items: center;

  transition: transform 300ms ease;

  &.show {
    transform: translateX(0);
  }

  .btn {
    background-color: $white;
    border-top-left-radius: 7px;
    border-bottom-left-radius: 7px;
    position: absolute;
    transform: translateX(-100%);
    cursor: pointer;
    align-items: center;

    svg {
      width: 2.5vw;
      height: 2.5vw;

      &:deep() {
        path {
          fill: $red;
        }
      }
    }
  }
  nav {
    align-items: center;
    gap: 2em;
    padding: 0 2em;
  }
}
</style>
