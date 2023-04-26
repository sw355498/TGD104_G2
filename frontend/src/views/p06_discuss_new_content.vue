<template>
    <div>
        <!-- navgation -->
        <frontNavbar />

        <main class="wrapper_p06_new_content">
            <div class="top_block">
                <div class="nonymous">
                    <label>
                        <span class="text">匿名發文：</span>
                        <input type="checkbox" name="" id="" class="checkbox" v-model="isChecked" @click="isChecked = !isChecked">
                        <span class="btn-box">
                            <span class="btn"></span>      
                        </span>
                    </label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="form-label" style="">文章分類：</label>
                    <select class="form-select" aria-label="Default select example" v-model="selectDiscussType">
                        <option selected>請選擇文章分類</option>
                        <option value="1">網站詐騙</option>
                        <option value="2">交友詐騙</option>
                        <option value="3">金融詐騙</option>
                    </select>
                </div>
                <div class="d-flex align-items-center">
                    <label for="discuss_title" class="form-label">文章標題：</label>
                    <input type="text" class="form-control" id="discuss_title" v-model="title">
                </div>
                <div class="d-flex align-items-center">
                    <label for="discuss_title" class="form-label">文章預設圖片：</label>
                    <label class="file_btn">
                        <input id="upload_img" class="d-none" type="file" @change="picSubmit">
                        <i class="fa-solid fa-image fa-fw"></i>上傳圖片<span>{{ ImgName }}</span>
                    </label>
                </div>
            </div>
            <CKEditor
                @content="content = $event" />

            <div class="text-center"><button class="big_button w-25" @click="submitButton">送出</button></div>
            
        </main>

        <!-- footer -->
        <frontFooter />
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import axios from 'axios';
    import CKEditor from '@/components/CKEditor.vue';
    import frontNavbar from "@/components/f_nav.vue";
    import frontFooter from "@/components/f_footer.vue";
    import { API_URL } from "@/config";
    
    const fileImage = ref();
    const ImgName = ref();
    const title = ref();
    const isChecked = ref(false);
    const nonname = ref();
    const selectDiscussType = ref();
    // const editorData = ref();
    const content = ref();

    function picSubmit(event){
        fileImage.value = event.target.files[0];
        ImgName.value = `: ${fileImage.value.name}`;
    }
    
    // 是否匿名
    if(isChecked.value){
        // 2是匿名
        nonname.value = 2;
    }else{
        // 1是不匿名
        nonname.value = 1;
    }

    function submitButton(){
        
        // 封裝成 FormData 的形式傳給後端處理資料
        const form = new FormData();
        form.append('userId', localStorage.getItem('token'));
        form.append('title', title.value);
        form.append('newImage', fileImage.value);
        form.append('content', content.value);
        form.append('nonname', nonname.value);
        form.append('discussTypeId', selectDiscussType.value);

        axios
        .post(`${API_URL}add_discuss.php`, form)
        .then((response)=>{
            alert(response.data.message);
            window.location = 'discuss';
        })
        .catch(err => alert(`發生了某些連線錯誤，請聯繫技術人員! 錯誤訊息: ${err.response.data}`));
    }
    

</script>