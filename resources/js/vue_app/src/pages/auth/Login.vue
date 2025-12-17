<template>
    <div>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                />
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"
                    >Senha</label
                >
                <input
                    type="password"
                    class="form-control"
                    id="exampleInputPassword1"
                />
            </div>
            <router-link :to="{ name: 'register' }" class="d-block">
                Registrar
            </router-link>
            <button type="submit" @click.prevent="submitLogin" class="btn btn-primary mt-3">Entrar</button>
        </form>
    </div>
</template>

<script setup>
import instanceAxios from '@/js/configAxios';


async function submitLogin() {
    const axios = await instanceAxios();
    axios
        .get("teste")
        .then((response) => {
            console.log(response.data);
        })
        .catch((error) => {
            console.error(error);
        });
}
</script>
