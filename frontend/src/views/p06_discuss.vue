<template>
    <div>
        <!-- navgation -->
        <frontNavbar />
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
                <select name="" id="" class="form-select form-select-md">
                    <option selected>所有文章</option>
                    <option value="">網站詐騙</option>
                    <option value="">交友詐騙</option>
                    <option value="">金融詐騙</option>
                </select>
                    <div class="wide_tab">
                        <a href="#" :class="{ currentTab: isActive }">所有文章</a>　|　<a
                        href="#"
                        >網站詐騙</a
                        >　|　<a href="#">交友詐騙</a>　|　<a href="#">金融詐騙</a>
                    </div>
                </div>

                <div class="position-relative input_p01_news_searchBar">
                <i
                    class="fa-sharp fa-solid fa-magnifying-glass fa-fw position-absolute top-50 end-0 translate-middle"
                ></i>
                <input type="text" placeholder="搜尋文章" />
                </div>
            </div>
            <section v-for="(item, index) in articleList" :kye="item.id">
                    <div class="topBlock_p06_discuss">
                        <div class="author">
                            <img src="../assets/img/p08_user/user.jpg" alt="cat"  class="pic_p06_discuss"/>
                            <span class="paragraph">{{item.author}}</span>
                        </div>
                        <button class="ellipsisBtn" @click="ellipsisBtn(index)"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    </div>
                    <div class="articleBlock_p06_discuss">
                        <div class="articleText_p06_discuss">
                            <h3>{{item.title}}</h3>
                            <div class="articleInformation_p06_discuss text_title">
                                <span class="tag">#{{item.tag}}</span>
                                <span>・</span>
                                <span>{{item.time}}</span>
                            </div>
                            <div class="articleContent h6_component">
                                {{item.content}}
                            </div>
                            <ul class="articleInteractive text_title">
                                <li><i class="fa-solid fa-thumbs-up fa-fw"></i><span> {{item.thumbsNum}} </span></li>   
                                <li><i class="fa-solid fa-message fa-fw"></i><span> {{item.messageNum}} </span></li>
                                <li>
                                    <router-link to="/discuss/discuss_content">
                                        <button class="viewDetails medium_button">
                                            查看詳細
                                        </button>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <div class="articleImage_p06_discuss">
                            <img src="https://picsum.photos/200/300" alt="">
                        </div>
                    </div>
            </section>
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

    export default {
        components: {
            frontNavbar,
            frontFooter,
        },
        setup(){
            function ellipsisBtn(index) {
                console.log(index)
            }
            let id = 0
            const articleList = ref([
                {id: id++, author:'Doflamingo', title: '玩tinder 被裸聊詐騙', tag: '交友詐騙', time: '三個小時以前', content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum adipisci beatae est temporibus ad! Dicta velit aliquid fuga vero praesentium unde, magni sit veniam aliquam iure quo alias eius culpa?', thumbsNum: 100, messageNum: 250},
                {id: id++, author:'Doflamingo', title: '玩tinder 被裸聊詐騙', tag: '交友詐騙', time: '三個小時以前', content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum adipisci beatae est temporibus ad! Dicta velit aliquid fuga vero praesentium unde, magni sit veniam aliquam iure quo alias eius culpa?', thumbsNum: 100, messageNum: 250},
                {id: id++, author:'Doflamingo', title: '玩tinder 被裸聊詐騙', tag: '交友詐騙', time: '三個小時以前', content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum adipisci beatae est temporibus ad! Dicta velit aliquid fuga vero praesentium unde, magni sit veniam aliquam iure quo alias eius culpa?', thumbsNum: 100, messageNum: 250},
                {id: id++, author:'Doflamingo', title: '玩tinder 被裸聊詐騙', tag: '交友詐騙', time: '三個小時以前', content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum adipisci beatae est temporibus ad! Dicta velit aliquid fuga vero praesentium unde, magni sit veniam aliquam iure quo alias eius culpa?', thumbsNum: 100, messageNum: 250},
                {id: id++, author:'Doflamingo', title: '玩tinder 被裸聊詐騙', tag: '交友詐騙', time: '三個小時以前', content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum adipisci beatae est temporibus ad! Dicta velit aliquid fuga vero praesentium unde, magni sit veniam aliquam iure quo alias eius culpa?', thumbsNum: 100, messageNum: 250},
            ])



            return{
                isActive: true,
                articleList,
                frontNavbar,
                frontFooter,
                ellipsisBtn,
            }
        }
    }
</script>