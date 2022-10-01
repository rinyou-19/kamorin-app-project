<template>
  <div class="w-full">
    <h1 class="mt-4 flex justify-center text-3xl">二要素認証</h1>
    <div class="flex justify-center">
      <form class="w-2/3 bg-white shadow-md rounded pt-6 pb-8 mt-4 px-2 sm:px-16">
        <div class="flex justify-center mt-8 text-xs sm:text-xl">
          <label for="name" class="block mt-2 inline-block text-gray-700">認証コード</label>
          <input type="text" id="name" name="name" class="ml-6 w-1/3 rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.password" placeholder="******" />
        </div>
        <div class="flex justify-center text-x mt-2">
          <button class="mt-8 rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="auth">認証</button>
        </div>
      </form>    
    </div>
    <TransitionRoot appear :show="data.isOpen" as="template" class="w-1/5 h-1/5">
      <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>
        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
              <DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">確認</DialogTitle>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">{{ data.message }}</p>
                </div>
                <div class="mt-4 flex justify-center">
                  <button type="button" class="inline-flex justify-center rounded-md ml-4 border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2" @click="closeModal">閉じる</button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<script lang="ts">
import { router } from "./router"
import { defineComponent, reactive } from "vue"
import axios from "axios"
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, } from '@headlessui/vue';

export default defineComponent({
  components: { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle },
  setup() {
    // 変数定義
    const data : {
      password: string;
      message: string;
      isOpen: boolean;
    }  = reactive({
      password: "",
      message: "",
      isOpen: false
    })

    // 関数定義
    const closeModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      console.log(1)
      data.isOpen = false
    }

    // 認証ボタンクリック時の処理
    const auth = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault()

      // 入力チェック
      if (data.password === "") {
        // 認証コードが入力されていない場合
        data.message = "認証コードが入力されていません"
        data.isOpen = true
        return
      }

      // 入力チェックが問題なかった場合
      const parameter = {
        password: data.password,
        userName: sessionStorage.getItem('userName')
      }

      // 認証処理
      axios.post('auth', parameter).then(res => {
        if(res.data.result === true) {
          // 認証コードが一致した場合はメニュー画面へ遷移
          router.push("/menu")
          return
        }
        // 認証コードが誤っていた場合
        data.message = "認証コードが誤っています"
        data.isOpen = true
      })
    }

    return { data, closeModal, auth }
  }
})
</script>
