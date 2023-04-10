<template>
  <Transition name="modal">
    <div v-if="show" class="layout-modal-mask">
      <div class="modal-container">
        <div class="modal-header">
          <slot name="header">default header</slot>
          <button
              class="modal-default-button small_button"
              @click="$emit('close')"
          >Ｘ</button>
        </div>

        <div class="modal-body">
          <slot name="body">default body</slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">default footer</slot>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup>
    import { watch } from 'vue'
    const props = defineProps({
        show: Boolean
    })


    watch(props, (value) => {
      let bodyBlock = document.querySelector('body')
      if(value.show){
        bodyBlock.style.cssText = 'height: 100vh; overflow-y: hidden;'
      } else {
        bodyBlock.style.cssText = ''
      }

    })
</script>
