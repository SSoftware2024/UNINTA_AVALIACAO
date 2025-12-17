<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ userStore.name }}</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" to="dashboard">Lista</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="_logout">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <router-view></router-view>
    </div>
</template>

<script setup>
import { useLoginStore } from "@stores/login";
import { useUserStore } from "@stores/user";
import { onMounted } from "vue";
import { useRouter } from 'vue-router';
const userStore = useUserStore();
const loginStore = useLoginStore();
const router = useRouter();

function _logout() {
    loginStore.logout();
}

onMounted(() => {
    loginStore.setRouter(router);
    if(!loginStore.isAuthenticated) {
        router.push({ name: 'login' });
    }
});
</script>

<style scoped>
.content {
    padding: 10px;
}
</style>
