<template>
    <div>
        <!-- navgation -->
        <frontNavbar />
        <Teleport to="body">
            <modal :show="showModal" @close="showModal = false, messageContent === ''">
            <template #header>
                <div v-html="modalContent"></div>
            </template>
            <template #body>
                <textarea class="modal_textarea_p06" v-model="messageContent"></textarea>
            </template>
            <template #footer>
                <button class="medium_button" @click="submitMessage">送出</button>
            </template>
            </modal>
        </Teleport>
        <main class="wrapper_p06_discuss_content">
            <ul class="breadcrumb-list text_title">
                <li><router-link to="/index">首頁</router-link></li>
                <li><router-link to="/discuss">討論專區</router-link></li>
                <li>文章內容</li>
            </ul>
            <section class="articleBlock_p06_discuss_content" v-for="discussObject in discussObject">
                <div class="topBlock_p06_discuss">
                    <div class="author">
                        <img src="../assets/img/p08_user/user.jpg" alt="cat"  class="pic_p06_discuss"/>
                        <span class="paragraph">{{ discussObject.NICKNAME }}</span>
                    </div>
                    <button class="ellipsisBtn" @click="ellipsisBtn"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <div class="ellipsisList" style="display: none;">
                        <ul>
                            <!-- <li id="show-modal" @click="showModal = true, modalContent = '<h4>檢舉</h4>'">檢舉</li> -->
                            <li @click="shareBtn()">分享</li>
                        </ul>
                        <div class="p06_shareButton">
                            <a href="#" class="p06_shareBtn" target="_blank" @click="openShareWindow(`https://www.facebook.com/sharer.php?u=${curentUrl}`);"><i class="fa-brands fa-square-facebook"></i></a>
                            <a href="#" class="p06_shareBtn" target="_blank" @click="openShareWindow(`https://social-plugins.line.me/lineit/share?url=${curentUrl}`);"><i class="fa-brands fa-line"></i></a>
                            <a href="#" class="p06_shareBtn" target="_blank" @click="openShareWindow(`https://www.twitter.com/share?url=${curentUrl}`);"><i class="fa-brands fa-square-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <h2>{{ discussObject.TITLE }}</h2>
                <div class="articleInformation_p06_discuss text_title">
                    <div>                    
                        <span class="tag">#{{ discussObject.CATEGORY }}</span>
                        <span>・</span>
                        <span>{{ formatDate(discussObject.CREATE_TIME) }}</span>
                    </div>
                    <div class="iconHover">
                        <!-- <button class="medium_button" @click="sweetAlertCollect()">收藏</button> -->
                        <a v-if="isFavorite == false " @click="addToFavorites()">
                            <i class="fa-solid fa-bookmark"></i>
                            收藏
                        </a>
                        <a v-if="isFavorite == true " @click="removeFavorites()" class="newsCollected">
                            <i class="fa-solid fa-bookmark"></i>
                            已收藏
                        </a>
                        <!-- <button class="medium_button">按讚</button> -->
                    </div>
                </div>
                <div class="articleContent_p06_discuss paragraph">
                    <p>{{ discussObject.CONTENT }}</p>
                </div>
            </section>
            <article class="articleMessage_p06_discuss">
                <div class="topBlock_p06_discuss">
                    <h3>共<span>{{ messages.length }}</span>則 留言</h3>
                    <button v-if="!token" class="medium_button" @click="MsgSweetAlertLogin()"><i class="fa-solid fa-pen fa-fw"></i>我要留言</button>
                    <button v-else id="show-modal" 
                    @click="showModal = true, modalContent = '<h4>我要留言</h4>' " 
                    class="medium_button"><i class="fa-solid fa-pen fa-fw"></i>我要留言</button>
                </div>
                <div class="messageList" v-for="(message, index1) in messages" :key="index1">
                    <div v-for="(item, index) in message" :key="index">
                        <div v-if="index === 0">
                            <div class="topBlock">                    
                                <img v-if="item.img !== ''" :src="item.img">
                                <img v-else src="@/assets/img/p08_user/user.jpg">
                                <span>{{item.user}}</span>
                                <!-- <ul class="action">
                                    <li class="iconHover">
                                        <i :style="{ color: computedColor }" @click="toggleColor"
                                        class="fa-solid fa-thumbs-up fa-fw"></i>
                                    </li>
                                </ul> -->
                            </div>
                            <div class="messageMain">
                                <p>{{ item.content }}</p>
                                <ul>
                                    <li>                                
                                        <i class="fa-solid fa-clock fa-fw"></i>
                                        <span>{{ formatDate(item.time) }}</span>
                                    </li>
                                    <li v-if="!token" @click="ReplySweetAlertLogin()" class="iconHover">
                                        <i class="fa-solid fa-reply fa-solid"></i>
                                        <span>回覆</span>
                                    </li>
                                    <li v-else
                                    id="show-modal" @click="showModal = true, modalContent = '<h4>回覆</h4>', thisIndex = index1" class="iconHover">
                                        <i class="fa-solid fa-reply fa-solid"></i>
                                        <span>回覆</span>
                                    </li>
                                </ul>
                                <div class="switch">                            
                                    <div class="solidLine"></div>
                                    <span class="iconHover" @click="hideMessage(index1)">{{ message[0].replyMessage }}</span>
                                </div>
                            </div>
                        </div>
                        <div v-else-if="message.reply" class="reply">
                            <ul class="messageItems" v-show="message[0].show"> 
                                <li>
                                    <div class="topBlock">
                                        <img v-if="item.img !== ''" :src="item.img">
                                        <img v-else src="@/assets/img/p08_user/user.jpg">
                                        <span>{{ item.user }}</span>
                                        <!-- <ul class="action">
                                            <li class="iconHover">
                                                <i :style="{ color: computedColor }" @click="toggleColor"
                                                class="fa-solid fa-thumbs-up fa-fw"></i>
                                            </li>
                                        </ul> -->
                                    </div>
                                    <div class="messageMain">
                                        <p>{{ item.content }}</p>
                                        <div>
                                            <i class="fa-solid fa-clock fa-fw"></i>
                                            <span>{{ formatDate(item.time) }}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </article>
            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                    <a class="page-link pagination-dark" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link  pagination-dark" href="#">1</a></li>
                    <li class="page-item"><a class="page-link  pagination-dark" href="#">2</a></li>
                    <li class="page-item"><a class="page-link  pagination-dark" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link pagination-dark" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
            </nav> -->
        </main>
        <Modal v-show="isModalVisible" @close="closeModal" />
        <!-- footer -->
        <frontFooter />
    </div>
</template>

<script setup>
    import { ref, onMounted, reactive, computed, nextTick } from 'vue';
    import frontNavbar from "@/components/f_nav.vue";
    import frontFooter from "@/components/f_footer.vue";
    import Modal from '@/components/modal.vue';
    import axios from 'axios';
    import { API_URL } from "@/config";
    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import { useRoute } from 'vue-router';
    import { formatDate } from '@/formatDate.js';
    const discuss = ref([]);
    const discussId = ref();
    const current_url = ref(null);
    const isFavorite = ref(false);
    const ellipsisList = ref();
    const p06_shareButton = ref();
    const modalContent = ref('');
    const showModal = ref(false);
    const token = localStorage.getItem("token");
    const route = useRoute();
    const discussObject = ref([]);
    const messageObject = ref([]);
    const replyObject = ref([]);
    const messageContent = ref();
    const findPic = ref();
    const thisIndex = ref();
    const curentUrl = ref();
    const findU_PIC = ref();
    const messages = ref([
        // [
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', replyMessage: '查看更多回覆', showReport: false, show:false},
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false},
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false},
        //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false}
        // ],
        // [
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Tom Lee', content:'上班時間是1900-0200就該知道了吧', time:'2018年5月1日', replyMessage: '查看更多回覆', showReport: false, show:false},
        //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false}
        // ],
        // [
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Tom Lee', content:'上班時間是1900-0200就該知道了吧', time:'2018年5月1日', replyMessage: '查看更多回覆', showReport: false, show:false},
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false},
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false},
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false},
            //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false}
            // ],
            // [
                //     {img:'@/assets/img/p08_user/user.jpg', user:'Tom Lee', content:'上班時間是1900-0200就該知道了吧', time:'2018年5月1日', replyMessage: '查看更多回覆', showReport: false, show:false},
                //     {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日', reply: false, showReport: false}
                // ],
                // [
        //     {img:'@/assets/img/p08_user/user.jpg', user:'Tom Lee', content:'上班時間是1900-0200就該知道了吧', time:'2018年5月1日', replyMessage: '查看更多回覆', showReport: false, show:false}
        // ]
    ])

    curentUrl.value = window.location.href;
    
    // 按讚按鈕變顏色=============
    const state = reactive({
      isToggled: false,
      color: '#007aff',
      highlightColor: '#d3d3d3'
    });
    const buttonLabel = ref('Toggle Color');
    const computedColor = computed(() => state.isToggled ? state.highlightColor : state.color);
    const toggleColor = () => {
      state.isToggled = !state.isToggled;
      buttonLabel.value = state.isToggled ? 'Reset Color' : 'Toggle Color';
    };
    // 按讚按鈕變顏色結束========================

    const getDiscussContent = () => {
        axios
        .post(`${API_URL}get_discussContent.php`, {
            id: route.params.article
        })
        .then((res)=>{
            discussObject.value = res.data;
        })
        .catch((err)=>{
            console.log(err.response);
        })
    }

    const getMessage = () => {
        axios
        .post(`${API_URL}get_message.php`, {
            discussId: route.params.article
        })
        .then((res)=>{
            const messageNewData = res.data.map(item => {
                try {
                findU_PIC.value = require(`@/assets/img/p08_user/${item.img}`);
                } catch (err) {
                findU_PIC.value = `https://tibamef2e.com/tgd104/g2/img/${item.img}`;
                }
                if(item.img === null){
                    findU_PIC.value = ''
                }
                return{
                    id: item.ID,
                    img: findU_PIC.value,
                    user: item.user,
                    content: item.content,
                    time: item.CREATE_TIME
                }
            })
            messageObject.value = messageNewData;
            
            const arrayA = replyObject.value;
            const arrayB = messageObject.value;
            const arrayC = [];

            arrayB.forEach(a => {
                const tempArr = [a];
                const filteredB = arrayA.filter(b => b.messageId === a.id);
                filteredB.forEach(b => tempArr.push(b));
                arrayC.push(tempArr);
            });
            
            const newArray = arrayC.map((item)=>{
                return item.map((innerItem) => {
                    return {...innerItem, replyMessage: '查看更多回覆', showReport: false, show: false};
                });
            });

            const newArr = newArray.map(subArr => {
                return subArr.map(obj => {
                    return Object.entries(obj).reduce((acc, [key, value]) => {
                        acc[key] = value === '' ? '' : isNaN(value) ? value : Number(value);
                        return acc;
                    }, {});
                });
            });

            messages.value = newArr;

        })
        .catch((err)=>{
            // console.log(err.response)
            // console.log('no');
        })
    }

    const getReply = () => {
        axios
        .post(`${API_URL}get_reply.php`)
        .then((res)=>{
            const replyNewData = res.data.map(item => {
                try {
                findU_PIC.value = require(`@/assets/img/p08_user/${item.img}`);
                } catch (err) {
                findU_PIC.value = `https://tibamef2e.com/tgd104/g2/img/${item.img}`;
                }
                if(item.img === null){
                    findU_PIC.value = ''
                }
                return{
                    messageId: item.MESSAGE_ID,
                    img: findU_PIC.value,
                    user: item.user,
                    content: item.content,
                    time: item.CREATE_TIME
                }
            })
            replyObject.value = replyNewData;
        })
        .catch((err)=>{
            // console.log(err.response);
            // console.log('no');
        })
    }

    const submitMessage = () => {
        if(modalContent.value === '<h4>我要留言</h4>'){
            axios
            .post(`${API_URL}add_message.php`, {
                discussId: route.params.article,
                userId: localStorage.getItem('token'),
                content: messageContent.value
            })
            .then((res)=>{
                // alert('成功留言')
                sweetAlertSendMessage()
                messageContent.value = '';
                showModal.value = false;
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            })
            .catch((err)=>{
                // console.log(err.response);
            })
        }else{
            // console.log(typeof( messageObject.value[thisIndex.value].id))
            axios
            .post(`${API_URL}add_reply.php`, {
                messageId: messageObject.value[thisIndex.value].id,
                userId: localStorage.getItem('token'),
                content: messageContent.value
            })
            .then((res)=>{
                // alert('成功回覆')
                sweetAlertSendReply()
                messageContent.value = '';
                showModal.value = false;
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            })
            .catch((err)=>{
                // console.log(err.response.data);
            })
            
        }
    }

    const submitReply = () => {
        axios
        .post(`${API_URL}add_reply.php`, {
            discussId: route.params.article,
            userId: localStorage.getItem('token'),
            content: messageContent.value
        })
        .then((res)=>{
            alert('成功留言:')
            messageContent.value = '';
            showModal.value = false;
            // window.location.reload();
        })
        .catch((err)=>{
            // console.log(err.response.data);
        })
    }

    function checkDiscussFavorite (){
        const token = localStorage.getItem('token')
        if (token) {
        // 如果使用者已登入，呼叫 API 檢查是否已收藏
        axios
          .post(`${API_URL}discussCheckFavorite.php`, {
            discuss_id: discuss.value.ID,
            token: token,
          })
          .then((response) => {
            if (response.data.success && response.data.is_favorite) {
              isFavorite.value = true;
            } else {
              isFavorite.value = false;
            }
          })
          .catch((error) => {
            console.error(error);
          });
      }
    }

    function addToFavorites(){
        const discussId = discuss.value.ID
        const token = localStorage.getItem('token')
        if (!token) {
            // showModal()
            AddSweetAlertLogin()
            return
        }

        axios.post(`${API_URL}discussAddFavorite.php`, {
            discuss_id: discussId,
            token: token,
        })
        .then((response) => {
        isFavorite.value = true
        })
        .catch((error) => {
        console.error(error)
        alert('收藏失敗，請稍後再試！')
        isFavorite.value = false
        })
    }

    function removeFavorites(){
        // 取得目前 ID
        const discussId = discuss.value.ID;
        // 取得使用者的 token
        const token = localStorage.getItem("token");
        if (!token) {
        // 如果沒有 token，表示使用者尚未登入，顯示登入彈窗
        alert("請先登入才能取消收藏！");
        return;
        }

        // 呼叫 API 刪除收藏資料
        axios
        .post(`${API_URL}discussRemoveFavorite.php`, {
            discuss_id: discussId,
            token: token,
        })
        .then((response) => {
            // 取消收藏成功，提示訊息
            // alert("已取消收藏！");
            isFavorite.value = false;
        })
        .catch((error) => {
            // 取消收藏失敗，顯示錯誤訊息
            console.error(error);
            alert("取消收藏失敗，請稍後再試！");
            isFavorite.value = true;
        });
    }

    function openShareWindow(index){
        window.open(index, 'share', "height: 600, width: 800")
    }
        
    // sweetAlert =================================================
    const AddSweetAlertLogin = ()=>{
    Swal.fire({
        title: '非會員',
        text: '請先登入會員才能收藏哦',
        icon: 'error',
        position: 'center',
        confirmButtonText: '確認',
    })
    };
    const MsgSweetAlertLogin = ()=>{
    Swal.fire({
        title: '非會員',
        text: '請先登入會員才能留言哦',
        icon: 'error',
        position: 'center',
        confirmButtonText: '確認',
    })
    };
    const ReplySweetAlertLogin = ()=>{
    Swal.fire({
        title: '非會員',
        text: '請先登入會員才能回覆哦',
        icon: 'error',
        position: 'center',
        confirmButtonText: '確認',
    })
    };
    const sweetAlertSendReply = ()=>{
        Swal.fire({
            title: '成功回覆',
            // text: '請先登入會員才能蒐藏哦',
            icon: 'success',
            position: 'center',
            showConfirmButton: false,
            timer: 1500
        })
    };
    const sweetAlertSendMessage = ()=>{
        Swal.fire({
            title: '成功留言',
            icon: 'success',
            position: 'center',
            showConfirmButton: false,
            timer: 1500
        })
    };
    function ellipsisBtn(){
        nextTick(()=>{
            ellipsisList.value = document.querySelector('.ellipsisList');
            p06_shareButton.value = document.querySelector('.p06_shareButton');
            if(ellipsisList.value.style.display === 'none'){
                ellipsisList.value.style.display = 'block'
            }else{
                ellipsisList.value.style.display = 'none'
            }
        })
    }

    function shareBtn(){
        if(p06_shareButton.value.classList.contains('hover')){
            p06_shareButton.value.classList.remove('hover')
        }else{
            p06_shareButton.value.classList.add('hover')
        }
    }

    function hideMessage(index){
        messages.value[index][0].show = !messages.value[index][0].show
        if(messages.value[index][0].replyMessage === ('查看更多回覆') && messages.value[index].length > 1){
            messages.value[index][0].replyMessage = ('隱藏回復');
            messages.value[index].reply = true;
        }else if(messages.value[index][0].replyMessage === ('查看更多回覆') && messages.value[index].length === 1){
            messages.value[index][0].replyMessage = ('目前沒有回覆');
        }else{
            messages.value[index][0].replyMessage = ('查看更多回覆');
            messages.value[index].reply = false;
        }
    }

    function showReport(index1, index){
        messages.value[index1][index].showReport = !messages.value[index1][index].showReport;
    }

    onMounted(()=>{

        current_url.value = window.location;

        const route = useRoute();
        const id = route.params.article;
        axios.get(`${API_URL}getDiscuss.php`)
        .then((response) => {
            const data = response.data;
            for (let i = 0; i < data.length; i++) {
                if (data[i].ID == id) {
                    discuss.value = data[i];
                    break;
                }
            };
            checkDiscussFavorite()
        })
        .catch((error) => {
            console.error(error)
        })


        getDiscussContent();
        getReply();
        getMessage();
    })
    
</script>