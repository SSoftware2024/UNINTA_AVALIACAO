import { defineStore } from "pinia";
import instanceAxios from "@/js/configAxios";
export const useLoginStore = defineStore("login", {
    state: () => ({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        errors: "",
        isLoading: false,
        router: null,
    }),
    actions: {
        setRouter(router) {
            this.router = router;
        },
        async logout() {
            const axios = await instanceAxios();
            try {
                await axios.post("/logout");
                // Limpa dados locais
                localStorage.removeItem("@admin_Token");
                localStorage.removeItem("@user_api");

                // Resetar store de usuário
                this.name = "";
                this.email = "";
                this.id = "";


                if (this.router) {
                    this.router.push({name: 'login'});
                }
            } catch (error) {
                console.log("Erro ao sair:", error.response?.data || error);
            }
        },
    },
});
