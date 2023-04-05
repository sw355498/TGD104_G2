<template>
    <div class="d-flex">
        <LeftNav/>
        <div class="b_content">
            <h2 class="h1_component">會員管理</h2>
            <div class="d-flex justify-content-end align-items-center my-2">
                <button class="medium_button btn_bUser_addUser me-2">新增會員</button>
                <div class="position-relative">
                    <i class="fa-sharp fa-solid fa-magnifying-glass fa-fw position-absolute top-50 end-0"></i>
                    <input type="text">
                </div>
            </div>
            <div id="jsGrid"></div>
        </div>
    </div>
</template>
<script>
import $ from 'jquery'
import 'jsgrid'
import LeftNav from '../components/b_leftNav.vue';
export default {
    
    mounted() {
        let id = 0, user = 111
        var clients = [
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Google", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Line", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Google", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Line", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Line", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Line", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Google", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Line", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Google", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Line", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Line", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "會員註冊", "狀態": "正常", },
            { "ID": `${id++}`, "帳號": `user_${user}`, "暱稱": "Otto Clay", "建立日期": '2023-03-19', "E-mail": `user_${user++}@test.com`, "登入方式": "Line", "狀態": "正常", },
        ];
     
        $('#jsGrid').jsGrid({
            width: "100%",
     
            inserting: false, //添加
            editing: false, //編輯
            sorting: true, //排序
            /*分頁設定*/
            paging: true,
            pagerContainer: null,   //jQueryElement或DomNode指定呈現一個分頁欄，為null時在表格底部。
            pageIndex: 1,   //當前頁面數
            pageSize: 10,   //頁面的數據量
            pageButtonCount: 2,    //最大數量的頁面按鈕
            pagerFormat: "{first} {pages} {last} &nbsp;&nbsp; {pageIndex} of {pageCount}", //占位符來指定分頁欄格式
            //pageNextText: "Next",   //下一頁
            //pagePrevText: "Prev",   //上一頁
            pageFirstText: "首頁", //首頁
            pageLastText: "最後一頁",   //尾頁
            pageNavigatorNextText: "...",    //最大數量頁面按鈕超出時右邊顯示
            pageNavigatorPrevText: "...",       //最大數量頁面按鈕超出時右邊顯示
                        data: clients,
            fields: [
                { 
                    name: 'ID',
                    css: 'd-none',
                },
                { 
                    name: "帳號",
                    type: "text", 
                    // width: 80, 
                    validate: "required" 
                },
                {   
                    name: "暱稱", 
                    type: "text", 
                    width: 100,
                    css: "d-none"
                },
                {   
                    name: "建立日期", 
                    type: "text", 
                    width: 80
                },
                { 
                    name: "E-mail", 
                    type: "text", 
                },
                { 
                    name: "登入方式", 
                    type: "text",
                    width: 60,
                },
                { 
                    name: "狀態", 
                    type: "text",
                    width: 50,
                },
                {
                    name: "操作",
                    width: 150,
                    itemTemplate:function(){
                        let $buttonContainer = $("<div>")
                        // Jquery 等同於 js中的 let buttonContainer = document.createElement("<div>")
                        // let $blockade = $("<button>").html(`<i class="fa-solid fa-lock"></i>封鎖`).addClass("small_button mx-1").on("click", operate);
                        let $blockade = $("<button>").text(`封鎖`).addClass("small_button mx-1").on("click", operate);
                        $buttonContainer.append($blockade);
                        let $delete = $("<button>").text("刪除").addClass("small_button mx-1").on("click", operate);
                        $buttonContainer.append($delete);
                        let $revise = $("<button>").text("修改").addClass("small_button mx-1").on("click", operate);
                        $buttonContainer.append($revise);
                        
                        let $check = $("<button>").text("查看").addClass("small_button mx-1").on("click", operate);
                        $buttonContainer.append($check);
                        return $buttonContainer
                    },
                },
            ]
        });
        
        function operate(){
            let thisID = this.closest('tr').firstElementChild.innerHTML
            switch (this.innerHTML){
                case "封鎖":
                    alert(`封鎖帳號 ${thisID}`)
                    break
                case "刪除":
                    alert(`刪除帳號 ${thisID}`)
                    break
                case "修改":
                    alert(`修改帳號 ${thisID}`)
                    break
                case "查看":
                    alert(`查看帳號 ${thisID}`)
                    break
            }
        }
    },
    components: {
        LeftNav
    }
}
</script>

<style>
        .fa-sharp{
            transform: translate(-50%, -50%);
        }
</style>