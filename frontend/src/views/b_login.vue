<template>
    <div>
        <Teleport to="body">
            <modal :show="showModal"  @close="showModal = false,modelWidth= false,goback()">
            <template #header>
                <h4>登入後台帳號</h4>
            </template>
            <template #body>
                <form class="pb-3" @submit="handleSubmit" id="addDataForm">
                    <div>     
                        <div class="mb-3">                    
                            <label for="account">
                                帳號<span class="text-danger">*<small>必填</small></span>
                            </label>
                            <div class="d-none text-danger" id="accountErrorText"></div>
                            <input
                                v-model="account"
                                type="email"
                                id="account"
                                @focus="removeError('account')"
                                
                            />
                        </div>           
                        <div class="mb-3">                   
                            <label for="password">
                                密碼<span class="text-danger">*<small>必填</small></span>
                            </label>
                            <div class="text-danger" id="passwordErrorText"></div>
                            <input
                                v-model="password"
                                type="password"
                                id="password"
                                @focus="removeError('password')"
                                
                            />
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="medium_button">送出</button>
                    </div>
                </form>
            </template>
            </modal>
        </Teleport>
    </div>
</template>
<script setup>
    import { ref } from "vue";
    import Modal from "@/components/modal.vue";
    import { API_URL } from "@/config";
    import axios from "axios";
    import router from '@/router'

    const showModal = ref(true)
    const account = ref('')
    const password = ref('')

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post(`${API_URL}b_login.php`, {
                account: account.value,
                password: password.value,
            });
            if(response.data.hasOwnProperty('message')){
                //確認sessionStorage是否存在currentStaff物件，如果不存在則建立一個空物件
                const currentStaff = JSON.parse(sessionStorage.getItem('staff')) || {}

                //把需要的參數加到物件中
                currentStaff.id = response.data.id
                currentStaff.account = response.data.account
                currentStaff.nickname = response.data.nickname
                currentStaff.pic = response.data.pic
                currentStaff.account_type_id = response.data.account_type_id

                //寫入至sessionStorage
                sessionStorage.setItem('staff', JSON.stringify(currentStaff))

                // 清除表單
                account.value = "";
                password.value = "";
                // 清除可能存在的error
                removeError("account");
                removeError("password");
                // 關閉彈窗
                showModal.value = false;
                router.push('/b_index')
            }
            if(response.data === '帳號或密碼錯誤'){
                addError("account", "帳號或密碼錯誤");
                addError("password", "帳號或密碼錯誤");
            }
            if (response.data.hasOwnProperty('errorAccount')) {
                addError("account", "帳號尚未輸入");
            }
            if (response.data.hasOwnProperty('errorPassword')) {
                addError("password", "密碼尚未輸入");
            }

        } catch (e) {
            if (e.response) {
                console.log(e.response.data.message);
            } else {
                console.log(e.message);
            }
        }
    };

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
    const goback = () => {
        router.push('/')
    }
</script>
<style lang="scss">
.error {
    outline: 3px solid red;
}
</style>