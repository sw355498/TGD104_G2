<template>
    <Teleport to="body">
        <modal
            :modelWidth="bigModal"
            :show="showModal"
            @close="closeModal,modelWidth= false"
        >
        <template #header>
            <h4>密碼更新</h4>
        </template>
        <template #body>
            <form class="pb-3" @submit="passwordSubmit" id="b_dataFrom">
                <div>     
                    <div class="mb-3">                  
                        <label for="oldPassword"> 舊密碼 </label>
                        <div class="d-none text-danger" id="oldPasswordErrorText"></div>
                        <input
                            v-model="oldPassword"
                            type="password"
                            class="form-control"
                            style="margin-bottom: 20px"
                            id="oldPassword"
                            @focus="removeError('oldPassword')"
                        />
                    </div> 
                    <div class="mb-3">                  
                        <label for="newPassword"> 新密碼 </label>
                        <div class="d-none text-danger" id="newPasswordErrorText"></div>
                        <input
                            v-model="newPassword"
                            type="password"
                            class="form-control mb-3"
                            id="newPassword"
                            @focus="removeError('newPassword')"
                        />
                    </div> 
                    <div class="mb-3">                  
                        <label for="confirmPassword"> 再次輸入密碼 </label>
                        <div class="d-none text-danger" id="confirmPasswordErrorText"></div>
                        <input
                            v-model="confirmPassword"
                            type="password"
                            class="form-control mb-3"
                            id="confirmPassword"
                            @blur="confirming"
                            @focus="removeError('confirmPassword')"
                        />
                    </div> 
                </div>
                <div class="text-end">
                    <button class="medium_button me-4">更新密碼</button>
                    <button class="medium_button" @click="goback">取消</button>
                </div>
            </form>
        </template>
        </modal>
    </Teleport>
    <div class="w-75 mx-auto mt-5 row">
        <div class="col-3 text-center">
            <img :src="userPic" class="img-fluid" alt="">
            <div class="mt-3">
                <div class="d-none text-danger" id="upload_imgErrorText"></div>
                <label class="file_btn">
                    <input 
                        id="upload_img" 
                        class="d-none" 
                        type="file" 
                        @change="fileChange"
                    />
                    <i class="fa-solid fa-image fa-fw"></i>更換大頭貼
                </label>
            </div>
            <button class="medium_button mt-3 w-100" @click="showModal = true">更換密碼</button>
            <div class="d-flex gx-5">
            </div>
        </div>
        <div class="col">       
            <form class="text-light row g-3" @submit="handleSubmit" id="b_dataFrom">
                <div>     
                    <div class="mb-3 col">                    
                        <label for="account">
                            帳號
                        </label>
                        <input
                            v-model="account"
                            type="email"
                            class="form-control-plaintext"
                            id="account"
                            required
                            readonly
                        />
                    </div>
                    <div class="mb-3 col">                  
                        <label for="nickname"> 顯示名稱 </label>
                        <input
                            v-model="nickname"
                            type="text"
                            class="form-control"
                            style="margin-bottom: 20px"
                            id="nickname"
                        />
                    </div>
                    <div class="mb-3 col">                  
                        <label for="mobile"> 電話 </label>
                        <input
                            v-model="mobile"
                            type="tel"
                            class="form-control"
                            style="margin-bottom: 20px"
                            id="mobile"
                        />
                    </div>
                    <div class="mb-3 col">                  
                        <label for="birth"> 生日 </label>
                        <input
                            v-model="birth"
                            type="date"
                            class="form-control"
                            style="margin-bottom: 20px"
                            id="birth"
                        />
                    </div>
                </div>

                <div class="text-center">
                    <button class="medium_button me-5" @click="upData">更新資料</button>
                    <button class="medium_button" @click="goback">返回後台</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, watch} from "vue";
import Modal from "@/components/modal.vue";
import router from "@/router";
import { API_URL } from "@/config";
import axios from "axios";
import Swal from "sweetalert2/dist/sweetalert2.js";

//彈窗設定
const showModal = ref(false); //彈窗顯示設定
const bigModal = ref(false); //彈窗寬度是否要為width 75%

//表單驗證所需的正規式
const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/

const fileImage = ref()
const fileImageName = ref()
const oldPassword = ref('')
const newPassword = ref('')
const confirmPassword = ref('')
const account = ref('')
const nickname = ref('')
const mobile = ref('')
const birth = ref('')
const userPic = ref('')

//從sessionStorage撈取資料
const id = ref('')
let savedData = JSON.parse(sessionStorage.getItem('staff'));
id.value = Number(savedData.id)

onMounted(async () => {
    //撈取資料庫的資料
    selectTable();
});

//更換大頭貼
async function fileChange(e) {
    fileImage.value = e.target.files[0]
    fileImageName.value = e.target.files[0].name
    removeError("upload_img");
    const formData = new FormData();
        formData.append('account', account.value);
        formData.append('newImage', fileImage.value);
        
    try {
        const response = await axios.post(`${API_URL}changeImage.php`, formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            });
            const strResponse = response.data.trimEnd();
            const arrResponse = strResponse.split(',')
            if(arrResponse.includes('圖片更新成功')){
                Swal.fire({
                    title: "圖片更新成功",
                    icon: "success",
                    confirmButtonText: "確認",
                });
                try {
                    userPic.value = require('@/assets/img/p08_user/' + fileImageName.value)
                } catch (e) {
                    userPic.value = `https://tibamef2e.com/tgd104/g2/img/${fileImageName.value}`
                }
                return userPic.value
                // return userPic.value = require('@/assets/img/p08_user/' + fileImageName.value)
            } else if(response.data === '只允許上傳 jpg 或 phg 或 gif 格式的圖片檔案'){
                addError("upload_img", "只允許上傳 jpg 或 phg 或 gif 格式的圖片檔案");
            } else if(response.data === '檔案大小不得超過1MB'){
                addError("upload_img", "檔案大小不得超過1MB");
            } else {
                console.log('error-Image')
            }
        } catch (e) {
            if (e.response) {
                console.log(e.response.data.message);
            } else {
                console.log(e.message);
            }
        }
}


//密碼更新
const confirming = () => {
    if(confirmPassword.value !== newPassword.value){
        addError('newPassword', '密碼不一致')
        addError('confirmPassword', '密碼不一致')
    } else {
        removeError('newPassword')
        removeError('confirmPassword')
    }
}
//密碼表單送出
const passwordSubmit = async (e) => {
    e.preventDefault();
    // 清除可能存在的error
    removeError('oldPassword')
    removeError('newPassword')
    removeError('confirmPassword')

    // 前端驗證使用正規式驗證password是否包含至少一個數字一個英文字長度不得小於6個字的格式
    if(!passwordRegex.test(newPassword.value)){
        addError("newPassword", "密碼至少一個數字一個英文字，長度不得小於6個字");
    }else if(confirmPassword.value !== newPassword.value){
        addError('newPassword', '密碼不一致')
        addError('confirmPassword', '密碼不一致')
    } else {
        try {
            const response = await axios.post(`${API_URL}changePassword.php`, {
                account: account.value,
                oldPassword: oldPassword.value,
                newPassword: newPassword.value
            });
            const strResponse = response.data.trimEnd();
            const arrResponse = strResponse.split(',')
            if(arrResponse.includes('密碼修改成功')){
                Swal.fire({
                    title: "密碼更新成功",
                    icon: "success",
                    confirmButtonText: "確認",
                });
                closeModal()
            } else {
                if(arrResponse.includes('密碼修改失敗')){
                    addError('oldPassword', '密碼修改失敗')
                    addError('newPassword', '密碼修改失敗')
                    addError('confirmPassword', '密碼修改失敗')
                } else {
                    if(arrResponse.includes('密碼輸入錯誤')){
                        addError('oldPassword', '密碼輸入錯誤')
                    }
                    if(arrResponse.includes('原密碼尚未輸入')){
                        addError('oldPassword', '原密碼尚未輸入')
                    }
                    if(arrResponse.includes('新密碼尚未輸入')){
                        addError('newPassword', '新密碼尚未輸入')
                        addError('confirmPassword', '新密碼尚未輸入')
                    }
                }
            }
        } catch (e) {
            if (e.response) {
                console.log(e.response.data.message);
            } else {
                console.log(e.message);
            }
        }
    }
}


//返回後台
const  goback = () => {
    router.push('/b_index');
}


//表單送出
const handleSubmit = async (e) => {
    e.preventDefault()
    try {
        const response = await axios.post(`${API_URL}b_data_insert.php`, {
            whichTable: 'USER',
            nickname: nickname.value,
            mobile: mobile.value,
            birth: birth.value,
            whichID: id.value 
        });
        account.value = response.data[0].ACCOUNT
        nickname.value = response.data[0].NICKNAME
        mobile.value = response.data[0].MOBILE
        birth.value = response.data[0].BIRTH
        if (response.data === "更新資料成功") {
            Swal.fire({
                title: '資料更新成功',
                icon: 'success',
                confirmButtonText: "確認",
            })
            //撈取資料庫的資料
            selectTable();
        } else {
            console.log(response.data);
        }
        return response.data.data;
    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}

//資料庫查詢
const selectTable = async() => {
    try {
        const response = await axios.post(`${API_URL}b_data_select.php`, {
            whichTable: 'USER',
            whichID: id.value
        });
        account.value = response.data[0].ACCOUNT
        nickname.value = response.data[0].NICKNAME
        mobile.value = response.data[0].MOBILE
        birth.value = response.data[0].BIRTH
        try {
            if(response.data[0].PIC){
                userPic.value = require('@/assets/img/p08_user/' + response.data[0].PIC)
            } else{
                userPic.value = require('@/assets/img/p08_user/user.jpg')
            }
        } catch (e) {
            if(response.data[0].PIC){
                userPic.value = `https://tibamef2e.com/tgd104/g2/img/${response.data[0].PIC}`
            } else{
                userPic.value = `https://tibamef2e.com/tgd104/g2/img/user.jpg`
            }
        }
        // if(response.data[0].PIC){
        //     userPic.value = require('@/assets/img/p08_user/' + response.data[0].PIC)
        // } else{
        //     userPic.value = require('@/assets/img/p08_user/user.jpg')
        // }
        return response.data.data;
    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}

//關閉彈窗
const closeModal = () => {
    //清除 input
    oldPassword.value = "";
    newPassword.value = ""
    confirmPassword.value = ""
    
    // 清除可能存在的error
    removeError('oldPassword')
    removeError('newPassword')
    removeError('confirmPassword')
    // 關閉彈窗
    showModal.value = false;
}

// 新增錯誤訊息
const addError = (InputID, ErrorText) => {
    let theInputDOM = document.querySelector(`#${InputID}`);
    let theErrorText = document.querySelector(`#${InputID}ErrorText`);
    theInputDOM.classList.add("error");
    theErrorText.classList.remove("d-none");
    theErrorText.innerText = ErrorText;
};

//刪除錯誤訊息
const removeError = (InputID) => {
    let theInputDOM = document.querySelector(`#${InputID}`);
    if (theInputDOM.classList.contains("error")) {
        let theErrorText = document.querySelector(`#${InputID}ErrorText`);
        theInputDOM.classList.remove("error");
        theErrorText.classList.add("d-none");
    }
};
</script>

<style>
    .b_settingAccount_block{
        top: 50%;
        left: 50%;
    }
</style>