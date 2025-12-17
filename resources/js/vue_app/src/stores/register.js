import { defineStore } from "pinia";
import instanceAxios from "@/js/configAxios";
export const useRegisterStore = defineStore("register", {
    state: () => ({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        errors: "",
        isLoading: false,
    }),
    actions: {
        async register() {
            this.isLoading = true;
            const axios = await instanceAxios();
            try {
                const response = await axios.post("/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                });
                this.isLoading = false;
            } catch (error) {
                this.errors = error.response.data.errors;
                this.isLoading = false;
            }
        },
    },
});
