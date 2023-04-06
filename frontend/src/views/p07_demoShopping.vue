<template>
    <main class="body_p07_demoShopping">
        <div class="main_p07_demoShopping">

            <!-- header -->
            <frontNavbar />

            <!-- demo nav -->
            <p07_demo_nav />
            
            <!-- popup -->
            <div v-if="showModal">
                <p07_demoShopping_popup :show="showModal" @close="showModal = false"/>
            </div>
            <!-- 瀏覽器 -->
            <div class="browser_p07_demoShopping">
                <!-- 電腦版瀏覽器 上面tool -->
                <div class="toolbar_demoShopping">
                    <!-- 手機板的 toolbar_top -->
                    <!-- 先註解掉 用下面的手機瀏覽器 -->
                    <!-- <div class="toolbar_mbtop_demoShopping">
                        <span>3:30</span>
                        <i class="fa-solid fa-signal"></i>
                        <i class="fa-solid fa-wifi"></i>
                        <i class="fa-solid fa-battery-three-quarters"></i>
                    </div> -->
                    <div class="toolbar_top_demoShopping">
                        <div class="circles_demoShopping"></div>
                        <div class="tab_demoShopping">
                            <i class="fa-solid fa-globe"></i>
                            <span>詐騙網站</span>
                        </div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="toolbar_down_demoShopping">
                        <i class="fa-solid fa-arrow-left"></i>
                        <i class="fa-solid fa-arrow-right"></i>
                        <i class="fa-solid fa-rotate-right"></i>
                        <div class="address_demoShopping">
                            <i class="fa-solid fa-lock"></i>
                            <span>http://shopee.rip/te9</span>
                            <!-- <i class="fa-solid fa-arrow-up-from-bracket"></i> -->
                        </div>
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                </div>
                <!-- 手機瀏覽器 -->
                <div class="phoneBrowswer_p07_demoShopping">
                    <div class="top_icons">
                        <span >3:30</span>
                        <i class="fa-solid fa-signal"></i>
                        <i class="fa-solid fa-wifi"></i>
                        <i class="fa-solid fa-battery-full"></i>
                    </div>
                    <div class="address_demoShopping">
                        <i class="fa-solid fa-lock"></i>
                        <span>http://shopee.rip/te9</span>
                    </div>
                </div>
                <!-- 除了toolbar的內容區 -->
                <div class="browser_container">
                    <!-- =============== component 下單購物車 =============== -->
                    <div class="cart_p07_demoShopping" v-if="showComponent">
                        <!-- 在元件上面加 :bind 就可以把資料傳進去 -->
                        <p07_demoShopping_cart :cart="cart" @close="showComponent = false"/>
                        <!-- <div class="mask" v-if="showComponent" @click="closeComponent"></div> -->
                    </div>
                    <!-- 假購物網站 -->
                    <article class="scamWeb_p07_demoShopping_container">

                        <!-- 購物網站 nav -->
                        <div class="scamWeb_p07_demoShopping_nav">
                            <p class="scamWeb_p07_demoShopping_navP">新品上市，勁爆特殺！全場大放送，單件低至NT$432。2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                            <ul class="scamWeb_p07_demoShopping_navbar">                       
                                <li><a href="#">商品列表</a></li>
                                <li><a href="#">訂單查詢</a></li>
                                <li><a href="#">下單須知</a></li>
                                <li><a href="#">立即下單</a></li>
                                <li>
                                    <span>
                                       <span class="cart_length"> {{cart.length}} </span>
                                       <img 
                                        src="../assets/img/p07_demo/p07_demoShopping/cart.png" alt="購物車" 
                                        @click="showComponent = true"
                                       >
                                    </span>
                                </li>
                                <li><img src="../assets/img/p07_demo/p07_demoShopping/info.png" alt="個人資訊"></li>
                            </ul>
                        </div>

                        <!-- 購物網站第一 banner -->
                        <div class="scamWeb_p07_demoShopping_banner1" id="tour5">
                            <p class="scamWeb_p07_demoShopping_banner1P">現實下殺</p>
                            <span class="scamWeb_p07_demoShopping_banner1Countdown">01:18:29</span>
                        </div>

                        <!-- 第一紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed">
                            <ul>
                                <li>NT$480</li>
                                <li>NT$1280</li>
                                <li>限量200件! 立即搶購！</li>
                            </ul>
                        </div>

                        <!-- 第一灰條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerGray" id="tour4">
                            <p>新品上市，勁爆特殺！全場大放送，單件低至NT$432，2020新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                        </div>

                        <!-- 第二紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed"  id="tour6">
                            <p class="scamWeb_p07_demoShopping_bannerRedP1">現在下單免運包郵</p>
                        </div>

                        <!-- 購物網站第二 banner -->
                        <img class="scamWeb_p07_demoShopping_banner2" src="../assets/img/p07_demo/p07_demoShopping/demoShoppingPic02.jpg">
                        
                        <!-- 第三紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed scrollBar">
                            <p class="scamWeb_p07_demoShopping_bannerRedP2">新品上市，勁爆特殺！全場大放送，單件低至 NT$432，2020 新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                        </div>

                        <!-- 貨運廣告 banner -->
                        <div class="scamWeb_p07_demoShopping_deliveryAdvertisement" id="tour7">
                            <img src="../assets/img/p07_demo/p07_demoShopping/onepage-02.jpg">
                            <img src="../assets/img/p07_demo/p07_demoShopping/onepage-01.jpg">
                        </div>

                        <!-- 衣服卡片區 -->
                        <!-- <div class="scamWeb_p07_demoShopping_clothCardContainer" id="clothCardContainer"> -->
                        <div class="scamWeb_p07_demoShopping_clothCardContainer" id="tour2">
                            <!-- v-for 商品列表 -->
                            <div 
                                v-for="(product, index) in products" :key="index"
                                class="scamWeb_p07_demoShopping_clothCard" 
                            >
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img :src="product.imageUrl" :alt="product.name" />
                                <a href="#">女裝>洋裝</a>
                                <p>{{ product.name }}</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1980</span>
                                    <span>${{ product.price }}</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button @click.prevent="addProductToCart(product)">加入購物車</button>
                            </div>
                            
                        </div>

                        <!-- 第四紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed scamWeb_p07_demoShopping_bannerRed4">
                            <p class="scamWeb_p07_demoShopping_bannerRedP2">新品上市，勁爆特殺！全場大放送，單件低至NT$432，廠家直銷，超值優惠，買到賺到！</p>
                        </div>

                        <!-- 四張信用卡 -->
                        <div class="scamWeb_p07_demoShopping_creditCard">
                            <img src="../assets/img/p07_demo/p07_demoShopping/credit_card-01.jpg">
                            <img src="../assets/img/p07_demo/p07_demoShopping/credit_card-02.jpg">
                            <img src="../assets/img/p07_demo/p07_demoShopping/credit_card-03.jpg">
                            <img src="../assets/img/p07_demo/p07_demoShopping/credit_card-04.jpg">
                        </div>

                        <!-- 第五紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed scamWeb_p07_demoShopping_bannerRed4 scamWeb_p07_demoShopping_bannerRed5">
                            <p class="scamWeb_p07_demoShopping_bannerRedP2">商品熱銷中 好評不斷</p>
                        </div>

                        <!-- 動態評論區 -->
                        <ul class="scamWeb_p07_demoShopping_discussion">
                            <!-- 以下會用 v-for 並使用向上輪播動畫 -->
                            <li>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</li>
                            <li>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</li>
                            <li>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</li>
                            <li>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</li>
                            <!-- 以上會用 v-for 並使用向上輪播動畫 -->
                        </ul>

                        <!-- 第六紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed scamWeb_p07_demoShopping_bannerRed4 scamWeb_p07_demoShopping_bannerRed6">
                            <p class="scamWeb_p07_demoShopping_bannerRedP2">立刻下單 免運包郵</p>
                        </div>

                        <!-- 購物網站 footer -->
                        <div class="scamWeb_p07_demoShopping_footer" id="tour3">
                            <p>正品保證</p>
                            <p>如果您未收到商品全額退款！</p>
                            <p>如果您購買的商品與描述不符，全額或部分退款！</p>
                            <div class="scamWeb_p07_demoShopping_footerCard">
                                <img src="../assets/img/p07_demo/p07_demoShopping/footer_card-01.jpg">
                                <img src="../assets/img/p07_demo/p07_demoShopping/footer_card-02.jpg">
                                <img src="../assets/img/p07_demo/p07_demoShopping/footer_card-03.jpg">
                                <img src="../assets/img/p07_demo/p07_demoShopping/footer_card-04.jpg">
                            </div>
                            <div class="scamWeb_p07_demoShopping_footerInfo">
                                <div class="scamWeb_p07_demoShopping_footerNav">
                                    <ul>
                                        <li>商品頁面</li>
                                        <li>物流條款</li>
                                        <li>服務條款</li>
                                        <li>隱私協議</li>
                                    </ul>
                                    <p>郵箱：qaxzzzavitzfqbevelln@hotmail.com</p>
                                    <p>Copyright © 2016-2023 All Rights Reserved</p>
                                </div>
                                <div class="scamWeb_p07_demoShopping_footerSocialMedia">
                                    <img src="../assets/img/p07_demo/p07_demoShopping/fb.jpg">
                                    <img src="../assets/img/p07_demo/p07_demoShopping/line.png">
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- 手機板瀏覽器下面 -->
                <div class="phonetoolbar_down_demoShopping">
                    <div class="icons">
                        <i class="fa-solid fa-chevron-left"></i>
                        <i class="fa-solid fa-chevron-right"></i>
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <i class="fa-solid fa-book-open"></i>
                        <i class="fa-regular fa-square"></i>
                    </div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <frontFooter />
    </main>
</template>


<script>
import { ref } from 'vue';
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import p07_demo_nav from "@/components/p07_demo_nav.vue";
import p07_demoShopping_cart from "@/components/p07_demoShopping_cart.vue";
import p07_demoShopping_popup from "@/components/p07demoShopping_popup.vue";

export default {
    name: 'shoppingCart',
    components: {
        frontNavbar,
        frontFooter,
        p07_demo_nav,
        p07_demoShopping_cart,
        p07_demoShopping_popup
    },
    setup(){
        const cart = ref([])
        const product = ref({ name: '', price: 0 , number: 1 });
        const products = ref([
        {
            name: '自制春夏修身高腰洋裝',
            price: 499,
            // 抓不到圖片路徑 要先用 require 包起來
            imageUrl: require('@/assets/img/p07_demo/p07_demoShopping/demoShoppingPic03.jpg'),
            number: 1
        },
        {
            name: '仿亞麻復古圓領設計感洋裝',
            price: 399,
            imageUrl: require('@/assets/img/p07_demo/p07_demoShopping/demoShoppingPic04.jpg'),
            number: 1
        },
        {
            name: '高端修身收腰顯瘦圖騰氣質洋裝',
            price: 299,
            imageUrl: require('@/assets/img/p07_demo/p07_demoShopping/demoShoppingPic05.jpg'),
            number: 1
        },
        {
            name: '2023新款長袖復古中長版裙',
            price: 499,
            imageUrl: require('@/assets/img/p07_demo/p07_demoShopping/demoShoppingPic06.jpg'),
            number: 1
        },
        {
            name: '氣質白色連衣裙小個子',
            price: 399,
            imageUrl: require('@/assets/img/p07_demo/p07_demoShopping/demoShoppingPic07.jpg'),
            number: 1
        },
        {
            name: '修身收腰白色小晚禮服',
            price: 199,
            imageUrl: require('@/assets/img/p07_demo/p07_demoShopping/demoShoppingPic08.jpg'),
            number: 1
        },
        {
            name: '女神裙 設計氣質顯瘦連衣裙',
            price: 499,
            imageUrl: require('@/assets/img/p07_demo/p07_demoShopping/demoShoppingPic09.jpg'),
            number: 1
        },
        {
            name: '早春新款V領長袖法式設計洋裝',
            price: 299,
            imageUrl: require('@/assets/img/p07_demo/p07_demoShopping/demoShoppingPic10.jpg'),
            number: 1
        },
        ]);
        const addProductToCart = (product) => {
            const index = cart.value.findIndex(item => item.name === product.name);
            if (index >= 0) { // 如果購物車中已經有此商品，數量加 1
                cart.value[index].number++;
            } else { // 如果購物車中沒有此商品，新增至購物車中
                cart.value.push({ ...product, number: 1 });
            }
        };

        // 點擊才出現 =================================================
        const showComponent = ref(false);
        const showModal = ref(true);
        return {
            cart,
            product,
            products,
            addProductToCart,
            showComponent,
            showModal,
        }
    },
}
</script>
