import { defineStore } from "pinia";
import instanceAxios from "@/js/configAxios";
export const useTaskListStore = defineStore("taskList", {
    state: () => ({
        title: "",
        user_id:''
    }),
    actions: {
        setRouter(router) {
            this.router = router;
        },
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
                let data = response.data;
                console.log(data.token)
                if(data.token){
                    localStorage.setItem('@admin_Token', data.token);
                    this.router.push({ name: 'dashboard' });
                }
            } catch (error) {
                this.errors = error.response?.data?.errors;
                this.isLoading = false;
            }
        },
    },
});
