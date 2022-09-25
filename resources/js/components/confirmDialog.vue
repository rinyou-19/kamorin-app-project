<template>
  <!-- 確認ダイアログ -->
  <TransitionRoot appear :show="isConfirmOpen" as="template" class="w-1/5 h-1/5">
    <Dialog as="div" @close="closeConfirmModal" class="relative z-10">
      <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>
      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
            <DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">{{ category }}</DialogTitle>
              <div class="mt-2">
                <p class="text-sm text-gray-500">{{ confirmMessage }}</p>
              </div>
              <div class="mt-4 flex justify-center">
                <button type="button" class="inline-flex justify-center rounded-md ml-4 border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2" @click="$emit(closemModal)">閉じる</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script lang="ts">
import { defineComponent, reactive } from "vue"
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, } from '@headlessui/vue'

export default defineComponent({
  components: { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle },
  props: {
    category: String,
    confirmMessage: Boolean,
    isConfirmOpen: String,
  },
  setup(props, context) {

    // 関数定義
    const execEmit = () => {
      context.emit('closemModal')
    }
    // 確認ダイアログを開く処理
    const openModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()

      return
    }

    return { openModal, execEmit }
  }
})
</script>