<template>
 
    <section id="app" class="p07_demoGame_p01bg">

        <div class="quiz_background">

            <div class="p07_demoGame_01_question_number">
                <div class="quiz_number_frame">
                    <h1 class="quiz_question_num">第{{numberToChinese(questionNumber)}} 題</h1>
                </div>
                
            </div>

            <div class="p07_demoGame_01_quiz_view">
                <div class="p07_demoGame_01_quiz_question_title">
                    <p>{{questionText}}</p>
                </div>
                <img :src="questionImage"  alt="題目示意圖">
                <!-- <img :src="require('@/assets/img/p07_demo/p07_demoGame/quiz1.jpg')"  alt="題目示意圖"> -->
            </div>
            
            <div class="answer_button">
                <div class="answer" 
                
                v-for="(answer,key) in  questions[(questionNumber-1)].answers" :key="key"
                @click="choose_answer(answer)" 
                >
                <p :class="{ 'disabled': questions[(questionNumber-1)].choosed !== null && questions[(questionNumber-1)].choosed !== answer ,'selected' :questions[(questionNumber-1)].choosed === answer }">{{ answer }}</p></div>

            </div>

             <!-- 印章部分 -->

            <div class="stamp" v-if="this.questions[(this.questionNumber-1)].choosed">
                <p v-if = "isCorrect">正確</p>
                <p v-else>錯誤</p>
            </div>



            <!-- 解答部分 -->

            
            <Transition name="slide">
                <div class="answer_zone" v-if="isAnswered">
                    <button 
                    class="answer_zone_button" @click="showAnswerBoardContent = !showAnswerBoardContent"
                    
                    >點擊這裡看破解</button>
                    <div class="answer_board" v-show="showAnswerBoardContent">
                        <h2>破解</h2>
                        <p v-html="questions[questionNumber - 1].answerZoneContent"></p>
                        
                        </div> 
    
                </div>
            </transition>

            <div class="score">目前累積分數:{{score}}</div>


            <div class="next">

                <button class="next_quiz_botton"  @click="changeQuestionAndScrollToTop">
                   <div class="botton_p">
                    下一題 
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.84655 1.74029C0.925074 1.2852 0.950356 2.64625 1.20318 3.38365L5.12195 7.68167L1.20318 12.0429C0.343585 13.9138 1.94059 14.0023 2.84655 13.8127L7.77663 8.75618C8.38341 7.9977 8.02945 7.2603 7.77663 6.9864L2.84655 1.74029Z" fill="#033159" stroke="black"/>
                <path d="M8.73186 1.20675C7.01265 0.599971 6.83567 1.96523 6.96209 2.7237L12.3978 8.15943L6.96209 13.4688C6.60813 15.2385 7.99446 15.3017 8.73186 15.1121L14.6101 9.17073C15.6214 8.15943 15.0314 7.31668 14.6101 7.02172L8.73186 1.20675Z" fill="#033159" stroke="black"/>
</svg>

</div></button>


                <div class="next_quiz_frame"></div>
                
            </div>
            



        </div>

    </section>

     <!-- footer -->
     <frontFooter />
   
</template>



<script>

import frontFooter from "@/components/f_footer.vue";

import axios from "axios";

export default {

    components: {
    frontFooter
  },
    data(){
        return{
            //題目選項，圖片跟答案
             // 从PHP后端获取的题目数据
            quizData: null,
            // 当前问题的编号
            questionNumber: 1,
            // 当前问题的文本
            questionText: "",
            // 当前问题的图片路径
            questionImage: "",
            // 当前问题的答案选项
            questionOptions: [],
            // 当前问题的答案
            correctAnswer: "",
            // 当前问题的选中答案
            choosedAnswer: null,
            // 选项区的内容
            answerZoneContent: "",
            questionNumber:1, //標題第幾題，第一題為初始值
            showNextButton: false,
            // selectedAnswer:null, //選項還沒有被選擇時的初始值
            // isCorrect: false,  // 選項裡正確與錯誤判斷的預設值
            // isAnswered: false,  //答案未被確認時的初始值
            score: 0, //分數計算初始值
            showAnswerBoardContent:false, // 按"點擊這裡看破解"的按鈕被觸發前，預設值為否
            showLoginAlert: true,

            
          
        };
    },

    mounted(){
        axios
        .get("getQuiz.php")
        .then(response => {
            this.quizData = JSON.parse(response.data);
            this.showQuestion(this.quizData[0]);
            console.log('this.showQuestion');
        })
        .catch(error =>{
            console.log(error);
        });
    },

    computed:{
        //每按下一題，題目內容會變動
        questionText(){
            return this.questions[this.questionNumber -1 ].text;
        },

        //每按下一題，圖片會變動
        questionImage(){
            return require(`@/assets/img/p07_demo/p07_demoGame/quiz${this.questionNumber}.jpg`);
        },
    },


    methods:{

        

       // 将指定问题的数据显示在界面上
        showQuestion(question) {
            this.questionNumber = question.ID;
            this.questionText = question.QUESTION;
            this.questionImage = question.PIC;
            this.questionOptions = question.OPTION.split(",");
            this.correctAnswer = question.ANSWER;
            this.answerZoneContent = question.DESCRIPTION;
            this.choosedAnswer = null;
        },

         // 点击答案选项的处理函数
            choose_answer(answer) {
                this.choosedAnswer = answer;
                // 检查答案是否正确，并显示下一道问题
                setTimeout(() => {
                    if (this.choosedAnswer === this.correctAnswer) {
                    // 回答正确
                    this.questionNumber++;
                    if (this.questionNumber <= this.quizData.length) {
                        this.showQuestion(this.quizData[this.questionNumber - 1]);
                    } else {
                        alert("您已完成所有问题！");
                    }
                    } else {
                    // 回答错误
                    alert("回答错误，请再试一次！");
                    this.choosedAnswer = null;
                    }
                }, 500);
            },



        // //每按下一題，選項會變更
        // changeQuestion(){
        //     this.questionNumber +=1;
        // },
        // //每按下一題，卷軸會直接到頂部
        // scrollToTop() {
        // window.scrollTo(0, 0);
        // },

        //結合上面兩者的方法後，再創一個新的方法寫入按鈕裡
        changeQuestionAndScrollToTop() {
            if(this.questionNumber === this.questions.length){
                localStorage.setItem('score', this.score);
                this.$router.push('demoGameresult');
            }else{
                this.questionNumber +=1;
                window.scrollTo(0, 0);
                // this.selectedAnswer = null; //清空選擇的答案
                this.isAnswered = false; //設為未作答狀態
                this.showAnswerBoardContent = false;
                
            }

        // this.changeQuestion();
        // this.scrollToTop();
        },
        //跳動的標題"第?題"，裡面從本來的數字變文字，會隨著換頁變更數字
        numberToChinese(num){
        const chineseNums = ["一","二","三","四","五","六","七","八","九","十"];
        return chineseNums[num - 1];
        },

        //選項的功能，包含點擊選擇後顏色變化，判斷是否被選擇，判斷選項的答案的正確與錯誤，每選擇一個選項後其他選項不能被選擇，跟蓋章效果，計算分數(正確的選項加10分，非正確選項不加分)

        choose_answer(answer) {
      if ( this.questions[(this.questionNumber-1)].choosed === null) {
        this.questions[(this.questionNumber-1)].choosed = answer //每一題被選擇的答案都放進choose裡面
        // element.classList.toggle('selected'); //點擊後背景圖片變化的部分
        // this.selectedAnswer = answer // answer 是指當前被點擊的答案，它作為 toggleClass 方法的參數傳入。在方法的內部，this.selectedAnswer 是一個數據屬性，它的值會被設置為當前被點擊的答案，以便後續判斷該答案是否為正確答案。
        this.isAnswered = true //表示此題目已經被回答過，即選擇了一個答案。它是一個boolean值，當點擊一個答案時，會將它設置為true，這樣就可以避免重複選擇答案或是選擇多個答案。
        // alert(this.questions[(this.questionNumber-1)].choosed);
        // alert(this.questions[(this.questionNumber-1)].correctAnswer);
        if (this.questions[(this.questionNumber-1)].choosed === this.questions[this.questionNumber - 1].correctAnswer) {//若選擇的選項 === 跳頁過後的題目裡面的那個正確的選項
          this.isCorrect = true; //如果選項為對
          this.score +=10;  // 加10分
        } else {
          this.isCorrect = false; //選項為錯，什麼都不做
        }
      }
    },

    showAnswerBoard(){ // "點擊這裡看破解"被點擊時，顯示破解的內文
        this.showAnswerBoardContent = true;
    },


    closeLoginAlert() {
    this.showLoginAlert = false;
  }

  
        
    },







};



</script>



