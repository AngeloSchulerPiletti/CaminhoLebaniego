<template>
  <footer>
      <div class="top">
          <h2 class="title3">Links Úteis</h2>
      </div>
      <div class="center">
          <ul>
              <router-link to="/area-do-administrador"><li>Área do Administrador</li></router-link>
              <!-- <router-link to="/"><li>Fale Conosco</li></router-link> -->
              <a href="https://www.linkedin.com/in/angelo-schuler-piletti/" target="_blank"><li>Quem desenvolveu o site?</li></a>
          </ul>
          <ul>
              <!-- <router-link to="/"><li>Política de Privacidade</li></router-link> -->
              <a href="https://www.caminolebaniego.com/" target="_blank"><li>Site Oficial</li></a>
              <!-- <router-link to="/"><li>Patrocínio ou Doações</li></router-link> -->
          </ul>
      </div>
          <div class="bottom">
              <p>&copy; Jone Mario Piletti, All rights reserved</p>
          </div>
  </footer>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
footer{
    display: flex;
    flex-direction: column;
    background-color: $white;
    padding: 55px 0;
    gap: 30px;
    color: $blackest;

    .top{
        display: flex;
        justify-content: center;

    }
    .center{
        display: flex;
        justify-content: space-around;

        ul{
            display: flex;
            flex-direction: column;
            gap: 0.5em;

            a{
            color: $black;
            @include Font0;

                li{
                    position: relative;
                    &::before{
                        content: "";
                        position: absolute;
                        border-left: 2px solid transparent;
                        left: 0;
                        top: 0;
                        bottom: 0;

                        transition: left 300ms, border-left 300ms;
                    }
                    &:hover::before{
                        left: -10px;
                        border-left: 2px solid $red;
                    }
                }
            }
        }
    }
    .bottom{
        display: flex;
        justify-content: center;
        p{
            
        }
    }
}

</style>