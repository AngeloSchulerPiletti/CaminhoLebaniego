<template>
  <aside class="wrapper">
    <label class="whatsapp" @click="share('whatsapp')"
      ><whatsapp />Compartilhe via Whatsapp</label
    >
    <label class="linkedin" @click="share('linkedin')"
      ><linkedin />Compartilhe via LinkedIn</label
    >
    <label
      class="link-icon"
      @click.stop.prevent="copy()"
      @mouseleave="linkIconText = 'Copiar Link'"
      ><link-icon />{{ linkIconText }}</label
    >
    <input type="hidden" id="article_url" :value="urlCompleta" />
  </aside>
</template>

<script>
import Whatsapp from "@/components/SVGs/Whatsapp";
import Linkedin from "@/components/SVGs/Linkedin";
import Link from "@/components/SVGs/Link";

export default {
  data() {
    return {
      linkIconText: "Copiar Link",
    };
  },
  computed: {
    urlCompleta() {
      return `${this.$store.state.urlAppBase}/artigo?titulo=${this.url}`;
    },
  },
  methods: {
    copy() {
      let urlToCopy = document.querySelector("#article_url");
      urlToCopy.setAttribute("type", "text");
      urlToCopy.select();

      try {
        var successful = document.execCommand("copy");
        var msg = successful ? "Copiado!" : "Navegador Bloqueou...";
        this.linkIconText = msg;
      } catch (err) {
        this.linkIconText = "Navegador Bloqueou...";
      }

      urlToCopy.setAttribute("type", "hidden");
      window.getSelection().removeAllRanges();
    },
    share(which) {
      var time = 0;
      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
        time = 400;
      setTimeout(() => {
        switch (which) {
          case "whatsapp":
            window.open(
              "https://api.whatsapp.com/send?text=Olha+que+legal+esse+artigo%21%0D%0A" +
                this.urlCompleta,
              "_blank"
            );
            break;

          case "linkedin":
            window.open(
              "https://www.linkedin.com/sharing/share-offsite/?url=" +
                this.urlCompleta,
              "_blank"
            );
            break;

          default:
            break;
        }
      }, time);
    },
  },
  props: {
    url: String,
  },
  components: {
    Whatsapp,
    Linkedin,
    "link-icon": Link,
  },
};
</script>

<style lang="scss" scoped>
$reference: 30px;
.wrapper {
  position: fixed;
  right: 0;
  bottom: 10vh;
  display: flex;
  flex-direction: column;
  gap: $reference/5;
  z-index: 100;

  label {
    position: relative;
    display: flex;
    align-items: center;
    transform: translateX(calc(100% - (#{$reference}/ 2)));
    padding: 0 $reference;
    @include Font0;
    font-size: (3 * $reference)/5;
    color: transparent;
    cursor: pointer;
    height: $reference;

    transition: transform 400ms ease, background-color 300ms, color 300ms;

    &:hover {
      transform: translateX(0);
      color: $white;
    }

    svg {
      width: $reference;
      height: $reference;
      position: absolute;
      left: 0;
      transform: translateX(-50%);
    }
  }

  .whatsapp:hover {
    background-color: #25d366d0;
  }
  .linkedin:hover {
    background-color: #0077b5d0;
  }
  .link-icon:hover {
    background-color: #4d4d4fd0;
  }
}
</style>
