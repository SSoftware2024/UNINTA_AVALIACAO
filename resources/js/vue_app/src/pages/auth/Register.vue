<template>
    <div>
        <form @submit.prevent="registerStore.register">
            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="form-label">Nome</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="registerStore.name"
                    />
                </div>

                <div class="text-danger" v-if="registerStore.errors?.name">
                    {{ registerStore.errors.name[0] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        v-model="registerStore.email"
                    />
                </div>
                <div class="text-danger" v-if="registerStore.errors?.email">
                    {{ registerStore.errors.email[0] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="password" class="form-label">Senha</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        v-model="registerStore.password"
                    />
                    <div class="text-danger" v-if="registerStore.errors?.password">
                        {{ registerStore.errors.password[0] }}
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label"
                        >Confirmar senha</label
                    >
                    <input
                        type="password"
                        class="form-control"
                        id="password_confirmation"
                        v-model="registerStore.password_confirmation"
                    />
                </div>
            </div>
            <router-link :to="{ name: 'login' }" class="d-inline-block ">
                Login
            </router-link>
            <Button text="Registrar" type="submit" class="btn btn-primary mt-3 d-block" :isLoading="registerStore.isLoading"></Button>
        </form>
    </div>
</template>
<script setup>
import { useRegisterStore } from "@stores/register";
import Button from "@/components/Button.vue";
import { useRouter } from 'vue-router';
import { onMounted } from "vue";
const router = useRouter();
const registerStore = useRegisterStore();

onMounted(() => {
    registerStore.setRouter(router);
});
</script>
