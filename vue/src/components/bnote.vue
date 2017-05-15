<template>
<el-row class="bnote">
<navmenu></navmenu>
  <el-col :span="4"><sidebar></sidebar></el-col>
  <el-col :span="4"><notelist></notelist></el-col>
  <el-col :span="16"><editor></editor></el-col>
</el-row>
</template>

<script>
import navmenu from './navmenu'
import sidebar from './sidebar'
import notelist from './notelist'
import editor from './editor'

export default {
  name: 'bnote',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  },
  components:{
    navmenu,
    sidebar,
    notelist,
    editor,
  },
}
</script>
<style>
  .bnote {
    padding-top: 60px;
    position: absolute;
    top:0;
    right: 0;
    bottom: 0;
    left: 0;
    height: 100%;
  }
</style>
