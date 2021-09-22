<template>
    <div>
        <header-component />
        <main>
          <slot></slot>
        </main>
    </div>
</template>

<script>
import Header from "@/components/admin/Header";

export default {
    components:{
        "header-component": Header,
    }
}
</script>

<style lang="scss" scoped>
</style>