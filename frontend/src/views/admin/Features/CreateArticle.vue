<template>
  <div>
    <form @submit.prevent>
      <div class="inputs">
        <div class="input_container">
          <label for="title">Título do Artigo</label>
          <input type="text" id="title" name="title" placeholder="Exemplo de Título"/>
        </div>
        <div class="input_container">
          <label for="description">Descrição</label>
          <textarea name="description" id="description" placeholder="Adicione aqui uma descrição para o seu artigo!"></textarea>
        </div>
        <div class="input_container">
          <label for="text">Artigo</label>
          <textarea name="text" id="text" placeholder="Escreva seu artigo conforme as regras de formatação pré-estabelecidas"></textarea>
        </div>
        <div class="input_container">
          <label for="tags">TAGS do Artigo</label>
          <input type="text" id="tags" name="tags" placeholder="Insira tags, separando-as por vírgula"/>
        </div>
        <div class="input_container">
          <label for="draft">Salvar como Rascunho?</label>
          <select name="draft" id="draft">
            <option value="true">Sim</option>
            <option value="false" selected>Não</option>
          </select>
        </div>
        <div class="input_container">
          <label for="images">Adicione as Imagens Zipadas ao Artigo</label>
          <input type="file" name="images" id="images">
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
