<template>
  <nav v-if="$route.path === '/'">
    <div class="title">詐知就好</div>
    <div class="router_block">
      <router-link to="/index" class="router_item">
        <div>進入前台</div>
      </router-link>
      <router-link to="/b_index" class="router_item">
        <div>進入後台</div>
      </router-link>
    </div>
  </nav>
  <router-view></router-view>
  <div id="particles-js" v-if="$route.path === '/'"></div>
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
    },
  },
};
</script>
<style lang="scss">
#particles-js {
  width: 100vw;
  height: 100vh;
}
.router_block {
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
.router_item {
  padding: 80px;
  background: rgba($color: #13e5f2, $alpha: 0.5);
  color: #fff;
  font-size: 2rem;

  &hover {
    background: rgba($color: #13e5f2, $alpha: 1);
  }
  div {
    width: 130px;
    text-align: center;
  }
}

.title {
  position: absolute;
  top: 20%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 3rem;
  letter-spacing: 0.5rem;
  color: #fff;
  animation: neon 1.5s ease-in-out infinite alternate;
  // padding: 50px;
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
