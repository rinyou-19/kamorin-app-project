<template>
  <div class="w-full">
    <h1 class="mt-4 flex justify-center text-3xl">リリースノート</h1>
    <ul>
      <li>・2022/09/18 ver0.0リリース 基本機能　馬券購入情報入力・照会・集計、問合せ機能リリース</li>
      <li>・2022/09/25 ver1.0リリース ユーザー作成機能・二要素認証機能リリース</li>
      <li>・2022/09/28 ver1.1リリース ユーザー作成機能・二要素認証機能レスポンシブ対応済み</li>
      <li>・2022/10/01 ver1.2リリース レスポンシブ対応実施、フォントサイズ要調整</li>
      <li>・アップデート予定:CSV取込機能追加、順次UI対応</li>
      <li>・日付式が誤っているのにデータ登録できてしまう</li>
      <li>※本アプリは馬券収支を管理するアプリとなっています、ユーザー登録をしてご利用ください。</li>
      <li>※メールでの二要素認証が標準仕様となっております。</li>
      <li>※現在スマホ対応も進めておりますが、PC使用を推奨しています</li>
      <li>・不明点がありましたら、kamorin.app19@gmail.comへお問い合わせください。</li>
    </ul>
    <div class="flex justify-center mt-2 mb-2 sm:mt-4 sm:mb-4">
      <p class="cursor-pointer text-sky-500 text-sm sm:text-base" @click="openLogin">ログイン画面へ</p>
    </div>
  </div>
</template>

<script lang="ts">
import { router } from "./router"
import { defineComponent } from "vue"

export default defineComponent({
  setup() {
    // 関数定義
    const openLogin = () => {
      router.push("/")
    }

    return { openLogin }
  }
})
</script>