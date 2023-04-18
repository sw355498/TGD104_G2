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
                    <label for="url">網站網址 (*必填)</label>
                    <input 
                        v-model.trim="url"
                        class="input_p03" type="text" name="url" 
                        @focus="urlExist = false"
                        placeholder="http://" required>
                    <i 
                        v-show="urlExist"
                        class="fa-solid fa-circle-xmark"></i>
                    <p v-show="url == ''">請輸入可疑的網站網址</p>
                    <p 
                        v-show="urlExist"
                        class="warning_p03">該網址已通報過囉</p>
                    <!-- email -->
                    <div class="active_p03_reportURL">
                        <label for="email">通報人信箱 (*必填)</label>
                        <input
                            v-model.trim="email"
                            class="input_p03"
                            type="email" name="email"
                            placeholder="請輸入您的信箱">
                            <p v-show="email == ''">請輸入信箱</p>
                        <p v-show="email !== '' && !emailRegex.test(email)">
                            請輸入正確的信箱格式</p>
                                        
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
                        :disabled="!isFormValid "
                    > 
                </div>
            </form>
        </section>    
        
        <!-- ======== 已通報的可疑網站列表，掛外掛要拿 ======== -->
        <section class="urlList_p03_reportURL">
            <h2>已通報的可疑網站列表</h2>
            <!-- ======== 外掛 jsGrid ========= -->
            <div v-if="!isJsgrid">
                <p style="color:red;">全速載入中，感謝耐心等候...</p>
            </div>
            <div v-else id="jsGrid"></div>
        </section>
    </main>
    <frontFooter />
</template>

<script setup>
import { ref, computed, onMounted,watch } from 'vue';
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import axios from 'axios';
import { API_URL } from '@/config' // 統一 api 路徑變數
import Swal from 'sweetalert2/dist/sweetalert2.js'
    // sweetalert
    const sweetAlert = ()=>{
        Swal.fire({
            title: '成功送出',
            text: '將由專人為您審核',
            icon: 'success',
            confirmButtonText: '確認'
        })
    }
    // 傳送表單
    const url = ref('')
    const email = ref('')
    const title = ref('')
    const notes = ref('')
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    // 驗證表單url不等於空、email正確格式才可以送出
    const isFormValid = computed(() => {
        return (
            url.value !== '' &&
            emailRegex.test(email.value)
        )
    })
    const urlExist = ref('')
    // 傳送表單到資料庫
    const submitForm = async () => {
        console.log(allURL.value);
        try { 
            // 判断url是否已存在于allURL.value中
            const urlExists = allURL.value.some(word =>word.WEBURL ===  url.value);
            if (urlExists) {
                console.log('網址已經有了');
                urlExist.value = true;
                console.log(urlExist.value);
            return urlExist.value, isFormValid.value;
            }else{
                urlExist.value = false;
            }
            const response = await axios.post(`${API_URL}reportURL.php`, {
                url: url.value,
                email: email.value,
                title: title.value,
                notes: notes.value
            })
            // 提交成功後的處理
            console.log('成功送出:', response.data);
            sweetAlert();
            // 刷新jsgrid資料
            allURL.value = await allData();
            loadJsGrid();
        } catch (error) {
            // 提交失敗的處理
            console.error('Submit failed:', error)
        }
    }
    // 全速載入中感謝等候
    const isJsgrid = ref(false);
    // allURL 資料庫需要的變數
    const allURL = ref([]);
    onMounted(
    async () => {
        //撈取 opendata 跟資料庫的資料
        allURL.value = await allData();
        const jsgrid = await import('jsgrid');
        loadJsGrid();
    });
    // 撈政府 opendata 跟 後臺資料庫 api
    async function allData(){
        try {
            isJsgrid.value = false;
            const response = await axios.get('/madeByNeil/api/v1/rest/datastore/A01010000C-002150-013')
            let myArray = response.data.result.records;
            myArray.splice(0, 1);  // 刪除政府預設第一欄
                const responseServer = await axios.get(`${API_URL}getWebURL.php`)
                let myArray2 = responseServer.data;
                let mergeData = myArray.concat(myArray2)
                // 對合併的陣列排序
                mergeData.sort((b, a) => new Date(a.STA_EDATE) - new Date(b.STA_EDATE)); 
            isJsgrid.value= true;
            return mergeData
        } catch (error) {
            console.log(error);
        }
        console.log(allURL.value)
    };
    // 需要 filtering 的欄位
    // var filterColumn = ["回報日期", "回報狀態", "網站名稱", "網址"];
    // // filtering 下拉框 要改成 撈的資料=============
    // var arr = []
    // for (var i = 0; i < filterColumn.length ; i++) {
    //     arr[i] = new Set()
    //     // 下拉框的預設為空" "
    //     arr[i].add(" ")
    // };
    // for (var i = 0; i < allURL.value.length; i++) {
    //     arr[0].add(allURL.value[i].STATUS_NAME)
    // };
    // var STATUS_NAME = []
    // for (var i of arr[0]) {
    //     STATUS_NAME.push({
    //         回報狀態: i
    //     })
    // }
    
    // jsgrid 套件設定
    const loadJsGrid = () => {
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
            // loadIndication: true,
            data: allURL.value,
            fields: [
                { name: "STA_EDATE", title:"回報日期", type: "text", width: 100, },
                { name: "STATUS_NAME", title:"回報狀態",type: "text",
                // { name: "STATUS_NAME", title:"回報狀態",type: "select",
                itemTemplate:function(value){
                    let status = value ? value : '確認為詐騙網站';
                    return status;
                } },
                { name: "WEBSITE_NM", title:"網站名稱", type: "text", width: 100 },
                { name: "WEBURL", title:"網址", type: "text", width: 200 },

            ],
            // 过滤
            // controller: {
            //     data: allURL.value,
            //     loadData: function (filter) {
            //         return this.data.filter(function (item) {
            // // 声明返回数组的长度
            // const flags = new Array(filterColumn.length)
            //             // 三个筛选条件（true,true,true）
            //             flags.fill(true)
            //             for (var i = 0; i < filterColumn.length; i++) {
            //                 const key = filterColumn[i]
            //                 // 过滤掉默认值" "
            //                 if (filter[key] !== " ") {
            //                     /*
            //                     (item[key].indexOf(filter[key]) > -1)表示只要包含某一部分字段，就为true
            //                     例如目标列为：911-5143 Luctus Ave
            //                     输入：911
            //                     也可以找到这一行
            //                      */
            //                     flags[i] = (item[key].indexOf(filter[key]) > -1)
            //                 }
            //             }
            //             // 返回的数组里面的元素必须都为true
            //             return flags.indexOf(false) === -1
            //         });
            //     },
            // }
        });
    };
</script>