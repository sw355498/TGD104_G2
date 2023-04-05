<template>
  <div>
 <!-- navgation -->
 <frontNavbar />
  <div class="p08_user">
    <div class="container">
      <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
            <li class="breadcrumb-item">
              <router-link to="/p08_user">會員中心</router-link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">修改密碼</li>
          </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
          <div class="col-md-6 mb-3 col-lg-4">
            <div class="card order-1">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img
                    src="../assets/img/p08_user/user.jpg"
                    alt="Admin"
                    class="rounded-circle"
                    width="150"
                  />
                  <!-- <div class="file btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="file" />
                  </div> -->
                  <div class="mt-3">
                    <h4 class="">Karen</h4>
                    <p class="text_title mb-1">LV.2</p>
                    <p class="text font-size-sm">防詐小尖兵</p>
                    <p class="text font-size-sm">加入時間:yyyy/mm</p>

                    <p class="text_title mb-1">狀態</p>
                    <p class="text font-size-sm">Email 驗證</p>
                    <p class="text font-size-sm">防詐小達人</p>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
          <div class="col-md-6 col-lg-8 order-2 profile-head">
            <h4>修改密碼</h4>
            <h6>karen@gmail.com</h6>

            <div class="row mt-4">
              <div class="col-lg-6 margin-10 col-sm-12">
                <label for="">輸入舊密碼</label>
                <input type="text" class="input_p08_user_login" />

                <label for="">修改密碼</label>
                <input type="text" class="input_p08_user_login" />
                
                <label for="">再次確認密碼</label>
                <input type="text" class="input_p08_user_login" />
                <button class="btn btn-primary">儲存</button>
                <button class="btn">取消</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
         <!-- footer -->
         <frontFooter />
  </div>
</template>

<script>
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";

export default {
  components: {
    frontNavbar,
    frontFooter,
  },
}
</script>
