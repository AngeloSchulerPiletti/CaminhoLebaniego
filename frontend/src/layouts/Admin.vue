<template>
    <div>
        <header-component />
        <main>
          <slot></slot>
        </main>
        <lateral-menu-bottom :locations="admin_links"/>
    </div>
</template>

<script>
import Header from "@/components/admin/Header";
import LateralMenuBottom from "@/components/LateralMenuBottom";

export default {
    data(){
        return{
            admin_links:[
                {name: 'trash', button: 'Lixeira'},
                {name: 'drafts', button: 'Rascunhos'},
            ],
        }
    },
    components:{
        "header-component": Header,
        LateralMenuBottom,
    }
}
</script>

<style lang="scss">
main{
    margin: 10vh 0;
}
</style>