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
        router: null,
    }),
    actions: {
        setRouter(router) {
            this.router = router;
        },

    },
});
