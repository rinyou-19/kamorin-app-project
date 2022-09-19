<template>
  <div class="w-5/6">
    <h5 class="p-3 text-2xl font-bold">購入情報照会</h5>
    <form>
      <!-- 購入日のブロック-->
      <div class="mb-6 flex items-center">
        <div class="w-1/6">
          <label class="text-black-400 mb-1 block pr-4 text-right font-bold" for="purchase-date-from">購入日</label>
        </div>
        <div class="w-2/6">
          <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-date-from" name="purchase-date-from" type="number" placeholder="20220601" v-model="data.dateFrom" />
        </div>
        <div class="w-1/8 px-4">～</div>
        <div class="w-2/6">
          <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-date-to" name="purchase-date-to" type="number" placeholder="20220630" v-model="data.dateTo" />
        </div>
      </div>
      <!-- 検索ボタンのブロック -->
      <div class="flex justify-center text-xl">
        <button class="rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="getData">検索</button>
      </div>
      <!-- ヘッダーと表示内容の位置がずれるのは、幅を固定するしかないかも-->
      <div class="mt-1 ml-12 flex items-center w-11/12">
        <table class="w-full">
          <thead style="display: block">
            <tr>
              <th class="px-2 py-2 w-32">日付</th>
              <th class="px-2 py-2 w-28">競馬場</th>
              <th class="px-2 py-2 w-28">グレード</th>
              <th class="px-2 py-2 w-48">レース名</th>
              <th class="px-2 py-2 w-24">芝/ダ</th>
              <th class="px-2 py-2 w-24">距離</th>
              <th class="px-2 py-2 w-24">購入金額</th>
              <th class="px-2 py-2 w-24">払戻金額</th>
              <th class="px-2 py-2 w-24">収支金額</th>
            </tr>
          </thead>
          <tbody style="display: block; overflow: scroll; height:340px;"></tbody>
        </table>
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
import { defineComponent, reactive  } from "vue";
import axios from "axios";
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, } from '@headlessui/vue';

export default defineComponent({
  components: { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle },
  setup () {
    // 変数宣言
    const data: {
      dateFrom: number | string;
      dateTo: number | string;
      message: string;
      isOpen: boolean;  
    } = reactive({
      dateFrom: "",
      dateTo: "",
      message: "",
      isOpen: false
    })
    const closeModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isOpen = false
    }
    
    // 関数宣言
    const getData = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault();

      // 入力チェック
      if (data.dateFrom !== "" && typeof data.dateFrom === "number" && data.dateFrom.toString().length !== 8) {
        data.message = "購入日(From)の入力形式が正しくありません"
        data.isOpen = true
        return
      }

      if (data.dateTo !== "" && typeof data.dateTo === "number" && data.dateTo.toString().length !== 8) {
        data.message = "購入日(To)の入力形式が正しくありません"
        data.isOpen = true
        return
      }

      // 入力チェックが問題なかった場合
      const parameter = {
        dateFrom: data.dateFrom,
        dateTo: data.dateTo,
      }

      // データ取得処理
      axios.post("getData", parameter).then((res) => {
          if(res.data.result === true) {
            // テーブルの要素を取得
            const element = document.querySelector<HTMLElement>("tbody");

            if (
              element?.firstChild !== undefined &&
              element?.firstChild !== null
            ) {
              // 子要素を削除する
              while (element?.firstChild) {
                element.removeChild(element.firstChild);
              }
            }

            for (let value of res.data.data) {
              // テーブルに表示する要素
              let tableParantElememt = document.createElement("tr");
              let talbleChildElement = document.createElement("td");
              talbleChildElement.classList.add("border");
              talbleChildElement.classList.add("px-2");
              talbleChildElement.classList.add("py-2");
              talbleChildElement.classList.add("w-32");
              talbleChildElement.innerHTML = value.race_day;
              tableParantElememt.appendChild(talbleChildElement);
              let talbleChildElement2 = document.createElement("td");
              talbleChildElement2.classList.add("border");
              talbleChildElement2.classList.add("px-2");
              talbleChildElement2.classList.add("py-2");
              talbleChildElement2.classList.add("w-28");
              talbleChildElement2.innerHTML = value.race_course;
              tableParantElememt.appendChild(talbleChildElement2);
              let talbleChildElement3 = document.createElement("td");
              talbleChildElement3.classList.add("border");
              talbleChildElement3.classList.add("px-2");
              talbleChildElement3.classList.add("py-2");
              talbleChildElement3.classList.add("w-28");
              talbleChildElement3.innerHTML = value.grade;
              tableParantElememt.appendChild(talbleChildElement3);
              let talbleChildElement4 = document.createElement("td");
              talbleChildElement4.classList.add("border");
              talbleChildElement4.classList.add("px-2");
              talbleChildElement4.classList.add("py-2");
              talbleChildElement4.classList.add("w-48");
              talbleChildElement4.innerHTML = value.race_name;
              tableParantElememt.appendChild(talbleChildElement4);
              let talbleChildElement5 = document.createElement("td");
              talbleChildElement5.classList.add("border");
              talbleChildElement5.classList.add("px-2");
              talbleChildElement5.classList.add("py-2");
              talbleChildElement5.classList.add("w-24");
              talbleChildElement5.innerHTML = value.dirt_or_turf;
              tableParantElememt.appendChild(talbleChildElement5);
              let talbleChildElement6 = document.createElement("td");
              talbleChildElement6.classList.add("border");
              talbleChildElement6.classList.add("px-2");
              talbleChildElement6.classList.add("py-2");
              talbleChildElement6.classList.add("w-24");
              talbleChildElement6.innerHTML = value.distance;
              tableParantElememt.appendChild(talbleChildElement6);
              let talbleChildElement7 = document.createElement("td");
              talbleChildElement7.classList.add("border");
              talbleChildElement7.classList.add("px-2");
              talbleChildElement7.classList.add("py-2");
              talbleChildElement7.classList.add("w-24");
              talbleChildElement7.innerHTML = value.purchase_m;
              tableParantElememt.appendChild(talbleChildElement7);
              let talbleChildElement8 = document.createElement("td");
              talbleChildElement8.classList.add("border");
              talbleChildElement8.classList.add("px-2");
              talbleChildElement8.classList.add("py-2");
              talbleChildElement8.classList.add("w-24");
              talbleChildElement8.innerHTML = value.return_m;
              tableParantElememt.appendChild(talbleChildElement8);
              let talbleChildElement9 = document.createElement("td");
              talbleChildElement9.classList.add("border");
              talbleChildElement9.classList.add("px-2");
              talbleChildElement9.classList.add("py-2");
              talbleChildElement9.classList.add("w-24");
              talbleChildElement9.innerHTML = value.balance_m;
              tableParantElememt.appendChild(talbleChildElement9);
              element?.appendChild(tableParantElememt);
            }
          } else {
            data.message = "データの取得に失敗しました"
            data.isOpen = true
          }
        })
    }

    return {data, closeModal, getData}
  }
});
</script>