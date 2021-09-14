<template>
  <aside id="great_modal">
    <div id="modal_container">
        <article v-if="modalPage != ''" v-html="modalPage"></article>
        <div v-if="modalOptions != {}">
            <router-link v-for="(route, name) in modalOptions" :key="name" :to="route">
                <div class="btn_2">
                    {{name}}
                </div>
            </router-link>
        </div>
    </div>
  </aside>
</template>

<script>
export default {
    mounted(){
        console.log(this.modalPage);
        console.log(this.modalOptions);
    },
    props:{
        modalPage: String,
        modalOptions: Object,
    }
};
</script>

<style lang="scss" scoped></style>
