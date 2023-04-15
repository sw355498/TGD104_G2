<template>
  <Transition name="modal">
    <div v-if="show" class="layout-modal-mask">
      <div class="modal-container">
        <div class="modal-header">
          <slot name="header"></slot>
          <button
            class="modal-default-button small_button"
            @click="$emit('close')"
          >
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>

        <div class="modal-body">
          <slot name="body"></slot>
        </div>

        <div class="modal-footer">
          <slot name="footer"></slot>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup>
import { watch } from "vue";
const props = defineProps({
        show: Boolean
    })
    let bodyBlock = document.querySelector('body')
    if(props.show){
        bodyBlock.style.cssText = 'height: 100vh; overflow-y: hidden;'
} else {
        bodyBlock.style.cssText = ''
}
watch(props, (value) => {

      if(value.show){
        bodyBlock.style.cssText = 'height: 100vh; overflow-y: hidden;'
  } else {
        bodyBlock.style.cssText = ''
  }

    })
</script>
