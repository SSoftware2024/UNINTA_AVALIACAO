<template>
    <div>
        <form @submit.prevent="_submitLogin">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="loginStore.email"
                />
                <div class="text-danger" v-if="loginStore.errors?.email">
                    {{ loginStore.errors.email[0] }}
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"
                    >Senha</label
                >
                <input
                    type="password"
                    class="form-control"
                    id="exampleInputPassword1"
                    v-model="loginStore.password"
                />
                <div class="text-danger" v-if="loginStore.errors?.password">
                    {{ loginStore.errors.password[0] }}
                </div>
            </div>
            <router-link :to="{ name: 'register' }" class="d-block">
                Registrar
            </router-link>
            <Button
                type="submit"
                class="btn btn-primary mt-3"
                text="Entrar"
                :isLoading="loginStore.isLoading"
            >
                Entrar
            </Button>
        </form>
    </div>
</template>

<script setup>
import Button from "@/components/Button.vue";
import axio from "axios";
import { onMounted } from "vue";
import { useLoginStore } from "@stores/login";
import { useRouter } from "vue-router";
const loginStore = useLoginStore();
const router = useRouter();
async function _submitLogin() {
    loginStore.login();
}

async function _getCSRFToken() {
    axio.defaults.baseURL = "http://localhost:8000";
    axio.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    await axio.get("/sanctum/csrf-cookie");
}

onMounted(() => {
    _getCSRFToken();
    loginStore.setRouter(router);
});
</script>
