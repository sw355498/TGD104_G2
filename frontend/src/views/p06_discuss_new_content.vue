<template>
    <div>
        <!-- navgation -->
        <frontNavbar />

        <main class="wrapper_p06_new_content">
            <div class="top_block">
                <div class="nonymous">
                    <label>
                        <span class="text">匿名發文：</span>
                        <input type="checkbox" name="" id="" class="checkbox">
                        <span class="btn-box">
                            <span class="btn"></span>      
                        </span>
                    </label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="form-label" style="">文章分類：</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>請選擇文章分類</option>
                        <option value="1">網站詐騙</option>
                        <option value="2">交友詐騙</option>
                        <option value="3">金融詐騙</option>
                    </select>
                </div>
                <div class="d-flex align-items-center">
                    <label for="discuss_title" class="form-label">文章標題：</label>
                    <input type="text" class="form-control" id="discuss_title">
                </div>
                <div class="d-flex align-items-center">
                    <label for="discuss_title" class="form-label">文章預設圖片：</label>
                    <label class="file_btn">
                        <input id="upload_img" class="d-none" type="file">
                        <i class="fa-solid fa-image fa-fw"></i>{{fileUrl}}
                    </label>
                </div>
            </div>
            <CKEditor />
        </main>

        <!-- footer -->
        <frontFooter />
    </div>
</template>

<script>
    import { ref } from 'vue';
    import CKEditor from '../components/CKEditor.vue';
    import frontNavbar from "@/components/f_nav.vue";
    import frontFooter from "@/components/f_footer.vue";

    export default {
        components: {
            CKEditor,
            frontNavbar,
            frontFooter,
        },
        setup() {
            const fileUrl = ref('上傳圖片')

            return{
                fileUrl,
                frontNavbar,
                frontFooter,
            }
        }
    }
</script>