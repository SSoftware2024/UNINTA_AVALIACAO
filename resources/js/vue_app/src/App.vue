<script setup>
import { useCounterStore } from './stores/counter'
const counter = useCounterStore()

</script>

<template>
  <h1 class="text-primary">Olá bootstrap! Pinia({{ counter.name }} - {{ counter.doubleCount }}): {{ counter.count }}</h1>
  <h2 @click="counter.increment()">Click</h2>
</template>


