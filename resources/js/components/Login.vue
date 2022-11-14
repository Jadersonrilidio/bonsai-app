<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        Login
                    </div>

                    <div class="card-body">
                        <form method="POST" action="" @submit.prevent="login($event)">
                            
                            <input type="hidden" name="_token" :value="csrf_token">
    
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" :class="formInputs.email.classes" name="email" required autocomplete="email" autofocus v-model="formInputs.email.value">
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" :class="formInputs.password.classes" name="password" required v-model="formInputs.password.value">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
    
                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
    
                                    <!-- PASSWORD REQUEST ROUTE LINK -->
                                    <a class="btn btn-link" href="#">
                                        Forgot Your Password?
                                    </a>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'csrf_token'
        ],
        data() {
            return {
                formInputs: {
                    email: {
                        classes: '',
                        value: ''
                    },
                    password: {
                        classes: '',
                        value: ''
                    }
                }
            }
        },
        methods: {
            login(event) { 
                let url = this.$store.state.apiauthurl + '/login';

                let formData = new FormData();
                formData.append('email', this.formInputs.email.value);
                formData.append('password', this.formInputs.password.value);

                axios.post(url, formData)
                    .then(response => {
                        document.cookie = 'token=' + response.data.access_token + ';SameSite=Lax';
                        event.target.submit();
                    })
                    .catch(errors => {
                        this.assertFormInputsAtLoginFail();
                    });
            },
            assertFormInputsAtLoginFail() {
                this.formInputs.email.classes = 'is-invalid';
                this.formInputs.password.classes = 'is-invalid';
            }
        }
    }
</script>
