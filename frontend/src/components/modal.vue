<template>
  <Transition name="modal">
    <div v-if="show" class="modal-wrapper">
      <div class="modal-container">
        <div class="modal-header">
          <slot name="header">default header</slot>
          <button
              class="modal-default-button"
              @click="$emit('close')"
          >Ｘ</button>
        </div>

        <div class="modal-body">
            
        </div>

        <div class="modal-footer">
            <button
              class="modal-default-button"
              @click="$emit('close')"
          >送出</button>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup>
    const props = defineProps({
        show: Boolean
    })
</script>

