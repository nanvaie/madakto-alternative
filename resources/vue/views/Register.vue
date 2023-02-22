<template>
    <div>
        <div
            style="text-align: center; margin-top: 3em;border: solid;border-width: 0.1px;margin-right: 25%;margin-left: 25%;padding-top: 3em;border-radius: 8px; ">

            <div>
                <label for="full_name" style="font-size: 1em"> {{ $t('full name') }}</label>
            </div>
            <div>
                <input
                    style="width: 75%;border-radius: 5px"
                    type="text"
                    name="full_name"
                    v-model="formData.full_name"
                >
                <p style="color: red" v-text="registerErrors.full_name"></p>
            </div>
            <div>
                <label for="user_name" style="font-size: 1em"> {{ $t('user name') }}</label>
            </div>
            <div>
                <input
                    style="width: 75%;border-radius: 5px"
                    type="text"
                    name="user_name"
                    v-model="formData.user_name"
                >
                <p style="color: red" v-text="registerErrors.user_name"></p>
            </div>
            <div>
                <label style="font-size: 1em">{{ $t('email') }}</label>
            </div>
            <div>
                <input
                    style="width: 75%;border-radius: 5px"
                    type="text"
                    name="email"
                    v-model="formData.email"

                />
                <p style="color: red" v-text="registerErrors.email"></p>
            </div>
            <div>
                <label style="font-size: 1em" for="password">{{ $t('password') }}</label>
            </div>
            <div>
                <input
                    style="width: 75%;border-radius: 5px"
                    type="Password"
                    name="password"
                    v-model="formData.password"
                />
                <p style="color: red" v-text="registerErrors.password"></p>
            </div>
            <div>
                <label style="font-size: 1em" for="confirm_password"
                >{{ $t('confirm password') }}</label>
            </div>
            <div>
                <input
                    style="width: 75%;border-radius: 5px"
                    type="Password"
                    name="confirm_password"
                    v-model="formData.confirm_password"
                />
                <p style="color: red" v-text="registerErrors.confirm_password"></p>
            </div>
            <div>
                <div>
                    <router-link to="/login"
                    >{{ $t('have account') }}
                    </router-link
                    >
                </div>
                <div style="margin-bottom:2em">
                    <button
                        aria-label="button"
                        class="fd-button fd-button--emphasized fd-padding-begin-end--sm fd-margin-top--sm"
                        @click="register_handler"
                    >
                        {{ $t('register') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import {ref} from "vue";
import {useRouter} from "vue-router";

const router = useRouter();

const formData = ref({
    full_name: '',
    email: '',
    password: '',
    confirm_password: '',
    user_name: '',
});

const registerErrors = ref({});


function register_handler() {
    axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
            .post("/api/register", formData.value)
            .then((response) => {
                console.log("register user success");
                router.push({name: 'login'});
            })
            .catch((errors) => {
                registerErrors.value = errors.response.data.errors;
                console.log(errors);
            });
    });
};


</script>
