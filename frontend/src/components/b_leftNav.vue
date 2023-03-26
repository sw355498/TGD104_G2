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
                <li><a href="" class="b_active"><i class="fa-solid fa-user fa-fw"></i>會員管理</a></li>
                <li><a href=""><i class="fa-solid fa-message fa-fw"></i>討論版管理</a></li>
                <li><a href=""><i class="fa-solid fa-share fa-fw"></i>回報管理</a></li>
                <li><a href=""><i class="fa-solid fa-exclamation fa-fw"></i>檢舉管理</a></li>
                <li><a href=""><i class="fa-solid fa-circle-info fa-fw"></i>最新消息管理</a></li>
                <li><a href=""><i class="fa-solid fa-masks-theater fa-fw"></i>防騙教學介紹管理</a></li>
                <li><a href=""><i class="fa-solid fa-people-pulling fa-fw"></i>互動體驗成績管理</a></li>
                <li><a href=""><i class="fa-solid fa-robot fa-fw"></i>聊天機器人管理</a></li>
                <li><a href=""><i class="fa-solid fa-key fa-fw"></i>後台帳號管理</a></li>
            </ul>
        </nav>
    </div>
</template>
<style>
    .fa-sharp{
        transform: translate(-50%, -50%);
    }
</style>