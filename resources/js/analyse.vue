<template>
  <div class="w-5/6">
    <h5 class="p-3 text-2xl font-bold">購入情報分析</h5>
    <form>
      <!-- 集計月のブロック-->
      <div class="mb-6 flex items-center">
        <div class="w-1/6">
          <label class="text-black-400 mb-1 block pr-4 text-right font-bold" for="purchase-month-from">集計月</label>
        </div>
        <div class="w-2/6">
          <input class=" w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-month-from" name="purchase-month-from" type="number" placeholder="202206" v-model="data.monthFrom" />
        </div>
        <div class="w-1/8 px-4">～</div>
        <div class="w-2/6">
          <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-month-to" name="purchase-month-to" type="number" placeholder="202206" v-model="data.monthTo" />
        </div>
      </div>
      <div class="flex justify-center text-xl">
        <button class="mt-1 mb-3 rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="summary">集計</button>
      </div>
      <div class="mt-1 flex justify-center text-xl">
        <Chart
          :size="{ width: 1000, height: 350 }"
          :data="data.summaryData"
          :margin="margin"
          :direction="direction"
        >
          <template #layers>
            <Grid strokeDasharray="2,2" />
            <Line :dataKeys="['month', 'purchase']" :lineStyle="{ stroke: 'blue' }"  />
            <Line :dataKeys="['month', 'balance']" :lineStyle="{ stroke: 'red' }" />
            <Line :dataKeys="['month', 'return']" :lineStyle="{ stroke: 'green' }" />
          </template>
        </Chart>
      </div>
    </form>
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
import { defineComponent, ref, reactive } from "vue";
import axios from "axios";
import { Chart, Grid, Line } from "vue3-charts";
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, } from '@headlessui/vue';

export default defineComponent({
  components: { Chart, Grid, Line,  TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle },
  setup() {
    // 変数定義
    const data : {
      // 型の定義は要検討
      summaryData: any;
      monthFrom: number | string;
      monthTo: number | string;
      message: string;
      isOpen: boolean;  
    } = reactive({
      summaryData: [{ month: "", purchase: 0, return: 0, balance: 0 }],
      monthFrom: "",
      monthTo: "",
      message: "",
      isOpen: false
    })

    // チャートの設定
    const direction = ref("horizontal");
    const margin = ref({
      left: 0,
      top: 20,
      right: 20,
      bottom: 0,
    })

    // 関数定義
    // ダイアログを閉じる処理
    const closeModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isOpen = false
    }
    // 集計結果表示処理
    const summary = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault();

      // 入力チェック
      if (data.monthFrom !== "" && typeof data.monthFrom === "number" && data.monthFrom.toString().length !== 6) {
        data.message = "集計月(From)の入力形式が正しくありません"
        data.isOpen = true
        return
      }

      if (data.monthTo !== "" && typeof data.monthTo === "number" && data.monthTo.toString().length !== 6) {
        data.message = "集計月(To)の入力形式が正しくありません"
        data.isOpen = true
        return
      }

      // 入力チェックが問題なかった場合
      const parameter = {
        monthFrom: data.monthFrom,
        monthTo: data.monthTo,
      }

      // データ取得処理
      axios.post("summary", parameter).then((res) => {
        data.summaryData = []
        if(res.data.result === true) {
          // データを取得できた場合
          res.data.data.forEach((value: any) => {
            let summary = {
              month: value.purchase_month,
              purchase: Number(value.total_purchase),
              return: Number(value.total_return),
              balance: Number(value.total_balance),
            }
            data.summaryData.push(summary)
          })
        } else {
          data.message = "データの取得に失敗しました"
          data.isOpen = true
        }    
      })
    }

    return { data, direction, margin, closeModal, summary };
  },
})
</script>