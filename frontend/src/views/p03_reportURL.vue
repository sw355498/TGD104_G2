<template>
    <div class="p03_reportUrl">
        <section class="sectionTop_p03_reportUrl">
            <h1>回報可疑網站</h1>
            <!-- <p>回報可疑網站</p> -->
            <form method="post" action="" class="form_p03_reportURL">
                <h6>我要回報填寫表單</h6>
                <p class="websizeText">民眾若發現可疑網站，可於本平台進行通報<br>
                    本站將由專人協助判斷是否為「偽冒網站/詐騙網站」
                </p>
                <span class="phonesizeText">
                    民眾若發現可疑網站<br>可於本平台進行通報<br>本站將由專人協助判斷<br>是否為「偽冒網站/詐騙網站」
                </span>
                <!-- 會員 -->
                <div class="user_p03_reportURL">
                    <div class="userImg">
                        <img src="../assets/img/p08_user/user.jpg" alt="userImg">
                    </div>
                    <div class="userInfo">
                        <span>嗨！</span> Karen
                        <p>有發現什麼可疑網站嗎</p>
                    </div>
                </div>
                <!-- 輸入資料 -->
                <div class="formInput_p03_reportURL">
                    <label for="url">網站網址</label>
                    <input v-model="url" class="input_p03" type="text" name="url" placeholder="http://">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <p class="warning_p03">該網址已通報過囉</p>
                    <div class="active_p03_reportURL">
                        <label for="email">通報人信箱</label>
                        <input v-model="email" class="input_p03" type="email" name="email" placeholder="請輸入您的信箱">
                        <p class="warning_p03">請輸入信箱</p>
                    </div>
                    <label for="title">網站名稱</label>
                    <input v-model="title" class="input_p03" type="text" name="title" placeholder="被偽冒或詐騙公司名稱">
                    <label for="notes">備註</label>
                    <textarea v-model="notes" class="input_p03" name="notes" placeholder="可說明該網站可疑之處..."></textarea>
                    <!-- 綁定了 @click.prevent 事件來防止默認提交行為 -->
                    <input class="inputSubmit_p03 small_button" type="submit" value="送出" @click.prevent="submitForm"> 
                </div>
            </form>
        </section>    
        
        <!-- ======== 已通報的可疑網站列表，掛外掛要拿 ======== -->
        <section class="urlList_p03_reportURL">
            <h2>已通報的可疑網站列表</h2>
            <!-- <table class="" id="keywords">
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
                </tbody>
            </table>
            <div class="pages ">
            <i class="fa-solid fa-angles-left"></i>
            <span>1 2 3 4 5 ... </span>
            <i class="fa-solid fa-angles-right"></i>
            </div> -->
            
            <!-- ======== 外掛 jsGrid ========= -->
            <div id="jsGrid"></div>
        </section>
    </div>
</template>

<script>
import{ ref} from "vue";
export default {
    name: 'Form',
    mounted() {
        var website = [
            { "回報日期": "2023-03-19", "回報狀態": "待審核", "網站名稱": "-", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "非詐騙網站", "網站名稱": "google", "網址": "https://www.google.com.tw/?hl=zh_TW",  },
            { "回報日期": "2023-03-19", "回報狀態": "非詐騙網站", "網站名稱": "google", "網址": "https://www.google.com.tw/?hl=zh_TW",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-11", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-11", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
            { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },

        ];
        $("#jsGrid").jsGrid({
            width: "100%",
            // height: "600px",
            // filtering: true,
            inserting: false,
            editing: false,
            sorting: true,
            /*分頁設定*/
            paging: true,
            pagerContainer: null,   //jQueryElement或DomNode指定呈現一個分頁欄，為null時在表格底部。
            pageIndex: 1,   //當前頁面數
            pageSize: 10,   //頁面的數據量
            pageButtonCount: 3,    //最大數量的頁面按鈕
            pagerFormat: "{first} {pages} {last} &nbsp;&nbsp; ", //占位符來指定分頁欄格式
            //pageNextText: "Next",   //下一頁
            //pagePrevText: "Prev",   //上一頁
            pageFirstText: "首頁", //首頁
            pageLastText: "最後一頁",   //尾頁
            pageNavigatorNextText: "...",    //最大數量頁面按鈕超出時右邊顯示
            pageNavigatorPrevText: "...",       //最大數量頁面按鈕超出時右邊顯示

            data: website,
            fields: [
                { name: "ID", css: "d-none", validate: "required",},
                { name: "回報日期", type: "text", width: 100, validate: "required" },
                { name: "回報狀態", type: "text",   width: 100, },
                { name: "網站名稱", type: "text", width: 100 },
                { name: "網址", type: "text", width: 200 },
                
            ],
        });

  },
};
</script>