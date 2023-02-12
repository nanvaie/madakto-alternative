<template>
    <div>
        <div class="row justify-content-center w-50 m-auto mt-5">
            <div class="col-ml-4">
                <div class="card">
                    <div class="card-header text-center">
                        {{ $t('login form') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email"> {{ $t('email') }}</label>
                            <input
                                v-model="formData.email"
                                type="text"
                                class="form-control"
                                name="email"
                            >
                            <p class="text-danger mt-1" v-text="errors.email"></p>
                        </div>
                        <div class="form-group">
                            <label for="password"> {{ $t('password') }}</label>
                            <input
                                v-model="formData.password"
                                type="password"
                                class="form-control"
                                name="password"
                            >
                            <p class="text-danger mt-1" v-text="errors.password"></p>
                        </div>

                        <div class="form-group ">
                            <router-link
                                class="float-right"
                                to="/register"
                            >
                                {{ $t('register') }}
                            </router-link>
                        </div>
                        <div class="form-group ">
                            <router-link
                                class="float-left"
                                to="/forgetPass"
                            >
                                {{ $t('forget password') }}
                            </router-link>
                        </div>
                        <div class="form-group text-center">
                            <button
                                class="btn btn-primary text-center"
                                @click.prevent="login_handler"
                            >
                                {{ $t('login') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
