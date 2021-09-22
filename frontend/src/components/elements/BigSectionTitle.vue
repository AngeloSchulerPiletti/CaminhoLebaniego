<template>
    <div class="wrapper">
        <h1 :class="'title4 ' + color">{{title}}</h1>
    </div>
</template>

<script>
export default {
    props:{
        title: String,
        color: String,
    }
}
</script>

<style lang="scss" scoped>
.wrapper{
    position: relative;
    z-index: 10;

    .red{
        color: $red;
    }
    .black{
        color: $black;
    }
    .white{
        color: $white;
    }
}

</style>