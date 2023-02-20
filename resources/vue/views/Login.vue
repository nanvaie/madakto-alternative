<!--<template>-->
<!--    <div>-->
<!--        <div class="row justify-content-center w-50 m-auto mt-5">-->
<!--            <div class="col-ml-4">-->
<!--                <div class="card">-->
<!--                    <div class="card-header text-center">-->
<!--                        {{ $t('login form') }}-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <div class="form-group">-->
<!--                            <label for="email"> {{ $t('email') }}</label>-->
<!--                            <input-->
<!--                                v-model="formData.email"-->
<!--                                type="text"-->
<!--                                class="form-control"-->
<!--                                name="email"-->
<!--                            >-->
<!--                            <p class="text-danger mt-1" v-text="errors.email"></p>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="password"> {{ $t('password') }}</label>-->
<!--                            <input-->
<!--                                v-model="formData.password"-->
<!--                                type="password"-->
<!--                                class="form-control"-->
<!--                                name="password"-->
<!--                            >-->
<!--                            <p class="text-danger mt-1" v-text="errors.password"></p>-->
<!--                        </div>-->

<!--                        <div class="form-group ">-->
<!--                            <router-link-->
<!--                                class="float-right"-->
<!--                                :to="{name: 'register'}"-->
<!--                            >-->
<!--                                {{ $t('register') }}-->
<!--                            </router-link>-->
<!--                        </div>-->
<!--                        <div class="form-group ">-->
<!--                            <router-link-->
<!--                                class="float-left"-->
<!--                                to="/forgetPass"-->
<!--                            >-->
<!--                                {{ $t('forget password') }}-->
<!--                            </router-link>-->
<!--                        </div>-->
<!--                        <div class="form-group text-center">-->
<!--                            <button-->
<!--                                class="btn btn-primary text-center"-->
<!--                                @click.prevent="login_handler"-->
<!--                            >-->
<!--                                {{ $t('login') }}-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->
<template>


    <ui5-form style="text-align: center; margin-top: 3em; background-color: red" >
        <div >
            <div class="fd-margin-begin-end--md">
                <ui5-label >{{ $t('email') }}</ui5-label>
            </div>
            <div >
                <ui5-input type="email"/>
            </div>
        </div>
        <div >
            <div>
            <ui5-label class="fd-margin-begin-end--md" >{{ $t('password') }}</ui5-label>
            </div>
        <div>
            <ui5-input type="password"/>
        </div>
        </div>
        <div>
            <ui5-button type="submit" >{{ $t('login') }}</ui5-button>
        </div>
    </ui5-form>



</template>
<script>
import axios from 'axios';


export default {
    data() {
        return {
            formData: {
                email: '',
                password: '',
            },
            errors: {},
        };
    },
    methods: {
        login_handler() {
            axios.get('/sanctum/csrf-cookie').then((response) => {
                axios
                    .post('/api/login', this.formData)
                    .then((response) => {
                        localStorage.setItem('token', response.data.token);
                        localStorage.setItem('user_id', response.data.user_id);
                        localStorage.setItem('name', response.data.user);
                        localStorage.setItem('shift_id', 1);
                        localStorage.setItem('department_id', 1);

                        console.log(response.data.token);

                        this.$router.push({name: 'dashbord'});
                    })
                    .catch((errors) => {
                        // this.errors = errors.response.data.errors;
                        console.log(errors);
                    });
            });
        },
    },
};
</script>

