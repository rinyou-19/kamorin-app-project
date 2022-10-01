<template>
  <div class="flex flex-row lg:inline-block lg:side-menu bg-green-200 w-full lg:w-1/6 lg:h-full">
      <div class="border-r-4 lg:border-r-0 lg:border-b-4 border-dotted border-gray-400 bg-green-200 h-full lg:h-1/4 w-1/4 text-sm sm:text-lg lg:w-full md:text-2xl text-center align-center py-4 lg:py-5" v-on:click="showPurchase">購入情報入力</div>
      <div class="border-r-4 lg:border-r-0 lg:border-b-4 border-dotted border-gray-400 bg-green-200 h-full lg:h-1/4 w-1/4 text-sm sm:text-lg lg:w-full md:text-2xl text-center align-center py-4 lg:py-5" v-on:click="showInquiry">購入情報照会</div>
      <div class="border-r-4 lg:border-r-0 lg:border-b-4 border-dotted border-gray-400 bg-green-200 h-full lg:h-1/4 w-1/4 text-sm sm:text-lg lg:w-full md:text-2xl text-center align-center py-4 lg:py-5" v-on:click="showAnalyse">購入情報分析</div>
      <div class="border-gray-400 lg:border-none bg-green-200 h-full lg:h-1/4 w-1/4 lg:w-full text-sm sm:text-lg md:text-2xl text-center align-center py-4 lg:py-5" v-on:click="showContact">お問い合わせ</div>
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