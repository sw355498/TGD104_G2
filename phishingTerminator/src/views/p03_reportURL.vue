<template>
  <div class="reportUrl">
        <h1>回報可疑網站</h1>
        <form method="post" action="" class="form_p03_reportURL">
            <h6>可疑網站填寫表單</h6>
            <p>民眾若發現可疑網站，可於本平台進行通報<br>
                本站將由專人協助判斷是否為「偽冒網站/詐騙網站」
            </p>
            <!-- 會員 -->
            <div class="user_p03_reportURL">
                <div class="userImg">
                    <img src="" alt="userImg">
                </div>
                <div class="userInfo">
                    <span>嗨！</span>會員
                    <p>有發現什麼可疑網站嗎</p>
                </div>
            </div>
            <div class="formInput_p03_reportURL">
                <label for="url">網站網址</label>
                <input v-model="url" class="input_p03" type="text" name="url" placeholder="http://">
                <i class="fa-solid fa-circle-xmark"></i>
                <p class="warning_p03">該網址已通報過囉</p>
                <div class="active_p03_reportURL">
                    <label for="email">通報人信箱</label>
                    <input v-model="email" class="input_p03" type="email" name="email" placeholder="請輸入您的信箱">
                </div>
                <label for="title">網站名稱</label>
                <input v-model="title" class="input_p03" type="text" name="title" placeholder="被偽冒或詐騙公司名稱">
                <label for="notes">備註</label>
                <textarea v-model="notes" class="input_p03" name="notes" placeholder="可說明該網站可疑之處..."></textarea>
                <!-- 綁定了 @click.prevent 事件來防止默認提交行為 -->
                <input class="inputSubmit_p03 small_button" type="submit" value="送出" @click.prevent="submitForm"> 
            </div>
        </form>
        <!-- ======== 已通報的可疑網站列表，掛外掛要拿 ======== -->
        <section class="urlList_p03_reportURL">
            <h2>已通報的可疑網站列表</h2>
            <table class="" id="keywords">
                <thead>
                    <tr>
                        <th><i class="fa-regular fa-calendar"></i><span> 日期 </span><i class="fa-solid fa-angle-down"></i></th>
                        <th><i class="fa-solid fa-file-circle-check"></i><span> 回報狀態 </span><i class="fa-solid fa-angle-down"></i></th>
                        <th><i class="fa-solid fa-globe"></i><span> 網站名稱 </span><i class="fa-solid fa-angle-down"></i></th>
                        <th><i class="fa-solid fa-link"></i><span> 網址 </span><i class="fa-solid fa-angle-down"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023/01/10</td>
                        <td>未審核</td>
                        <td>17play娛樂城</td>
                        <td>https://cesare.asia/6</td>
                    </tr>
                    <tr>
                        <td>2023/01/09</td>
                        <td>非詐騙網站</td>
                        <td>19play娛樂城</td>
                        <td>https://cesare.asia/5</td>
                    </tr>
                    <tr>
                        <td>2023/02/11</td>
                        <td>確認為詐騙網站</td>
                        <td>18play娛樂城</td>
                        <td>https://cesare.asia/64</td>
                    </tr>
                    <tr>
                        <td>2023/02/11</td>
                        <td>確認為詐騙網站</td>
                        <td>18play娛樂城</td>
                        <td>https://cesare.asia/64</td>
                    </tr>
                    <tr>
                        <td>2023/02/11</td>
                        <td>確認為詐騙網站</td>
                        <td>18play娛樂城</td>
                        <td>https://cesare.asia/64</td>
                    </tr>
                    <tr>
                        <td>2023/02/11</td>
                        <td>確認為詐騙網站</td>
                        <td>18play娛樂城</td>
                        <td>https://cesare.asia/64</td>
                    </tr>
                    <tr>
                        <td>2023/02/11</td>
                        <td>確認為詐騙網站</td>
                        <td>18play娛樂城</td>
                        <td>https://cesare.asia/64</td>
                    </tr>
                    <tr>
                        <td>2023/02/11</td>
                        <td>確認為詐騙網站</td>
                        <td>18play娛樂城</td>
                        <td>https://cesare.asia/64</td>
                    </tr>
                </tbody>
              </table>
              <div class="pages ">
                <i class="fa-solid fa-angles-left"></i>
                <span>1 2 3 4 5 ... </span>
                <i class="fa-solid fa-angles-right"></i>
              </div>
              <!-- 外掛 jsGrid -->
            <div id="jsGrid"></div>
        </section>
    </div>
</template>


<script>
import{ ref} from "vue";
export default {
    name: 'Form',
    setup() {
        // 使用 ref 定義表單中的變量
        const url = ref('')
        const email = ref('')
        const title = ref('')
        const notes = ref('')

        // 定義表單提交函數
        function submitForm() {
            console.log(`網址：${url.value}`)
            console.log(`電子郵件：${email.value}`)
            console.log(`姓名：${title.value}`)
            console.log(`訊息：${notes.value}`)
        // 在這裡可以向後端發送表單數據並進行其他處理
        }

        // 將變量和函數返回以在模板中使用
        return {
            url,
            email,
            title,
            notes,
            submitForm,
        }
    },
}
</script>