<template>
  <frontNavbar />
  <backTopBtn />
  <div class="body_p09_team_block">
    <h2>our team</h2>
    <section>
      <img src="../assets/img/p09_team/p09_team_crews2.png" alt="teamMember" />
      <div>
        <p>
          我們是一群對軟體開發保持熱情的團隊，並同時關心著網路使用者們安全所創立的團隊，我們專注於前端應用軟體開發，以網頁設計及RWD為此教學網站核心服務。
          我們希望網路使用者們於使用網路的同時也知道如何保護個人資料及避免個資被駭客及釣魚網站的惡意給利用。
        </p>
      </div>
    </section>

    <main>
      <h3>crew member</h3>
      <div class="intro_p09_team_block">
        <div class="card1_p09_team_block">
          <p>全容君KarenChuan</p>
          <div class="pic" id="karen"></div>
          <div class="work_p09_team_block">
            <ul>
              負責功能<br />
              <li>系統分析</li>
              <li>網站視覺規劃</li>
              <li>簡報製作</li>
              <li>首頁Index</li>
              <li>FAQ頁</li>
              <li>互動體驗手機頁</li>
              <li>團隊介紹頁</li>
            </ul>
          </div>
          <button><i class="fa-solid fa-info"></i></button>
        </div>
        <div class="card2_p09_team_block">
          <h4>專案策劃</h4>
        </div>
        <div class="card1_p09_team_block">
          <p>林欣妤Shinyu Lin</p>
          <div class="pic" id="shsinyu"></div>
          <div class="work_p09_team_block">
            <ul>
              負責功能<br />
              <li>網站企劃</li>
              <li>系統分析</li>
              <li>聊天機器人</li>
              <li>回報可疑網站</li>
              <li>互動體驗網站頁</li>
              <li>互動體驗訊息頁</li>
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
              <li>系統分析</li>
              <li>專題簡報製作</li>
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
              <li>互動體驗測驗頁</li>
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
              <li>資料庫規劃建置</li>
              <li>討論專區頁</li>
              <li>後台管理頁</li>
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
              <li>系統分析</li>
              <li>資料庫規劃建置</li>
              <li>相關政府連結頁</li>
              <li>互動體驗購物頁</li>
              <li>互動體驗訊息頁</li>
            </ul>
          </div>
          <button><i class="fa-solid fa-info"></i></button>
        </div>
      </div>

      <div class="contact_p09_team_from">
        
      </div>
    </main>
  </div>

  <frontFooter />
</template>

<script>
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import backTopBtn from "@/components/backTopBtn.vue";

export default {
  components: {
    frontNavbar,
    frontFooter,
    backTopBtn,
  },
};
</script>
