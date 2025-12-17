import { defineStore } from "pinia";
import instanceAxios from "@/js/configAxios";
export const useTaskListStore = defineStore("taskList", {
    state: () => ({
        title: "",
        user_id:'',
        isLoading: {
            register: false,
        },
        errors: "",
    }),
    actions: {
        setRouter(router) {
            this.router = router;
        },
        async register() {
            this.isLoading.register = true;
            const axios = await instanceAxios();
            try {
                const response = await axios.post("/task_list/create", {
                    title: this.title,
                    user_id: this.user_id,
                });
                this.title = "";
                this.user_id = '';
                this.isLoading.register = false;

            } catch (error) {
                this.errors = error.response?.data?.errors;
                this.isLoading.register = false;
            }
        },
    },
});
