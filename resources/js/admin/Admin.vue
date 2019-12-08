
<template>
   <div class="container-flex">
       <div class="row">
        <div class="col-12 col-md-2 main-navigation">
            <the-navigation/>    
        </div>
           <div class="col bg-faded py-3">
               <div class="content">
                   <the-stats/>
                   <router-view/>
               </div>
        </div>
      </div>
   </div>
</template>

<script>
import tableMixin from './mixins/tableMixin';
import TheNavigation from "./components/TheNavigation";
import TheStats from './components/TheStats.vue';

    export default {
        mixins: [ tableMixin ],
        components: {
            TheNavigation, 
            TheStats
        },
   
    }
</script>

<style lang="scss" scoped>

</style>