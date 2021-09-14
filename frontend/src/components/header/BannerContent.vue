<template>
   <div id="bannerContent">
        <h1>{{ pageData["title"] }}</h1>
        <p v-if="pageData['paragraph']">{{ pageData["paragraph"] }}</p>
    </div>
</template>

<script>
export default {
    props:{
        pageData: Object,
    }
}
</script>

<style lang="scss" scoped>
@include bannerContent;
</style>