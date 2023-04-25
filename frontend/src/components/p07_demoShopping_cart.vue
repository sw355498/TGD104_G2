<template>
<div class="cart_container_p07_demoShopping">
    <div class="cart_item_p07_demoShopping" v-if="!show">
        <!-- title -->
        <div class="title_p07_demoShopping" >
            <p>您的購物車</p>
            <!-- <p>( {{cart.length}} )</p> -->
        </div>
         <!-- ========= 購物車沒商品 ========= -->
        <div class="non_cart" v-if="cart.length === 0">
            <div class="bagIcon">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <button @click="$emit('close')">尚未加入商品 點我購物</button>
        </div>
        <!-- ========= 購物車有商品 ========= -->
        <div class="cart_list" v-if="cart.length != 0">
            <!-- 商品列表 -->
            <div class="products" v-for="(item, index) in cart" :key="index">
                <div class="product_img">
                    <img :src="item.imageUrl" :alt="item.name" />
                </div>
                <div class="product_details">
                    <p class="product_details_title" >
                        {{ item.name }}
                    </p>
                    <div class="product_details_num">
                        <span> 數量
                            <i class="fas fa-minus" @click="updateProductNumber(item, -1)"></i>
                            {{ item.number }}
                            <i class="fas fa-plus" @click="updateProductNumber(item, 1)"></i>
                        </span>
                    </div>
                    <span> 單價 ${{ item.price }}</span>
                </div>
                <div class="product_details_price">
                    <span> 金額 ${{ item.price * item.number }}</span>
                    <button @click.prevent="removeProduct(index)">刪除</button>
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
                            <!-- <span id="generatecard">隨機產生</span> -->
                            <input id="cardnumber" type="text" pattern="[0-9]*" 
                            inputmode="numeric" value="4000 0566 5566 5556">
                        </div>
                        <div class="field_container">
                            <label for="card_name">姓名</label>
                            <input id="card_name" maxlength="20" type="text" value="王曉明">
                        </div>
                        <div class="field_container">
                            <label for="expirationdate">到期 (月份/年份)</label>
                            <input id="expirationdate" type="text" pattern="[0-9]*" 
                            inputmode="numeric" value="06 29">
                        </div>
                        <div class="field_container">
                            <label for="securitycode">安全碼</label>
                            <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric" value="123">
                        </div>
                    </div>
                </div>
                <!-- ======== 運送方式 ======== -->
                <div class="delever selected" >
                    <p>運送方式</p>
                    <label>
                        <input type="radio" value="home" v-model="deleverMethod" checked
                            @click="removeIdx"
                        />
                        <span>宅配到府</span>
                    </label>
                    <label>
                        <input type="radio" value="seven" v-model="deleverMethod"
                            @click="removeReceiverAddress"
                        />
                        <span>7-11</span>
                    </label>
                </div>
                <!-- 宅配 -->
                <div v-if="deleverMethod === ''|| deleverMethod ==='home'" class="seven delever_stroes box">
                <!-- <div class="seven box"> -->
                    <!-- <p>請輸入地址</p> -->
                    <div class="form_container">
                        <!-- 地址資訊 -->
                        <div class="field_container">
                            <label for="home_city">地址資訊</label>
                            <!-- 台灣縣市 -->
                            <div class="store_info">
                                <select v-model="cityIdx">
                                <option :key="idx" v-for="(option,idx) in citiesTW" :value="idx">{{option.name}}</option>
                                </select>
                                <select v-model="areaIdx">
                                <option :key="idx" v-for="(option,idx) in areas" :value="idx">{{option.name}}</option>
                                </select>
                            </div>
                        </div>
                        <!-- 地址 -->
                        <div class="field_container">
                            <label for="delver_address">詳細地址</label>
                            <input 
                                id="delver_address"
                                maxlength="50" type="text" 
                                v-model="receiverAddress"
                                placeholder="請輸入詳細地址以便包裹寄送"
                            >
                            <p class="needName"
                            v-show="receiverAddress ==''"
                            >請輸入詳細地址</p>
                        </div>
                        <!-- 收件人 -->
                        <div class="field_container">
                            <label for="delver_name">收件人姓名</label>
                            <input 
                                id="delver_name" type="text" 
                                v-model="receiverName"
                                placeholder="請輸入您的真實姓名"
                            >
                            <p class="needName"
                            v-show="receiverName == ''"
                            >請輸入收件人姓名</p>
                        </div>
                    </div>
                </div>
                <div v-if="deleverMethod === 'seven'" 
                    class="seven delever_stroes box">
                    <div class="form_container">
                        <!-- 門市資訊 -->
                        <div class="field_container">
                            <label for="seven_store_city">門市資訊</label>
                            <div class="store_info">
                                <select v-model="selectedCity" @change="handleCityChange">
                                <option value="">縣市</option>
                                <option v-for="(city, index) in cities" :key="index" :value="city">{{ city }}</option>
                                </select>
                                <select v-model="selectedDistrict" @change="handleDistrictChange">
                                <option value="">鄉鎮區</option>
                                <option v-for="(district, index) in districts" :key="index" :value="district">{{ district }}</option>
                                </select>
                                <select v-model="receiverAddress">
                                <option value="">詳細地址</option>
                                <option v-for="(address, index) in addresses" :key="index" :value="address">{{ address }}</option>
                                </select>
                            </div>
                            <p class="needName"
                            v-show="receiverAddress ==''"
                            >請選擇 7-11 門市</p>
                        </div>
                        <!-- 地址 -->
                        <div class="field_container">
                            <label for="delver_address">詳細地址</label>
                            <input id="delver_address" maxlength="50" type="text" 
                                v-model="receiverAddress"
                                readonly="readonly"
                                style="background: #eee;"
                            >
                        </div>
                        <!-- 收件人 -->
                        <div class="field_container">
                            <label for="delver_name">收件人姓名</label>
                            <input id="delver_name" type="text" v-model="receiverName">
                            <p class="needName"
                            v-show="receiverName == ''"
                            >請輸入收件人姓名</p>
                        </div>
                    </div>
                </div>
                <button class="submitDemoShoppingCart"
                :disabled="receiverAddress =='' || receiverName == ''"
                @click.prevent="sweetAlert()">
                    立刻下單
                </button>
                <!-- <button class="submitDemoShoppingCart"
                :disabled="receiverAddress =='' || receiverName == ''"
                @click.prevent="show = true">
                    立刻下單
                </button> -->
            </form>
        </div>
    </div>
    <!-- 下單成功彈窗改用sweetalert -->
    <!-- <div class="orderChecked" v-if="show">
        <div class="orderChecked_container">
            <div class="top">
                <i class="fa-solid fa-xmark" @click="$emit('close')"></i>
            </div>
            <div class="mid">
                <p class="success">下單成功</p>
                <p class="text">幽靈包裹 約3-5個工作天送到<br>
                {{ receiverAddress }}</p> 
                <p class="text"> 親愛的 {{ receiverName }} 
                    <br>請準備領取詐騙包裹</p>
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="bottom">
                <button @click="$emit('close')">點我繼續體驗詐騙網站購物</button>
            </div>
        </div>
    </div> -->
    <div class="mask" @click="$emit('close')"></div>
</div>
</template>
<script>
import { ref, computed, watch,onMounted } from 'vue';
import axios from 'axios';
import { API_URL } from '@/config';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import citiesTW from "@/assets/data/dataCity.json";
import { objectExpression } from '@babel/types';
export default {
    name: 'Cart',
    props: {
        cart: {
        type: Array,
        default: () => [],
        },
    },
    setup(props) {
        // sweetAlert
        const sweetAlert = ()=>{
            Swal.fire({
                position: 'center',
                title: '下單成功',
                html: `幽靈包裹 約3-5個工作天送到 <br>
                ${receiverAddress.value} <br>
                親愛的 ${receiverName.value} <br>
                感謝您的訂購`,
                icon: 'success',
                confirmButtonText: '點我繼續體驗詐騙網站購物'
            })
        }
        // 下拉縣市地址
        const cityIdx = ref(0);
        const areaIdx = ref(0);
        const citiesData = computed(() => {
            console.log('citiesTW');
            console.log(citiesTW);
            return citiesTW;
        });
        const areasData = computed(() => {
            console.log('citiesData.value[0].areas');
            console.log(citiesData.value[0].areas);
        return citiesData.value[cityIdx.value].areas;
        });
        const zipCode = computed(() => {
        return areasData.value[areaIdx.value].zip;
        });
        function removeIdx() {
            areaIdx.value = 0;
            cityIdx.value = 0;
        }
        watch(cityIdx, () => {
            areaIdx.value = 0;
            receiverAddress.value = `${citiesData.value[cityIdx.value].name}`;
        });
        watch(areaIdx, () => {
            receiverAddress.value = `${citiesData.value[cityIdx.value].name} - ${areasData.value[areaIdx.value].name}`;
        });

        // 拿超商資料
        const addressList = ref([]);
        async function allData(){
            try { 
                const response = await axios.get(`${API_URL}getStores.php`);
                const addressList = response.data;
                console.log(addressList);
                return addressList
            } catch (error) {
                // 提交失敗的處理
                console.error('failed', error)
            }
        }
        onMounted(
            async () => {
            //撈取資料庫的資料
            addressList.value = await allData();
            console.log(addressList.value);
            }
        );
        // 超商
        const cities = ref([]);
        const districts = ref([]);
        const addresses = ref([]);

        const selectedCity = ref('');
        const selectedDistrict = ref('');

        const handleCityChange = () => {
        districts.value = addressList.value
            .filter(address => address.ADDRESS.startsWith(selectedCity.value))
            .map(address => {
                 // 這個正則表達式匹配地址中的鄉鎮市名稱，並將其捕獲到第一個分組中
                const pattern = /(.+?[縣市])(.+?[區鎮市鄉]).*/;
                const match = address.ADDRESS.match(pattern);
                if (match) {
                    // 如果找到了鄉鎮市名稱，返回第二個分組
                    return match[2];
                } else {
                    // 如果沒有找到鄉鎮市名稱，返回空字符串
                    return '';
                }
                // const matches = address.ADDRESS.match(/(區)/)
                // const matches = address.ADDRESS.match(/(市|鄉|區|鎮)/)
                // return matches ? address.ADDRESS.slice(3, matches.index + 1) : ''
            })
            .filter((district, index, self) => self.indexOf(district) === index);
        selectedDistrict.value = '';
        receiverAddress.value = '';
        };

        const handleDistrictChange = () => {
        addresses.value = addressList.value
            .filter(address => address.ADDRESS.includes(selectedCity.value) && address.ADDRESS.includes(selectedDistrict.value))
            .map(address => address.ADDRESS);
        receiverAddress.value = '';
        };

        watch(addressList, () => {
            cities.value = addressList.value
                .map(address => address.ADDRESS.slice(0, 3))
                .filter((city, index, self) => self.indexOf(city) === index);
            }, { immediate: true });
        // totalPrice ===============================================
        const totalPrice = computed(() => {
            return props.cart.reduce((acc, cur) => acc + cur.price * cur.number, 0);
        });

        const updateProductNumber = (item, amount) => {
            item.number += amount;
            if (item.number < 1) {
                item.number = 1;
            }
        };
        const removeProduct = (index) => {
            props.cart.splice(index, 1);
        };
        const paymentMethod = ref('');
        const deleverMethod = ref('');
        const creditCardNumber = ref('');
        const expirationDate = ref('');
        const show = ref(false);
        const receiverName = ref('');
        const receiverAddress = ref('');
        function removeReceiverAddress() {
            // console.log('removeReceiverAddress');
            receiverAddress.value = ''
        }

        return {
            totalPrice,
            updateProductNumber,
            removeProduct,
            paymentMethod,
            deleverMethod,
            creditCardNumber,
            expirationDate,
            receiverName,
            receiverAddress,
            removeReceiverAddress,
            show,
            // 超商地址
            cities,
            districts,
            addresses,
            selectedCity,
            selectedDistrict,
            handleCityChange,
            handleDistrictChange,
            // 自製下拉縣市
            cityIdx,
            areaIdx,
            citiesTW: citiesData,
            areas: areasData,
            zip: zipCode,
            removeIdx,
            // sweetAlert
            sweetAlert,
        };
    },
};


</script>

<style scoped>
    .mask{
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.3);;
    }
</style>