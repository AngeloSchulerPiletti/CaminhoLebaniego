<template>
  <aside id="great_modal">
    <div id="modal_container">
        <article v-html="modalPage"></article>
        <div v-if="modalOptions">
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
    props:{
        modalPage: String,
        modalOptions: Object,
    }
};
</script>

<style lang="scss" scoped></style>
