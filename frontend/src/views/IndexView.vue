<template>
  <div class="home">

    <indexChatbot msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
// @ is an alias to /src
import indexChatbot from '@/components/indexChatbot.vue'

export default {
  name: 'HomeView',
  components: {
    indexChatbot
  }
}
</script>
