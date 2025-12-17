import { defineStore } from "pinia";
import instanceAxios from "@/js/configAxios";
export const useListItemStore = defineStore("listItem", {
    state: () => ({
        title: "",
        task_list_id: "",
        isLoading: {
            register: false,
            update: false,
            delete: []
        },
        errors: "",
        status: "pending",
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
                const response = await axios.post("list_item", {
                    title: this.title,
                    task_list_id: this.task_list_id,
                });
                this.title = "";
                this.task_list_id = "";
                this.isLoading.register = false;
            } catch (error) {
                this.errors = error.response?.data?.errors;
                this.isLoading.register = false;
            }
        },
        async read() {
            const axios = await instanceAxios();
            try {
                const response = await axios.get("list_item", {
                    params: {
                        task_list_id: this.task_list_id,
                        status: this.status,
                    },
                });
                this.data = response.data;
            } catch (error) {
                this.errors = error.response?.data?.errors;
            }
        },
        async update(item_id, title) {
            const axios = await instanceAxios();
            this.isLoading.update = true;
            try {
                const response = await axios.patch(`list_item/${item_id}`, {
                    title: title,
                });
                this.title = "";
                this.isLoading.update = false;
            } catch (error) {
                this.errors = error.response?.data?.errors;
                this.isLoading.update = false;
            }
        },
        async delete(task_id) {
            const axios = await instanceAxios();
            this.isLoading.delete[task_id] = true;
            try {
                const response = await axios.delete(`task_list/${task_id}`);
                this.isLoading.delete[task_id] = false;
            } catch (error) {
                this.errors = error.response?.data?.errors;
                this.isLoading.delete[task_id] = false;
            }
        },
    },
});
