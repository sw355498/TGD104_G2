<template>
 
    <section class="p07_resultbg">

        <div class="result_background">

            <!-- 彈跳視窗 -->

            <!-- <div class="p07game_login_alert">
                <div class="alert_cross">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>    
                </div>   
                <div class="login_panel">
                
                <p>您尚未登入會員，請問是否要登入會員記錄分數？</p>
                
                <button class="gamebutton game_login" >
                <router-link to='/p08_userLogin'>    
                    登入會員
                </router-link>    
                </button>
                <button class="gamebutton game_cancel" >取消</button>    
                    
                </div>                
            </div> -->


            <!-- 測驗計分標題 -->

            <div class="p07_gameend_result">
                <div class="result_frame">
                    <h1 class="result_title">測驗計分</h1>
                </div>
                
            </div>

            <!-- 測驗視窗1 -->

            <div class="result_view view1">
               <p>測驗結果，你的防詐指數....</p>
               <p class="result_percent">...80%</p>
            </div>

            <!-- 測驗視窗2 -->

            <div class="result_view view2">
               <p>哇！你是正港的防詐達人！</p>
              
            </div>


            <!-- 按鈕部分 -->


             <div class="again">

                <button class="again_quiz_botton">
                   <router-link to='/p07demoGamep01'>
                    再玩一次&emsp;  
                   <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="9.92871" y="8" width="10" height="10" transform="rotate(-45 9.92871 8)" fill="#033159"/>
                    <rect x="0.928711" y="17" width="10" height="10" transform="rotate(-45 0.928711 17)" fill="#033159"/>
                    <rect x="18.9287" y="17" width="10" height="10" transform="rotate(-45 18.9287 17)" fill="#033159"/>
                    <rect x="9.92871" y="26" width="10" height="10" transform="rotate(-45 9.92871 26)" fill="#033159"/>
                    </svg>

                    </router-link></button>


                <div class="again_quiz_frame"></div>
                
            </div>


             <div class="index">

                <button class="index_botton">
                   <router-link to='/p07demoGame'>
                    回首頁&emsp;  
                   <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="9.92871" y="8" width="10" height="10" transform="rotate(-45 9.92871 8)" fill="#033159"/>
                    <rect x="0.928711" y="17" width="10" height="10" transform="rotate(-45 0.928711 17)" fill="#033159"/>
                    <rect x="18.9287" y="17" width="10" height="10" transform="rotate(-45 18.9287 17)" fill="#033159"/>
                    <rect x="9.92871" y="26" width="10" height="10" transform="rotate(-45 9.92871 26)" fill="#033159"/>
                    </svg>
                    </router-link></button>


                <div class="index_frame"></div>
                
            </div>

           

















































            




        </div>

    </section>
   
</template>