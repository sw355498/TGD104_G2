<template>
    <main class="body_p07_demoShopping">
        <div class="main_p07_demoShopping" >

            <!-- header -->
            <frontNavbar />

            <!-- demo nav -->
            <p07_demo_nav />
            
            <!-- popup -->
            <div v-if="showPopup">
                <p07_demoShopping_popup :show="showPopup" @close="showPopup = false"/>
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

                <!-- 內容區 -->
                <div class="browser_container" id="browserDemoShoppingContainer">
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
                                <li><a  @click="changeSection1()">商品主頁</a></li>
                                <!-- <li><a style="cursor: auto;">訂單查詢</a></li> -->
                                <li><a  @click="changeSection2()">下單須知</a></li>
                                <li><a @click="changeSection3()">立即下單</a></li>
                                <li>
                                    <span>
                                       <span class="cart_length"> {{ total_product }}</span>
                                       <img 
                                        src="../assets/img/p07_demo/p07_demoShopping/cart.png" alt="購物車" 
                                        @click="showComponent = true"
                                       >
                                    </span>
                                </li>
                                <li><img src="../assets/img/p07_demo/p07_demoShopping/info.png" alt="個人資訊" style="cursor: auto;"></li>
                            </ul>
                        </div>
                        <div class="mainDemoShopping" v-show="showSection1" id="mainDemoShopping">
                            <!-- 購物網站第一 banner -->
                            <div class="scamWeb_p07_demoShopping_banner1" id="tour5">
                                <p class="scamWeb_p07_demoShopping_banner1P">現實下殺</p>
                                <span class="scamWeb_p07_demoShopping_banner1Countdown">{{ remainingTime }}</span>
                            </div>
    
                            <!-- 第一紅條廣告詞 -->
                            <div class="scamWeb_p07_demoShopping_bannerRed scamWeb_p07_demoShopping_bannerRed1">
                                <ul>
                                    <li>NT$480</li>
                                    <li>NT$1280</li>
                                    <li>限量200件! 立即搶購！</li>
                                </ul>
                            </div>
    
                            <!-- 第一灰條廣告詞 -->
                            <div class="scamWeb_p07_demoShopping_bannerGray" id="tour4">
                                <p>新品上市，勁爆特殺！全場大放送，單件低至NT$432，2020新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                                <p>新品上市，勁爆特殺！全場大放送，單件低至NT$432，2020新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                                <p>新品上市，勁爆特殺！全場大放送，單件低至NT$432，2020新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                            </div>
    
                            <!-- 第二紅條廣告詞 -->
                            <div class="scamWeb_p07_demoShopping_bannerRed" >
                                <p class="scamWeb_p07_demoShopping_bannerRedP1">現在下單免運包郵 買到賺到 貨到付款不用怕 免郵費 七天鑒賞期</p>
                            </div>
    
                            <!-- 購物網站第二 banner -->
                            <img class="scamWeb_p07_demoShopping_banner2" src="../assets/img/p07_demo/p07_demoShopping/demoShoppingPic02.jpg">
                            
                            <!-- 第三紅條廣告詞 -->
                            <div class="scamWeb_p07_demoShopping_bannerRed scrollBar">
                                <p class="scamWeb_p07_demoShopping_bannerRedP2">新品上市，勁爆特殺！全場大放送，單件低至 NT$432，2020 新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
                                <p class="scamWeb_p07_demoShopping_bannerRedP2">新品上市，勁爆特殺！全場大放送，單件低至 NT$432，2020 新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！</p>
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
                                    <!-- <ul class="scamWeb_p07_demoShopping_clothCardSizeSelect">
                                        <li>S</li>
                                        <li>M</li>
                                        <li>L</li>
                                        <li>XL</li>
                                    </ul> -->
                                    <button @click.prevent="addProductToCart(product); ">加入購物車</button>
                                </div>
                                
                            </div>
    
                            <!-- 第四紅條廣告詞 -->
                            <div class="scamWeb_p07_demoShopping_bannerRed scamWeb_p07_demoShopping_bannerRed4">
                                <p class="scamWeb_p07_demoShopping_bannerRedP2">新品上市，勁爆特殺！全場大放送，單件低至NT$432，廠家直銷，超值優惠，買到賺到！</p>
                                <p class="scamWeb_p07_demoShopping_bannerRedP2">新品上市，勁爆特殺！全場大放送，單件低至NT$432，廠家直銷，超值優惠，買到賺到！</p>
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
                                <li><p>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</p></li>
                                <li><p>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</p></li>
                                <li><p>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</p></li>
                                <li><p>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</p></li>
                                <li><p>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</p></li>
                                <li><p>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</p></li>
                                <li><p>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</p></li>
                                <li><p>李*[0920****5361]<br>2分鐘前下單 新品上市，勁爆特殺！全場大放送，單件低至NT$432，2023新款夏裝中長款韓版寬松顯瘦條紋襯衫女七分袖，廠家直銷，超值優惠，買到賺到！過後漲價！ - 【買一送一】任選2件 僅需NT$1098，單件低至NT$549！</p></li>
                                <!-- 以上會用 v-for 並使用向上輪播動畫 -->
                            </ul>
    
                            <!-- 第六紅條廣告詞 -->
                            <div class="scamWeb_p07_demoShopping_bannerRed scamWeb_p07_demoShopping_bannerRed4 scamWeb_p07_demoShopping_bannerRed6"  id="tour6">
                                <p class="scamWeb_p07_demoShopping_bannerRedP2">立刻下單 免運包郵 貨到付款 最有保障</p>
                            </div>
                        </div>
                        <!-- 下單須知 -->
                        <div class="notice" v-show="showSection2" id="noticeDemo">
                            <!-- 拿第二紅條廣告詞 物流條款 -->
                            <div class="scamWeb_p07_demoShopping_bannerRed" id="noticeDemo1">
                                <p class="scamWeb_p07_demoShopping_bannerRedP1">物流條款</p>
                            </div>
                            <p class="notice_demoShopping_p">1、配送範圍與郵費<br>
                            配送範圍全台灣免運離島地區加收NT$200運費（蘭嶼、澎湖、綠島、七星岩、崇明島、金門）
                            支持7-11，全家取貨，下方付款方式選擇超取付款和附近超商（請務必填寫行動電話號碼以便接收簡訊，下訂後7-10日請前往超商取貨，無特殊原因未取拒收會進入店鋪信用名單，影響下次購買喔）
                            <br>
                            2、配送時間<br>
                            下單成功之後，我們會按照下單先後順序進行配貨，配貨週期為3個工作日左右；不限定時間送貨和指定時段送貨、星期六週日及國定假日可以提供收送服務
                            <br>
                            3、到貨時間<br>
                            訂單完成後到達時間為7個工作日左右
                            <br>
                            4、簽收須知<br>
                            下單時，請盡量留下本人能夠簽收的地址與聯絡電話。
                            收到商品時請當場驗貨，檢查外包裝是否完好，商品種類數量是否與訂單明細相符，購物清單是否齊全，不提供簽收前拆開手機包裝驗貨。如果外箱封條出現破損或者撕開，您有權選擇拒收。
                            但對於封條完好，開箱後缺料等異常情況，請您聯繫我們24小時在線客服，並保持包裹原樣。
                            在本人不能親自簽收的情況下，請委託他人簽收並嚴格按照第二項內容操作。配送快遞員只負責派送貨物給快遞單指定位址，該位址任何人都可以簽收例如櫃台，不保證派送給指定的人。
                            出於風險考慮，您的訂單在確認購買後無法修改地址和電話，還請在下單時務必填入正確的地址和電話。爲您帶來的麻煩我們表示抱歉。
                            即日起，因資訊不足無法配送的滯留訂單將會被配送方保留5日。我們將會以電子郵件的形式通知用戶，請回覆信箱中的郵件或聯繫客服人員。逾期5日未能得到回覆的訂單我們將安排返回倉庫及退款。由此給您帶來的不便，敬請諒解。
                            <br>
                            5、退貨退款<br>
                            1、如果您所訂購的商品有瑕疵，您可以要求全額退費
                            2、關於退貨退款方式及條件，依各該商品銷售網頁及訂購流程中之相關網頁之記載
                            3、您所退回的商品，必須保持所有商品、贈品、附件、包裝、及所有附隨文件或資料在出貨當時狀態的完整性，如果有實體發票，並應連同發票一併退回及簽署折讓單等相關法令所要求之單據；否則，我們得拒絕接受您的退貨退款要求。
                            4、您瞭解並同意，若因您要求退貨或換貨、或因我們無法接受您全部或部分之訂單、或契約因故解除或失其效力，而需為您辦理退款事宜時，我們得代您處理發票或折讓單等相關法令所要求之單據
                            <br>
                            6、配送常見問題<br>
                            Q1：下單時可以指定送貨時間嗎？<br>
                            A1：依照訂單運輸信息中的「運輸公司」對應不同送貨時間。可以選擇，指定時段送貨（時段為：13時前和14時~18時）送貨，不含週日。<br>
                            Q2: 如何投訴快遞人員？<br>
                            A2: 依照訂單運輸信息中的「運輸公司」對應不同快遞公司，客戶可以聯絡當地的服務熱線<br>
                            Q3：配送需要多長時間？<br>
                            A3：正常情況下，自訂單出庫日起，7個工作日左右即可送達（不含週日）。<br>
                            Q4：簽收驗貨需注意什麼？<br>
                            A4：請確保外包裝完好，收件人可以拒絕收取外包裝破損的貨物。<br>
                            Q5：收貨時是否需要提供證件？<br>
                            A5： 不需要。快遞員只負責派送貨物給快遞單指定位址，該位址任何人都可以簽收例如櫃台。不保證派送給指定的人。<br>
                            Q6：被他人簽收了，怎麼辦？<br>
                            A6：如出現此種情況，請依照訂單運輸信息中的「運輸公司」聯絡對應的快遞公司。 請聯絡當地的服務熱線。<br>
                            Q7：如何查詢合作廠商配送的狀態？<br>
                            A7：請依照訂單運輸信息中的「運輸公司」查詢對應的快遞公司可以查詢貨物狀態。<br>
                            我們客服將七天24小時在線為您回復郵件<br>
                            </p>
                            <!-- 拿第二紅條廣告詞 服務條款 -->
                            <div class="scamWeb_p07_demoShopping_bannerRed" id="noticeDemo2">
                                <p class="scamWeb_p07_demoShopping_bannerRedP1">服務條款</p>
                            </div>
                            <p class="notice_demoShopping_p">
                                感謝您瀏覽本網站。根據以下服務條款和其他相關條例，您可以訪問或使用本網站或相關服務。使用本服務，例如在本網站上訂購商品，即表示您同意遵守所有服務條款。本協議並不構成您與我們之間的任何關係（包括合夥、合作、雇用或其他形式）。本協議並不賦予您成為我們的代表。我們保留在任何時候更改本網站、相關政策和協議、隱私聲明以及本服務條款的權利。我們建議您定期查看本網站，以了解上述政策、協議、隱私聲明和服務條款的更新或更改。
                                <br>知識產權<br>
                                我們的所有軟件和內容（包括任何文字、音訊、音樂、影片、圖像、照片和圖片）都是我們的知識產權作品，受知識產權、版權法和國際公約的保護。本網站僅供個人和非商業用途。除非經過我們及/或其第三方授權人的明確授權，否則不得將內容用於任何非個人和/或非商業用途。在未經我們同意或授權之前，不得發佈、複製、出售或許可任何本網站的內容。任何未經授權的行為可能導致民事後果或刑事處罰。
                                我們保留撤消或修改任何服務的權利，而且並不需要事先通知。如果因任何原因本網站在任何時間或期間內無法使用，我們概不負責。
                                <br>產品描述<br>
                                我們將盡力確保本網站的內容和產品描述是準確和完整的。但是，我們無法保證內容和產品描述均為準確、完整、最新和無誤。如果您認為我們提供的產品與描述不符，請參閱我們的退貨及退款程序。
                                價格 本網站所標示的價格為新臺幣。<br>
                                我們建議您在使用本網站和相關服務之前，仔細閱讀本服務條款及其他政策和協議。您在使用本網站和相關服務時，即表示您同意遵守本服務條款及其他政策和協議的條款和條件。
                                如有任何疑問或需要進一步幫助，請聯繫我們的客戶服務部門。我們將盡最大努力回答您的問題並提供支援。
                                感謝您的閱讀，如有任何需要，請隨時聯繫我們。
                            </p>
                            <!-- 拿第二紅條廣告詞 服務條款 -->
                            <div class="scamWeb_p07_demoShopping_bannerRed" id="noticeDemo3">
                                <p class="scamWeb_p07_demoShopping_bannerRedP1">隱私協議</p>
                            </div>
                            <p class="notice_demoShopping_p">
                                我們非常注重客戶的隱私權，因此只會按照本隱私聲明的方式收集和使用您的個人資料。
                                我們只會在必要或與交易相關的情況下收集您的資料。
                                我們只會在法律要求或與收集用途有關的情況下保留您的資料。
                                您可以在不提供個人資料的情況下瀏覽我們的網站。如果您未登入用戶帳戶來瀏覽我們的網站，您將會以匿名身份瀏覽，我們將無法識別您的身份。
                                我們非常樂意聆聽您的意見，如果您有任何意見或建議，請透過在線客服向我們提供相關資訊。
                                <br>個人資料收集<br>
                                我們不會向第三方出售、分享或交易您在網上收集的個人資料。我們僅會在本公司集團內部使用這些資料。當您下訂單時，我們會收集您的基本個人資料，包括：
                                <br>姓名<br>
                                送貨地址<br>
                                電郵地址<br>
                                聯絡電話號碼<br>
                                出生日期<br>
                                性別<br>
                                我們會將您提供的個人資料用於以下用途：<br>
                                運送您所購買的商品。
                                提供商品運送狀況和客戶支援的最新消息。
                                為您提供有關商品的資料。
                                處理您的訂單或根據您的要求提供服務和資訊。
                                此外，我們還會使用您提供的資料來管理您的帳戶，驗證您的網上付款交易，審查您從我們網站下載的資料，識別網站瀏覽器，進行網站用戶統計調查，並在您表明不拒絕接收訊息的情況下，發送我們認為適合您的相關商品或服務資訊。
                                為了方便送貨，我們可能會將您的姓名和地址提供給第三方（例如速遞公司或供應商）。
                            </p>
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
                                        <li @click="changeSection3()">商品列表</li>
                                        <li @click="changeSection4()">物流條款</li>
                                        <li @click="changeSection5()">服務條款</li>
                                        <li @click="changeSection6()">隱私協議</li>
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
            <div class="demoRobot_container">
                <p class="demoRobot_message">
                    此購物網站為 DEMO 體驗，本站不會儲存您的個資！
                    <button class="small_button" @click="showPopup = true">
                        詐騙網站導覽
                    </button>
                </p>
                <svg width="110" height="90px" style="">
                    <use xlink:href="#robot" width="110" />
                </svg>
            </div>
            <!-- <p07_demo_robot/> -->
        </div>
        <frontFooter />
    </main>
</template>


<script>
import { ref, watch, computed } from 'vue';
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
import p07_demo_nav from "@/components/p07_demo_nav.vue";
import p07_demoShopping_cart from "@/components/p07_demoShopping_cart.vue";
import p07_demoShopping_popup from "@/components/p07_demoShopping_popup.vue";
import p07_demo_robot from "@/components/p07_robot.vue";
import Swal from 'sweetalert2/dist/sweetalert2.js'

export default {
    name: 'shoppingCart',
    components: {
        frontNavbar,
        frontFooter,
        p07_demo_nav,
        p07_demoShopping_cart,
        p07_demoShopping_popup,
        p07_demo_robot
    },
    setup(){
        // 切換商品主頁、下單須知 =================================================
        const showSection1 = ref(true);
        const showSection2 = ref(false);
        function changeSection1() { //切換商品主頁
            showSection1.value = true;
            showSection2.value = false;
            window.requestAnimationFrame(() => {//等element加載出來才scroll
                const container = document.getElementById('browserDemoShoppingContainer');
                const mainDemoShopping = document.getElementById('mainDemoShopping');
                const rect = mainDemoShopping.getBoundingClientRect();
                const top = rect.top - container.getBoundingClientRect().top + container.scrollTop;
                const offset = 100; // 額外位移量
                container.scroll({
                    top: top - offset,
                    behavior: 'smooth'
                });
            });
            // const element = document.getElementById('mainDemoShopping');
            // window.requestAnimationFrame(() => { //等element加載出來才scroll
            //     element.scrollIntoView({ behavior: 'smooth' }); //用這個會整個視窗卷軸滑動
            // });
        };
        function changeSection2() { //切換下單須知
            showSection1.value = false;
            showSection2.value = true;
            window.requestAnimationFrame(() => {//等element加載出來才scroll
                const container = document.getElementById('browserDemoShoppingContainer');
                const notice = document.getElementById('noticeDemo');
                const rect = notice.getBoundingClientRect();
                const top = rect.top - container.getBoundingClientRect().top + container.scrollTop;
                const offset = 100; // 額外位移量
                container.scroll({
                    top: top - offset,
                });
            });
        };
        function changeSection3() { //切換商品主頁並跳轉到商品列表
            showSection1.value = true;
            showSection2.value = false;
            window.requestAnimationFrame(() => {//等element加載出來才scroll
                const container = document.getElementById('browserDemoShoppingContainer');
                const productList = document.getElementById('tour2');
                const rect = productList.getBoundingClientRect();
                const top = rect.top - container.getBoundingClientRect().top + container.scrollTop;
                const offset = 100; // 額外位移量
                container.scroll({
                    top: top - offset,
                    behavior: 'smooth'
                });
            });
        };
        function changeSection4() { //切換下單須知 - 物流條款
            showSection1.value = false;
            showSection2.value = true;
            window.requestAnimationFrame(() => {//等element加載出來才scroll
                const container = document.getElementById('browserDemoShoppingContainer');
                const notice1 = document.getElementById('noticeDemo1');
                const rect = notice1.getBoundingClientRect();
                const top = rect.top - container.getBoundingClientRect().top + container.scrollTop;
                const offset = 70; // 額外位移量
                container.scroll({
                    top: top - offset,
                });
            });
        };
        function changeSection5() { //切換下單須知 - 服務條款
            showSection1.value = false;
            showSection2.value = true;
            window.requestAnimationFrame(() => {//等element加載出來才scroll
                const container = document.getElementById('browserDemoShoppingContainer');
                const notice2 = document.getElementById('noticeDemo2');
                const rect = notice2.getBoundingClientRect();
                const top = rect.top - container.getBoundingClientRect().top + container.scrollTop;
                const offset = 70; // 額外位移量
                container.scroll({
                    top: top - offset,
                });
            });
        };
        function changeSection6() { //切換下單須知 - 隱私
            showSection1.value = false;
            showSection2.value = true;
            window.requestAnimationFrame(() => {//等element加載出來才scroll
                const container = document.getElementById('browserDemoShoppingContainer');
                const notice3 = document.getElementById('noticeDemo3');
                const rect = notice3.getBoundingClientRect();
                const top = rect.top - container.getBoundingClientRect().top + container.scrollTop;
                const offset = 70; // 額外位移量
                container.scroll({
                    top: top - offset,
                });
            });
        };
        // sweetAlert =================================================
        const sweetAlert = ()=>{
            Swal.fire({
                title: '加入成功',
                text: '已將商品加入購物車',
                icon: 'success',
                position: 'center',
                showConfirmButton: false,
                timer: 1100
            })
        };
        const sweetAlertAlready = ()=>{
            Swal.fire({
                title: '已將商品數量+1',
                // text: '已將商品數量+1',
                icon: 'success',
                position: 'center',
                showConfirmButton: false,
                timer: 1400
            })
        }
        // 購物車 =================================================
        const cart = ref([]);
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

        const total_product = computed(()=>{
            const product_value = cart.value
            console.log( cart.value)
            let total = 0
            for (let index = 0; index < product_value.length; index++) {
                const element = product_value[index];
                console.log( element.number );
                total = total + element.number 
            }
            return total
        
        })
        const addProductToCart = (product) => {
            const index = cart.value.findIndex(item => item.name === product.name);
            if (index >= 0) { // 如果購物車中已經有此商品，數量加 1
                cart.value[index].number++;
                sweetAlertAlready();
                console.log(cart.value);
            } else { // 如果購物車中沒有此商品，新增至購物車中
                cart.value.push({ ...product, number: 1 });
                sweetAlert();
                // console.log(cart.value);
            }
        };
        
        // 點擊才出現 =================================================
        const showComponent = ref(false);
        const showPopup = ref(true);


        // 倒數計時器 =================================================
        const remainingSeconds = ref(4825);

        const remainingTime = computed(() => {
            const hours = Math.floor(remainingSeconds.value / 3600);
            const minutes = Math.floor((remainingSeconds.value % 3600) / 60);
            const seconds = remainingSeconds.value % 60;
            return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        });

        watch(remainingSeconds, (newVal) => {
            if (newVal === 0) {
                clearInterval(intervalId);
            }
        });

        const intervalId = setInterval(() => {
            remainingSeconds.value--;
        }, 1000);


        return {
            cart,
            product,
            total_product,
            products,
            addProductToCart,
            showComponent,
            showPopup,
            remainingTime,
            sweetAlert,
            sweetAlertAlready,
            showSection1,
            showSection2,
            changeSection1,
            changeSection2,
            changeSection3,
            changeSection4,
            changeSection5,
            changeSection6,
        }
    },
}
</script>
