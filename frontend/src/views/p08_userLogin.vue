<template>
 <div>
    <button
      type="button"
      
      @click="showModal"
    >
      登入/註冊會員
    </button>

    <Modal
      v-show="isModalVisible"
      @close="closeModal"
    />
  </div>
</template>

<script>
import Modal from '@/components/userLogin.vue'

  export default {
    name: 'App',
    components: {
      Modal,
    },
    data() {
      return {
        isModalVisible: false,
      };
    },
    methods: {
      showModal() {
        this.isModalVisible = true;
      },
      closeModal() {
        this.isModalVisible = false;
      }
    }
  };
</script>

