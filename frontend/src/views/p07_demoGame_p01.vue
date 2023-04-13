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
                <img :src="questionImage"  alt="">
            </div>
            
            <div class="answer_button">
                <div class="answer" 
                v-for="(answer,key) in  questions[(questionNumber-1)].answers" :key="key"
                @click="toggleClass($event.target, answer)" 
                :class="{ disabled: selectedAnswer !== null && selectedAnswer !== answer }">
                <p>{{ answer }}</p></div>

            </div>

             <!-- 印章部分 -->

            <div class="stamp" v-if="isAnswered">
                <p v-if = "isCorrect">正確</p>
                <p v-else>錯誤</p>
            </div>



            <!-- 解答部分 -->


            <div class="answer_zone">
                <div class="answer_board">
                    <h2>破解</h2>
                    <p>網路交友陷阱多，尤其一旦陷入戀愛更容易沖昏頭，網戀注意以下幾點，讓你遠離詐騙爛桃花<br>1.永遠不要把感情與錢放在一起，真要放一起，就要當作這筆錢已經丟了<br>2.認識一周以內，就會叫你老公、老婆的人，絕對不能相信<br>3.認識一周以後，叫妳老公、老婆的人，談到投資，只能他給你錢，絕對不要給他錢<br>4.伴侶或朋友有錢，不關你的事，祝福他就好，請不要投資他<br>5.年投資報酬率超過20%，風險可能超過200%。低風險、高報酬，得想想為什麼會是自己<br>6.匯款的時候，請跟銀行行員老實交代原因，他們都受過訓練，會幫你分辨真假，但是如果你騙他們，那就愛莫能助了<br>7.錢不要匯到國外！那會追不回來，連人頭帳戶都無法追查</p>
                    
                    </div> 


            </div>


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
   
</template>




<script>

export default {
    data(){
        return{

            //標題第幾題
            questionNumber:1, 

            //題目選項跟答案
            questions:[{
                text:'1請問哪一支電話號碼會是詐騙號碼？',
                image: "@/assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.165","B.+886227652122"," C.0800700365","D.以上皆是"],
                correctAnswer: "D.以上皆是",
            },
            {
                text:"2請參考下列圖片，這是屬於哪一方面的詐騙？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.電話詐騙","B.抽獎詐騙網頁惡意彈跳視窗 ","C.投資詐騙","D.交友詐騙"]
            },
            {
                text:"3當你收到一個領取包裹的簡訊，然而你忘了之前有沒有訂包裹，請問該如何處理能避免被詐騙？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.先領再說","B.叫別人幫我領","C.領了之後拆開發現裡面根本不是自己當初買的東西，大叫倒楣被騙","D.先去查詢自己的購買紀錄，確定這不是自己的包裹後，不要去領"]
            },
            {
                text:"4請問幽靈包裹有哪些特徵？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["包裹的寄貨地點多在中國大陸，外國等非本地地區","B.包裹以土黃色膠帶封裝","C.包裹上有鑫金、皓炫、依熙、長慶代寄、非賣家等關鍵字","D.以上皆是"]
            },
            {
                text:"5下列哪一項不是一頁式詐騙的特徵？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.售價與市價差不多高","B.網頁上沒有公司地址、客服電話(或無人接聽)，只有電子信箱","C.常以限時或倒數方式吸引民眾購買","D.網頁大多會有夾雜簡體字或使用大陸用語(如直郵、郵費、支持換貨等)"]
            },
            {
                text:"6在疫情期間，政府為體恤人民困苦，有發放補助金之行為，然而有不肖詐騙集團以政府發放補助金為名義，利用簡訊方式詐騙人民個資，請問哪一個網址才是正確連結政府網站的網址？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.http://shufabu6000.com  /moda.gov.tw/","B.https://moda.gov.tw/press  /clarification/378#qaH3521","C.https://shuweibu6000  .com/","http://taiwanzz.com/  moda.gov.tw/ "]
            },
            {
                text:"7請問下列選項，何者有可能你與對方談了一份真摯的網路戀情？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.對方的大頭貼放著帥哥美女圖，而且對方跟你網戀一段時間後就用各種名目向你要錢","B.你跟對方談了一陣子的網戀後，對方跟你介紹股票，投資等要你掏錢的話題","C.對方跟你快速建立感情，然而要求見面時卻東躲西躲，且說些前後矛盾的故事","D.他不會情緒勒索你，強迫你交一些隱私資料，如信用卡卡號，銀行帳戶，身分證號碼等"]
            },
            {
                text:"8請問哪一項並非是在line裡面的詐騙方式？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.謊稱健保卡被盜，即將停卡的詐騙","B.股票投資詐騙","C.打字詐騙","D.假貼圖下載詐騙"]
            },
            {
                text:"9請問若要查詢確認自己是否被詐騙，可以打下面哪一支電話",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.1922","B.55688","C.165","D.104"]
            },
            {
                text:"10請問若要查詢確認自己是否被詐騙，可以打下面哪一支電話？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.提款","B.轉帳","C.解除分期付款或退款","D.餘額查詢"]
            },
            ],
            selectedAnswer:null,
            isCorrect: false,
            isAnswered: false


          
        };
    },

    computed:{
        questionText(){
            return this.questions[this.questionNumber -1 ].text;
        },

        questionImage(){
            return this.questions[this.questionNumber - 1].image;
        },
    },


    methods:{
        changeQuestion(){
            this.questionNumber +=1;
        },
        scrollToTop() {
        window.scrollTo(0, 0);
        },
        changeQuestionAndScrollToTop() {
        this.changeQuestion();
        this.scrollToTop();
        },
        numberToChinese(num){
        const chineseNums = ["一","二","三","四","五","六","七","八","九","十"];
        return chineseNums[num - 1];
        },

        toggleClass(element, answer) {
      if (!this.isAnswered) {
        element.classList.toggle('selected');
        this.selectedAnswer = answer
        this.isAnswered = true
        if (this.selectedAnswer === this.questions[this.questionNumber - 1].correctAnswer) {
          this.isCorrect = true
        } else {
          this.isCorrect = false
        }
      }
    },

        
        
        
    },







};



</script>



