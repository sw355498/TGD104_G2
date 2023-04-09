<template>
    <div>
        <!-- navgation -->
        <frontNavbar />
        <Teleport to="body">
            <modal :show="showModal" @close="showModal = false">
            <template #header>
                <div v-html="modalContent"></div>
            </template>
            <template #body>
                <textarea rows="" cols=""></textarea>
            </template>
            </modal>
        </Teleport>
        <main class="wrapper_p06_discuss_content">
            <ul class="breadcrumb-list text_title">
                <li><router-link to="/index">首頁</router-link></li>
                <li><router-link to="/discuss">討論專區</router-link></li>
                <li>文章內容</li>
            </ul>
            <section class="articleBlock_p06_discuss_content">
                <div class="topBlock_p06_discuss">
                    <div class="author">
                        <img src="../assets/img/p08_user/user.jpg" alt="cat"  class="pic_p06_discuss"/>
                        <span class="paragraph">Doflamingo</span>
                    </div>
                    <button class="ellipsisBtn" @click="ellipsisBtn"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                </div>
                <h2>小心酒店新的徵人模式</h2>
                <div class="articleInformation_p06_discuss text_title">
                    <div>                    
                        <span class="tag">#交友詐騙</span>
                        <span>・</span>
                        <span>三個小時以前</span>
                    </div>
                    <div>
                        <button class="medium_button">收藏</button>
                        <button class="medium_button">按讚</button>
                    </div>
                </div>
                <div class="articleContent_p06_discuss paragraph">
                    <p>更新</p>
                    <p>希望不要上FB 沒想到會引起那麼多人注意...</p>
                    <p>先跟大家說抱歉最後語氣太輕浮了 畢竟如果被帶去真的很危險</p>
                    <p>然後我大概3年沒喝過星巴克了 因為快200喝一杯飲料實在喝不起 所以才覺得賺到了</p> 
                    <p>本身個性粗心又急需要工作才去問問看 沒想到居然上熱門</p>
                    <p>然後我會說騙是因為跟原本職缺上的餐廳完全不一樣= =</p>
                    <p>因為那家餐酒館雖然營業到很晚 但就是正常餐廳 所以會讓人以為是去正常餐酒館打工</p>
                    <p>後來他還傳訊息給我 不過查了後發現誹謗只要是真實還有為了公共利益就不成立</p>  
                    <p>以防萬一還是碼一下資料 如果真的不行再刪文</p>
                    <p>謝謝大家這麼擔心我 然後我會腳踏實地找工作的 </p>
                    <p>--------------------------------------------------------</p>
                    <p>正文</p>
                    <p>其實是因為我最近找打工很貪小便宜 想說時薪那麼高就先問問看</p>
                    <p>它顯示的店和地址也是正常的店家 想說時薪高可能是因為夜班的關係吧？ 就加line去面試了</p>
                    <p>但一直覺得很奇怪 南京三民和那家店明明距離超遠 但我還是傻傻的去了</p>  
                    <p>而且餐廳會試上班也不太可能... 只能說我真的很蠢</p>
                    <p>到了捷運站後有個身上刺青的男生來 開始覺得不妙了</p> 
                    <p>他請我到星巴克面談 然後一開頭就直接說如果有時薪700多</p> 
                    <p>內容是聊天偶爾喝一下酒的工作會想做嗎 馬上知道就是酒店小姐呀</p>
                    <p>所以在一小時內用各種方法推辭 最後終於可以離開了</p> 
                    <p>真的嚇死我 不然今天要被帶去酒店做到2點欸</p>  
                </div>
            </section>
            <article class="articleMessage_p06_discuss">
                <div class="topBlock_p06_discuss">
                    <h3>共<span>2</span>則 留言</h3>
                    <button id="show-modal" @click="showModal = true, modalContent = '<h3>我要留言</h3>' " class="medium_button"><i class="fa-solid fa-pen fa-fw"></i>我要留言</button>
                </div>
                <div class="messageList" v-for="(message, index) in messages" :key="index">
                    <div v-for="(item, index) in message" :key="index">
                        <div v-if="index === 0">
                            <div class="topBlock">                    
                                <img src="@/assets/img/p08_user/user.jpg" alt="">
                                <span>{{item.user}}</span>
                                <ul class="action">
                                    <li class="iconHover">
                                        <i class="fa-solid fa-thumbs-up fa-fw iconHover"></i>
                                    </li>
                                    <li class="iconHover">
                                        <i class="fa-solid fa-ellipsis-vertical fa-fw iconHover"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="messageMain">
                                <p>{{item.content}}</p>
                                <ul>
                                    <li>                                
                                        <i class="fa-solid fa-clock fa-fw"></i>
                                        <span>{{item.time}}</span>
                                    </li>
                                    <li id="show-modal" @click="showModal = true, modalContent = '<h3>回覆</h3>'" class="iconHover">
                                        <i class="fa-solid fa-reply fa-solid"></i>
                                        <span>回覆</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div v-else class="reply">
                            <div class="switch">                            
                                <div class="solidLine"></div>
                                <span>隱藏回覆</span>
                            </div>
                            <ul class="messageItems" > 
                                <li>
                                    <div class="topBlock">
                                        <img src="@/assets/img/p08_user/user.jpg" alt="">
                                        <span>{{item.user}}</span>
                                        <ul class="action">
                                            <li class="iconHover">
                                                <i class="fa-solid fa-thumbs-up fa-fw"></i>
                                            </li>
                                            <li class="iconHover">
                                                <i class="fa-solid fa-ellipsis-vertical fa-fw"></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="messageMain">
                                        <p>{{item.content}}</p>
                                        <div>
                                            <i class="fa-solid fa-clock fa-fw"></i>
                                            <span>{{item.time}}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </article>
            <nav aria-label="Page navigation example">
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
            </nav>
        </main>
                
        <!-- footer -->
        <frontFooter />
    </div>
</template>

<script>
    import { ref } from 'vue';
    import frontNavbar from "@/components/f_nav.vue";
    import frontFooter from "@/components/f_footer.vue";
    import Modal from '@/components/modal.vue'
    export default {
        components: {
            frontNavbar,
            frontFooter,
            Modal,
        },
        setup(){
            const modalContent = ref('')
            const showModal = ref(false)
            const messages = ref([
                [
                    {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日'}
                ],
                [
                    {img:'@/assets/img/p08_user/user.jpg', user:'Tom Lee', content:'上班時間是1900-0200就該知道了吧', time:'2018年5月1日'},
                    {img:'@/assets/img/p08_user/user.jpg', user:'Ruby Shi', content:'問身高體重我就覺得有問題了', time:'2018年5月1日'}
                ],
            ])
            return{
                messages,
                showModal,
                frontNavbar,
                frontFooter,
                Modal,
            }
        }
    }
</script>