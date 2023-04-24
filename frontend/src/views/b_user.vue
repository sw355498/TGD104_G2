<template>
    <Teleport to="body">
        <modal
            :show="showModal"
            :modelWidth="bigModal"
            @close="showModal = false,modelWidth= true, goback()"
        >
        <template #header>
            <h4>單筆查詢</h4>
        </template>
        <template #body>
            <form class="pb-3" @submit="handleSubmit" id="b_dataFrom">
                <div v-if="whichTable === 'USER' || whichTable === 'staff'">     
                    <div class="mb-3">                    
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
                    <div class="mb-3">                  
                        <label for="nickname"> 顯示名稱 </label>
                        <input
                            v-model="nickname"
                            type="text"
                            class="form-control-plaintext"
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
                            class="form-control-plaintext"
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
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="birth"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="user_createTime"> 建立日期 </label>
                        <input
                            v-model="user_createTime"
                            type="date"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="user_createTime"
                            readonly
                        />
                    </div>
                    <div class="mb-3">                  
                        <label for="userStatus"> 帳號狀態 </label>
                        <input
                            v-model="userStatus"
                            type="text"
                            class="form-control-plaintext"
                            style="margin-bottom: 20px"
                            id="userStatus"
                            readonly
                        />
                    </div> 
                </div>

                <div class="text-end">
                    <button class="medium_button" @click="goback">返回後台</button>
                    <button class="medium_button" @click="upData">更新資料</button>
                </div>
            </form>
        </template>
        </modal>
    </Teleport>
</template>
<script setup>
import { ref, onMounted} from "vue";
import Modal from "@/components/modal.vue";
import router from "@/router";
import { API_URL } from "@/config";
import axios from "axios";

//彈窗設定
const showModal = ref(true); //彈窗顯示設定
const bigModal = ref(true); //彈窗寬度是否要為width 75%

</script>

<style>
        .fa-sharp{
            transform: translate(-50%, -50%);
        }
</style>