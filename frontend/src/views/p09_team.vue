<template>
  <div class="body_p09_team_block">
    <frontNavbar />
    <h2>our team</h2>
    <section>
      <img src="../assets/img/p09_team/p09_team_crews1.png" alt="teamMember" />
      <div class="ourCore">
        <p>
          我們是個名為「TGD104G2」的開發團隊，我們是一群熱愛編程且來自各領域的開發者所組成。我們的目標是開發出易用性高的軟體，並提供最佳的用戶體驗。這是我們的第一個開發項目名為「詐災就好」(台語：早知就好)的體驗式網站。
          這個網站的目的是讓使用者能夠輕鬆地了解目前可能會遇到詐騙類型，並且網站內也提供有關如何防範詐騙及可即時於線上提供詐騙回報的功能。團隊成員們經過一段時間的討論和設計，最終創造出了一個極具靈活性和易用性的產。
          然而，這個項目的開發過程並非一帆風順。過程遭遇了許多問題，例如：一些功能沒有按預期運作、用戶介面不夠直覺、效能問題等等。但是，每當遇到問題時，我們總是不斷思考和嘗試解決方法，並在最短時間內提供解決方案。
          這樣的反覆試驗和改進過程，讓我們對產品有更深入的了解和熟悉，讓團隊成員們能夠更快速地發現問題並解決。這個項目終於如期完成了！期望這個網站對人是有幫助的，也期待使用者們提供的反應及回饋。
        </p>
      </div>
    </section>
    <!-- 分工介紹 -->
    <main>
      <h3>crew member</h3>
      <div class="intro_p09_team_block">
        <div class="card1_p09_team_block">
          <p>全容君KarenChuan</p>
          <div class="pic" id="karen"></div>
          <div class="work_p09_team_block">
            <ul>
              負責功能<br />
              <li>網站視覺規劃</li>
              <li>Design System</li>
              <li>簡報製作</li>
              <li>系統分析</li>
              <li>首頁Index</li>
              <li>FAQ頁</li>
              <li>互動體驗手機語音詐騙</li>
              <li>團隊介紹頁</li>
            </ul>
          </div>
          <button><i class="fa-solid fa-info"></i></button>
        </div>
        <div class="card2_p09_team_block">
          <h4>專案策劃</h4>
        </div>
        <div class="card1_p09_team_block">
          <p>林欣妤hsinyu Lin</p>
          <div class="pic" id="shsinyu"></div>
          <div class="work_p09_team_block">
            <ul>
              負責功能<br />
              <li>網站企劃</li>
              <li>系統分析</li>
              <li>聊天機器人</li>
              <li>回報可疑網站</li>
              <li>互動體驗購物網站詐騙</li>
              <li>互動體驗愛情訊息詐騙</li>
            </ul>
          </div>
          <button><i class="fa-solid fa-info"></i></button>
        </div>
        <div class="card2_p09_team_block">
          <h4>主視覺規劃</h4>
        </div>
        <div class="card1_p09_team_block">
          <p>阮炫瑞Lucy Ruan</p>
          <div class="pic" id="lucyruan"></div>
          <div class="work_p09_team_block">
            <ul>
              負責功能<br />
              <li>Logo設計</li>
              <li>網站視覺規劃</li>
              <li>簡報製作</li>
              <li>系統分析</li>
              <li>最新消息頁</li>
              <li>防範詐騙教學頁</li>
              <li>會員中心頁</li>
            </ul>
          </div>
          <button><i class="fa-solid fa-info"></i></button>
        </div>
        <div class="card1_p09_team_block">
          <p>黃資蓉</p>
          <div class="pic" id="candybomb"></div>
          <div class="work_p09_team_block">
            <ul>
              負責功能<br />
              <li>網站資料搜集</li>
              <li>網站流程圖</li>
              <li>UserCase</li>
              <li>系統分析</li>
              <li>專題簡報製作</li>
              <li>互動體驗詐騙測驗頁</li>
            </ul>
          </div>
          <button><i class="fa-solid fa-info"></i></button>
        </div>
        <div class="card1_p09_team_block">
          <p>詹皓丞</p>
          <div class="pic" id="sw"></div>
          <div class="work_p09_team_block">
            <ul>
              負責功能<br />
              <li>系統分析</li>
              <li>ERModel</li>
              <li>資料庫規劃建置串接</li>
              <li>後台登入頁</li>
              <li>後台各頁面管理頁</li>
              <li>系統環境建置</li>
            </ul>
          </div>
          <button><i class="fa-solid fa-info"></i></button>
        </div>
        <div class="card2_p09_team_block">
          <h4>工程技術</h4>
        </div>
        <div class="card1_p09_team_block">
          <p>張家恩</p>
          <div class="pic" id="bbn"></div>
          <div class="work_p09_team_block">
            <ul>
              負責功能<br />
              <li>系統分析及文件</li>
              <li>ERModel</li>
              <li>相關政府連結頁</li>
              <li>互動體驗購物頁</li>
              <li>互動體驗訊息頁</li>
              <li>討論專區頁</li>
            </ul>
          </div>
          <button><i class="fa-solid fa-info"></i></button>
        </div>
      </div>

      <div class="contact_p09_team_from"></div>
    </main>
  </div>

  <frontFooter />
</template>

<script setup>
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
</script>
