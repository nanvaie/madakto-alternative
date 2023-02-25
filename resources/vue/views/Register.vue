<template>

    <div style="margin-right: 25%;margin-left:25%;margin-top: 10%">

        <form class="fd-card sap-overflow-hidden sap-padding"  @submit.prevent="submit" >
            <div class="fd-form-header sap-flex--center " >
                <span class="fd-form-header__text">{{ $t('register form') }}</span>
            </div>
            <div class="fd-margin--lg">
                <div class="fd-form-item">

                    <label class="fd-form-label" for="full_name" style="font-size: 1em"> {{ $t('full name') }}</label>
                    <input
                        class="fd-input"
                        type="text"
                        name="full_name"
                        v-model="formData.full_name"
                    >
                    <p style="color: red" v-text="registerErrors.full_name"></p>
                </div>


                <div class="fd-form-item">
                    <label class="fd-form-label" for="user_name" style="font-size: 1em"> {{ $t('user name') }}</label>
                    <input
                        class="fd-input"
                        type="text"
                        name="user_name"
                        v-model="formData.user_name"
                    >
                    <p style="color: red" v-text="registerErrors.user_name"></p>
                </div>
                <div class="fd-form-item">
                    <label class="fd-form-label" style="font-size: 1em">{{ $t('email') }}</label>
                    <input
                        class="fd-input"
                        type="text"
                        name="email"
                        v-model="formData.email"

                    />
                    <p style="color: red" v-text="registerErrors.email"></p>
                </div>
                <div class="fd-form-item fd-margin-top--sm">
                    <label class="fd-form-label">{{ $t('password') }}</label>
                    <div class="fd-input-group">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            class="fd-input fd-input-group__input"
                            v-model="formData.password"
                            required
                        />
                        <span
                            class="fd-input-group__addon cursor-pointer"
                            @click="toggleShowPassword"
                        >
                                <span
                                    :class="
                                        showPassword
                                            ? 'sap-icon--hide'
                                            : 'sap-icon--show'
                                    "

                                ></span>
                             </span>
                    </div>
                        <p style="color: red" v-text="registerErrors.password"></p>

                    </div>
                <div class="fd-form-item fd-margin-top--sm">
                    <label class="fd-form-label">{{ $t('confirm password') }}</label>
                    <div class="fd-input-group">
                        <input
                            :type="showConfirmPassword ? 'text' : 'password'"
                            class="fd-input fd-input-group__input"
                            name="confirm_password"
                            v-model="formData.confirm_password"
                            required
                        />
                        <span
                            class="fd-input-group__addon cursor-pointer"
                            @click="toggleShowConfirmPassword"
                        >
                                <span
                                    :class="
                                        showConfirmPassword
                                            ? 'sap-icon--hide'
                                            : 'sap-icon--show'
                                    "

                                ></span>
                             </span>

                    </div>
                    <p style="color: red" v-text="registerErrors.confirm_password"></p>
                </div>


                <div class="fd-form-item">
                    <div style="margin-bottom:2em" class="fd-form-item">
                        <button
                            aria-label="button"
                            class="fd-button fd-button--emphasized fd-padding-begin-end--sm fd-margin-top--sm"
                            @click="register_handler"
                        >
                            {{ $t('register') }}
                        </button>
                        <div>
                            <router-link to="/login" class="fd-link fd-margin-top--sm"
                            >{{ $t('have account') }}
                            </router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import axios from "axios";
import {ref} from "vue";
import {useRouter} from "vue-router";

const router = useRouter();
const showConfirmPassword=ref(true);
const showPassword=ref(true);

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

function toggleShowPassword() {
    showPassword.value = !showPassword.value;
}
function toggleShowConfirmPassword() {
    showConfirmPassword.value = !showConfirmPassword.value;
}
</script>
