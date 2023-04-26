<template>
    <div class="b_left_nav flex-shrink-0">
        <div class="b_login_user d-flex flex-column justify-content-evenly">
            <div class="d-flex justify-content-center align-items-center">
                <div class="b_user_pic">
                    <img :src="userImage" :alt="userPic"  class="b_user_pic border border-dark"/>
                </div>
                <span class="paragraph m-0">{{ userName }}</span>
            </div>
            <div class="login d-flex justify-content-center align-items-center">
                <button class="small_button me-3" @click="settingAccount">帳號設定</button>
                <button class="small_button" @click="b_logout">登出</button>
            </div>
        </div>
        <nav>
            <ul class="list-unstyled text_title">
                <li v-for="item in navItems"  :key="item.id">
                    <a 
                        @click="changeTab(item.clickName)" 
                        class="link" 
                        :class="{ 'b_active': selectedTab === item.clickName}"
                    >
                            <i :class="item.icon + fontawesome"></i>
                            {{item.name}}
                    </a>
                </li>
                <li v-if="userLevel">
                    <a
                        @click="changeTab('staff')"  
                        class="link" 
                        :class="{ 'b_active': selectedTab === 'staff' }"
                    >
                        <i class="fa-solid fa-key fa-fw"></i>
                        後台帳號管理
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script setup>
    import { ref } from 'vue'
    import router from '@/router'
    const userImage = ref('')

    let id = 0
    const fontawesome = ref(' fa-solid fa-fw')
    const selectedTab = ref('user')
    const navItems = ref([
        {id: id++,name:'會員管理', icon:'fa-user', clickName: 'user'},
        {id: id++,name:'討論版管理', icon:'fa-message', clickName: 'discuss'},
        {id: id++,name:'回報可疑網站管理', icon:'fa-share', clickName: 'share'},
        // {id: id++,name:'檢舉管理', icon:'fa-exclamation', clickName: 'reply'},
        {id: id++,name:'最新消息管理', icon:'fa-circle-info', clickName: 'news'},
        {id: id++,name:'聊天機器人管理', icon:'fa-robot', clickName: 'chatbot'},
        {id: id++,name:'詐騙知識測驗管理', icon:'fa-gamepad', clickName: 'FraudKnowledge'},
    ])

    //子元件傳值父元件
    const emit = defineEmits(['response'])
    emit('response', selectedTab.value)
    function changeTab(newTab){
        selectedTab.value = newTab
        emit('response', selectedTab.value)
    }

    //父元件傳過來的值
    const props = defineProps({
        userLevel: Boolean,
        userName: String,
        userPic: String
    })
    userImage.value = require('@/assets/img/p08_user/' + props.userPic)

    //帳號登出
    const b_logout = () => {
        sessionStorage.removeItem("staff");
        router.push('/')
    }

    const settingAccount = () => {
        router.push('/b_settingAccount')
    }
</script>
<style>
    .fa-sharp{
        transform: translate(-50%, -50%);
    }
</style>