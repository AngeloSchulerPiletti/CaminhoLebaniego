module.exports={
    css: {
        loaderOptions:{
            sass:{
                prependData: `@import "@/sass/_geralImports.scss";`,
            }
        }
    }
};