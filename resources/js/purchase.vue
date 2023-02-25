<template>
  <div class="w-full h-full lg:w-5/6 lg:inline-block lg:align-top">
    <h5 class="p-3 text-2xl font-bold">購入情報入力</h5>
    <form>
      <!-- 購入日・格付・競馬場のブロック-->
      <div class="mb-7 flex items-center">
        <!-- 購入日 -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-right text-xxxs sm:text-sm md:text-base font-bold" for="purchase-date">購入日*</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-date" name="purchase-date" type="number" placeholder="20220101" v-model="data.purchaseDate" />
          </div>
        </div>
        <!-- 格付 -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="grade">格付*</label>
          </div>
          <div class="w-2/3">
            <select class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="grade" name="grade" v-model="data.grade">
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
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="race-course">競馬場*</label>
          </div>
          <div class="w-2/3">
            <select class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="race-course" name="race-course" v-model="data.raceCourse">
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
              <option value="海外">海外</option>
            </select>
          </div>
        </div>
      </div>
      <!-- レース名・コース・距離のブロック-->
      <div class="mb-7 flex items-center">
        <!-- レース名 -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="race-name">レース名*</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="race-name" name="race-name" type="text" placeholder="日本ダービー" v-model="data.raceName" />
          </div>
        </div>
        <!-- コース -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="race-course">コース*</label>
          </div>
          <div class="w-2/3">
            <select class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="course" name="course" v-model="data.course">
              <option value="芝">芝</option>
              <option value="ダート">ダート</option>
              <option value="障害">障害</option>
            </select>
          </div>
        </div>
        <!-- 距離 -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="distance">距離*</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="distance" name="distance" type="number" placeholder="1600" v-model="data.distance" />
          </div>
        </div>
      </div>
      <!-- 購入金額・払戻金額・収支金額のブロック-->
      <div class="mb-7 flex items-center">
        <!-- 購入金額-->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-right font-bold text-xxxs sm:text-sm md:text-base" for="purchase">購入金額*</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-basetext-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase" name="purchase" type="number" placeholder="1000" v-model="data.purchase" />
          </div>
        </div>
        <!-- 払戻金額-->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="return-money">払戻金額*</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="return-money" name="return-money" type="number" placeholder="1000" v-model="data.returnMoney" />
          </div>
        </div>
        <!-- 収支金額-->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="balance">収支金額*</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="balance" name="balance" type="number" placeholder="1000" v-model="data.balance" />
          </div>
        </div>
      </div>
      <!-- 軸馬・騎手・購入方法のブロック-->
      <div class="mb-7 flex items-center">
        <!-- 軸馬 -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="axis-horse">軸馬</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="axis-horse" name="axis-horse" type="text" placeholder="ディープインパクト" v-model="data.axisHorse" />
          </div>
        </div>
        <!-- 騎手 -->
        <div class="flex w-1/3">
         <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="jockey">騎手</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="jockey" name="jockey" type="text" placeholder="武豊" v-model="data.jockey" />
          </div>
        </div>
        <!-- 購入方法 -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="purchase-mathod">購入方法</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="purchase-mathod" name="purchase-mathod" type="text" placeholder="単複ワイド" v-model="data.purchaseMathod" />
          </div>
        </div>     
      </div>
      <!-- 父親・母父・コンディションのブロック-->
      <div class="mb-7 flex items-center">
        <!-- 父親 -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="father">父親</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="father" name="father" type="text" placeholder="ディープインパクト" v-model="data.father" />
          </div>
        </div>
        <!-- 母父 -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="mother-father">母父</label>
          </div>
          <div class="w-2/3">
            <input class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="mother-father" name="mother-father" type="text" placeholder="キングカメハメハ" v-model="data.motherFather" />
        </div>
        </div>
        <!-- コンディション -->
        <div class="flex w-1/3">
          <div class="w-1/3">
            <label class="text-black-400 mb-1 block pr-4 text-xxxs sm:text-sm md:text-base text-right font-bold" for="condition">馬場状態</label>
          </div>
          <div class="w-2/3">
            <select class="w-full appearance-none rounded border-2 border-gray-200 bg-gray-200 py-2 px-4 leading-tight text-xxxs sm:text-sm md:text-base text-gray-700 focus:border-purple-500 focus:bg-white focus:outline-none" id="condition" name="condition" v-model="data.condition" >
              <option value="良">良</option>
              <option value="稍重">稍重</option>
              <option value="重">重</option>
              <option value="不良">不良</option>
            </select>
          </div>
        </div>
      </div>
      <!-- 登録ボタンのブロック -->
      <div class="flex justify-center text-xl">
        <button class="mt-3 mb-3 rounded-full bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700" v-on:click="openModal">登録</button>
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
                        <button type="button" v-show="data.isEntry" class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2" @click="entry">OK</button>
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
import { defineComponent, reactive  } from "vue";
import axios from "axios";
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, } from '@headlessui/vue';

export default defineComponent({
  components: { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle },
  setup() {
    // 変数宣言
    const data: {
      purchaseDate: number | string;
      grade: string;
      raceCourse: string;
      raceName: string;
      course: string;
      distance: number | string;
      purchase: number | string;
      returnMoney: number | string;
      balance: number | string;
      axisHorse: string;
      jockey: string;
      purchaseMathod: string;
      father: string;
      motherFather: string;
      condition: string;
      errorMessage: string;
      message: string;
      isOpen: boolean;
      isEntry: boolean;
      userName: string;
      errorFlag: boolean;
    } = reactive({
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
      errorMessage: "",
      message: "",
      isOpen: false,
      isEntry: true,
      userName: "",
      errorFlag: false
    })
    // 関数宣言
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

      // エラーメッセージ初期化
      data.message = ""

      // エラーフラグをfalseに設定
      data.errorFlag = false

      // 必須チェック
      if (data.purchaseDate == null || data.purchaseDate == "") {
        data.message = "購入日が設定されていません"
        data.isOpen = true
        return
      }
      if (data.grade == null || data.grade == "") {
        data.message = "格付が設定されていません"
        data.isOpen = true
        return
      }
      if (data.raceCourse == null || data.raceCourse == "") {
        data.message = "競馬場が設定されていません"
        data.isOpen = true
        return
      }
      if (data.raceName == null || data.raceName === "") {
        data.message = "レース名が設定されていません"
        data.isOpen = true
        return
      }
      if (data.course == null || data.course === "") {
        data.message = "芝・ダが設定されていません"
        data.isOpen = true
        return
      }
      if (data.distance == null || data.distance == "") {
        data.message = "距離が設定されていません"
        data.isOpen = true
        return
      }
      if (data.purchase == null || data.purchase == "") {
        data.message = "購入金額が設定されていません"
        data.isOpen = true
        return
      }
      if (data.returnMoney == null || data.returnMoney === "") {
        data.message = "払戻金額が設定されていません"
        data.isOpen = true
        return
      }
      if (data.balance == null || data.balance === "") {
        data.message = "収支金額が設定されていません"
        data.isOpen = true
        return
      }

      // 購入日の桁数チェック
      if (data.purchaseDate !== "" && typeof data.purchaseDate === "number" && data.purchaseDate.toString().length !== 8) {
        data.message = "購入日の入力形式が正しくありません"
        data.isOpen = true
        return
      }

      // ダイアログのメッセージを設定
      data.message = "データを登録しますか？"
      // データ登録フラグをtrueに設定
      data.errorFlag = true
      // ダイアログを表示
      data.isOpen = true

    }

    const entry = (e: Event) => {
      // デフォルトのイベントをキャンセルする
      e.preventDefault()

      // ダイアログを閉じる
      data.isOpen = false
 
      if (data.errorFlag === false) {
        // エラーフラグが立っている時は処理をしない
        return
      }

      // 登録情報を設定
      const parameter = {
        purchaseDate: data.purchaseDate,
        grade: data.grade,
        raceCourse: data.raceCourse,
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
        condition: data.condition,
        userName: sessionStorage.getItem('userName')
      }

      // データ登録処理
      axios.post("entry", parameter).then((res) => {
        // ダイアログのメッセージを設定
        data.message = "データの登録に失敗しました"
        if(res.data.result === true) {
          // メールの送信に成功した場合  
          data.purchaseDate = ""
          data.grade = ""
          data.raceCourse = ""
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
          data.message = "データの登録に成功しました"
        }

        data.isEntry = false

        // ダイアログを開く
        data.isOpen = true
      })
    }

    return { data, closeModal, openModal, entry }
  }
})
</script>