<script setup>
    import { useRouter } from 'vue-router';
    const router = useRouter()

</script>

<template>
    <h1>Registro</h1>
    <a href="#" @click.prevent="router.push({ name: 'login' })">Login</a>
</template>
