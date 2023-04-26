<template>
 
    <section id="app" class="p07_demoGame_p01bg">

        <div class="quiz_background">

            <div class="quiz_num">目前已答題數:{{quizNum}}/共10題</div>

            <div class="p07_demoGame_01_question_number">
                <div class="quiz_number_frame">
                    <h1 class="quiz_question_num">第{{numberToChinese(questionNumber)}}題</h1>
                </div>
                
            </div>

            <div class="p07_demoGame_01_quiz_view">
                <div class="p07_demoGame_01_quiz_question_title">
                    <p>{{questionText}}</p>
                </div>

                <div class="quizimg">
                    <img :src="questionImage"  alt="題目示意圖">
                    <!-- <img :src="require('@/assets/img/p07_demo/p07_demoGame/quiz1.jpg')"  alt="題目示意圖"> -->
                </div>
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

           


            <div class="next" v-if="showNextButton">

                <button class="next_quiz_botton"  @click="changeQuestionAndScrollToTop">
                   <div class="botton_p">
                    {{nextButtonText}}
                    <svg><use xlink:href="#onward" /></svg>

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

export default {

    components: {
    frontFooter
  },
    data(){
        return{
            //題目選項，圖片跟答案
            questions:[
                {
                text:'請問哪一支電話號碼會是詐騙號碼？',
                image:'@/assets/img/p07_demo/p07_demoGame/quiz1.jpg',
                answers:["A.165","B.+886227652122"," C.0800700365","D.以上皆是"],
                correctAnswer: "D.以上皆是",
                choosed:null,
                answerZoneContent:"1.這幾通來電可能都是「竄改來電顯示」的詐騙電話<br>2.110、165、0800免付費電襪等特殊號碼只能撥入，無法撥出<br>3.手機來電顯示開頭出現「+」字號，代表是國際電話"
            },
            {
                text:"請參考下列圖片，這是屬於哪一方面的詐騙？",
                image: '',
                answers:["A.電話詐騙","B.抽獎詐騙網頁惡意彈跳視窗 ","C.投資詐騙","D.交友詐騙"],
                correctAnswer: "B.抽獎詐騙網頁惡意彈跳視窗 ",
                choosed:null,
                answerZoneContent:"您是否也有過使用手機、電腦、接收EMAIL時，瀏覽器突然跳出「祝賀！您被 Google 隨機選中」、「有機會贏得 iPhone 或其他 Google 獎品」這樣類似的中獎視窗？請小心，這可是詐騙手法喔!其實這是很常見的抽獎詐騙網頁惡意彈跳視窗，不管是在 Android 、íso系統或是電腦版的網頁上都會出現，此種跳出廣告通知中獎的詐騙手法，內容會隨著更新為目前市面上最新版的手機，並提出小問題,藉此以假亂真。由此可知，完全就是想要騙民眾留下個資。若民眾依據內容一一填輸，甚至輸入個人信用卡資料，日後更有可能會被盜刷!"
            },
            {
                text:"當你收到一個領取包裹的簡訊，然而你忘了之前有沒有訂包裹，請問該如何處理能避免被詐騙？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.先領再說","B.叫別人幫我領","C.領了之後拆開發現裡面根本不是自己當初買的東西，大叫倒楣被騙","D.先去查詢自己的購買紀錄，確定這不是自己的包裹後，不要去領"],
                choosed:null,
                correctAnswer: "D.先去查詢自己的購買紀錄，確定這不是自己的包裹後，不要去領",
                answerZoneContent:"警方分析此類手法，歹徒郵寄粗劣商品詐取貨到付款費用，其來源多與臉書「一頁式廣告」相同，這類包裹由境外運送至國內後，歹徒透過預先收集民眾個資，經由貨運業者、物流人員進行派送，並以貨到付款方式隨機寄送來騙取民眾付款。若民眾不確定包裹「寄件人」是否正確，請直接拒收。警方表示：若親屬家人代收，請先查證有無購物；萬一已經取貨付款，請撥打託運單上面「寄件人」電話，告知未購買商品卻收到包裹，申請退款退貨，以保障自身權益。"
            },
            {
                text:"請問幽靈包裹有哪些特徵？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.包裹的寄貨地點多在中國大陸，外國等非本地地區","B.包裹以土黃色膠帶封裝","C.包裹上有鑫金、皓炫、依熙、長慶代寄、非賣家等關鍵字","D.以上皆是"],
                choosed:null,
                correctAnswer: "D.以上皆是",
                answerZoneContent:"現代人越來越依賴網購，買到後來常常忘了自己到底買什麼，總是收到取貨簡訊抱著「先領先付款再說」的心態，給了詐騙集團可趁之機，盜用個資寄給你一堆裝滿垃圾的千元「幽靈包裹」。除了領取包裹前，最好先查證自己到底領的是什麼貨以外，該怎麼從外觀辨識「幽靈包裹」呢？有超商店員在臉書「爆廢公社公開版」分享了辨識「幽靈包裹」的訣竅，首先這些包裹比正常包裹都會多了一個「土黃色膠帶」封箱，再者就是「代寄」字樣，通常只要有這2項特徵，9成大多是詐騙。有網友補充，只要看到「鑫金、皓炫、依熙、長慶代寄」這些關鍵字都要小心。新北市政府消費者保護官也提醒，如果包裹上出現「非賣家」等關鍵詞，就要警覺可能是境外寄來的詐騙包裹，千萬不要輕易的付款取貨。"
            },
            {
                text:"下列哪一項不是一頁式詐騙的特徵？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.售價與市價差不多高","B.網頁上沒有公司地址、客服電話(或無人接聽)，只有電子信箱","C.常以限時或倒數方式吸引民眾購買","D.網頁大多會有夾雜簡體字或使用大陸用語(如直郵、郵費、支持換貨等)"],
                correctAnswer: "A.售價與市價差不多高",
                choosed:null,
                answerZoneContent:"一頁式詐騙皆具有下列特徵：<br>1、網頁上沒有公司地址、客服電話，僅留下電子信箱或通訊軟體帳號。2、售價明顯低於市場行情。常以限時或倒數方式吸引消費者。 <br>3、號稱免運費、7天鑑賞期、可拆箱驗貨、不滿意包退等， 4、廣告底下留言都是正評，沒有負評。 <br>5、僅能使用「貨到付款」或信用卡刷卡付款。 6、網頁大多粗糙不精美或夾雜簡體字。<br>我們能依照下面幾點來避免被一頁式詐騙：<br>1. 除非是從官網或是官方臉書粉絲團來的連結，否則不要太相信自動跳出來或親友轉貼的廣告。<br>2. 若要訂購，請詳細檢視該一頁式廣告上有無聯繫資訊（地址或電話等）及這些資訊的真實性（例如親自撥打官網電話向店家確認）。<br>3. 若可以選貨到付款，盡量不要刷信用卡，也可避免信用卡盜刷風險。<br>4. 貨到付款『前』，別急著付款，先確認商品是否為『境外』寄送？寄件人的資訊是否合於所訂購商品的店家？包裹外觀、重量或質感是否合於所訂購的商品？5. 若有疑惑寧可不領貨"
            },
            {
                text:"在疫情期間，政府為體恤人民困苦，有發放補助金之行為，然而有不肖詐騙集團以政府發放補助金為名義，利用簡訊方式詐騙人民個資，請問哪一個網址才是正確連結政府網站的網址？",
                choosed:null,
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.http://shufabu6000.com  /moda.gov.tw/","B.https://moda.gov.tw/press  /clarification/378#qaH3521","C.https://shuweibu6000  .com/","http://taiwanzz.com/  moda.gov.tw/ "],
                correctAnswer: "B.https://moda.gov.tw/press  /clarification/378#qaH3521",
                answerZoneContent:"民眾收到偽冒數位部名義發送的詐騙簡訊，點網址可快速領取新台幣6000元。數位部表示，已經報警處理，同時也把簡訊中冒用的網址加以註冊，民眾若點入可以看到澄清說明網頁，遏止假訊息擴散。數位部指出，詐騙簡訊所載網址首段不是gov.tw結尾，不屬於政府機關網址，明顯是假訊息，民眾若收到這類詐騙簡訊，務必不要轉傳。數位部提醒，不會透過簡訊通知民眾領錢，農曆年後才會發放6000元，發放方式一有定案就會馬上公開說明，申領網站的網址首段一定會是gov.tw結尾。"
            },
            {
                text:"請問下列選項，何者有可能你與對方談了一份真摯的網路戀情？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.對方的大頭貼放著帥哥美女圖，而且對方跟你網戀一段時間後就用各種名目向你要錢","B.你跟對方談了一陣子的網戀後，對方跟你介紹股票，投資等要你掏錢的話題","C.對方跟你快速建立感情，然而要求見面時卻東躲西躲，且說些前後矛盾的故事","D.他不會情緒勒索你，強迫你交一些隱私資料，如信用卡卡號，銀行帳戶，身分證號碼等"],
                choosed:null,
                correctAnswer:"D.他不會情緒勒索你，強迫你交一些隱私資料，如信用卡卡號，銀行帳戶，身分證號碼等",
                answerZoneContent:"網路交友陷阱多，尤其一旦陷入戀愛更容易沖昏頭，網戀注意以下幾點，讓你遠離詐騙爛桃花<br>1.永遠不要把感情與錢放在一起，真要放一起，就要當作這筆錢已經丟了<br>2.認識一周以內，就會叫你老公、老婆的人，絕對不能相信<br>3.認識一周以後，叫妳老公、老婆的人，談到投資，只能他給你錢，絕對不要給他錢<br>4.伴侶或朋友有錢，不關你的事，祝福他就好，請不要投資他<br>5.年投資報酬率超過20%，風險可能超過200%。低風險、高報酬，得想想為什麼會是自己<br>6.匯款的時候，請跟銀行行員老實交代原因，他們都受過訓練，會幫你分辨真假，但是如果你騙他們，那就愛莫能助了<br>7.錢不要匯到國外！那會追不回來，連人頭帳戶都無法追查"
            },
            {
                text:"請問哪一項並非是在line裡面的詐騙方式？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.謊稱健保卡被盜，即將停卡的詐騙","B.股票投資詐騙","C.打字詐騙","D.假貼圖下載詐騙"],
                choosed:null,
                correctAnswer:"A.謊稱健保卡被盜，即將停卡的詐騙",
                answerZoneContent:"謊稱健保卡被盜，即將停卡的詐騙為電話形式詐騙，接起電話時，以「先生(小姐)，您的健保卡使用違規異常，請按9由專人為您說明……」為開頭的電話語音進行詐騙，當您聽到這樣的電話語音內容，千萬別照著做，否則您的個資恐被盜用。健保署提醒，目前健保欠費與民眾就醫權已完全脫鉤，亦即健保欠費不會導致民眾被鎖卡或不得就醫。民眾若接到電話告知「欠費將被鎖卡、健保卡被盜用、有違規紀錄」，切勿依指示做任何動作。健保署強調，該署不會主動以電話語音、簡訊、Line等方式，要求民眾匯款、回電、或點選連結，呼籲民眾若接到任何疑似詐騙電話，可撥打免付費專線0800-030-598查證，或撥165防詐騙電話報案。"
            },
            {
                text:"請問若要查詢確認自己是否被詐騙，可以打下面哪一支電話",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.1922","B.55688","C.165","D.104"],
                correctAnswer:"C.165",
                choosed:null,
                answerZoneContent:"台灣的防詐專線為165，若有任何詐騙疑慮，請不吝於查詢！"
            },
            {
                text:"請問銀行ATM做不到下列哪件事？",
                image: "../assets/img/p07_demo/p07_demoGame/quiz1.jpg",
                answers:["A.提款","B.轉帳","C.解除分期付款或退款","D.餘額查詢"],
                correctAnswer:"C.解除分期付款或退款",
                choosed:null,
                answerZoneContent:"分期付款詐騙手法為，歹徒經常假冒網購商店客服人員誆稱被害人前次交易資料有誤，致經銷商、批發商造成訂單(訂購)重複訂單、扣款(分期付款)，經核對(個資、交易)資料後轉通知金融機構處理解除分期付款或退款的話術。如接獲陌生來電或境外來電(開頭有+)必須提高警覺，勿隨意提供個人資料或依照指示提款或轉帳。若接獲網購客服聲稱訂單有問題，應將電話掛斷後，主動撥打該客服電話再度作確認或撥打165反詐騙諮詢專線諮詢。提醒民眾ATM只有「提款」跟「轉帳」功能，不能解除分期付款或退款；遊戲點數亦只有儲值遊戲之功能，並無法解除任何設定或身分識別。"
            },
            ],
            questionNumber:1, //標題第幾題，第一題為初始值
            // selectedAnswer:null, //選項還沒有被選擇時的初始值
            isCorrect: false,  // 選項裡正確與錯誤判斷的預設值
            isAnswered: false,  //答案未被確認時的初始值
            score: 0, //分數計算初始值
            quizNum:0, //題目計算初始值
            showAnswerBoardContent:false, // 按"點擊這裡看破解"的按鈕被觸發前，預設值為否
            showLoginAlert: true,
            nextButtonText: "下一題",
            showNextButton:false


            
          
        };
    },

    // created(){
    //     this.fetchQuestions()
    // },

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

        //若題目
            if(this.questionNumber === this.questions.length){
                localStorage.setItem('score', this.score);
                this.$router.push('demoGameresult');
            }

            else if (this.questionNumber === this.questions.length - 1){
                this.questionNumber +=1;
                this.nextButtonText = "看結果";
                window.scrollTo(0, 0);
                this.isAnswered = false; //顯示看破解的設定為關
                this.showNextButton = false; //顯示下一題的設定為關
                this.showAnswerBoardContent = false; //顯示看破解欄位的設定為關
            }

            else{
                this.questionNumber +=1;
                this.nextButtonText = "下一題";
                window.scrollTo(0, 0);
                // this.selectedAnswer = null; //清空選擇的答案
                this.isAnswered = false; //顯示看破解的設定為關
                this.showNextButton = false; //顯示下一題的設定為關
                this.showAnswerBoardContent = false; //顯示看破解欄位的設定為關
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

        this.showNextButton = true;
        this.isAnswered = true //表示此題目已經被回答過，即選擇了一個答案。它是一個boolean值，當點擊一個答案時，會將它設置為true，這樣就可以避免重複選擇答案或是選擇多個答案。
       
        // alert(this.questions[(this.questionNumber-1)].choosed);
        // alert(this.questions[(this.questionNumber-1)].correctAnswer);
        if (this.questions[(this.questionNumber-1)].choosed === this.questions[this.questionNumber - 1].correctAnswer) {//若選擇的選項 === 跳頁過後的題目裡面的那個正確的選項
          this.isCorrect = true; //如果選項為對
          this.score +=10;  // 加10分
          this.quizNum +=1;
        } else {
          this.isCorrect = false; //選項為錯，什麼都不做
          this.quizNum +=1;
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




