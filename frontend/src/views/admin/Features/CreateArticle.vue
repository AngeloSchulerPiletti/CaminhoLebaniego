<template>
  <div>
    <form @submit.prevent="submit">
      <div class="inputs">
        <div class="input_container">
          <label for=""></label>
          <input type="text" />
        </div>
      </div>
      <div class="actions">
        <button :class="'btn_3 ' + disabled" type="submit">Criar</button>
      </div>
    </form>
  </div>
</template>

<script>
import Dashboard from "@/views/admin/Dashboard";
export default {
  data() {
    return {
      article: {},
      disabled: "",
    };
  },
  methods: {
    submit() {},
  },
  components: {
    Dashboard,
  },
};
</script>

<style lang="scss" scoped>
form {
  @include form1;
}
</style>
