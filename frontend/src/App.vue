<template>
  <div v-if="loading">
    <Loading v-show="loading" />
  </div>
  <div v-else>
    <nav v-if="$route.path === '/'">
      <div class="app_content_block">
        <div class="app_title">詐知就好</div>
        <div class="router_block">
          <router-link to="/index" class="router_item">
            <div>進入前台</div>
          </router-link>
          <router-link to="/b_index" class="router_item">
            <div>進入後台</div>
          </router-link>
        </div>
      </div>
    </nav>
    <router-view />
  </div>
  <div id="particles-js" v-if="$route.path === '/' || $route.path === '/b_login' || $route.path === '/b_data'"></div>
</template>
<script>
import particlesJs from "particles.js";
import particlesConfig from "@/assets/particles.json";
import Loading from "@/components/loading.vue";
export default {
  data() {
    return {
      loading: true,
    };
  },
  mounted() {
    particlesJS('particles-js', particlesConfig);
    setTimeout(() => {
      this.loading = false;
    }, 500);
  },
  components: {
    Loading,
  },
};
</script>
<style lang="scss" scoped>
.app_content_block {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);

  .app_title {
    text-align: center;
    margin-bottom: 20px;
    font-size: 3rem;
    letter-spacing: 0.5rem;
    color: #fff;
    animation: neon 1.5s ease-in-out infinite alternate;
  }

  .router_block {
    display: flex;
    justify-content: center;
    align-items: center;
    column-gap: 25px;
    row-gap: 25px;
    flex-wrap: wrap;

    .router_item {
      padding: 80px;
      background: rgba($color: #13e5f2, $alpha: 0.5);
      color: #fff;
      font-size: 2rem;

      &:hover {
        background: rgba($color: #13e5f2, $alpha: 1);
      }
      div {
        width: 130px;
        text-align: center;
      }
    }
  }
}
#particles-js {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
}

@keyframes neon {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #13e5f2,
      0 0 70px #13e5f2, 0 0 80px #13e5f2, 0 0 100px #13e5f2, 0 0 150px #13e5f2;
  }
  to {
    text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #13e5f2,
      0 0 35px #13e5f2, 0 0 40px #13e5f2, 0 0 50px #13e5f2, 0 0 75px #13e5f2;
  }
}
</style>
