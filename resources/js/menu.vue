<template>
  <div class="side-menu bg-green-200 w-1/6 h-full">
    <div class="h-full">
      <div class="border-b-4 border-dotted border-gray-400 bg-green-200 h-1/4 text-2xl text-center align-center py-16" v-on:click="showPurchase">購入情報入力</div>
      <div class="border-b-4 border-dotted border-gray-400 bg-green-200 h-1/4 text-2xl text-center align-center py-16" v-on:click="showInquiry">購入情報照会</div>
      <div class="border-b-4 border-dotted border-gray-400 bg-green-200 h-1/4 text-2xl text-center align-center py-16" v-on:click="showAnalyse">購入情報分析</div>
      <div class="bg-green-200 h-1/4 text-2xl text-center align-center py-16" v-on:click="showContact">お問い合わせ</div>
    </div>
  </div>
</template>

<script lang="ts">
import { router } from "./router";

export default {
  setup() {
    // 関数定義
    // 購入情報入力画面へ
    const showPurchase = () => {
      router.push("/purchase");
    };
    // 購入情報照会画面へ
    const showInquiry = () => {
      router.push("/inquiry");
    };
    // 購入情報分析画面へ
    const showAnalyse = () => {
      router.push("/analyse");
    };
    // お問い合わせ画面へ
    const showContact = () => {
      router.push("/contact");
    };

    // 定義したものをreturnする
    return { showPurchase, showInquiry, showAnalyse, showContact };

  },
};
</script>