<template>
    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


    export default {
        name: 'app',
        data() {
            return {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ]
                }
            };
        }
    }
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
