<template>
    <div class="cart_container_p07_demoShopping">
        <!-- 商品列表 -->
        <form>
            <label>
                商品名稱：
                <input type="text" v-model="product.name" />
            </label>
            <label>
                商品價格：
                <input type="number" v-model="product.price" />
            </label>
            <button @click.prevent="addProduct">加入商品</button>
        </form>
        <!-- title -->
        <div class="title">
            <p>您的購物車</p>
            <p>( {{cart.length}} )</p>
        </div>
         <!-- ========= 購物車沒商品 ========= -->
        <div class="non_cart" v-if="cart.length === 0" style="display:none;">
            <p >購物車是空的。</p>
            <div class="bagIcon">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <button>目前尚未加入商品</button>
        </div>
        <!-- ========= 購物車有商品 ========= -->
        <div class="cart_list">
        <!-- <div class="cart_list" v-else> -->
            <!-- 商品列表 -->
            <!-- 抓商品名稱 -->
            <!-- <ul>
                <li v-for="(item, index) in cart" :key="index">
                {{ item.name }} - ${{ item.price }}
                </li>
            </ul> -->
            <div class="products">
                <div class="product_img">
                    <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg" alt="">
                </div>
                <div class="product_details">
                    <p class="product_details_title" >
                        早春新款V領法式洋裝小眾氣質高腰長裙
                    </p>
                    <div class="product_details_num">
                        <span>2x</span>
                        <span>$200</span>
                    </div>
                </div>
                <div class="product_details_price">
                    <span>$400</span>
                </div>
            </div>
            <!-- ======== 總計 ======== -->
            <div class="total">
                <div class="total_item">
                    <span>小記</span>
                    <span>${{ totalPrice }}</span>
                </div>
                <div class="total_item">
                    <span>運費</span>
                    <span>$0</span>
                </div>
                <div class="total_item total_price">
                    <span>總計</span>
                    <span>${{ totalPrice }}</span>
                </div>
            </div>
            <!-- ======== 付款方式選擇 ======== -->
            <form class="payment selected" >
                    <p>付款方式</p>
                    <label>
                        <input type="radio" value="cashOnDelivery" v-model="paymentMethod" checked/>
                        <span>貨到付款</span>
                    </label>
                    <label>
                        <input type="radio" value="creditCard" v-model="paymentMethod"/>
                        <span>信用卡</span>
                    </label>
                <div v-if="paymentMethod === 'creditCard'" class="creditCard box">
                <!-- <div class="creditCard box"> -->
                    <span>請輸入信用卡資訊</span>
                    <div class="form-container">
                        <div class="field-container">
                            <label for="cardnumber">信用卡卡號</label>
                            <input id="cardnumber" type="text" pattern="[0-9]*" inputmode="numeric"><i class="fa-regular fa-credit-card"></i>
                            <span id="generatecard">隨機產生</span>
                        </div>
                        <div class="field-container">
                            <label for="card_name">姓名</label>
                            <input id="card_name" maxlength="20" type="text">
                        </div>
                        <div class="field-container">
                            <label for="expirationdate">到期日 (月份/年份)</label>
                            <input id="expirationdate" type="text" pattern="[0-9]*" inputmode="numeric">
                        </div>
                        <div class="field-container">
                            <label for="securitycode">安全碼</label>
                            <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric">
                        </div>
                    </div>
                </div>
            </form>
            <!-- ======== 運送方式 ======== -->
            <form class="delever selected" >
                    <p>運送方式</p>
                    <label>
                        <input type="radio" value="home" v-model="deleverMethod" checked/>
                        <span>宅配到府</span>
                    </label>
                    <label>
                        <input type="radio" value="seven" v-model="deleverMethod"/>
                        <span>7-11</span>
                    </label>
                    <label>
                        <input type="radio" value="family" v-model="deleverMethod"/>
                        <span>全家</span>
                    </label>
                <div v-if="deleverMethod === 'seven'" class="seven box">
                <!-- <div class="seven box"> -->
                    <span>請選擇 7-11 門市</span>
                    <div class="form-container">
                        <div class="field-container">
                            <label for="seven_store_title">門市資訊</label>
                            <input id="seven_store_title" type="text">
                        </div>
                        <div class="field-container">
                            <label for="delver_address">詳細地址</label>
                            <input id="delver_address" maxlength="20" type="text">
                        </div>
                        <div class="field-container">
                            <label for="delver_name">收件人姓名</label>
                            <input id="delver_name" type="text">
                        </div>
                    </div>
                </div>
                <div v-if="deleverMethod === 'family'" class="family box">
                    <span>請選擇 全家 門市</span>
                    <div class="form-container">
                        <div class="field-container">
                            <label for="seven_store_title">門市資訊</label>
                            <input id="seven_store_title" type="text">
                        </div>
                        <div class="field-container">
                            <label for="delver_address">詳細地址</label>
                            <input id="delver_address" maxlength="20" type="text">
                        </div>
                        <div class="field-container">
                            <label for="delver_name">收件人姓名</label>
                            <input id="delver_name" type="text">
                        </div>
                    </div>
                </div>
                <button @click.prevent="submitPayment">立刻下單</button>
            </form>
        </div>
    </div>
</template>
<script>
import { ref, computed } from 'vue';

export default {
  name: 'ShoppingCart',
  setup() {
    const cart = ref([]);
    const product = ref({ name: '', price: 0 });
    const paymentMethod = ref('');
    const deleverMethod = ref('');
    const creditCardNumber = ref('');
    const expirationDate = ref('');

    const addProduct = () => {
      cart.value.push({ ...product.value });
      product.value = { name: '', price: 0 };
    };

    const submitPayment = () => {
      cart.value = [];
      paymentMethod.value = '';
      deleverMethod.value = '';
      creditCardNumber.value = '';
      expirationDate.value = '';
    };

    const totalPrice = computed(() => {
      return cart.value.reduce((acc, item) => acc + item.price, 0);
    });

    return {
      cart,
      product,
      paymentMethod,
      deleverMethod,
      creditCardNumber,
      expirationDate,
      addProduct,
      submitPayment,
      totalPrice,
    };
  },
};
</script>