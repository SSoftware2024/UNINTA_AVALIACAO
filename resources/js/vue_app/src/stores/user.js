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
            let user = localStorage.getItem("@user_api");
            if (user) {
                const userData = JSON.parse(user);
                this.name = userData.name;
                this.email = userData.email;
                this.id = userData.id;
                return;
            } else {
                console.log("Fetching user from API");
                const axios = await instanceAxios();
                try {
                    axios({
                        method: "get",
                        url: "user",
                    }).then((response) => {
                        console.log(response.data);
                        localStorage.setItem(
                            "@user_api",
                            JSON.stringify(response.data)
                        );
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
