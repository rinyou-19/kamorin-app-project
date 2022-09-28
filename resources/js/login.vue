<template>
  <div class="w-full">
    <h1 class="mt-4 flex justify-center text-2xl md:text-3xl">ログイン</h1>
    <div class="flex justify-center">
      <form class="w-5/6 md:w-2/3 lg:w-1/2 bg-white shadow-md rounded px-2 md:px-8 lg:px-16 pt-2 md:pt-4 lg:pt-6 md:pb-4 lg:pb-8 mt-4">
        <div class="flex justify-center mt-1 sm:mt-8 text-sm sm:text-xl">
          <label for="name" class="mb-2 md:ml-4 lg:ml-8 xl:ml-12 inline-block text-gray-700 w-1/4 md:w-1/3">ユーザー名</label>
          <input type="text" id="name" name="name" class="ml-1 md:ml-4 w-3/4 md:w-2/3 rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-sm sm:text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.userName" placeholder="山田 太郎" />
        </div>
        <div class="flex justify-center mt-1 sm:mt-5 text-sm sm:text-xl">
          <label for="password" class="mb-2 md:ml-4 lg:ml-8 xl:ml-12 inline-block text-gray-700 w-1/4 md:w-1/3">パスワード</label>
          <input type="password" id="password" name="password" class="ml-1 md:ml-4 w-3/4 md:w-2/3 rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-sm sm:text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.password" />
        </div>
        <div class="flex justify-center mt-2 sm:mt-4 sm:mb-4">
          <button class="mt-3 rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="login">ログイン</button>
        </div>
        <div class="flex justify-center mt-2 mb-2 sm:mt-4 sm:mb-4">
          <p class="cursor-pointer text-sky-500 text-sm sm:text-base" @click="openModal">新規ユーザー登録はこちら</p>
        </div>
        <div class="flex justify-center mt-2 mb-2 sm:mt-4 sm:mb-4">
          <p class="cursor-pointer text-sky-500 text-sm sm:text-base" @click="openReleasNote">リリースノートへ</p>
        </div>
        <div class="flex justify-center mt-2 mb-2 sm:mt-4 sm:mb-4">
          <p class="text-red-500 text-sm sm:text-base">↑ご一読ください</p>
        </div>
      </form>
    </div>
    <!-- ユーザー登録ダイアログ -->
    <TransitionRoot appear :show="data.isOpen" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>
        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full w-full items-center justify-center p-4 text-center">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
              <DialogPanel class="transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">ユーザー登録</DialogTitle>
                <form class="w-full bg-white shadow-md rounded p-4">
                  <div class="flex justify-center mt-3 mb-1 sm:mb-3 text-xxs sm:text-base md:text-xl">
                    <div class="w-1/3">
                      <label for="userName" class="block inline-block text-gray-700 px2 sm:px-4 py-1 sm:py-2">ユーザー名*</label>
                    </div>
                    <div class="w-2/3">
                      <input type="text" id="userName" name="userName" class="w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding p-1 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.entryUserName" placeholder="山田 太郎" />
                    </div>
                  </div>
                  <div class="flex justify-center mb-1 sm:mb-3 text-xxs sm:text-base md:text-xl">
                    <div class="w-1/3">
                      <label for="userPassword" class="form-label inline-block text-gray-700 px2 sm:px-4 py-1 sm:py-2">パスワード*</label>
                    </div>
                    <div class="w-2/3">
                      <input type="password" id="userPassword" name="userPassword" class="w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding p-1 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.entryPassword" />
                    </div>       
                  </div>
                  <div class="flex justify-center mb-1 sm:mb-3 text-xxs sm:text-base md:text-xl">
                    <div class="w-1/3">
                      <label for="confirmPassword" class="form-labelinline-block text-gray-700 px2 sm:px-4 py-1 sm:py-2">パスワード確認*</label>
                    </div>
                    <div class="w-2/3">
                      <input type="password" id="confirmPassword" name="confirmPassword" class="w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding p-1 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.entryConfirmPassword" />
                    </div>            
                  </div>
                  <div class="flex justify-center  mb-1 sm:mb-3 text-xs sm:text-base md:text-lg">
                    <p class="text-red-500 px2 sm:px-4 py-1 sm:py-2">※パスワードは8文字以上24文字以内、数値と大文字・小文字アルファベットを含んでください</p>
                  </div>
                  <div class="flex justify-center mb-1 sm:mb-3 text-xxs sm:text-base md:text-xl">
                    <div class="w-1/3">
                      <label for="mailAddress" class="form-label inline-block text-gray-700 px2 sm:px-4 py-1 sm:py-2">メールアドレス*</label>
                    </div>
                    <div class="w-2/3">
                      <input type="email" id="mailAddress" name="mailAddress" class="w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding p-1 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.entryEMail" />
                    </div>         
                  </div>
                  <div class="flex justify-center text-xs sm:text-base mt-1">
                    <button class="rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="entryUserCheck">ユーザー登録</button>
                    <button class="rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700 ml-4" v-on:click="closeModal">閉じる</button>
                  </div>
                </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog> 
    </TransitionRoot>
    <!-- 確認ダイアログ -->
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
                  <p class="text-sm text-gray-500">{{ data.message }}</p>
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
import { defineComponent, reactive, ref } from "vue"
import axios from "axios"
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, } from '@headlessui/vue'

export default defineComponent({
  components: { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle },
  setup(context) {
    // 変数定義
    const data : {
      userName: string,
      password: string,
      message: string,
      entryUserName: string,
      entryPassword: string,
      entryConfirmPassword: string,
      entryEMail: string,
      isOpen: boolean,
      isConfirmOpen: boolean,
    }  = reactive({
      userName: "",
      password: "",
      message: "",
      entryUserName: "",
      entryPassword: "",
      entryConfirmPassword: "",
      entryEMail: "",
      isConfirmOpen: false,
      isOpen: false,
    })

    // 関数定義
    // 新規ユーザー登録クリック時の処理
    const openModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isOpen = true
    }

    // 新規ユーザー登録ダイアログを閉じる処理
    const closeModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isOpen = false
    }

    // 確認ダイアログを閉じる処理
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
        // ユーザー名かパスワードが入力されていない場合
        // 確認ダイアログを開く
        data.message = "ユーザー名かパスワードが入力されていません"
        data.isConfirmOpen = true
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
          const mailParameter = {
            userName: data.userName,
          }
          // 二要素認証の認証コードを送信する
          axios.post('sendPassword', mailParameter).catch(e => {
            // 確認ダイアログを開く
            data.message = "二要素認証のメールの送信に失敗しました"
            data.isConfirmOpen = true
          })
          // 二要素認証画面へ遷移する
          sessionStorage.setItem('userName', data.userName)
          router.push("/twoFactorAuth")
          return
        }
        // ユーザー名かパスワードが一致していなかった場合
        data.message = "ユーザー名かパスワードが誤っています"
        data.isConfirmOpen = true
      })
    }

    // ユーザー登録チェック
    const entryUserCheck = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault()

      // 入力チェック
      if (data.entryUserName === "" || data.entryPassword === "" || data.entryConfirmPassword === "" || data.entryEMail === "") {
        // 入力されていない項目がある場合
        data.message = "全ての項目が入力されていません"
        data.isConfirmOpen = true
        return
      }
      // パスワードが一致しているか確認
      if (data.entryPassword !== data.entryConfirmPassword) {
        // パスワードが一致していない場合
        data.message = "パスワードが一致していません"
        data.isConfirmOpen = true
        return
      }
      // パスワードの形式チェック
      const regex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z])[a-zA-Z0-9]{8,24}$/
      if(regex.test(data.entryPassword) === false) {
        // パスワードの形式を満たしていない場合
        data.message = "パスワードの形式要件を満たしていません"
        data.isConfirmOpen = true
        return
      }

      const checkParameter = {
        userName: data.entryUserName
      }

      // ユーザー名の重複チェック
      axios.post('userConflictcheck', checkParameter).then(res => {
        if(res.data.result === false) {
          // ユーザー名が重複している場合
          data.message = "データの登録に失敗しました"
          data.isConfirmOpen = true
          return
        } else {
          // ユーザー登録処理
          entryUser()
        }
      })
    }

    // ユーザー登録処理
    const entryUser = () => {
      // パラメーターのセット
      const parameter = {
        userName: data.entryUserName,
        password: data.entryPassword,
        email: data.entryEMail
      }

      // ユーザー登録
      axios.post('entryUser', parameter).then(res => {
        if(res.data.result === true) {
          // ユーザー登録ダイアログを閉じる
          data.isOpen = false
          // 変数を初期化
          data.entryUserName = ""
          data.entryPassword = ""
          data.entryConfirmPassword =""
          data.entryEMail = ""
          
          // 確認ダイアログを開く
          data.message = "ユーザー登録が完了しました"
          data.isConfirmOpen = true
          return
        }
        // ユーザーの登録に失敗した場合
        data.message = "ユーザーの登録に失敗しました"
        data.isConfirmOpen = true
      })
    }

    // リリースノートへ
    const openReleasNote = () => {
      router.push("/releaseNote")
    }

    return { data, openModal, closeModal, login, entryUserCheck, entryUser, closeConfirmModal, openReleasNote }
  }
})
</script>
