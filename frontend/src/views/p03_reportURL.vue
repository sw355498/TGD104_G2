<template>
    <main class="p03_reportUrl">
         <!-- header -->
        <frontNavbar />
        <section class="sectionTop_p03_reportUrl">
            <h1>回報可疑網站</h1>
            <!-- <p>回報可疑網站</p> -->
            <form class="form_p03_reportURL" action=""  @submit.prevent="submitForm">
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
                    <!-- url -->
                    <label for="url">網站網址</label>
                    <input 
                        v-model.trim="url"
                        class="input_p03" type="text" name="url" 
                        placeholder="http://" required>
                    <i class="fa-solid fa-circle-xmark"></i>
                    <p class="warning_p03">該網址已通報過囉</p>
                    <!-- email -->
                    <div class="active_p03_reportURL">
                        <label for="email">通報人信箱</label>
                        <input 
                            v-model.trim="email"
                            class="input_p03" type="email" name="email" 
                            laceholder="請輸入您的信箱">
                        <p class="warning_p03">請輸入信箱</p>
                    </div>
                    <!-- title -->
                    <label for="title">網站名稱</label>
                    <input 
                        v-model="title"
                        class="input_p03" type="text" name="title" 
                        placeholder="被偽冒或詐騙公司名稱">
                    <!-- note -->
                    <label for="notes">備註</label>
                    <textarea 
                        v-model.trim="notes"
                        class="input_p03" name="notes" 
                        placeholder="可說明該網站可疑之處...">
                    </textarea>
                    <!-- 綁定了 @click.prevent 事件來防止默認提交行為 -->
                    <input 
                        class="inputSubmit_p03 small_button" 
                        type="submit" value="送出" @click.prevent="submitForm"> 
                </div>
            </form>
        </section>    
        
        <!-- ======== 已通報的可疑網站列表，掛外掛要拿 ======== -->
        <section class="urlList_p03_reportURL">
            <h2>已通報的可疑網站列表</h2>
            <!-- ======== 外掛 jsGrid ========= -->
            <div id="jsGrid"></div>
        </section>
    </main>
    <frontFooter />
</template>

<script>
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import axios from 'axios';
import { API_URL, reactive } from '@/config'

export default {
    name: 'Form',
    components: {
        frontNavbar,
        frontFooter,
    },
    // setup(){
    //     const form = reactive({
    //     url: '',
    //     email: '',
    //     title: '',
    //     notes: '',
    // })
    // const submitForm = async () => {
    //   try {
    //     const response = await axios.post(`${API_URL}reportURL.php`, form)
    //     console.log(response.data)
    //   } catch (error) {
    //     console.error(error)
    //   }
    // }

    // return {
    //   form,
    //   submitForm
    // }
    // },
   
    mounted() {
        // axios
        //     // 要先 proxy
        //     // .get(`https://od.moi.gov.tw/api/v1/rest/datastore/A01010000C-002150-013`)
        //     .get(`/madeByNeil/api/v1/rest/datastore/A01010000C-002150-013`)
        //     // .get(`${API_URL}getWebURL.php`)
        //     .then((response) => {
        //         // this.datas = response.data.result.records;
        //         // let govURL = response.data.result;
        //         // let govWebTitle = [];
        //         // let govWebURL = [];
        //         // let govWebDate = [];
        //         // for (let i = 0; i < govURL.records.length; i++) {
        //         //     govWebTitle += govURL.records[i].WEBSITE_NM;
        //         //     govWebURL +=  govURL.records[i].WEBURL;
        //         //     govWebDate += govURL.records[i].STA_EDATE;
        //         //     console.log(govWebTitle, govWebURL, govWebDate);
        //         // };
        //         // return{govWebTitle, govWebURL, govWebDate}
        //     })
        //     .catch(function (error) { // 请求失败处理
        //         console.log(error);
        //     });
        // console.log(govWebTitle);
        // 需要 filtering 的欄位
        var filterColumn = ["回報日期", "回報狀態", "網站名稱", "網址"];
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
        // filtering 下拉框 要改成 撈的資料=============
        var arr = []
        for (var i = 0; i < filterColumn.length ; i++) {
            arr[i] = new Set()
            // 下拉框的預設為空" "
            arr[i].add(" ")
        };
        for (var i = 0; i < website.length; i++) {
            arr[0].add(website[i].回報狀態)
        };
        var statusURL = []
        for (var i of arr[0]) {
            statusURL.push({
                回報狀態: i
            })
        }
        function setGrid() {
            $("#jsGrid").jsGrid({
                width: "100%",
                filtering: true,
                inserting: false,
                editing: false,
                sorting: true,

                /*分頁設定*/
                paging: true,
                pagerContainer: null,   //jQueryElement或DomNode指定呈現一個分頁欄，為null時在表格底部。
                pageIndex: 1,   //當前頁面數
                pageSize: 10,   //頁面的數據量
                pageButtonCount: 5,    //最大數量的頁面按鈕
                pagerFormat: "{first} {pages} {last} &nbsp;&nbsp; ", //占位符來指定分頁欄格式
                // pageNextText: "Next",   //下一頁
                // pagePrevText: "Prev",   //上一頁
                pageFirstText: "首頁", //首頁
                pageLastText: "最後一頁",   //尾頁
                pageNavigatorNextText: "...",    //最大數量頁面按鈕超出時右邊顯示
                pageNavigatorPrevText: "...",       //最大數量頁面按鈕超出時右邊顯示
                
                loadMessage: "全速載入中，感謝耐心等候...",
                loadIndication: true,
                // data: website,
                fields: [
                    { name: "STA_EDATE", title:"回報日期", type: "text", width: 100, },
                    // { name: "STATUS_NAME", title:"回報狀態",type: "text",itemTemplate:function(value){
                    { name: "STATUS_NAME", title:"回報狀態",type: "select",itemTemplate:function(value){
                        let status = value  ? value : '確認為詐騙網站';
                        return status;
                    } },
                    { name: "WEBSITE_NM", title:"網站名稱", type: "text", width: 100 },
                    { name: "WEBURL", title:"網址", type: "text", width: 200 },

                ],
                controller: {
                    loadData: function () {
                        var d = $.Deferred();
                        axios
                            .get('/madeByNeil/api/v1/rest/datastore/A01010000C-002150-013')
                            .then((response) => {
                                let myArray = response.data.result.records;
                                myArray.splice(0, 1);  // 刪除政府預設第一欄
                                axios
                                    .get(`${API_URL}getWebURL.php`)
                                    .then((response) => {
                                        let myArray2 = response.data;
                                        const mergeData = myArray.concat(myArray2)
                                        d.resolve(mergeData);
                                        console.log(mergeData);
                                    })
                            })
                            .catch(function (error) { // 请求失败处理
                                console.log(error);
                            });
                            return d.promise();
                    },
                    function (filter) {
                        return myArray.filter(function (item) {
                            var flags = new Array(filterColumn.length)
                            flags.fill(true)
                            for (var i = 0; i < filterColumn.length; i++) {
                                var key = filterColumn[i]
                                // 過濾掉下拉選單的預設值 空" "
                                if (filter[key] !== " ") {
                                   flags[i] = (item[key].indexOf(filter[key]) > -1)
                                }
                            }
                            // 返回的数组里面的元素必须都为true
                            return flags.indexOf(false) === -1
                        });
                    },
                },
            });
        }
        setTimeout(function () { $("#jsGrid").jsGrid("loadData"); }, 1000);
        // $("#jsGrid").jsGrid("loadData")
        setGrid();
    },
};
</script>