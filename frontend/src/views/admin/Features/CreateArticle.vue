<template>
  <div>
    <form @submit.prevent>
      <div class="inputs">
        <div class="input_container">
          <label for=""></label>
          <input type="text" />
        </div>
      </div>
      <div class="actions">
        <button :class="'btn_3 ' + disabled" type="submit" @click="submit">Criar</button>
        <button class="btn_3" @click="clean">Limpar</button>
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
    submit() {
        console.log('sended');
    },
    clean(){
        console.log('clean');
    }
  },
  components: {
    Dashboard,
  },
};
</script>

<style lang="scss" scoped>
form {
  @include form1(50vw, 700px);
}
</style>
