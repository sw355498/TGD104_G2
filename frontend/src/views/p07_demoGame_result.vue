<template>
 
    <section class="p07_resultbg">

        <div class="result_background">

            <!-- 彈跳視窗 -->

            <div class="p07game_login_alert" v-if="showLoginAlert && !isLoggedIn">

                <!-- //打X按鈕 -->
                <div class="alert_cross"  @click="closeLoginAlert"  >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>    
                </div>   
                <div class="login_panel">
                
                <p>您尚未登入會員，請問是否要登入會員記錄分數？</p>
                
                <!-- 會員登入按鈕與會員填寫資料的部分 -->
                <button type="button" @click="showModal" class="gamebutton game_login">登入/註冊</button>
                <Modal v-show="isModalVisible" @close="closeModal" />

                <!-- 取消按鈕 -->
                <button class="gamebutton game_cancel" @click="closeLoginAlert">取消</button>    
                    
                </div>                
            </div>


            <!-- 測驗計分標題 -->

            <div class="p07_gameend_result">
                <div class="result_frame">
                    <h1 class="result_title">測驗結果</h1>
                </div>
                
            </div>

            <!-- 測驗視窗1 -->

            <div class="result_view view1">
                <p ref="item" v-for="(text,index) in texts" :key="index">
                    {{ text }}
                </p>
               <span ref="scorep" class="result_percent">...{{ score !== null ? score + '%' : '' }}</span>
            </div>

            <!-- 測驗視窗2 -->

            <div class="result_view view2" v-show="showScore">
               <p>{{ scoreText }}</p>
              
            </div>


            <!-- 按鈕部分 -->


             <div class="again">

                <button class="again_quiz_botton">
                   <router-link to='/demoGame'>
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
                   <router-link to='/index'>
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

    <!-- footer -->
    <frontFooter />
   
</template>



<script>

import Modal from "@/components/userLogin.vue"; // 填寫會員登入資料的那個彈窗
import frontFooter from "@/components/f_footer.vue"; //footer的欄位
// 抓會員資料用套件
import axios from "axios";
import { API_URL, reactive } from "@/config";


export default {

    //會員登入的那個彈窗部分
    name: "App",
    components: {
    Modal,
    frontFooter,
    },



    data(){
      return{
        texts:["測驗結果，你的防詐指數...."],
        score:null, //分數計算預設空值
        showScore: false, //顯示分數的部分預設為否
        showLoginAlert: true,  //顯示確認會員登入與否的彈窗
        isLogin:false, //登入狀態顯示為否 (需判斷)
        isModalVisible: false, //預設顯示modal的部分為否
        isLoggedIn: false,
      }
    },

    created(){
        //判斷localStorage中是否有token
        const isLoggedIn = localStorage.getItem("token");
        //沒有token的話跑出會員登入提示視窗
        if (!isLoggedIn){
            this.showLoginAlert = true;
        }else{
            //不會跑出提示視窗
            this.showLoginAlert = false;

        }
    },

    

    
       

    // setup(props){
    //     const scorep = ref(null);
    //     let x = 0;

    //     onMounted(() => {
    //         setTimeout(() => {
    //             function countSecond(){
    //                 if(x <= props.score){
    //                     scorep.value.innerHTML = x++;
    //                     setTimeout(countSecond, 300);
    //                 }
    //             }
    //             countSecond();
    //         }, 5000)
    //     });

    //     return{
    //         scorep,
    //         state,
    //         closeLoginAlert
    //     };
    // },



  

  mounted() {


    //分數延遲顯示
    setTimeout(() =>{
        this.score = localStorage.getItem('score');  //取得分數的部分
        this.showScore = true; //顯示分數的部分為是
        this.sendScore(); //呼叫新增分數的函式
      },2500);

      // 亂碼效果的部分
    this.$refs.item.forEach((el) => {
        el.style.width = el.getBoundingClientRect().width + 5 + "px";
        this.scramble(el);
      });



    // setTimeout(() => {
    //     function countSecond(){
    //         if(x <= 50){
    //             scorep.value.innerHTML = x++;
    //             setTimeout(countSecond, 300);
    //                 }
    //             }
    //             countSecond();
    //         }, 5000);   
       
  },

  


  methods:{  
    
    //關閉詢問是否要會員登入的視窗
    closeLoginAlert(){
        this.showLoginAlert = false;
        document.querySelector('.p07game_login_alert').classList.add('p07game_login_alert_close');
    },

    //會員登入資料的彈窗開與關的設定
    showModal() {
      this.isModalVisible = true;
    },

    closeModal() {
    this.showLoginAlert = false;  //關閉顯示詢問是否要會員登入的視窗
      this.isModalVisible = true; // 這裡寫true 或false好像都可以？
    },
    
    sendScore(){
        const token = localStorage.getItem("token"); //取得token (假設為會員 ID)
        const apiUrl = `${API_URL}/add_score.php`;
        //const data = {score: this.score};

        //封裝data兩個資料('token','score')
        var data = new FormData();
        data.append('token', token);
        data.append('score', this.score);
        axios.post(apiUrl,data).then((response) =>{
            console.log(response);
        }).catch((error) => {
            console.log(error);
        });

    },
    
        
    //亂碼效果
        randomChar(){
        const lower = "abcdefghijklmnopqrstuvwxyz";
        const upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const signs = "*?><[]&@#)(.%$-_:/;?!";
        const chars = [...lower.split(""), ...signs.split("")];
        return chars[Math.floor(Math.random() * chars.length)];
        },
        scramble(element, { speed = 30, rounds = 2} = {}) {
            let original = element.textContent;
            let count = 0;
            let text = [];
            let letter = 0;

            window.scrambler = setInterval(() => {
                element.textContent = "";
                if (letter >= original.length) {
                element.textContent = original;
                clearInterval(window.scrambler);
                return;
        }
        if (count > rounds) {
          text[letter] = original[letter];
          letter += 1;
          count = 0;
        } else {
          text[letter] = this.randomChar();
        }

        count += 1;
        element.textContent = text.join("");


        },speed);
        },

        //新增分數的函式

    },

    computed:{
        scoreText(){
            if(this.score >= 80){
                return "哇！你是正港的防詐達人！";
            }else if (this.score >= 50){
                return " 加油！還差一點！"
            }else{
                return "唉呀！是不是該去再重新補補防詐課程啦？"
            }
        },
        
    },
    

};



</script>

<style>

.modal-wrapper .modal-container{
    top:-100%;
}

</style>
