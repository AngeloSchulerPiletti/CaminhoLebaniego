<template>
  <div class="wrapper">
    <title-special
      :char="secTitle.char"
      :rest="secTitle.rest"
      :broken="secTitle.broken"
    />
    <div class="bottom">
      <aside>
        <nav>
          <ul>
            <li
              v-for="(content, title, index) in content"
              :key="title"
              @click="changeSelection(index)"
            >
              {{ title }}
            </li>
          </ul>
        </nav>
      </aside>
      <article>
        <section
          v-for="(paragraphsArr, title) in Object.values(content)[secIndex]"
          :key="title"
        >
          <h3 class="title3-1" v-if="title != 'paragraphs'">{{ title }}</h3>
          <p v-for="(p, i) in paragraphsArr" :key="i">{{ p }}</p>
        </section>
      </article>
    </div>
  </div>
</template>

<script>
import TitleSpecial from "@/components/elements/TitleSpecial.vue";

export default {
  data() {
    return {
      secTitle: {
        char: "",
        rest: "",
        broken: "on",
      },
      secIndex: "",
    };
  },
  methods: {
    changeSelection(num) {
      this.secIndex = num;
      this.secTitle.char = Object.keys(this.content)[num].slice(0, 1);
      this.secTitle.rest = Object.keys(this.content)[num].slice(1);

      this.secTitle.broken =
        Object.keys(this.content)[num].slice(1, 2) == " " ? "off" : "on";
    },
  },
  props: {
    content: Object,
    total: Number,
  },
  mounted() {
    this.changeSelection(0);
    // console.log(this.content);
  },
  components: {
    TitleSpecial,
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  .bottom {
    aside {
      nav ul {
        li {
        }
      }
    }
    article {
      h3 {
      }
      p {
        color: $white;
      }
    }
  }
}
</style>
