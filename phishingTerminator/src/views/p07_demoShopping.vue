<template>
    <body class="body_p07_demoShopping">
        <div class="main_p07_demoShopping">
            <!-- demo nav -->
            <p07_demo_nav />
            <!-- 瀏覽器 -->
            <div class="browser_p07_demoShopping">
                <!-- 上面tool -->
                <div class="toolbar_demoShopping">
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
                        </div>
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                </div>
                <!-- 除了toolbar的內容區 -->
                <div class="browser_container">
                    <!-- 下單購物車 -->
                    <div class="cart_p07_demoShopping" v-if="showComponent">
                        <p07_demoShopping_cart/>
                        <div class="mask" v-if="showComponent" @click="closeComponent"></div>
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
                                <li><a href="#"><img src="../assets/img/p07_demo/p07_demoShopping/cart.png" alt="購物車" @click="showComponent = true; listenClickEvent"></a></li>
                                <li><a href="#"><img src="../assets/img/p07_demo/p07_demoShopping/info.png" alt="個人資訊"></a></li>
                            </ul>
                        </div>

                        <!-- 購物網站第一 banner -->
                        <div class="scamWeb_p07_demoShopping_banner1">
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
                        <div class="scamWeb_p07_demoShopping_bannerGray">
                            <p>新品上市，勁爆特殺！全場大放送，單件低至NT$432，2020新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                        </div>

                        <!-- 第二紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed">
                            <p class="scamWeb_p07_demoShopping_bannerRedP1">現在下單免運包郵</p>
                        </div>

                        <!-- 購物網站第二 banner -->
                        <img class="scamWeb_p07_demoShopping_banner2" src="../assets/img/p07_demo/p07_demoShopping/pic02.jpg">
                        
                        <!-- 第三紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed">
                            <p class="scamWeb_p07_demoShopping_bannerRedP2">新品上市，勁爆特殺！全場大放送，單件低至NT$432，2020新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                        </div>

                        <!-- 貨運廣告 banner -->
                        <div class="scamWeb_p07_demoShopping_deliveryAdvertisement">
                            <img src="../assets/img/p07_demo/p07_demoShopping/onepage-02.jpg">
                            <img src="../assets/img/p07_demo/p07_demoShopping/onepage-01.jpg">
                        </div>

                        <!-- 衣服卡片區第一排 -->
                        <div class="scamWeb_p07_demoShopping_clothCardContainer">
                            <div class="scamWeb_p07_demoShopping_clothCard">
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg">
                                <a href="#">女裝>洋裝</a>
                                <p class="scamWeb_p07_demoShopping_clothCardP">高端修身收腰顯瘦圖騰氣質洋裝</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1900.00</span>
                                    <span>$499</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button>加入購物車</button>
                            </div>

                            <!-- 以下將會改為 v-for -->
                            <div class="scamWeb_p07_demoShopping_clothCard">
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg">
                                <a href="#">女裝>洋裝</a>
                                <p>高端修身收腰顯瘦圖騰氣質洋裝</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1900.00</span>
                                    <span>$499</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button>加入購物車</button>
                            </div>
                            <div class="scamWeb_p07_demoShopping_clothCard">
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg">
                                <a href="#">女裝>洋裝</a>
                                <p>高端修身收腰顯瘦圖騰氣質洋裝</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1900.00</span>
                                    <span>$499</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button>加入購物車</button>
                            </div>
                            <div class="scamWeb_p07_demoShopping_clothCard">
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg">
                                <a href="#">女裝>洋裝</a>
                                <p>高端修身收腰顯瘦圖騰氣質洋裝</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1900.00</span>
                                    <span>$499</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button>加入購物車</button>
                            </div>
                            <!-- 以上將會改為 v-for -->
                        </div>
                        <!-- 衣服卡片區第二排 -->
                        <div class="scamWeb_p07_demoShopping_clothCardContainer">
                            <div class="scamWeb_p07_demoShopping_clothCard">
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg">
                                <a href="#">女裝>洋裝</a>
                                <p class="scamWeb_p07_demoShopping_clothCardP">高端修身收腰顯瘦圖騰氣質洋裝</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1900.00</span>
                                    <span>$499</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button>加入購物車</button>
                            </div>

                            <!-- 以下將會改為 v-for -->
                            <div class="scamWeb_p07_demoShopping_clothCard">
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg">
                                <a href="#">女裝>洋裝</a>
                                <p>高端修身收腰顯瘦圖騰氣質洋裝</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1900.00</span>
                                    <span>$499</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button>加入購物車</button>
                            </div>
                            <div class="scamWeb_p07_demoShopping_clothCard">
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg">
                                <a href="#">女裝>洋裝</a>
                                <p>高端修身收腰顯瘦圖騰氣質洋裝</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1900.00</span>
                                    <span>$499</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button>加入購物車</button>
                            </div>
                            <div class="scamWeb_p07_demoShopping_clothCard">
                                <span class="scamWeb_p07_demoShopping_clothCardSpecial">限時特價</span>
                                <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg">
                                <a href="#">女裝>洋裝</a>
                                <p>高端修身收腰顯瘦圖騰氣質洋裝</p>
                                <div class="scamWeb_p07_demoShopping_clothCardPrice">
                                    <span>$1900.00</span>
                                    <span>$499</span>
                                </div>
                                <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                    <li>S</li>
                                    <li>M</li>
                                    <li>L</li>
                                    <li>XL</li>
                                </ul>
                                <button>加入購物車</button>
                            </div>
                            <!-- 以上將會改為 v-for -->
                        </div>

                        <!-- 第四紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed scamWeb_p07_demoShopping_bannerRed4">
                            <p class="scamWeb_p07_demoShopping_bannerRedP2">新品上市，勁爆特殺！全場大放送，單件低至NT$432，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
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

                        <!-- 第五紅條廣告詞 -->
                        <div class="scamWeb_p07_demoShopping_bannerRed scamWeb_p07_demoShopping_bannerRed4 scamWeb_p07_demoShopping_bannerRed5">
                            <p class="scamWeb_p07_demoShopping_bannerRedP2">立刻下單 免運包郵</p>
                        </div>

                        <!-- 購物網站 footer -->
                        <div class="scamWeb_p07_demoShopping_footer">
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
            </div>
        </div>
    </body>
</template>


<script>
import { ref } from 'vue';
import p07_demo_nav from "@/components/p07_demo_nav.vue";
import p07_demoShopping_cart from "@/components/p07_demoShopping_cart.vue";

export default {
    name: 'shoppingCart',
    components: {
    p07_demo_nav,
    p07_demoShopping_cart
    },
    setup(){
        // 點擊才出現
        const showComponent = ref(false);
        let clickListener;

        function listenClickEvent() {
        clickListener = () => {
            showComponent.value = false;
            document.removeEventListener("click", clickListener);
        };
        document.addEventListener("click", clickListener);
        }

        function closeComponent() {
        if (showComponent.value) {
            showComponent.value = false;
            document.removeEventListener("click", clickListener);
        }
        }

        return {
        showComponent,
        listenClickEvent,
        closeComponent,
        }
    },
}
</script>

<style scoped>
    .mask{
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.3);;
    }
</style>