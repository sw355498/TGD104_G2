<template>
  <div>
        <!-- navgation -->
        <frontNavbar />
        <!-- 內文 -->
  <div class="p02_teach">
    <div class="banner_teachFrame">
      <div class="banner_teachtitle h1">
        防範詐騙教學
        <div class="banner_teachtitle_en">SCAM</div>
      </div>
    </div>
    <select name="" id="" class="form-select form-select-md">
      <option
        v-for="(tab, tab_index) in tabs"
        :class="{ tab: true, active: active_tab == tab_index }"
        
        :key="tab_index"
        @value="changeTab(tab_index)"
      >
        {{ tab.title }}
      </option>
    </select>
    <div id="tabs">
      <div
        v-for="(tab, tab_index) in tabs"
        :class="{ tab: true, active: active_tab == tab_index }"
        @click="changeTab(tab_index)"
        :key="tab_index"
      >
        <div class="tab-label h5">{{ tab.label }}</div>
      </div>
    </div>
    <div
      v-for="(tab, tab_index) in tabs"
      :class="{ content: true, active: active_tab == tab_index }"
      :key="tab_index"
    >
      <!-- 假投資詐騙 start -->
      <div class="div_wrapper">
        <div class="div_p02_teach_title">
          <h2>{{ tab.title }}</h2>
        </div>
        <div class="div_p02_teach_content">
          <div class=".div_p02_teach_contentLeft col-md-6">
            <div class="div_p02_teach_contentImg">
              <img v-for="(img, index) in tab.images" :src="img" :key="index" />
            </div>
          </div>
          <div class="div_p02_teach_contentRight col-md-6">
            <h3 class="h4_component underline">
              <span class="span_underline">手法與特徵</span>
            </h3>

            <div v-for="(step, key) in tab.steps" :key="key">
              <div class="div_p02_teach_method">
                <p class="div_p02_teach_step text_title">Tip {{ key }}</p>
                <p class="div_p02_teach_stepText paragraph">
                  {{ step }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- 防範之道 -->
        <div class="div_p02_teach_title">
          <h3>防範之道</h3>
        </div>
        <div class="div_p02_teach_prevent row">
          <div
            class="div_p02_teach_preventBox paragraph col-md-3"
            v-for="(item, index) in tab.preventbox"
            :key="index"
          >
            {{ item }}
          </div>
        </div>
        <!-- 相關影音 -->
        <div class="div_p02_teach_title">
          <h3>相關影音</h3>
        </div>
        <div class="div_p02_teach_vedio row">
          <iframe
            v-for="(film, index) in tab.vedio"
            :key="index"
            :src="film"
            class="div_p02_teach_vedioBox col-lg-4 col-md-6"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
          ></iframe>
        </div>
      </div>
      <!-- 假投資詐騙 end -->
    </div>
  </div>
      <!-- footer -->
      <frontFooter />
</div>
</template>

<script>
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";

export default {
  components: {
    frontNavbar,
    frontFooter,
  },
  data() {
    return {
      active_tab: 0,
      tabs: [
        {
          label: "假投資詐騙",
          content: ``,
          title: `假投資詐騙`,
          images: {
            1: require("../assets/img/p02_teach/pic01.jpg"),
          },
          steps: {
            1: "網路(FB、IG、Y2B)看到投資、輕鬆賺錢貼文，或在交友網站、交友軟體(APP)認識網友，網友慫恿投資，以掌握「平臺漏洞、後臺程式」等話術，宣稱保證獲利、穩賺不賠且利潤豐厚。",
            2: "後續加LINE聯繫或加入LINE群組(如投資體驗群)，有自稱「老師、指導員、分析師、總監」的人教學投注(代操)，且群組內不斷有其他學員獲利貼文。",
            3: "初期帳面顯示獲利(小額獲利有些可以出金)，引誘您加碼投入大筆資金(甚至要您貸款投資)。",
            4: "當您加碼入金後，以各種理由(洗碼量不足、保證金、IP異常等)不讓你出金，或是直接凍結帳號、對方失去聯繫，就是「不出金」。",
          },
          preventbox: {
            1: "將「趨勢科技防詐達人」加為LINE，傳送欲查證的訊息，系統將自動偵測出是否為詐騙資訊，目前可偵測「釣魚簡訊」、「詐騙購物網站」、「詐騙Line ID」、「詐騙投資網站」等。",
            2: "165全民防騙官網及臉書粉絲專頁每週公布投資詐騙網站，並可至投信投顧公會網站查詢合法投資管道。",
            3: "於桌上型與筆記型電腦安裝『趨勢科技防詐達人瀏覽器擴充功能』，民眾於連結詐騙網頁時便會顯示警示視窗。",
            4: "於桌上型與筆記型電腦安裝『趨勢科技防詐達人瀏覽器擴充功能』，民眾於連結詐騙網頁時便會顯示警示視窗。",
          },

          vedio: {
            1: "https://www.youtube.com/embed/UWFGV6lnO38",
            2: "https://www.youtube.com/embed/UWFGV6lnO38",
            3: "https://www.youtube.com/embed/UWFGV6lnO38",
          },
        },
        {
          label: "假網購詐騙",
          title: `假網購詐騙`,
          images: {
            1: require("../assets/img/p02_teach/pic02.jpg"),
          },
          steps: {
            1: "網路(只賣單一商品：網站只有一頁，只賣一種商品，沒有其他頁面超連結。)看到投資、輕鬆賺錢貼文，或在交友網站、交友軟體(APP)認識網友，網友慫恿投資，以掌握「平臺漏洞、後臺程式」等話術，宣稱保證獲利、穩賺不賠且利潤豐厚。",
            2: "假冒名人名店：盜用名人照片、知名商店推薦商品，記得到本人或官方社群帳號查證。(如投資體驗群)，有自稱「老師、指導員、分析師、總監」的人教學投注(代操)，且群組內不斷有其他學員獲利貼文。",
            3: "濫用聳動字眼：運用限時特賣、倒數計時等手法誘人上鉤，且優惠明顯低於一般市售價格。(小額獲利有些可以出金)，引誘您加碼投入大筆資金(甚至要您貸款投資)。",
            4: "過分強調保障：強調七日鑑賞期、貨到付款有保障，購買後要求退貨卻困難重重。(洗碼量不足、保證金、IP異常等)不讓你出金，或是直接凍結帳號、對方失去聯繫，就是「不出金」。",
            5: "無公司地址或客服聯絡電話",
          },
          preventbox: {
            1: "提醒民眾網購商品應慎選優良有信用之網路商家，透過面交方式或選擇提供第三方支付之網購平臺確保自己權益。切勿貪小便宜 ID」、「詐騙投資網站」等。",
            2: "網購應選擇具有保障交易安全機制的交易平臺，另外個人銀行存款帳號為重要個資，勿隨意提供予他人，賣家應確實比對買家姓名、匯款人姓名、匯款帳號、時間及收件人姓名是否相符(https://reurl.cc/a953KZ)查詢合法投資管道。",
            3: "「貨運業者宅配到府」可直接向業者辦理退款「超商貨到付款」爭議案件，均可進線客服，由該公司協助處理",
            4: "注意包裹外包裝先查證，再付款保護個人資料",
          },

          vedio: {
            1: "https://www.youtube.com/embed/6BZOSoA4A6I",
            2: "https://www.youtube.com/embed/6BZOSoA4A6I",
          },
        },
        {
          label: "解除分期詐騙",
          title: `解除分期詐騙`,
          images: {
            1: require("../assets/img/p02_teach/pic03.jpg"),
          },
          steps: {
            1: "歹徒假冒網購商店客服人員誆稱被害人前次交易資料有誤，致經銷商、批發商造成訂單(訂購)重複訂單、扣款(分期付款)，經核對(個資、交易)資料後轉通知金融機構處理。",
            2: "接獲陌生來電或境外來電(開頭有+)必須提高警覺，勿隨意提供個人資料或依照指示提款或轉帳。",
            3: "如接獲網購客服聲稱訂單有問題，應將電話掛斷後，主動撥打該客服電話再度作確認或撥打165反詐騙諮詢專線諮詢。",
          },
          preventbox: {
            1: "提醒民眾ATM只有「提款」跟「轉帳」功能，不能解除分期付款或退款；",
            2: "若碰到對象要遊戲點數亦只有儲值遊戲之功能，並無法解除任何設定或身分識別。",
            3: "165全民防騙官網及臉書粉絲專頁每週公布高風險賣場提醒民眾慎防近期若接獲假冒電商來電有上述情形，請掛斷電話勿聽從對方指令，以免受騙。",
          },

          vedio: {
            1: "https://www.youtube.com/embed/6BZOSoA4A6I",
            2: "https://www.youtube.com/embed/6BZOSoA4A6I",
          },
        },
        {
          label: "假冒機構詐騙",
          title: `假冒機構詐騙`,
          images: {
            1: require("../assets/img/p02_teach/pic04.jpg"),
          },
          steps: {
            1: "民眾接獲歹徒假冒電信局或健保局來電，告知民眾因身分證件遭盜用而申辦多支門號且電話費欠繳或稱民眾盜刷健保卡詐領保險金等(訂購)重複訂單、扣款(分期付款)，經核對(個資、交易)資料後轉通知金融機構處理。",
            2: "由自稱檢、警人員與被害人聯繫，表示目前因民眾涉及刑案，案件偵辦中需遵守偵查不公開不得告訴任何人(開頭有+)必須提高警覺，勿隨意提供個人資料或依照指示提款或轉帳。",
            3: "要求被害人交付名下所有財產做清查、監管，使被害人聽從詐騙集團指示交付金錢或提款卡、存摺、印章等。",
          },
          preventbox: {
            1: "提醒民眾如果有接獲類似來電，謹記一聽、二掛、三查證訣竅",
            2: "法院、檢、警不會監管民眾財產亦不會派員向民眾收取財產等有價物",
            3: "法院、檢、警不會要求民眾於線上製作筆錄，更不會要求至超商或使用LINE接收公文書",
            4: "安裝WHOSCALL APP，接獲來電時能協助辨識，降低受詐風險",
          },

          vedio: {
            1: "https://www.youtube.com/embed/6BZOSoA4A6I",
            2: "https://www.youtube.com/embed/6BZOSoA4A6I",
          },
        },
        {
          label: "交友愛情詐騙",
          title: `交友愛情詐騙`,
          images: {
            1: require("../assets/img/p02_teach/pic05.jpg"),
          },
          steps: {
            1: "歹徒透過網路FB、IG、交友軟體等管道搭訕，所使用的大頭照多為盜用網路上的帥哥、美女照片，讓被害人誤以為陷入迷惘，(訂購)重複訂單、扣款(分期付款)，經核對(個資、交易)資料後轉通知金融機構處理。",
            2: "認識過程不曾見面、文字甜言蜜語以老公、老婆、親愛的相稱，即使提供護照或證件卻難信以為真。(開頭有+)必須提高警覺，勿隨意提供個人資料或依照指示提款或轉帳。",
            3: "當愛情騙子得知熟女已對他產生好感，立即展開柔情攻勢，包括半夜寫情書、每天噓寒問暖、提醒要注意健康、不在乎熟女變胖、不介意容貌和身材，讓熟女以為找到了白馬王子。",
            4: "歹徒可能自稱為戰地軍官、軍醫、服務於聯合國官員，稱要送包裹、禮物給被害人，佯稱運送需要付運費、關稅等理由，或稱於聯合國請假前來找被害人依規定需要付保證金，被害人信以為真前往匯款。",
          },
          preventbox: {
            1: "尚未確認對方的真實身分之前，千萬不要透露個資、存款、財產，更不能將私密照片傳給對方。",
            2: "若碰到對象要求拿錢加入投資，還是自己不熟悉的領域，應該勇敢說不，那樣的關係也不是真愛。",
          },

          vedio: {
            1: "https://www.youtube.com/embed/6BZOSoA4A6I",
            2: "https://www.youtube.com/embed/6BZOSoA4A6I",
          },
        },
        {
          label: "人頭帳戶詐騙",

          title: `人頭帳戶詐騙`,
          images: {
            1: require("../assets/img/p02_teach/pic06.jpg"),
          },
          steps: {
            1: "詐騙集團於社群平臺張貼「徵求家庭代工」「簡單輕鬆工作」「貸款免手續費」等貼文吸引民眾洽詢，雙方加入LINE之後開始詳談。(訂購)重複訂單、扣款(分期付款)，經核對(個資、交易)資料後轉通知金融機構處理。",
            2: "起初對方對於工作或者貸款內容詳細說明、態度親和、提供公司登記證明書、甚至雙方簽訂線上「合作契約書」，一切看來像是按照正常申請的程序在進行。 (開頭有+)必須提高警覺，勿隨意提供個人資料或依照指示提款或轉帳。",
            3: "歹徒謊稱需要 登記材料、協助作帳、申請貸款、匯入工作薪資等各種原因，要求被害人A拍攝個人身分證照片，再寄出個人銀行存摺及提款卡",
            4: "歹徒會【指導】被害人A將個人資料保裝在袋子或盒子",
            5: "拿到手的銀行帳戶，讓歹徒可以再用來騙另一位被害人B將錢匯入，等被害人B報案時A成為了人頭帳戶",
          },
          preventbox: {
            1: "對於個人的印鑑、存摺、網路交易密碼等，負有應自行妥善保管之責任，絕對不可交付陌生人，否則成為人頭帳戶，亦將背負刑責",
            2: "對於找尋工作如有疑慮，應主動撥打該客服電話再度作確認或撥打165反詐騙諮詢專線諮詢。",
          },

          vedio: {
            1: "https://www.youtube.com/embed/6BZOSoA4A6I",
            2: "https://www.youtube.com/embed/6BZOSoA4A6I",
          },
        },
      ],
    };
  },
  methods: {
    changeTab(tab_index) {
      this.active_tab = tab_index;
    },
  },
};
</script>

<style scoped>
</style>