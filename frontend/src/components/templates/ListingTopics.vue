<template>
  <div class="wrapper">
    <title-special id="el_top"
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
              @click="changeSelection(index, $event)"
              :id="'topic' + index"
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
import { scrollToSec } from "@/modules/scrolling.js";

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
    changeSelection(num, event = null) {
      this.secIndex = num;
      this.secTitle.char = Object.keys(this.content)[num].slice(0, 1);
      this.secTitle.rest = Object.keys(this.content)[num].slice(1);

      this.secTitle.broken =
        Object.keys(this.content)[num].slice(1, 2) == " " ? "off" : "on";
      this.$el.querySelector("#topic" + num).classList.add("active");

      event === null ? null : scrollToSec('el_top', this.$el);
    },
  },
  props: {
    content: Object,
    total: Number,
  },
  mounted() {
    this.changeSelection(0);
  },
  components: {
    TitleSpecial,
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  .bottom {
    display: grid;
    grid-template-columns: 2fr 7fr;
    gap: 2vw;
    padding: 0 4vw 0 2vw;
    margin-top: 3.5vw;

    aside {
      position: -webkit-sticky;
      position: sticky;
      top: 5%;
      height: fit-content;
      nav ul {
        li {
          @include Title3;
          border-bottom: 1px solid $red;
          padding: 8px;
          color: $white;
          cursor: pointer;
          line-height: 1.2em;

          &.active {
            border-left: 4px solid $red;
          }
        }
      }
    }
    article {
      display: flex;
      flex-direction: column;
      gap: 60px;

      section {
        h3 {
          margin-bottom: 10px;
        }
        p {
          color: $white;
          text-align: justify;
          text-indent: 1em;
        }
      }
    }
  }
}



@media (max-width: 900px){
  .wrapper {
  .bottom {
    grid-template-columns: 5fr 11fr;

    aside {
      top: 2%;
    }
  }
}
}
</style>
