<template>
  <div class="w-full">
    <h1 class="mt-4 flex justify-center text-3xl">ログイン</h1>
    <div class="flex justify-center">
      <form class="w-2/3 bg-white shadow-md rounded pt-6 pb-8 mt-4 px-16">
        <div class="flex justify-center mt-8 text-xl">
          <label for="name" class="block mb-2 inline-block text-gray-700">ユーザー名</label>
          <input type="text" id="name" name="name" class="ml-6 w-1/3 rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.userName" placeholder="山田 太郎" />
        </div>
        <div class="flex justify-center mt-5 text-xl">
          <label for="password" class="form-label mb-1 inline-block text-gray-700">パスワード</label>
          <input type="password" id="password" name="password" class="ml-6 w-1/3 rounded border border-solid border-gray-300 bg-white bg-clip-padding px-1.5 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.password" />
        </div>
        <div class="flex justify-center text-x mt-2">
          <button class="mt-8 rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="login">ログイン</button>
        </div>
        <div class="flex justify-center text-x mt-3">
          <p @click="openModal">新規ユーザー登録はこちら</p>
        </div>
        <div class="flex justify-center text-2xl mt-3">
          <p class="text-red-700">{{ data.erroMessage }}</p>
        </div>
      </form>
      
    </div>
    <TransitionRoot appear :show="data.isOpen" as="template" class="w-1/2 h-1/4">
      <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>
        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full w-1/2 items-center justify-center p-4 text-center">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
              <DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">ユーザー登録</DialogTitle>
                <form class="w-full bg-white shadow-md rounded">
                  <div class="flex justify-center mt-3 text-xl">
                    <div class="w-1/3">
                      <label for="userName" class="block mb-2 inline-block text-gray-700">ユーザー名*</label>
                    </div>
                    <div class="w-2/3">
                      <input type="text" id="userName" name="userName" class="w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.entryUserName" placeholder="山田 太郎" />
                    </div>
                  </div>
                  <div class="flex justify-center mt-3 text-xl">
                    <div class="w-1/3">
                      <label for="userPassword" class="form-label mb-3 inline-block text-gray-700">パスワード*</label>
                    </div>
                    <div class="w-2/3">
                      <input type="password" id="userPassword" name="userPassword" class="w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-1.5 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.entryPassword" />
                    </div>       
                  </div>
                  <div class="flex justify-center mt-3 text-xl">
                    <div class="w-1/3">
                      <label for="confirmPassword" class="form-label mb-3 inline-block text-gray-700">パスワード確認*</label>
                    </div>
                    <div class="w-2/3">
                      <input type="password" id="confirmPassword" name="confirmPassword" class="w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-1.5 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.entryConfirmPassword" />
                    </div>            
                  </div>
                  <div class="flex justify-center mt-3 text-xl">
                    <div class="w-1/3">
                      <label for="mailAddress" class="form-label mb-3 inline-block text-gray-700">メールアドレス*</label>
                    </div>
                    <div class="w-2/3">
                      <input type="email" id="mailAddress" name="mailAddress" class="w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-1.5 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.entryEMail" />
                    </div>         
                  </div>
                  <div class="flex justify-center text-x mt-2">
                    <button class="mt-8 rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="entryUser">ユーザー登録</button>
                  </div>
                </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
      <TransitionRoot appear :show="data.isConfirmOpen" as="template" class="w-1/5 h-1/5">
      <Dialog as="div" @close="closeConfirmModal" class="relative z-10">
        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>
        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
              <DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">確認</DialogTitle>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">ユーザー登録が完了しました</p>
                </div>
                <div class="mt-4 flex justify-center">
                  <button type="button" class="inline-flex justify-center rounded-md ml-4 border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2" @click="closeConfirmModal">閉じる</button>
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
      userName: string,
      password: string,
      erroMessage: string,
      isOpen: boolean,
      entryUserName: string,
      entryPassword: string,
      entryConfirmPassword: string,
      entryEMail: string,
      isConfirmOpen: boolean,
    }  = reactive({
      userName: "",
      password: "",
      erroMessage: "",
      isOpen: false,
      entryUserName: "",
      entryPassword: "",
      entryConfirmPassword: "",
      entryEMail: "",
      isConfirmOpen: false,
    })

    // 関数定義
    // 新規ユーザー登録クリック時の処理
    const openModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isOpen = true
    }
    const closeModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isOpen = false
    }
    const closeConfirmModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isConfirmOpen = false
    }
    // ログインボタンクリック時の処理
    const login = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault()

      // 入力チェック
      if (data.userName === "" || data.password === "") {
        // ユーザー名かパスワードが入力されていない場合、エラーメッセージを設定して処理を抜ける
        data.erroMessage = "ユーザー名かパスワードが入力されていません"
        return
      }

      // 入力チェックが問題なかった場合
      const parameter = {
        userName: data.userName,
        password: data.password,
        email: data.entryEMail,
      }

      // ログイン処理
      axios.post('login', parameter).then(res => {
        if(res.data.result === true) {
          // 二要素認証の認証コードを送信する
          axios.post('sendPassword')
          // ユーザー名とパスワードが一致している場合、二要素認証画面へ遷移する
          router.push("/twoFactorAuth")
          return
        }
        // ユーザー名かパスワードが一致していなかった場合
        data.erroMessage = "ユーザー名かパスワードが誤っています"
      })
    }
    // ユーザー登録処理
    const entryUser = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault()

      // パスワードの確認
      // パスワードの形式確認
      // メールアドレスの形式確認
      // 入力チェックが問題なかった場合
      const parameter = {
        userName: data.entryUserName,
        password: data.entryPassword,
        email: data.entryEMail
      }

      // ログイン処理
      axios.post('entryUser', parameter).then(res => {
        if(res.data.result === true) {
          // ユーザー登録ダイアログを閉じる
          data.isOpen = false
          // 確認ダイアログを開く
          data.isConfirmOpen = true
          return
        }
        // ユーザー名かパスワードが一致していなかった場合
        data.erroMessage = "ユーザー名かパスワードが誤っています"
      })
    }

    return { data, openModal, closeModal, login, entryUser, closeConfirmModal }
  }
})
</script>
