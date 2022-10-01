<template>
  <div class="w-full h-full lg:w-5/6 lg:inline-block lg:align-top">
    <h5 class="p-3 text-2xl font-bold">購入情報照会</h5>
    <form>
      <!-- 購入日のブロック-->
      <div class="mb-6 flex items-center">
        <div class="w-1/6">
          <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="purchase-date-from">購入日</label>
        </div>
        <div class="w-2/6">
          <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-date-from" name="purchase-date-from" type="number" placeholder="20220601" v-model="data.dateFrom" />
        </div>
        <div class="w-1/8 px-4 text-xxxs sm:text-sm md:text-base">～</div>
        <div class="w-2/6">
          <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-date-to" name="purchase-date-to" type="number" placeholder="20220630" v-model="data.dateTo" />
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
              <th class="px-2 py-2 w-32 text-xxxs sm:text-sm md:text-base" v-show="false">id</th>
              <th class="px-2 py-2 w-32 text-xxxs sm:text-sm md:text-base">日付</th>
              <th class="px-2 py-2 w-28 text-xxxs sm:text-sm md:text-base">競馬場</th>
              <th class="px-2 py-2 w-28 text-xxxs sm:text-sm md:text-base">グレード</th>
              <th class="px-2 py-2 w-48 text-xxxs sm:text-sm md:text-base">レース名</th>
              <th class="px-2 py-2 w-24 text-xxxs sm:text-sm md:text-base">購入金額</th>
              <th class="px-2 py-2 w-24 text-xxxs sm:text-sm md:text-base">払戻金額</th>
              <th class="px-2 py-2 w-24 text-xxxs sm:text-sm md:text-base">収支金額</th>
            </tr>
          </thead>
          <tbody style="display: block; overflow: scroll;" class="h-1/4 max-h-56 lg:h-1/3 lg:max-h-96"></tbody>
        </table>
      </div>
    </form>
    <!-- データ更新ダイアログ -->
    <TransitionRoot appear :show="data.isDataDialogOpen" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>
        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full w-full items-center justify-center p-1 lg:p-6 text-center">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
              <DialogPanel class="transform overflow-hidden rounded-2xl bg-white p-1 lg:p-6 text-left align-middle shadow-xl transition-all">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">購入情報修正</DialogTitle>
                <form class="w-full bg-white shadow-md rounded p-2 lg:p-4">
                  <!-- 購入日・格付・競馬場のブロック-->
                  <div class="mb-3 lg:mb-7 flex items-center">
                    <!-- 購入日 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="purchase-date">購入日*</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-date" name="purchase-date" type="number" placeholder="20220101" v-model="data.purchaseDate" />
                      </div>
                    </div>
                    <!-- 格付 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="grade">格付*</label>
                      </div>
                      <div class="w-2/3">
                        <select class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="grade" name="grade" v-model="data.grade">
                          <option value="G1">G1</option>
                          <option value="G2">G2</option>
                          <option value="G3">G3</option>
                          <option value="オープン">オープン</option>
                          <option value="3勝">3勝</option>
                          <option value="2勝">2勝</option>
                          <option value="1勝">1勝</option>
                          <option value="未勝利">未勝利</option>
                          <option value="新馬">新馬</option>
                        </select>
                      </div>
                    </div>
                    <!-- 競馬場 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="race-course">競馬場*</label>
                      </div>
                      <div class="w-2/3">
                        <select class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="race-course" name="race-course" v-model="data.raceCourse">
                          <option value="東京">東京</option>
                          <option value="中山">中山</option>
                          <option value="阪神">阪神</option>
                          <option value="京都">京都</option>
                          <option value="中京">中京</option>
                          <option value="札幌">札幌</option>
                          <option value="函館">函館</option>
                          <option value="福島">福島</option>
                          <option value="新潟">新潟</option>
                          <option value="小倉">小倉</option>
                          <option value="地方">地方</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- レース名・コース・距離のブロック-->
                  <div class="mb-3 lg:mb-7 flex items-center">
                    <!-- レース名 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="race-name">レース名*</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="race-name" name="race-name" type="text" placeholder="日本ダービー" v-model="data.raceName" />
                      </div>
                    </div>
                    <!-- コース -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="race-course">コース*</label>
                      </div>
                      <div class="w-2/3">
                        <select class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="course" name="course" v-model="data.course">
                          <option value="芝">芝</option>
                          <option value="ダート">ダート</option>
                        </select>
                      </div>
                    </div>
                    <!-- 距離 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="distance">距離*</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="distance" name="distance" type="number" placeholder="1600" v-model="data.distance" />
                      </div>
                    </div>
                  </div>
                  <!-- 購入金額・払戻金額・収支金額のブロック-->
                  <div class="mb-3 lg:mb-7 flex items-center">
                    <!-- 購入金額-->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="purchase">購入金額*</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase" name="purchase" type="number" placeholder="1000" v-model="data.purchase" />
                      </div>
                    </div>
                    <!-- 払戻金額-->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="return-money">払戻金額*</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="return-money" name="return-money" type="number" placeholder="1000" v-model="data.returnMoney" />
                      </div>
                    </div>
                    <!-- 収支金額-->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="balance">収支金額*</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="balance" name="balance" type="number" placeholder="1000" v-model="data.balance" />
                      </div>
                    </div>
                  </div>
                  <!-- 軸馬・騎手・購入方法のブロック-->
                  <div class="mb-3 lg:mb-7 flex items-center">
                    <!-- 軸馬 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="axis-horse">軸馬</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="axis-horse" name="axis-horse" type="text" placeholder="ディープインパクト" v-model="data.axisHorse" />
                      </div>
                    </div>
                    <!-- 騎手 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="jockey">騎手</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="jockey" name="jockey" type="text" placeholder="武豊" v-model="data.jockey" />
                      </div>
                    </div>
                    <!-- 購入方法 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="purchase-mathod">購入方法</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-mathod" name="purchase-mathod" type="text" placeholder="単複ワイド" v-model="data.purchaseMathod" />
                      </div>
                    </div>     
                  </div>
                  <!-- 父親・母父・コンディションのブロック-->
                  <div class="mb-3 lg:mb-7 flex items-center">
                    <!-- 父親 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="father">父親</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="father" name="father" type="text" placeholder="ディープインパクト" v-model="data.father" />
                      </div>
                    </div>
                    <!-- 母父 -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="mother-father">母父</label>
                      </div>
                      <div class="w-2/3">
                        <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="mother-father" name="mother-father" type="text" placeholder="キングカメハメハ" v-model="data.motherFather" />
                      </div>
                    </div>
                    <!-- コンディション -->
                    <div class="flex w-1/3">
                      <div class="w-1/3">
                        <label class="text-black-400 mb-1 block pr-1 sm:pr-4 text-xxxxs sm:text-sm md:text-base text-right font-bold" for="condition">馬場状態</label>
                      </div>
                      <div class="w-2/3">
                        <select class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-1 px-2 sm:py-2 sm:px-4 leading-tight text-xxxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="condition" name="condition" v-model="data.condition" >
                          <option value="良">良</option>
                          <option value="稍重">稍重</option>
                          <option value="重">重</option>
                          <option value="不良">不良</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" id="purchase-id" name="purchase-id" v-model="data.id" >
                  <!-- 登録ボタンのブロック -->
                  <div class="flex justify-center text-base lg:text-xl">
                    <button class="mt-3 mb-3 rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="confirmUpdateModal">更新</button>
                    <button class="mt-3 mb-3 rounded-full bg-blue-500 py-2 px-4 ml-4 font-bold text-white hover:bg-blue-700" v-on:click="confirmDeleteModal">削除</button>
                    <button class="mt-3 mb-3 rounded-full bg-blue-500 py-2 px-4 ml-4 font-bold text-white hover:bg-blue-700" v-on:click="confirmCloseModal">閉じる</button>
                  </div>
               </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog> 
    </TransitionRoot>
    <!-- 確認ダイアログ -->
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
                  <button type="button" class="inline-flex justify-center rounded-md ml-4 border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2" @click="dataProcess" v-show="data.butonShow" >{{ data.dataProcess }}</button>
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
      purchaseDate: number | string | undefined;
      grade: string | undefined;
      raceCourse: string | undefined;
      raceName: string | undefined;
      course: string | undefined;
      distance: number | string | undefined;
      purchase: number | string | undefined;
      returnMoney: number | string | undefined;
      balance: number | string | undefined;
      axisHorse: string | undefined;
      jockey: string | undefined;
      purchaseMathod: string | undefined;
      father: string | undefined;
      motherFather: string | undefined;
      condition: string | undefined;
      isDataDialogOpen: boolean;
      id: number | string | undefined;
      butonShow: boolean;
      dataProcess: string
    } = reactive({
      dateFrom: "",
      dateTo: "",
      message: "",
      isOpen: false,
      purchaseDate: "",
      grade: "",
      raceCourse: "",
      raceName: "",
      course: "",
      distance: "",
      purchase: "",
      returnMoney: "",
      balance: "",
      axisHorse: "",
      jockey: "",
      purchaseMathod: "",
      father: "",
      motherFather: "",
      condition: "",
      isDataDialogOpen: false,
      id: "",
      butonShow: false,
      dataProcess: ""
    })
    // 関数宣言
    // 確認ダイアログを閉じる処理
    const closeModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isOpen = false
    }

    // 購入情報修正ダイアログを閉じる処理
    const confirmCloseModal = (e: Event) => {
      // デフォルトのイベントをキャンセル
      e.preventDefault()
      data.isDataDialogOpen = false
    }

    // データを取得する処理
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
        userName: sessionStorage.getItem('userName')
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

            // レコード数のループ
            let rowCount = 1
            for (let value of res.data.data) {
              // テーブルに表示する要素
              let tableParantElememt = document.createElement("tr");
              tableParantElememt.setAttribute("id", `row-number-${rowCount}`)
              // レコードごとのループ
              for (let key in value) {
                let talbleChildElement = document.createElement("td");
                talbleChildElement.classList.add("border");
                talbleChildElement.classList.add("px-2");
                talbleChildElement.classList.add("py-2");
                talbleChildElement.classList.add("text-xxxs");
                talbleChildElement.classList.add("sm:text-sm");
                talbleChildElement.classList.add("md:text-base");
                talbleChildElement.setAttribute("id", `key-${key}-${rowCount}`)
                talbleChildElement.onclick = getRowData
                talbleChildElement.innerHTML = value[key];
                switch (key) {
                  case 'race_day':
                    talbleChildElement.classList.add("w-32"); 
                    break
                  case 'race_course':
                  case 'grade':
                    talbleChildElement.classList.add("w-28"); 
                    break
                  case 'race_name':
                    talbleChildElement.classList.add("w-48"); 
                    break
                  case 'purchase_m':
                  case 'return_m':
                  case 'balance_m':
                    talbleChildElement.classList.add("w-24"); 
                    break
                  default:
                    talbleChildElement.style.display = 'none'
                    break
                }
                tableParantElememt.appendChild(talbleChildElement);               
              }
              rowCount = rowCount + 1
              element?.appendChild(tableParantElememt);
            }
          } else {
            data.message = "データの取得に失敗しました"
            data.isOpen = true
          }
        })
    }

    // 行のデータを取得する
    // 型は直したい
    const getRowData = (e: any) => {
      // テーブルのデータを設定
      data.id = e.path[1]?.children.item(0).innerHTML
      data.purchaseDate = e.path[1]?.children.item(1).innerHTML
      data.raceCourse = e.path[1]?.children.item(2)?.innerHTML
      data.grade = e.path[1]?.children.item(3)?.innerHTML
      data.raceName = e.path[1]?.children.item(4)?.innerHTML
      data.course = e.path[1]?.children.item(5)?.innerHTML
      data.distance = e.path[1]?.children.item(6)?.innerHTML
      data.purchase = e.path[1]?.children.item(7)?.innerHTML
      data.returnMoney = e.path[1]?.children.item(8)?.innerHTML
      data.balance = e.path[1]?.children.item(9)?.innerHTML
      data.axisHorse = e.path[1]?.children.item(10)?.innerHTML
      data.jockey = e.path[1]?.children.item(12)?.innerHTML
      data.purchaseMathod = e.path[1]?.children.item(11)?.innerHTML
      data.father = e.path[1]?.children.item(13)?.innerHTML
      data.motherFather = e.path[1]?.children.item(14)?.innerHTML
      data.condition = e.path[1]?.children.item(16)?.innerHTML

      // 購入情報修正ダイアログを表示
      data.isDataDialogOpen = true
    }

    // 更新ボタン押下時の処理
    const confirmUpdateModal = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault();

      data.butonShow = true
      data.dataProcess = "更新"
      data.message ="データを更新しますか？"

      // 確認ダイアログを表示する
      data.isOpen = true
    }

    // 削除ボタン押下時の処理
    const confirmDeleteModal = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault();

      data.butonShow = true
      data.dataProcess = "削除"
      data.message ="データを削除しますか？"

      // 確認ダイアログを表示する
      data.isOpen = true
    }

    // データ操作処理
    const dataProcess = (e: Event) => {
      // 確認ダイアログを閉じる
      data.isOpen = false
      const parameter = {
        id: data.id,
        purchaseDate: data.purchaseDate,
        raceCourse: data.raceCourse,
        grade: data.grade,
        raceName: data.raceName,
        course: data.course,
        distance: data.distance,
        purchase: data.purchase,
        returnMoney: data.returnMoney,
        balance: data.balance,
        axisHorse: data.axisHorse,
        jockey: data.jockey,
        purchaseMathod: data.purchaseMathod,
        father: data.father,
        motherFather: data.motherFather,
        condition: data.condition  
      }

      let process = ""
      if (data.dataProcess === "更新") {
        // 更新処理
        process = "update"
      } else {
        // 削除処理
        process = "delete"
      }

      axios.post(process, parameter).then(res => {
        data.butonShow = false
        data.isDataDialogOpen = false
        if (res.data.result === false) {
          data.message = "処理に失敗しました"
          data.isOpen = true
          return
        }
        data.message = "処理に成功しました"
        data.isOpen = true

        // データを初期化
        data.id = ""
        data.purchaseDate = ""
        data.raceCourse = ""
        data.grade = ""
        data.raceName = ""
        data.course = ""
        data.distance = ""
        data.purchase = ""
        data.returnMoney = ""
        data.balance = ""
        data.axisHorse = ""
        data.jockey = ""
        data.purchaseMathod = ""
        data.father = ""
        data.motherFather = ""
        data.condition = ""
      })

      const readParameter = {
        dateFrom: data.dateFrom,
        dateTo: data.dateTo,
        userName: sessionStorage.getItem('userName')
      }

      // データの再取得
      axios.post("getData", readParameter).then((res) => {

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

          // レコード数のループ
          let rowCount = 1
          for (let value of res.data.data) {
            // テーブルに表示する要素
            let tableParantElememt = document.createElement("tr");
            tableParantElememt.setAttribute("id", `row-number-${rowCount}`)
            // レコードごとのループ
            for (let key in value) {
              let talbleChildElement = document.createElement("td");
              talbleChildElement.classList.add("border");
              talbleChildElement.classList.add("px-2");
              talbleChildElement.classList.add("py-2");
              talbleChildElement.setAttribute("id", `key-${key}-${rowCount}`)
              talbleChildElement.onclick = getRowData
              talbleChildElement.innerHTML = value[key];
              switch (key) {
                case 'race_day':
                  talbleChildElement.classList.add("w-32"); 
                  break
                case 'race_course':
                case 'grade':
                  talbleChildElement.classList.add("w-28"); 
                  break
                case 'race_name':
                  talbleChildElement.classList.add("w-48"); 
                  break
                case 'dirt_or_turf':
                case 'distance':
                case 'purchase_m':
                case 'return_m':
                case 'balance_m':
                  talbleChildElement.classList.add("w-24"); 
                  break
                default:
                  talbleChildElement.style.display = 'none'
                  break
              }
              tableParantElememt.appendChild(talbleChildElement);               
            }
            rowCount = rowCount + 1
            element?.appendChild(tableParantElememt);
          }
        } else {
          data.message = "データの取得に失敗しました"
          data.isOpen = true
        }
      })
    }  

    return {data, closeModal, getData, getRowData, confirmCloseModal, confirmDeleteModal, confirmUpdateModal, dataProcess}
  }
});
</script>