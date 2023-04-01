<template>
    <div class="cart_container_p07_demoShopping">
        <!-- title -->
        <div class="title">
            <p>您的購物車</p>
            <p>( {{cart.length}} )</p>
        </div>
         <!-- ========= 購物車沒商品 ========= -->
        <div class="non_cart" v-if="cart.length === 0">
            <div class="bagIcon">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <button>目前尚未加入商品</button>
        </div>
        <!-- ========= 購物車有商品 ========= -->
        <div class="cart_list" v-else>
            <!-- 商品列表 -->
            <!-- <div class="products" v-for="(item, index) in cart" :key="index"> -->
            <div class="products" v-for="product in cart" :key="product.id">
                <div class="product_img">
                    <img :src="product.imageUrl" :alt="product.name" />
                    <!-- <img src="../assets/img/p07_demo/p07_demoShopping/pic03.jpg" alt=""> -->
                </div>
                <div class="product_details">
                    <p class="product_details_title" >
                        {{ product.name }}
                    </p>
                    <div class="product_details_num">
                        <span> 數量
                            <i class="fas fa-minus" @click.prevent="updateProductNumber(product, -1)"></i>
                            {{ product.number }}
                            <i class="fas fa-plus" @click.prevent="updateProductNumber(product, 1)"></i>
                        </span>
                    </div>
                    <span> 單價 ${{ product.price }}</span>
                </div>
                <div class="product_details_price">
                    <span> ${{ totalPrice }}</span>
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
            <!-- ======== 輸入 ======== -->
            <form>
                <!-- ======== 付款方式選擇 ======== -->
                <div class="payment selected" >
                    <p>付款方式</p>
                    <label>
                        <input type="radio" value="cashOnDelivery" v-model="paymentMethod" checked/>
                        <span>貨到付款</span>
                    </label>
                    <label>
                        <input type="radio" value="creditCard" v-model="paymentMethod"/>
                        <span>信用卡</span>
                    </label>
                </div>
                <!-- 輸入信用卡資訊 -->
                <div v-if="paymentMethod === 'creditCard'" class="credit_card box">
                <!-- <div class="credit_card box"> -->
                    <p>請輸入信用卡資訊</p>
                    <div class="form_container">
                        <div class="field_container">
                            <label for="cardnumber">信用卡卡號</label>
                            <span id="generatecard">隨機產生</span>
                            <input id="cardnumber" type="text" pattern="[0-9]*" inputmode="numeric">
                        </div>
                        <div class="field_container">
                            <label for="card_name">姓名</label>
                            <input id="card_name" maxlength="20" type="text">
                        </div>
                        <div class="field_container">
                            <label for="expirationdate">到期 (月份/年份)</label>
                            <input id="expirationdate" type="text" pattern="[0-9]*" inputmode="numeric">
                        </div>
                        <div class="field_container">
                            <label for="securitycode">安全碼</label>
                            <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric">
                        </div>
                    </div>
                </div>
                <!-- ======== 運送方式 ======== -->
                <div class="delever selected" >
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
                </div>
                <div v-if="deleverMethod === 'seven'" class="seven delever_stroes box">
                <!-- <div class="seven box"> -->
                    <p>請選擇 7-11 門市</p>
                    <div class="form_container">
                        <!-- 門市資訊 -->
                        <div class="field_container">
                            <label for="seven_store_city">門市資訊</label>
                            <div class="store_info">
                                <select name="seven_store_city">
                                    <option value="">縣市</option>
                                    <option value="taipei">台北市</option>
                                    <option value="newTaipei">新北市</option>
                                </select>
                                <select name="seven_store_district">
                                    <option value="">區</option>
                                    <option value="shulin">樹林區</option>
                                    <option value="banqiao">板橋區</option>
                                </select>
                                <select name="seven_store_name">
                                    <option value="">門市</option>
                                    <option value="store0001">大台</option>
                                    <option value="store0002">大信</option>
                                </select>
                            </div>
                        </div>
                        <!-- 地址 -->
                        <div class="field_container">
                            <label for="delver_address">詳細地址</label>
                            <input id="delver_address" maxlength="20" type="text">
                        </div>
                        <!-- 收件人 -->
                        <div class="field_container">
                            <label for="delver_name">收件人姓名</label>
                            <input id="delver_name" type="text">
                        </div>
                    </div>
                </div>
                <div v-if="deleverMethod === 'family'" class="family delever_stroes box">
                    <p>請選擇 全家 門市</p>
                    <div class="form_container">
                        <!-- 門市資訊 -->
                        <div class="field_container">
                            <label for="seven_store_city">門市資訊</label>
                            <div class="store_info">
                                <select name="seven_store_city">
                                    <option value="">縣市</option>
                                    <option value="taipei">台北市</option>
                                    <option value="newTaipei">新北市</option>
                                </select>
                                <select name="seven_store_district">
                                    <option value="">區</option>
                                    <option value="shulin">樹林區</option>
                                    <option value="banqiao">板橋區</option>
                                </select>
                                <select name="seven_store_name">
                                    <option value="">門市</option>
                                    <option value="store0001">大台</option>
                                    <option value="store0002">大信</option>
                                </select>
                            </div>
                        </div>
                        <!-- 地址 -->
                        <div class="field_container">
                            <label for="delver_address">詳細地址</label>
                            <input id="delver_address" maxlength="20" type="text">
                        </div>
                        <!-- 收件人 -->
                        <div class="field_container">
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
  name: 'Cart',
  props: {
    cart: {
      type: Array,
      default: () => [],
    },
  },
  setup(props) {
    const totalPrice = computed(() => {
      return props.cart.reduce((acc, cur) => acc + cur.price * cur.number, 0);
    });

    const updateProductNumber = (product, amount) => {
      product.number += amount;
      if (product.number < 1) {
        product.number = 1;
      }
    };
    const paymentMethod = ref('');
    const deleverMethod = ref('');
    const creditCardNumber = ref('');
    const expirationDate = ref('');
    const submitPayment = () => {
        cart.value = [];
        paymentMethod.value = '';
        deleverMethod.value = '';
        creditCardNumber.value = '';
        expirationDate.value = '';
    };
    return {
        totalPrice,
        updateProductNumber,
        paymentMethod,
        deleverMethod,
        creditCardNumber,
        expirationDate,
        submitPayment,
    };
  },
};


</script>