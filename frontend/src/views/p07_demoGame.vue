<template>

    <!-- navgation -->
    <frontNavbar />

    <section class="game_index">

        <!-- demo 體驗的 nav -->
        <p07_demo_nav />

        

        <div class="quiz_index">


            <!-- 標題 -->

            <div class="index_title">
               <h1 >防詐小測驗</h1>
               <h1 >測試你對詐騙的敏銳度</h1>
            </div>

            <!-- 簡介 -->

            <div class="index_quiz_summary">
               <div class="m"></div>
                <p ref="item" v-for="(text,index) in texts" :key="index">
                    {{ text }}
                </p>
              
            </div>


            <!-- 按鈕部分 -->


             <div class="star">

                <button class="game_start_botton">
                   <router-link to='/demoGamep01'>
                    遊戲開始&emsp;  
                   <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="9.92871" y="8" width="10" height="10" transform="rotate(-45 9.92871 8)" fill="#033159"/>
                    <rect x="0.928711" y="17" width="10" height="10" transform="rotate(-45 0.928711 17)" fill="#033159"/>
                    <rect x="18.9287" y="17" width="10" height="10" transform="rotate(-45 18.9287 17)" fill="#033159"/>
                    <rect x="9.92871" y="26" width="10" height="10" transform="rotate(-45 9.92871 26)" fill="#033159"/>
                    </svg>

                    </router-link></button>


                <div class="button_frame"></div>
                
            </div>

            

        </div>

        

    </section>

    <div>
    <span ref="text" class="quoteText"></span>
    <span ref="author" class="quoteAuth"></span>
    </div>


    <!-- footer -->
    <frontFooter />
   
</template>


<script>
import p07_demo_nav from "@/components/p07_demo_nav.vue";
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";

export default {
  components: {
    p07_demo_nav,
    frontNavbar,
    frontFooter
  },
  data(){
    return{
            texts:[ "近年，詐騙事件層出不窮，隨著科技日新月異，詐騙更是不斷翻新手法，讓人防不慎防。\n不論是身處在網路世界或現實生活中，都可能成為詐騙的受害者。詐騙對象不分年齡與性別，防詐從了解手法開始！讓我們一起以遊戲的方式了解近幾年的詐騙手法吧！"],
        }
    },

    mounted() {
      this.$refs.item.forEach((el) => {
        el.style.width = el.getBoundingClientRect().width + 5 + "px";
        this.scramble(el);
      });
    },

    methods:{
        randomChar(){
        const lower = "abcdefghijklmnopqrstuvwxyz";
        const upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const signs = "*?><[]&@#)(.%$-_:/;?!";
        const chars = [...lower.split(""), ...signs.split("")];
        return chars[Math.floor(Math.random() * chars.length)];
        },
        scramble(element, { speed = 20, rounds = 2} = {}) {
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

    },

  };
 








</script>

