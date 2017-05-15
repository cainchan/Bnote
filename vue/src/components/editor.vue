<template>
<div class="editor">
    <el-input class="note-title" v-model="input" placeholder="请输入内容"></el-input>
    <markdown-editor v-model="content" ref="markdownEditor"></markdown-editor>  
</div>
</template>

<script>
import { markdownEditor } from 'vue-simplemde'
export default {
  components: {
    markdownEditor
  },
  data() {
    return {
      input: '',
      content: '',
      configs: {
        status: true, // 禁用底部状态栏
        initialValue: 'hellow', // 设置初始值
        renderingConfig: {
          codeSyntaxHighlighting: true, // 开启代码高亮
          highlightingTheme: 'atom-one-light' // 自定义代码高亮主题，可选列表(https://github.com/isagalaev/highlight.js/tree/master/src/styles)
        }
      },
      
    }
  },
}
</script>
<style>
  .editor {
    padding: 10px;
  }
  .note-title {
    padding: 10px 0;
  }
  .markdown-editor {
    width: 100%;
    height: 100%;
    overflow: auto;
  }
</style>
