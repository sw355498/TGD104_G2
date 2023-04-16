<template>
    <Teleport to="body">
        <modal :show="showModal" @close="showModal = false">
        <template #header>
            <h4>{{btnName}}</h4>`
        </template>
        <template #body>
        <form @submit="handleSubmit">
            <label for="account">
                帳號<span class="text-danger">*<small>必填</small></span>
            </label>
            <div class="d-none text-danger" id="accountErrorText"></div>
            <input
                v-model="account" 
                type="text" 
                style="margin-bottom: 20px;" 
                id="account" 
                @focus="handleFocus('account')"
                
            >

            <label for="password">
                密碼<span class="text-danger">*<small>必填</small></span>
            </label>
            <div class="text-danger" id="passwordErrorText"></div>
            <input 
                v-model="password"
                type="password"
                style="margin-bottom: 20px;"
                id="password"
                @focus="handleFocus('password')"
                
            >
            
            <label for="nickname">
                顯示名稱
            </label>
            <input 
                v-model="nickname"
                type="text"
                style="margin-bottom: 20px;"
                id="nickname"
            >

            <button class="medium_button submitBtn" >送出</button>
        </form>  
        </template>
        </modal>
    </Teleport>
    <div class="d-flex">
        <LeftNav @response="selectedTab = $event" />
        <div class="b_content">
            <h2 class="h1_component">{{ h2Title }}</h2>
            <div class="d-flex justify-content-end align-items-center my-2">
                <button v-if="addbutton" class="medium_button b_add_btn me-2" @click="showModal = true">{{ btnName }}</button>
                <div class="position-relative">
                    <i class="fa-sharp fa-solid fa-magnifying-glass fa-fw position-absolute top-50 end-0"></i>
                    <input type="text">
                </div>
            </div>
            <div id="jsGrid"></div>
        </div>
    </div>
</template>
<script setup>
    import { ref, watch, onMounted} from 'vue'
    import $ from 'jquery'
    import 'jsgrid'
    import LeftNav from '../components/b_leftNav.vue';
    import Modal from '@/components/modal.vue';
    import { API_URL } from '@/config';
    import axios from 'axios';
    
    const selectedTab = ref('user')
    const h2Title = ref('會員管理')
    const addbutton = ref(true)
    const btnName = ref('新增會員')


    //監控子元件傳來的值
    watch(selectedTab, (newTab) => {
        console.log(newTab)
        switch (newTab){
            case 'user':
                h2Title.value = '會員管理';
                addbutton.value = true;
                btnName.value = '新增會員';
                break;
            case 'message':
                h2Title.value = '討論版管理';
                addbutton.value = false;
                break;
            case 'share':
                h2Title.value = '回報管理';
                addbutton.value = false;
                break;
            case 'reply':
                h2Title.value = '檢舉管理';
                addbutton.value = false;
                break;
            case 'news':
                h2Title.value = '最新消息管理';
                addbutton.value = true;
                btnName.value = '新增消息';
                break;
            case 'teach':
                h2Title.value = '防騙教學介紹管理';
                addbutton.value = true;
                btnName.value = '新增教學';
                break;
            case 'score':
                h2Title.value = '互動體驗成績管理';
                addbutton.value = false;
                break;
            case 'chatbot':
                h2Title.value = '聊天機器人管理';
                addbutton.value = true;
                btnName.value = '新增機器人回答內容';
                break;
            case 'staff':
                h2Title.value = '後台帳號管理';
                addbutton.value = true;
                btnName.value = '新增管理員帳號';
                break;
        }
    })

    const clients = ref([])
    const fields = ref([])

    const countries = [
    { Name: "", Id: 0 },
    { Name: "United States", Id: 1 },
    { Name: "Canada", Id: 2 },
    { Name: "United Kingdom", Id: 3 }
    ]
    let id = 0, user = 111
    clients.value = [
        { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
        { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Google", "狀態": "正常", },
    ];
    
    fields.value = [
        { name: 'ID', css: 'd-none'},
        { name: "帳號", type: "text", validate: "required" },
        { name: "暱稱", type: "text", width: 100, css: "d-none" },
        { name: "建立日期", type: "text", width: 80 },
        { name: "E-mail", type: "text"},
        { name: "登入方式", type: "text", width: 60},
        { name: "狀態", type: "text", width: 50},
        { name: "操作", width: 150, itemTemplate:function(){
            let $buttonContainer = $("<div>")

            let $blockade = $("<button>").text(`封鎖`).addClass("small_button mx-1").on("click", operate);
            $buttonContainer.append($blockade);
            let $delete = $("<button>").text("刪除").addClass("small_button mx-1").on("click", operate);
            $buttonContainer.append($delete);
            let $revise = $("<button>").text("修改").addClass("small_button mx-1").on("click", operate);
            $buttonContainer.append($revise);
            
            let $check = $("<button>").text("查看").addClass("small_button mx-1").on("click", operate);
            $buttonContainer.append($check);
            return $buttonContainer
        }},
    ];

    onMounted(() => {
        // 因為 jsGrid 模組是動態載入的，所以必須使用 import('jsgrid') 並且在其回傳的 Promise resolved 之後才能使用 $('#jsGrid').jsGrid() 方法。
        import('jsgrid').then((jsGrid) => {
            $('#jsGrid').jsGrid({
                width: "100%",
                inserting: false, //添加
                editing: false, //編輯
                sorting: true, //排序
                /*分頁設定*/
                paging: true,
                pagerContainer: null,   //jQueryElement或DomNode指定呈現一個分頁欄，為null時在表格底部。
                pageIndex: 1,   //當前頁面數
                pageSize: 8,   //頁面的數據量
                pageButtonCount: 2,    //最大數量的頁面按鈕
                pagerFormat: "{first} {pages} {last} &nbsp;&nbsp; {pageIndex} of {pageCount}", //占位符來指定分頁欄格式
                //pageNextText: "Next",   //下一頁
                //pagePrevText: "Prev",   //上一頁
                pageFirstText: "首頁", //首頁
                pageLastText: "最後一頁",   //尾頁
                pageNavigatorNextText: "...",    //最大數量頁面按鈕超出時右邊顯示
                pageNavigatorPrevText: "...",       //最大數量頁面按鈕超出時右邊顯示
                data: clients.value,
                fields: fields.value
            });
        });
    });

    // jsGrid內的自製按鈕事件
    function operate(){
        let thisID = this.closest('tr').firstElementChild.innerHTML
        switch (this.innerHTML){
            case "封鎖":
                alert(`封鎖帳號 ${thisID}`)
                break
            case "刪除":
                alert(`刪除帳號 ${thisID}`)
                break
            case "修改":
                alert(`修改帳號 ${thisID}`)
                break
            case "查看":
                alert(`查看帳號 ${thisID}`)
                break
        }
    }

    //彈窗設定
    const showModal = ref(false)
    const account = ref('')
    const password = ref('')
    const nickname = ref('')
    const handleSubmit = async (e) => {
        console.log(btnName.value)
        e.preventDefault()
        try {
            if(btnName.value === '新增會員'){
                const response = await axios.post(`${API_URL}add_user.php`, {
                    account: account.value,
                    password: password.value,
                    nickname: nickname.value,
                    accountTypeID: 1,
                })
            } else if(btnName.value === '新增管理員帳號'){
                const response = await axios.post(`${API_URL}add_user.php`, {
                    account: account.value,
                    password: password.value,
                    nickname: nickname.value,
                    accountTypeID: 2,
                })
            }
            if(response.data === "帳號註冊成功"){
                // 清除表單
                account.value = ''
                password.value = ''
                nickname.value = ''
                // 清除可能存在的error
                removeError('account')
                removeError('password')
                // 關閉彈窗
                showModal.value = false
            } else if(response.data === "此帳號已被註冊") {
                addError('account', '此帳號已被註冊')
            } else if (response.data === "帳號與密碼尚未輸入"){
                addError('account', '帳號尚未輸入')
                addError('password', '密碼尚未輸入')
            } else if (response.data === "帳號尚未輸入"){
                addError('account', '帳號尚未輸入')
            } else if (response.data === "密碼尚未輸入"){
                addError('password', '密碼尚未輸入')
            } else {
                console.log(response.data)
            }

        } catch (e) {
            if (e.response) {
                console.log(e.response.data.message)
            } else {
                console.log(e.message)
            }
        }
    }

    const handleFocus = (theInputID) => {
        removeError(theInputID)
    }

    // 新增錯誤訊息
    const addError = (InputID, ErrorText) => {
        let theInputDOM = document.querySelector(`#${InputID}`)
        let theErrorText = document.querySelector(`#${InputID}ErrorText`)
        theInputDOM.classList.add('error')
        theErrorText.classList.remove('d-none')
        theErrorText.innerText = ErrorText
    }

    //刪除錯誤訊息
    const removeError= (InputID) => {
        let theInputDOM = document.querySelector(`#${InputID}`)
        if(theInputDOM.classList.contains('error')){
            let theErrorText = document.querySelector(`#${InputID}ErrorText`)
            theInputDOM.classList.remove('error');
            theErrorText.classList.add('d-none')
        }
    }
</script>

<style lang="scss">
    .fa-sharp{
        transform: translate(-50%, -50%);
    }
    #jsGrid{
        .jsgrid-header-sortable::before{
            top: 10px;
            left: 0px;
        }
    }
    .submitBtn{
        float: right;
        &::after {
            content: "";
            display: block;
            clear: both;
        }
    }
    .error{
        outline: 3px solid red;
    }
</style>