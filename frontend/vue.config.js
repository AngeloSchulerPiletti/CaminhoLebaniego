module.exports={
    css: {
        loaderOptions:{
            sass:{
                prependData: `@use "@/sass" as *;`,
            }
        }
    }
};