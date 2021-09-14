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
#bannerContent{
        margin-left: 10vw;
        margin-top: 5vw;
        padding: 4vw;
        width: fit-content;
        color: $white;
        background: radial-gradient(closest-side at 40%, rgba(0,0,0, 0.6) 30%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.2) 75%, transparent);

        h1{
            // @include Title1;
            @include Drawed1;
            font-size: 50px;
        }
        p{
            font-size: 18px;
            margin-top: 18px;
            @include Font1;
        }
    }
</style>