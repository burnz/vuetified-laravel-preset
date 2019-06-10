<template>
  <v-app v-cloak>
    <app-nav-bar/>
    <main>
      <v-container transition="slide-x-transition" fluid pa-0 ma-0>
        <slot/>
      </v-container>
    </main>
    <app-footer/>
  </v-app>
</template>

<script>
import AppFooter from '@/partials/AppFooter';
import AppNavBar from '@/partials/AppNavBar';
export default {
    components:{
        AppFooter,
        AppNavBar
    }
};
</script>

<style>
</style>
