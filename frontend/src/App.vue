<template>

      
      <nav v-if="$route.path === '/'">
        <div class="router_block">      
          <router-link to="/index" class="router_item">
            <div>
              進入前台
            </div>
          </router-link>
          <router-link to="/b_index" class="router_item">
            <div>
              進入後台
            </div>
          </router-link>
        </div>
      </nav>
      <router-view></router-view>
      <div id="particles-js"></div>
</template>
<script>
import particlesJs from "particles.js";
import particlesConfig from "@/assets/particles.json";
export default {
  data() {
      return {};
    },
    mounted() {
      this.init();
    },
    methods: {
      init() {
        particlesJS("particles-js", particlesConfig);
        document.body.style.overflow = "hidden";
      }
    }
};
</script>
<style lang="scss">
  .router_block{
    display: flex;
    justify-content: center;
    align-items: center;
    column-gap: 25px;
    row-gap: 25px;
    flex-wrap: wrap;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  .router_item{
    padding: 80px;
    background: rgba($color: #13e5f2, $alpha: 0.5);
    color: #fff;
    font-size: 2rem;

    &hover{
      background: rgba($color: #13e5f2, $alpha: 1);
    }
    div{
      width: 130px;
      text-align: center;
    }
  }
</style>