<template>
    <div class="b_left_nav flex-shrink-0">
        <div class="b_login_user d-flex flex-column justify-content-evenly">
            <div class="d-flex justify-content-center align-items-center">
                <div class="b_user_pic">
                    <img src="https://loremflickr.com/600/400" alt="cat"  class="b_user_pic"/>
                </div>
                <span class="paragraph m-0">User_name</span>
            </div>
            <div class="login d-flex justify-content-center align-items-center">
                <button class="small_button me-3">帳號設定</button>
                <button class="small_button">登出</button>
            </div>
        </div>
        <nav>
            <ul class="list-unstyled text_title">
                <li v-for="item in navItems" :class="{ 'b_active': selectedTab === item.clickName}" :key="item.id">
                    <a @click.prevent="selectedTab = item.clickName" class="link"><i :class="item.icon + fontawesome"></i>{{item.name}}</a>
                </li>
                <li :class="{ 'b_active': selectedTab === 'staff' }"><a @click.prevent="selectedTab = 'staffManagement'" class="link"><i class="fa-solid fa-key fa-fw"></i>後台帳號管理</a></li>
            </ul>
        </nav>
    </div>
</template>
<script>
    import { ref } from 'vue'
    export default {
        setup() {
            let id = 0
            const fontawesome = ref(' fa-solid fa-fw')
            const navItems = ref([
                {id: id++,name:'會員管理', icon:'fa-user', clickName: 'user'},
                {id: id++,name:'討論版管理', icon:'fa-message', clickName: 'message'},
                {id: id++,name:'回報管理', icon:'fa-share', clickName: 'share'},
                {id: id++,name:'檢舉管理', icon:'fa-exclamation', clickName: 'reply'},
                {id: id++,name:'最新消息管理', icon:'fa-circle-info', clickName: 'news'},
                {id: id++,name:'防騙教學介紹管理', icon:'fa-masks-theater', clickName: 'teach'},
                {id: id++,name:'互動體驗成績管理', icon:'fa-people-pulling', clickName: 'score'},
                {id: id++,name:'聊天機器人管理', icon:'fa-robot', clickName: 'chatbot'},
            ])

            const selectedTab = ref('')

            return {
                navItems,
                fontawesome,
                selectedTab,
            }
        },
    }
</script>
<style>
    .fa-sharp{
        transform: translate(-50%, -50%);
    }
</style>