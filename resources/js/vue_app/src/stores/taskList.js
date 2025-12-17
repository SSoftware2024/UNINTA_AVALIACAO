import { defineStore } from "pinia";
import instanceAxios from "@/js/configAxios";
export const useTaskListStore = defineStore("taskList", {
    state: () => ({
        title: "",
        user_id: "",
        isLoading: {
            register: false,
            update: false,
        },
        errors: "",
        data: [],
    }),
    actions: {
        setRouter(router) {
            this.router = router;
        },
        async register() {
            this.isLoading.register = true;
            const axios = await instanceAxios();
            try {
                const response = await axios.post("task_list/create", {
                    title: this.title,
                    user_id: this.user_id,
                });
                this.title = "";
                this.user_id = "";
                this.isLoading.register = false;
            } catch (error) {
                this.errors = error.response?.data?.errors;
                this.isLoading.register = false;
            }
        },
        async read() {
            const axios = await instanceAxios();
            try {
                const response = await axios.get("task_list/read", {
                    params: {
                        user_id: this.user_id,
                    },
                });
                this.data = response.data;
            } catch (error) {
                this.errors = error.response?.data?.errors;
            }
        },
        async update(task_id, title) {
            const axios = await instanceAxios();
            this.isLoading.update = true;
            try {
                const response = await axios.patch("task_list/update", {
                    id: task_id,
                    title: title,
                });
                this.title = "";
                this.isLoading.update = false;
            } catch (error) {
                this.errors = error.response?.data?.errors;
                this.isLoading.update = false;
            }
        },
    },
});
