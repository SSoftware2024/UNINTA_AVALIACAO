import { defineStore } from "pinia";
import instanceAxios from "@/js/configAxios";
export const useLoginStore = defineStore("login", {
    state: () => ({
        name: "",
        email: "",
        password: "",
        errors: "",
        isLoading: false,
        router: null,
    }),
    getters: {
        isAuthenticated: () => localStorage.getItem("@token") !== null,
    },
    actions: {
        setRouter(router) {
            this.router = router;
        },
        async login() {
            const axios = await instanceAxios();
            this.isLoading = true;
            try {
                const response = await axios.post("/login", {
                    email: this.email,
                    password: this.password,
                });
                this.email = "";
                this.password = "";

                // Salvar token retornado da API
                localStorage.setItem("@token", response.data.token);
                this.isLoading = false;
                this.router.push({ name: "dashboard" });
            } catch (error) {
                this.errors = error.response?.data?.errors;
                this.isLoading = false;
            }
        },

        async logout() {
            const axios = await instanceAxios();
            try {
                await axios.post("/logout");
                // Limpa dados locais
                localStorage.removeItem("@token");

                // Resetar store de usuário
                this.name = "";
                this.email = "";
                this.id = "";

                if (this.router) {
                    this.router.push({ name: "login" });
                }
            } catch (error) {
                console.log("Erro ao sair:", error.response?.data || error);
            }
        },
    },
});
