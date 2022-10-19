<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    
                    <div class="card-header">
                        Register
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="" @submit.prevent="register($event)">
                            
                            <input type="hidden" name="_token" :value="csrf_token">
    
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control is-invalid" name="name" value="" required autocomplete="name" autofocus v-model="name">
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" v-model="email">
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" v-model="password">
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" v-model="password_confirmation">
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
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
                pathUri: '/api/auth/login',
                formInputs: {
                    name: {
                        classes: '',
                        value: ''
                    },
                    email: {
                        classes: '',
                        value: ''
                    },
                    password: {
                        classes: '',
                        value: ''
                    },
                    password_confirmation: {
                        classes: '',
                        value: ''
                    }
                }
            }
        },
        methods: {
            register(event) { 
                let url = this.$store.state.baseUrl + this.pathUri;

                let formData = new FormData();
                formData.append('name', this.formInputs.name.value);
                formData.append('email', this.formInputs.email.value);
                formData.append('password', this.formInputs.password.value);
                formData.append('password_confirmation', this.formInputs.password_confirmation.value);

                axios.post(url, formData)
                    .then(response => {
                        document.cookie = 'token=' + response.data.access_token + ';SameSite=Lax';
                        event.target.submit();
                    })
                    .catch(errors => {
                        this.assertFormInputsAtLoginFail();
                    });
            },
            assertFormInputsAtRegisterFail() {
                this.formInputs.name.classes = 'is-invalid';
                this.formInputs.email.classes = 'is-invalid';
                this.formInputs.password.classes = 'is-invalid';
                this.formInputs.password_confirmation.classes = 'is-invalid';
            }
        }
    }
</script>
