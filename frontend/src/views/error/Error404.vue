<template>
    <error>
        <div>
            <h1>ERROR 404</h1>
        </div>
    </error>
</template>

<script>
import Error from "@/views/error/Error";

export default {
    name: "error404",
  created(){
    this.$store.commit('setTitle', "Erro 404");
  },
components: {
    Error,
},
}
</script>

<style>

</style>