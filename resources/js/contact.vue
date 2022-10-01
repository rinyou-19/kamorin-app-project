<template>
  <div class="w-full h-full lg:w-5/6 lg:inline-block lg:align-top">
    <p class="p-3 text-2xl font-bold">お問い合わせ</p>
    <form>
      <!-- お問い合わせ件名 -->
      <div class="mb-2 lg:mb-6 flex items-center">
        <!-- お名前 -->
        <div class="w-1/5">
          <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="contact-name">お名前*</label>
        </div>
        <div class="w-4/5">
          <input class="w-full appearance-none rounded border-2 border-gray-200  bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="contact-name" name="contact-name" type="text" placeholder="山田太郎" v-model="data.sentName" />
        </div>
      </div>
            <div class="mb-2 lg:mb-6 flex items-center">
        <!-- ご連絡先 -->
        <div class="w-1/5">
          <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="mail-address">ご連絡先*</label>
        </div>
        <div class="w-4/5">
          <input class=" w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="mail-address" name="mail-address" type="email" placeholder="test@example.cpm" v-model="data.email" />
        </div>
      </div>
      <div class="mb-2 lg:mb-6 flex items-center">
        <!-- お問い合わせ分類 -->
        <div class="w-1/5">
          <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="category">分類*</label>
        </div>
        <div class="w-4/5">
          <select class=" w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="category" name="category" v-model="data.category">
            <option value=""></option>
            <option value="改善要望">改善要望</option>
            <option value="障害報告">障害報告</option>
            <option value="その他">その他</option>
          </select>
        </div>
      </div>
      <div class="mb-2 flex items-center h-1/3 lg:h-1/2">
        <!-- お問い合わせ詳細 -->
        <div class="w-1/5">
          <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="detail">詳細*</label>
        </div>
        <div class="w-4/5">
          <textarea name="detail" id="detail" rows="7" class="block p-2.5 w-full rounded border-2 border-gray-200 bg-gray-200 text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..." v-model="data.detail"></textarea>
        </div>
      </div>
      <div class="flex justify-center text-xl">
        <button class="rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" @click="openModal">送信</button>
      </div>
      <div class="flex justify-center text-xl mt-1">
        <p class="text-red-700">{{ data.erroMessage }}</p>
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
                        <button type="button" v-show="data.isEntry" class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2" @click="send">OK</button>
                        <button type="button" class="inline-flex justify-center rounded-md ml-4 border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2" @click="closeModal">閉じる</button>
                     </div>
                  </DialogPanel>
                </TransitionChild>
              </div>
            </div>
          </Dialog>
      </TransitionRoot>
    </form>
  </div>
</template>
<script lang="ts">
import { defineComponent, reactive } from 'vue'
import axios from "axios"
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, } from '@headlessui/vue'

export default defineComponent({
  components: { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle },
  setup () {
     // 変数定義
    const data : {
      sentName: string;
      category: string;
      email: string;
      detail: string;
      erroMessage: string;
      isOpen: boolean;
      message: string;
      isEntry: boolean;
    } = reactive({
      sentName: "",
      category: "",
      email: "",
      detail: "",
      erroMessage: "",
      isOpen: false,
      message: "",
      isEntry: true
    })
    // 関数定義
    // ダイアログを閉じる処理
    const closeModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isOpen = false
      data.isEntry = true
    }
    // ダイアログを開く処理
    const openModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()

      // 入力チェック
      if (data.sentName == "" || data.category == "" || data.email == ""|| data.detail == "") {
        // 未入力項目がある場合
        data.erroMessage = "未入力項目があります"
        return
      }

      // ダイアログのメッセージを設定
      data.message = "お問い合わせを送信しますか？"
      // ダイアログを表示
      data.isOpen = true

    }
    // メール送信処理
    const send = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()

      // 入力チェックが問題なかった場合
      const parameter = {
        sentName: data.sentName,
        category: data.category,
        email: data.email,
        detail: data.detail
      }

      // ダイアログを閉じる
      data.isOpen = false


      axios.post("send", data).then((res) => {
        // ダイアログのメッセージを設定
        data.message = "お問い合わせの送信に失敗しました"
        if(res.data.result === true) {
          // メールの送信に成功した場合  
          data.sentName = ""
          data.category = ""
          data.email = ""
          data.detail = ""
          data.message = "お問い合わせの送信に成功しました"
        }

        data.isEntry = false

        // ダイアログを開く
        data.isOpen = true
      })
    }
    return { data, closeModal, openModal, send }
  }
})
</script>