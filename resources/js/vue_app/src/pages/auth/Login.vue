<script setup>
    import { useRouter } from 'vue-router';
    const router = useRouter()

</script>

<template>
    <h1>Login</h1>
    <a href="#" @click.prevent="router.push({ name: 'register' })">Registrar</a>
</template>
