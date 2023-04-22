<template>
    <Teleport to="body">
        <modal
            :show="showModal"
            :modelWidth="bigModal"
            @close="showModal = false,modelWidth= true, goback()"
        >
        <template #header>
            <h4></h4>
        </template>
        <template #body>
            <form class="pb-3" @submit="handleSubmit" id="addDataForm">
                <form class="pb-3" @submit="handleSubmit" id="addDataForm">
                <div v-if="whichTable === 'USER'">     
                    <div class="mb-3">                    
                        <label for="account">
                            帳號
                        </label>
                        <div class="d-none text-danger" id="accountErrorText"></div>
                        <input
                            v-model="account"
                            type="email"
                            id="account"
                            required
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="nickname"> 顯示名稱 </label>
                        <input
                            v-model="nickname"
                            type="text"
                            style="margin-bottom: 20px"
                            id="nickname"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="mobile"> 電話 </label>
                        <input
                            v-model="mobile"
                            type="tel"
                            style="margin-bottom: 20px"
                            id="mobile"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="birth"> 生日 </label>
                        <input
                            v-model="birth"
                            type="date"
                            style="margin-bottom: 20px"
                            id="birth"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="createTime"> 建立日期 </label>
                        <input
                            v-model="createTime"
                            type="date"
                            style="margin-bottom: 20px"
                            id="createTime"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="userStatus"> 帳號狀態 </label>
                        <input
                            v-model="userStatus"
                            type="text"
                            style="margin-bottom: 20px"
                            id="userStatus"
                            readonly
                        />
                    </div> 
                    <div class="mb-3">                  
                        <label for="loginType"> 登入方式 </label>
                        <input
                            v-model="loginType"
                            type="text"
                            style="margin-bottom: 20px"
                            id="loginType"
                            readonly
                        />
                    </div> 
                </div>
                <button class="medium_button submitBtn mx-3" @click="goback">返回後台</button>
            </form>

            </form>
        </template>
        </modal>
    </Teleport>
</template>
<script setup>
import { ref, onMounted} from "vue";
import { useRoute } from 'vue-router'
import Modal from "@/components/modal.vue";
import router from "@/router";
import { API_URL } from "@/config";
import axios from "axios";

//彈窗設定
const showModal = ref(true); //彈窗顯示設定
const bigModal = ref(true); //彈窗寬度是否要為width 75%

//接收傳過來的參數
const id = ref('')
const readonly = ref()
const whichTable = ref('')

const route = useRoute()
id.value = Number(route.query.id)
readonly.value = route.query.readonly
whichTable.value = route.query.whichTable

//input的變數
const account =ref('')
const nickname =ref('')
const mobile =ref('')
const birth =ref('')
const createTime =ref('')
const userStatus =ref('')
const loginType =ref('')



onMounted(async () => {
    //撈取資料庫的資料
    selectTable();


});


const goback = () => {
    router.push('/b_index');
}

//資料庫查詢
async function selectTable() {
    try {
        const response = await axios.post(`${API_URL}b_updata_select.php`, {
            whichTable: whichTable.value,
            whichID: id.value
        });
        account.value = response.data[0].ACCOUNT
        nickname.value = response.data[0].NICKNAME
        mobile.value = response.data[0].MOBILE
        birth.value = response.data[0].BIRTH
        createTime.value = response.data[0].CREATE_TIME
        userStatus.value = response.data[0].USER_STATUS_NAME
        loginType.value = response.data[0].LOGIN_TYPE
        return response.data.data;
    } catch (e) {
        if (e.response) {
            console.log(e.response.data.message);
        } else {
            console.log(e.message);
        }
    }
}
</script>
<style lang="scss">
    .submitBtn {
        float: right;
        &::after {
            content: "";
            display: block;
            clear: both;
        }
    }
    .error {
        outline: 3px solid red;
    }
    .file_btn {
        width: 100%;
        height: 38px;
        font-size: 1rem;
        padding: 0.375rem 0.75rem;
        background: #033159;
        color: #ffffff;
        border: 1px solid #033159;
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.25);
        border-radius: 4px;
        line-height: 150%;
        cursor: pointer;
        text-align: center;
        white-space: nowrap;
        line-height: 1.5;
    }
</style>
