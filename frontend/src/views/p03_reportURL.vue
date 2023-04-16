<template>
    <main class="p03_reportUrl">
         <!-- header -->
        <frontNavbar />
        <section class="sectionTop_p03_reportUrl">
            <h1>回報可疑網站</h1>
            <!-- <p>回報可疑網站</p> -->
                <!-- 綁定了 @click.prevent 事件來防止默認提交行為 -->
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
                    <p 
                        v-show="url === ''"
                        class="warning_p03">請輸入您覺得可疑的網址</p>
                    <p 
                        
                        class="warning_p03">該網址已通報過囉</p>
                    <!-- email -->
                    <div class="active_p03_reportURL">
                        <label for="email">通報人信箱</label>
                        <input 
                            v-model.trim="email"
                            class="input_p03" type="email" name="email" 
                            placeholder="請輸入您的信箱">
                        <p 
                            class="warning_p03"
                        >{{ emailError }}123</p>
                        <p 
                            v-show="email === ''"
                            class="warning_p03">請輸入信箱</p>
                        
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
                    <input 
                        class="inputSubmit_p03 small_button" 
                        type="submit" value="送出"
                        @click="sweetAlert"
                    > 
                    <button
                        class="inputSubmit_p03" 
                        :disabled="!isFormValid & !validateEmail"
                        type="submit" value="送出"
                        @click="sweetAlert"
                    >送出</button>
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

<script setup>
import { ref, computed, onMounted } from 'vue';
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import axios from 'axios';
import { API_URL } from '@/config'
import Swal from 'sweetalert2/dist/sweetalert2.js'

    const sweetAlert=(bank)=>{
        Swal.fire({
            title: '成功送出',
            text: '將由專人為您審核',
            icon: 'success',
            confirmButtonText: '確認'
        })
    }
    const a =ref('')
    const url = ref('')
    const email = ref('')
    const title = ref('')
    const notes = ref('')
    const submitForm = async () => {
        if (emailError.value) {
            return
        }
        try {
            const response = await axios.post(`${API_URL}reportURL.php`, {
                url: url.value,
                email: email.value,
                title: title.value,
                notes: notes.value
            })
            // 提交成功後的處理
            console.log('成功送出:', response.data)
        } catch (error) {
            // 提交失敗的處理
            console.error('Submit failed:', error)
        }
    }
    const isFormValid = computed(() => {
        return url.value !== ''
    })
    const emailError = ref('')
    const validateEmail = () => {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        if (!emailPattern.test(email.value)) {
            emailError.value = 'Email格式錯誤'
        } else {
            emailError.value = ''
        }
    }
    onMounted(async()=> {
            const allURL = ref([])
            try {
                await axios
                // 要先 proxy
                .get('/madeByNeil/api/v1/rest/datastore/A01010000C-002150-013')
                .then((response) => {
                    let myArray = response.data.result.records;
                    myArray.splice(0, 1);  // 刪除政府預設第一欄
                    axios
                        .get(`${API_URL}getWebURL.php`)
                        .then((response) => {
                            let myArray2 = response.data;
                            const mergeData = myArray.concat(myArray2)
                            // 判斷 dataList 中是否有名稱為 'url' 的資料
                            
                            allURL.value = mergeData
                        })
                })
                .catch(function (error) { 
                    console.log(error);
                });
            } catch (error) {
                console.log(error);
            }
            
        // 需要 filtering 的欄位
        // var filterColumn = ["回報日期", "回報狀態", "網站名稱", "網址"];
        // var website = [
        //     { "回報日期": "2023-03-19", "回報狀態": "待審核", "網站名稱": "-", "網址": "https://cesare.asia/6",  },
        //     { "回報日期": "2023-03-19", "回報狀態": "非詐騙網站", "網站名稱": "google", "網址": "https://www.google.com.tw/?hl=zh_TW",  },
        //     { "回報日期": "2023-03-19", "回報狀態": "非詐騙網站", "網站名稱": "google", "網址": "https://www.google.com.tw/?hl=zh_TW",  },
        //     { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
        //     { "回報日期": "2023-03-19", "回報狀態": "確認為詐騙網站", "網站名稱": "17play 娛樂城", "網址": "https://cesare.asia/6",  },
        //   ];
        // // filtering 下拉框 要改成 撈的資料=============
        // var arr = []
        // for (var i = 0; i < filterColumn.length ; i++) {
        //     arr[i] = new Set()
        //     // 下拉框的預設為空" "
        //     arr[i].add(" ")
        // };
        // for (var i = 0; i < website.length; i++) {
        //     arr[0].add(website[i].回報狀態)
        // };
        // var statusURL = []
        // for (var i of arr[0]) {
        //     statusURL.push({
        //         回報狀態: i
        //     })
        // }
        // function setGrid() {
            
        import('jsgrid').then((jsGrid)=> {
            $("#jsGrid").jsGrid({
                width: "100%",
                // filtering: true,
                filtering: false,
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
                
                // loadMessage: "全速載入中，感謝耐心等候...",
                loadIndication: false,
                data: allURL.value,
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
                // controller: {
                //     loadData: 
                //     function callData() {
                //         var d = $.Deferred();
                //         axios
                //             // 要先 proxy
                //             .get('/madeByNeil/api/v1/rest/datastore/A01010000C-002150-013')
                //             .then((response) => {
                //                 let myArray = response.data.result.records;
                //                 myArray.splice(0, 1);  // 刪除政府預設第一欄
                //                 axios
                //                     .get(`${API_URL}getWebURL.php`)
                //                     .then((response) => {
                //                         let myArray2 = response.data;
                //                         const mergeData = myArray.concat(myArray2)
                //                         // 判斷 dataList 中是否有名稱為 'url' 的資料
                //                         const hasURL = mergeData.some((item) => item === 'url');
                //                         console.log(hasURL); // true
                //                         console.log(mergeData); // true
                //                         d.resolve(mergeData);
                //                     })
                //             })
                //             .catch(function (error) { 
                //                 console.log(error);
                //             });
                //             return d.promise();
                //     },
                //     // function (filter) {
                //     //     return d.filter(function (item) {
                //     //         var flags = new Array(filterColumn.length)
                //     //         flags.fill(true)
                //     //         for (var i = 0; i < filterColumn.length; i++) {
                //     //             var key = filterColumn[i]
                //     //             // 過濾掉下拉選單的預設值 空" "
                //     //             if (filter[key] !== " ") {
                //     //                flags[i] = (item[key].indexOf(filter[key]) > -1)
                //     //             }
                //     //         }
                //     //         // 返回的数组里面的元素必须都为true
                //     //         return flags.indexOf(false) === -1
                //     //     });
                //     // },
                // },
            // });
        });
        // setTimeout(function callData() { $("#jsGrid").jsGrid("loadData"); }, 100);
        // $("#jsGrid").jsGrid("loadData")
      // setGrid();
    })
});
</script>