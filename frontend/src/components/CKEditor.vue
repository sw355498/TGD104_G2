<template>
    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" ref="editorRef"></ckeditor>
</template>

<script setup>

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import { ref, watch } from 'vue';
    const editorData = ref();
    const editor = ref();
    const editorConfig = ref();

    editor.value = ClassicEditor;
    editorData.value = '';
    
    const emit = defineEmits(['content']);
    emit('content', editorData.value);
    watch(editorData, (newValue)=>{
        editorData.value = newValue;
        emit('content', editorData.value);
    })

</script>

<style>
    .ck-content{
        min-height: 200px;
    }
    .ck-content *{
        color: #08171E;
    }
    .ck-editor{
        margin-bottom: 30px!important;
    }
</style>
