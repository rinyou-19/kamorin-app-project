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
          <label for="password" class="form-label mb-3 inline-block text-gray-700">パスワード</label>
          <input type="password" id="password" name="password" class="ml-6 w-1/3 rounded border border-solid border-gray-300 bg-white bg-clip-padding px-1.5 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none" v-model="data.password" />
        </div>
        <div class="flex justify-center text-x mt-4">
          <button class="mt-8 rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="login">ログイン</button>
        </div>
        <div class="flex justify-center text-2xl mt-4">
          <p class="text-red-700">{{ data.erroMessage }}</p>
        </div>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import { router } from "./router"
import { defineComponent, reactive } from "vue"
import axios, { AxiosResponse} from "axios"

export default defineComponent({
  setup() {
    // 変数定義
    const data : {
      userName: string,
      password: string,
      erroMessage: string,

    }  = reactive({
      userName: "",
      password: "",
      erroMessage: "",
    })

    // 関数定義
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
      }

      // ログイン処理
      axios.post('login', data).then(res => {
        if(res.data.result === true) {
          // ユーザー名とパスワードが一致している場合、メニューへ遷移する
          router.push("/menu")
          return
        }
        // ユーザー名かパスワードが一致していなかった場合
        data.erroMessage = "ユーザー名かパスワードが誤っています"
      })
    }

    return { data, login }
  }
})
</script>
