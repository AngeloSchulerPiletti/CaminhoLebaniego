<template>
  <div class="error-view">
    <div class="content-default">
      <h1 class="title4 error-code">{{ error.code }}</h1>
      <p class="error-message">{{ error.message }}</p>
    </div>
    <div class="options">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    error: Object,
  },
};
</script>

<style lang="scss" scoped>
.error-view {
  position: absolute;
  background: url("http://localhost:8000/images/errors/404/Camino.jpg");
  background-size: cover;
  background-position-x: 50%;

  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;

  .content-default {
    padding: 5vw 4vw 7vw 4vw;
    background: linear-gradient(180deg, #000000C9 20%, #00000090 65%,#00000000);

    .error-code {
      width: 100%;
    }
    .error-message {
      color: $white;
      margin-top: 1em;
    }
  }

  .options{
    padding: 50px 14vw 50px 4vw;
    background: radial-gradient(
      closest-side at 40%,
      rgba(0, 0, 0, 0.6) 35%,
      rgba(0, 0, 0, 0.4) 55%,
      rgba(0, 0, 0, 0.15) 85%,
      transparent
    );
    width: fit-content;
  }
}
</style>
