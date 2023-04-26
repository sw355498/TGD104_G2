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
                <textarea class="modal_textarea_p06"></textarea>
            </template>
            <template #footer>
                <button class="medium_button">送出</button>
            </template>
            </modal>
        </Teleport>
        <main class="wrapper_p06_discuss">
            <ul class="breadcrumb-list text_title">
                <li><router-link to="/index">首頁</router-link></li>
                <li>討論專區</li>
            </ul>
            <div class="titleBlock">
                    <h2>所有文章</h2>
                    <button class="medium_button"><router-link to="/discuss_new_content">發表新文章</router-link></button>
            </div>
            <div class="tab_p01_newsChoose">
                <div class="tab_p01_news_category">
                <select class="form-select form-select-md">
                    <option @click="selectCategory()">所有文章</option>
                    <option @click="selectCategory(index)" v-for="(category, index) in categories" :key="category">{{ category.CATEGORY }}</option>
                </select>
                    <div class="wide_tab">
                        <a href="#" :class="{ currentTab: isActive }">所有文章</a>
                        　|　
                        <a href="#">網站詐騙</a>
                        　|　
                        <a href="#">交友詐騙</a>
                        　|　
                        <a href="#">金融詐騙</a>
                    </div>
                </div>

                <div class="position-relative input_p01_news_searchBar">
                <i
                    class="fa-sharp fa-solid fa-magnifying-glass fa-fw position-absolute top-50 end-0 translate-middle"
                ></i>
                <input type="text" v-model="search" placeholder="搜尋文章" />
                </div>
            </div>
            <section v-for="(item, index) in (articleList.slice(pageStart, pageEnd))" :key="index">
                    <div class="topBlock_p06_discuss">
                        <div class="author">
                            <img src="../assets/img/p08_user/user.jpg" alt="cat"  class="pic_p06_discuss"/>
                            <span class="paragraph">{{ item.NONNAME === 1 ? item.NICKNAME : '匿名'}}</span>
                        </div>
                        <button class="ellipsisBtn" @click="ellipsisBtn(index)"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        <div class="ellipsisList"  :style="{'display':showellipsisList === index ? 'block' : 'none'}">
                            <ul>
                                <li id="show-modal" @click="showModal = true, modalContent = '<h4>檢舉</h4>'">檢舉</li>
                                <li @click="shareBtn(index)">分享</li>
                            </ul>
                            <div class="p06_shareButton">
                                <a href="#" class="p06_shareBtn" target="_blank" @click="openShareWindow(item.facebookShareLink);"><i class="fa-brands fa-square-facebook"></i></a>
                                <a href="#" class="p06_shareBtn" target="_blank" @click="openShareWindow(item.lineShareLink);"><i class="fa-brands fa-line"></i></a>
                                <a href="#" class="p06_shareBtn" target="_blank" @click="openShareWindow(item.twitterShareLink);"><i class="fa-brands fa-square-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="articleBlock_p06_discuss">
                        <div class="articleText_p06_discuss">
                            <h3>{{item.TITLE}}</h3>
                            <div class="articleInformation_p06_discuss text_title">
                                <span class="tag">#{{item.CATEGORY}}</span>
                                <span>・</span>
                                <span>{{item.CREATE_TIME}}</span>
                            </div>
                            <div class="articleContent h6_component">
                                {{item.CONTENT}}
                            </div>
                            <ul class="articleInteractive text_title">
                                <li><i class="fa-solid fa-thumbs-up fa-fw iconHover"></i><span> {{item.thumbsNum}} </span></li>   
                                <li><i class="fa-solid fa-message fa-fw iconHover"></i><span> {{item.messageNum}} </span></li>
                                <li>
                                    <router-link :to="{ name: 'discuss_content', params: { article: item.ID } }">
                                        <button class="viewDetails medium_button">
                                            查看詳細
                                        </button>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <div class="articleImage_p06_discuss">
                            <img :src="item.PIC" v-if="item.PIC !== ''" alt="此作者沒有上傳圖片">
                            <span v-else>此作者沒有上傳圖片</span>
                        </div>
                    </div>
            </section>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item" v-show="currentPage != 1"><a class="page-link  pagination-dark" href="#" @click.prevent="setPage(currentPage - 1)">&laquo;</a></li>
                    <li class="page-item" :class="{ active: currentPage === n }" style="display: flex;" v-for="(n, index) in totalPage" :key="index" @click.prevent="setPage(n)"><a class="page-link  pagination-dark" href="#">{{ n }}</a></li>
                    <li class="page-item" v-show="currentPage < totalPage"><a class="page-link  pagination-dark" href="#" @click.prevent="setPage(currentPage + 1)">&raquo;</a></li>
                </ul>
            </nav>
        </main>

        <!-- footer -->
        <frontFooter />
    </div>
</template>

<script setup>
    import { ref, onMounted, computed, watch,nextTick } from 'vue';
    import frontNavbar from "@/components/f_nav.vue";
    import frontFooter from "@/components/f_footer.vue";
    import Modal from '@/components/modal.vue';
    import { API_URL } from '@/config'
    import axios, { all } from 'axios';
    
    const modalContent = ref('')
    const showModal = ref(false)
    const showellipsisList = ref(null)
    const articleList = ref([])
    const ellipsisList = ref([]);
    const p06_shareButton = ref([])
    const perpage = 10
    const currentPage = ref(1)
    const search = ref()
    const findPic = ref()
    const categories = ref([])



    function ellipsisBtn(index) {
        if(showellipsisList.value === index){
            showellipsisList.value = null
        }else{
            showellipsisList.value = index
        }
    }

    function shareBtn(index){
        if(p06_shareButton.value[index].classList.contains('hover')){
            p06_shareButton.value[index].classList.remove('hover')
        }else{
            p06_shareButton.value[index].classList.add('hover')
        }
    }

    function openShareWindow(link) {
        window.open(link, 'mywindow', 'width=700, height=400');
    }
    
    async function selectDiscuss(index){
        await axios
        .post(`${API_URL}get_discuss.php`, {
            datas: index
        })
        .then((response)=>{
            const newData = response.data.map(item => {
                let picPath = item.PIC;
                try {
                    findPic.value = require(`@/assets/img/p06_discuss/${picPath}`);
                } catch (err) {
                    picPath = '暫放之後刪.png';
                    findPic.value = ('')
                }
                return{
                    ID: item.ID,
                    CATEGORY: item.CATEGORY,
                    CONTENT: item.CONTENT,
                    CREATE_TIME: item.CREATE_TIME,
                    NICKNAME: item.NICKNAME,
                    NONNAME: item.NONNAME,
                    PIC: findPic.value,
                    TITLE: item.TITLE
                }
            })
            articleList.value = newData;
            nextTick(()=>{
                ellipsisList.value = document.querySelectorAll('.ellipsisList');
                p06_shareButton.value = document.querySelectorAll('.p06_shareButton')
            })
            return  articleList.value = newData;
        })
        .catch(error => console.log(error.response.data))
    }

    function selectCategory(index){
        axios
        .post(`${API_URL}get_discussCategory.php`)
        .then((res)=>{
            categories.value = res.data;
        })
        .catch((err)=>console.log(err.response.data))

    }

    watch(search, (newSearch => {
        selectDiscuss(newSearch);
    }))


    function setPage(page) {
        if (page <= 0 || page > totalPage.value) {
            return
        }
        currentPage.value = page
    }

    const totalPage = computed(() => {
        return Math.ceil(articleList.value.length / perpage)
    })

    const pageStart = computed(() => {
        return (currentPage.value - 1) * perpage
    })

    const pageEnd = computed(() => {
        return currentPage.value * perpage
    })
    
    onMounted(()=>{
        selectDiscuss();
        selectCategory();
    })
    
    
</script>
