import { defineStore } from "pinia";
import instanceAxios from "@/js/configAxios";
export const useUserStore = defineStore("user", {
    state: () => ({
        name: "",
        id: "",
        email: "",
        router: null,
    }),
    actions: {
        setRouter(router) {
            this.router = router;
        },
        async getUser() {
            let user = sessionStorage.getItem("user");

            if (user) {
                user = JSON.parse(user);
                this.name = user.name;
                this.email = user.email;
                this.id = user.id;
            } else {
                const axios = await instanceAxios();
                try {
                    axios({
                        method: "get",
                        url: "user",
                    }).then((response) => {
                        sessionStorage.setItem("user", JSON.stringify(response.data));
                        this.name = response.data.name;
                        this.email = response.data.email;
                        this.id = response.data.id;
                    });
                } catch (error) {
                    console.log(error);
                }
            }
        },
    },
});
