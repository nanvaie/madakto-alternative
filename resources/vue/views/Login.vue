<template>

    <div  style="margin-right: 25%;margin-left:25%;margin-top: 10%" >

            <div class="fd-card sap-overflow-hidden sap-padding">
                <div class="fd-margin--lg">
                    <div class="fd-form-item">
                        <label class="fd-form-label">{{ $t('email') }}</label>
                        <input class="fd-input" v-model="formData.email" required />
                        <p style="color: red" >{{loginErrors.email}}</p>
                    </div>

                    <div class="fd-form-item fd-margin-top--sm">
                        <label class="fd-form-label">{{ $t('password') }}</label>

                            <input
                                class="fd-input fd-input-group__input"
                                v-model="formData.password"
                                required
                            />
                            <p  style="color: red" >{{loginErrors.password}}</p>
                            <p style="color: red" >{{responseErrore}}</p>

                    </div>
                    <button
                        type="submit"
                        class="fd-col--12 fd-button fd-button--emphasized fd-margin-top--sm"
                        @click="login_handler"
                    >
                        {{ $t('login') }}
                    </button>

                    <router-link class="fd-link fd-margin-top--sm" to="/register" style="font-size: 1em"
                    >{{ $t('have account') }}
                    </router-link>
                </div>
            </div>

    </div>

</template>
<script setup>
import axios from 'axios';
import {reactive, ref} from 'vue';
import {useRouter} from "vue-router";

const router = useRouter();
const formData = ref({
    email: '',
    password: '',
});
const loginErrors = ref({});
const responseErrore = ref('');

function login_handler() {
    axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post('/api/login', formData.value)
            .then((response) => {
                localStorage.setItem('token', response.data.token);
                localStorage.setItem('user_id', response.data.user_id);
                localStorage.setItem('name', response.data.user);
                localStorage.setItem('shift_id', 1);
                localStorage.setItem('department_id', 1);

                console.log(response.data.token);
                console.log(response);

                router.push({name: 'test'});
            })
            .catch((errors) => {
                if (errors.response.data.errors) {
                    loginErrors.value = errors.response.data.errors;
                } else {
                    responseErrore.value = errors.response.data;
                    loginErrors.value ='';
                }
            });
    });
}


</script>

