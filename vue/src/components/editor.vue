<template>
<div class="editor">
  1111
    <!-- <tinymce id="editor" v-model="editor" :options="options" @change="change" :content='content'></tinymce> -->
    <tiny-mce id="description" v-model="description"></tiny-mce>
</div>
</template>

<script>
export default {
  name: 'editor',
  data () {
    return {
      msg: 'editor'
    }
  },
}
</script>
