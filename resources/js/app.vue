<template>
  <div class="w-full h-full">
    <div class="flex flex-row h-full">
      <router-view></router-view>
      <router-view name="contents"></router-view>
    </div>
  </div>
</template>

<script lang="ts">
import { logicalExpression } from "@babel/types"
import { defineComponent, ref } from "vue"
export default {
    //  setup(){
    //     const login = (e: Event) => {
    //       // デフォルトイベントをキャンセル
    //       console.log("a")
    //       e.preventDefault()
    //       window.alert("a")
    //     }
    // }
    data() {
      return {
        name1: '',
        password: '',
      }
    },
    methods: {
      login(e: Event): void {
        // デフォルトのイベントをキャンセルする
        e.preventDefault()
      }
    }
}
</script>