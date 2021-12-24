<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0">
                    <div class="card-body">
                        <div>
                            <form @submit.prevent="loginAccount()">
                                <div class="mb-3">
                                    <label for="email" class="form-label"
                                        >Email address</label
                                    >
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        v-model="email"
                                        placeholder="name@example.com"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label"
                                        >Password</label
                                    >
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="password"
                                        v-model="password"
                                        placeholder="******"
                                    />
                                </div>
                                <div>
                                    <button
                                        type="submit"
                                        class="btn btn-lg btn-success"
                                    >
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                        <hr />
                        <div>
                            <button
                                @click="authProvider('google')"
                                class="btn btn-lg btn-primary"
                            >
                                Login with Google
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        loginAccount() {
            let frmData = new FormData();
            frmData.append("login", this.email);
            frmData.append("password", this.password);
            frmData.append(
                "redirect_uri",
                "https://fantasy.premierleague.com/a/login"
            );
            frmData.append("app", "plfpl-web");

            axios
                .post(
                    "https://users.premierleague.com/accounts/login/",
                    frmData,
                    {
                        headers: {
                            // remove headers
                        },
                    }
                )
                .then((res) => {
                    console.log(res);
                    if (res.status == 200) {
                        const url = new URL(res.request.responseURL);
                        const urlParams = new URLSearchParams(url.search);
                        const state = urlParams.get("state");
                        const reason = urlParams.get("reason");
                        console.log(state);
                        console.log(reason);
                    }
                })
                .catch((err) => console.log(err));
        },
        authProvider(provider) {
            let self = this;
            this.$auth
                .authenticate(provider)
                .then((response) => {
                    self.socialLogin(provider, response);
                })
                .catch((err) => {
                    console.log({ err: err });
                });
        },
        socialLogin(provider, response) {
            this.$http
                .post("auth/social/" + provider, response)
                .then((response) => {
                    return response.data.token;
                })
                .catch((err) => {
                    console.log({ err: err });
                });
        },
    },
};
</script>
