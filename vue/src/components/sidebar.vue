<template>
<div class="sidebar">
  <el-menu theme="dark">
  <el-menu-item>笔记本<i class="el-icon-plus nav-right"></i></el-menu-item>
    <el-menu-item index="1">
      <i class="el-icon-message"></i><span>笔记本1</span>
      <i class="el-icon-setting nav-right"></i>
    </el-menu-item>
    <el-menu-item index="2">
      <i class="el-icon-message"></i><span>笔记本2</span>
      <i class="el-icon-setting nav-right"></i>
    </el-menu-item>
    <el-menu-item>标签</el-menu-item>
    <div class="tag">
      <el-tag>标签一</el-tag>
        <el-tag type="gray">标签二</el-tag>
        <el-tag type="primary">标签三</el-tag>
        <el-tag type="success">标签四</el-tag>
        <el-tag type="warning">标签五</el-tag>
        <el-tag type="danger">标签六</el-tag>
    </div>
  </el-menu>
</div>
</template>

<script>
export default {
  name: 'sidebar',
  data () {
    return {
      msg: 'sidebar'
    }
  },
}
</script>
<style>
  .sidebar {
    height: 100%;
    background-color: #324157;
  }
  .notebook-setting {
    margin: 0 auto;
  }
  .tag {
    padding: 0 20px 20px 20px; 
  }
  .tag span {
    margin-top: 10px;
  }
  .nav-right {
    margin: 0 auto;
    position: absolute;
    top: 50%;
    right: 20px;
    margin-top: -7px;
    transition: transform .3s;
    font-size: 12px;
    color: #ffffff;
  }
  .el-col {
    height: 100%;
  }
</style>
