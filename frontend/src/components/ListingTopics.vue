<template>
  <div class="wrapper">
    <title-special
      id="el_top"
      :char="secTitle.char"
      :rest="secTitle.rest"
      :broken="secTitle.broken"
    />
    <div class="bottom">
      <aside>
        <nav>
          <ul
            @mousedown="onAsideEvent(true, $event)"
            @mousemove="movingOnAside($event)"
            @mouseup="onAsideEvent(false, $event)"
          >
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
          <p v-for="(p, i) in paragraphsArr" :key="i" v-html="p"></p>
        </section>
      </article>
    </div>
  </div>
</template>

<script>
import TitleSpecial from "@/components/TitleSpecial.vue";
import { scrollToSec } from "@/scripts/modules/scrolling.js";

export default {
  data() {
    return {
      secTitle: {
        char: "",
        rest: "",
        broken: "on",
      },
      secIndex: "",
      lastSelection: 0,
      asideDrag: {
        clicked: false,
        lastDragPos: 0,
      },
    };
  },
  methods: {
    onAsideEvent(clicked, event) {
      if (window.innerWidth > 600) return;
      this.asideDrag.clicked = clicked;
      this.asideDrag.lastDragPos = event.clientX;
    },
    movingOnAside(event) {
      if (!this.asideDrag.clicked) return;

      var ul_element = this.$el.querySelector("ul");

      ul_element.scrollLeft += this.asideDrag.lastDragPos - event.clientX;
      this.asideDrag.lastDragPos = event.clientX;
    },
    changeSelection(num, event = null) {
      this.$el
        .querySelector(`#topic${this.lastSelection}`)
        .classList.remove("active");
      this.lastSelection = num;

      this.secIndex = num;
      this.secTitle.char = Object.keys(this.content)[num].slice(0, 1);
      this.secTitle.rest = Object.keys(this.content)[num].slice(1);

      this.secTitle.broken =
        Object.keys(this.content)[num].slice(1, 2) == " " ? "off" : "on";
      this.$el.querySelector("#topic" + num).classList.add("active");

      event === null ? null : scrollToSec("el_top", this.$el);
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

          &:deep() {
            .item {
              font-weight: 600;
              font-size: 1.1em;
            }
            img{
              float: right;
              margin: 18px;
              width: 50%;
            }
          }
        }
      }
    }
  }
}

@media (max-width: 900px) {
  .wrapper {
    .bottom {
      grid-template-columns: 5fr 11fr;

      aside {
        top: 2%;
      }
    }
  }
}

@media (max-width: 600px) {
  .wrapper {
    position: relative;

    #el_top {
      padding: 0;
      padding-top: 65px;
    }
    .bottom {
      grid-template-columns: auto;
      gap: 0;
      padding: 0 24px 0 24px;
      margin-top: 35px;

      aside {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10;
        box-shadow: 0 0 14px 4px #000;

        nav {
          ul::-webkit-scrollbar {
            display: none;
          }
          ul {
            scrollbar-width: none;
            overflow-x: scroll;
            display: flex;
            font-size: 13px;
            background-color: #000000b0;
            position: relative;

            li {
              white-space: nowrap;
              height: min-content;
              padding: 15px 18px 8px 18px;
              line-height: 1.2em;
              background-color: $red;
              user-select: none;
              box-shadow: inset 0 0 4px #000;
              border: none;

              transition: font-size 200ms, padding 200ms, box-shadow 200ms;

              &.active {
                border-left: 4px solid transparent;
                font-size: 1.2em;
                padding: 15px 22px;
                box-shadow: 0 0 5px #000;
                z-index: 10;
              }
            }
          }
        }
      }
    }
  }
}
</style>
