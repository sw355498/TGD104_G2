<template>
    <div class="wrapper_p06_new_content">
        <div class="row mb-5">
            <div class="col-12 col-md-6">
                <label>
                    <span class="text">匿名發文：</span>
                    <input type="checkbox" name="" id="" class="checkbox">
                    <span class="btn-box">
                        <span class="btn"></span>      
                    </span>
                </label>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center">
                <label class="form-label">文章分類：</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>請選擇文章分類</option>
                    <option value="1">網站詐騙</option>
                    <option value="2">交友詐騙</option>
                    <option value="3">金融詐騙</option>
                </select>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center">
                <label for="inputPassword4" class="form-label">文章標題：</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center">
                <label class="btn btn-info">
                    <input id="upload_img" style="display:none;" type="file">
                    <i class="fa fa-photo"></i> 上傳圖片
                </label>
            </div>
        </div>

        <CKEditor />
    </div>
</template>

<script>
    import CKEditor from '../components/CKEditor.vue';

    export default {
        components: {
            CKEditor
        },
        setup() {
            
        }
    }
</script>