<template>
  <header>
      <div id="logo_container">
          <router-link to="/">
              <header-logo/>
          </router-link>
      </div>
      <nav>
          <ul>
              <li><router-link to="/preparacao">Preparação</router-link></li>
              <li><router-link to="/caminho">O Caminho</router-link></li>
              <li><router-link to="/autor">Experiência</router-link></li>
              <li><router-link to="/artigos">Artigos</router-link></li>
              <li><router-link to="/contato">Contato</router-link></li>
          </ul>
      </nav>
  </header>
</template>

<script>
import HeaderLogo from '@/components/SVGs/HeaderLogo.vue'
export default {
  components: { 
      HeaderLogo 
    },

}
</script>

<style lang="scss" scoped>
header{
    display: grid;
    grid-template-columns: 2fr 5fr;
}
</style>