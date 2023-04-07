<template>
    <div class="popup_p07_demoShopping" v-show="show = true">
        <div class="popup_p07_demoShopping_container">
            <div class="beforeTour popup_p07_demoShopping_textArea" v-if="showStep === 0">
                <i class="fa-solid fa-xmark" @click="$emit('close')" style="z-index: 1;"></i>
                <div class="top">
                    <h2>詐騙網站7特徵</h2>
                    <p>快來看看詐騙購物網站通常哪那些特徵吧！</p>
                </div>
                <div class="down">
                    <button @click="$emit('close')">無情跳過</button>
                    <span>0 / 7</span>
                    <button @click="showNextStep();" style="background-color: #13e5f2;">開始導覽</button>
                </div>
                <div class="clost-bg" @click="$emit('close')" style="z-index: -100;"></div>
            </div>
            <!-- step 1 -->
            <div v-if="showStep === 1" class="popup_p07_demoShopping_textArea">
                <!-- 箭頭 -->
                <!-- <div class="popup_p07_demoShopping_arrow">
                    <i class="fa-solid fa-arrow-up"></i>
                </div> -->
                <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
                <div class="top">
                    <h2>詐騙網站特徵</h2>
                    <p>{{ steps[0].title }}</p>
                </div>
                <div class="down">
                    <button @click="$emit('close')">{{ steps[0].btnPre }}</button>
                    <span>1 / 7</span>
                    <button @click="showNextStep(); scrollToStep2()">{{ steps[0].btnNext }}</button>
                </div>
            </div>
            <!-- step 2 -->
            <div v-else-if="showStep === 2" class="popup_p07_demoShopping_textArea">
                <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
                <div class="top">
                    <h2>詐騙網站特徵</h2>
                    <p>{{ steps[1].title }}</p>
                </div>
                <div class="down">
                    <button @click="showPrevStep">{{ steps[1].btnPre }}</button>
                    <span>2 / 7</span>
                    <button @click="showNextStep(); scrollToStep3()">{{ steps[1].btnNext }}</button>
                </div>
            </div>
            <!-- step 3 -->
            <div v-else-if="showStep === 3" class="popup_p07_demoShopping_textArea">
                <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
                <div class="top">
                    <h2>詐騙網站特徵</h2>
                    <p>{{ steps[2].title }}</p>
                </div>
                <div class="down">
                    <button @click="showPrevStep(); scrollToStep2()">{{ steps[2].btnPre }}</button>
                    <span>3 / 7</span>
                    <button  @click="showNextStep(); scrollToStep4()">{{ steps[2].btnNext }}</button>
                </div>
            </div>
            <!-- step 4 -->
            <div v-else-if="showStep === 4" class="popup_p07_demoShopping_textArea">
                <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
                <div class="top">
                    <h2>詐騙網站特徵</h2>
                    <p>{{ steps[3].title }}</p>
                </div>
                <div class="down">
                    <button @click="showPrevStep(); scrollToStep3()">{{ steps[3].btnPre }}</button>
                    <span>4 / 7</span>
                    <button  @click="showNextStep(); scrollToStep5()">{{ steps[3].btnNext }}</button>
                </div>
            </div>
            <!-- step 5 -->
            <div v-else-if="showStep === 5" class="popup_p07_demoShopping_textArea">
                <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
                <div class="top">
                    <h2>詐騙網站特徵</h2>
                    <p>{{ steps[4].title }}</p>
                </div>
                <div class="down">
                    <button @click="showPrevStep(); scrollToStep4()">{{ steps[4].btnPre }}</button>
                    <span>5 / 7</span>
                    <button  @click="showNextStep(); scrollToStep6()">{{ steps[4].btnNext }}</button>
                </div>
            </div>
            <!-- step 6 -->
            <div v-else-if="showStep === 6" class="popup_p07_demoShopping_textArea">
                <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
                <div class="top">
                    <h2>詐騙網站特徵</h2>
                    <p>{{ steps[5].title }}</p>
                </div>
                <div class="down">
                    <button @click="showPrevStep(); scrollToStep5()">{{ steps[5].btnPre }}</button>
                    <span>6 / 7</span>
                    <button  @click="showNextStep(); scrollToStep7()">{{ steps[5].btnNext }}</button>
                </div>
            </div>
            <!-- step 7 -->
            <div v-else-if="showStep === 7" class="popup_p07_demoShopping_textArea">
                <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
                <div class="top">
                    <h2>詐騙網站特徵</h2>
                    <p>{{ steps[6].title }}</p>
                </div>
                <div class="down">
                    <button @click="showPrevStep(); scrollToStep6()">{{ steps[6].btnPre }}</button>
                    <span>7 / 7</span>
                    <button @click="$emit('close')">{{ steps[6].btnNext }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref , onMounted,onUnmounted } from 'vue';

export default {
  setup() {
    const show = ref(false);
    // 禁止背景滾動
    const disableBackgroundScroll = () => {
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = '-20vh';
        document.body.style.width = '100%';
    }
    const ableBackgroundScroll = () => {
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.width = '100%';
    }
    function scrollToStep2() {
      const element = document.getElementById('tour2');
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
        // document.body.style.position = 'fixed';
        // document.body.style.top = '-100px';
        // document.body.style.width = '100%';
      }
    }
    function scrollToStep3() {
      const element = document.getElementById('tour3');
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }
    function scrollToStep4() {
      const element = document.getElementById('tour4');
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }
    function scrollToStep5() {
      const element = document.getElementById('tour5');
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }
    function scrollToStep6() {
      const element = document.getElementById('tour6');
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }
    function scrollToStep7() {
      const element = document.getElementById('tour7');
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }
    const steps = ref([
        {
            title: '1. 檢查網址 (拼音奇特、與正版網址差幾個字)',
            scroll: 'scrollToStep2',
            btnPre: '跳過導覽',
            btnNext: '下一步',
        },
        {
            title: '2.  價格異常便宜',
            scroll: 'scrollToStep3',
            btnPre: '上一步',
            btnNext: '下一步',
        },
        {
            title: '3.  聯絡方式僅 Email、Messager 和 Line',
            scroll: 'scrollToStep3',
            btnPre: '上一步',
            btnNext: '下一步',
        },
        {
            title: '4.  出現中國用語，如包郵、郵資',
            scroll: 'scrollToStep3',
            btnPre: '上一步',
            btnNext: '下一步',
        },
        {
            title: '5.  強調限量、限時特價、永遠倒數計時',
            scroll: 'scrollToStep3',
            btnPre: '上一步',
            btnNext: '下一步',
        },
        {
            title: '6.  強調免運費、貨到付款有保障',
            scroll: 'scrollToStep3',
            btnPre: '上一步',
            btnNext: '下一步',
        },
        {
            title: '7.  標榜有七天鑑賞期',
            scroll: 'scrollToStep3',
            btnPre: '上一步',
            btnNext: '結束導覽',
        },
    ])
    const showStep = ref(0);

    function showNextStep() {
    showStep.value += 1;
    }

    function showPrevStep() {
    showStep.value -= 1;
    }
    // 開啟 Modal 時禁止背景滾動
    onMounted(() => {
        disableBackgroundScroll()
    })
    onUnmounted(() => {
        ableBackgroundScroll()
    })
    return {
        scrollToStep2,
        scrollToStep3,
        scrollToStep4,
        scrollToStep5,
        scrollToStep6,
        scrollToStep7,
        steps,
        showStep,
        showNextStep,
        showPrevStep,
        show,
    };
  },
};
</script>