<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
    
                    <div class="card-body">
                        <form method="POST" action="" @submit.prevent="debugSubmittedData($event)">
                            
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
                                    <!-- <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> -->
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
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        },
        methods: {
            debugSubmittedData(event) {
                console.log(this.name);
                console.log(this.email);
                console.log(this.password);
                console.log(this.password_confirmation);
                console.log(event);

                event.target.submit();
            }
        }
    }
</script>
