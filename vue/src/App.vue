<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style>
ul {
  list-style:none; 
  padding-left: 0; 
}
#app {
    position: absolute;
    top:-60px;
    right: 0;
    bottom: 0;
    left: 0;
    height: 100%;
}


</style>
