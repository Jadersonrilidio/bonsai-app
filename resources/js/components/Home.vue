<template>
    <div class="container">
        <div class="row form-layout justify-content-center">
            <div class="col-md-10 text-center">

                <h3 class="mb-5">
                    {{ card.title }}
                </h3>
                
                <div class="row justify-content-center">

                    <div class="card" style="width: 10rem; margin-right:30px">
                        <img src="/images/bonsai-vector.png" class="card-img-top">
                        <div class="card-body" style="color:#198754; font-weight:bolder">
                            <h5 class="card-title">Bonsai</h5>
                            <p class="card-text">{{ plantsCounter.bonsai }}</p>
                        </div>
                    </div>
    
                    <div class="card" style="width: 10rem;">
                        <img src="/images/pre-bonsai-vector.png" class="card-img-top">
                        <div class="card-body" style="color:#ffcc00; font-weight:bolder">
                            <h5 class="card-title">Pre-bonsai</h5>
                            <p class="card-text">{{ plantsCounter.preBonsai }}</p>
                        </div>
                    </div>
    
                    <div class="card" style="width: 10rem; margin-left:30px">
                        <img src="/images/seedling-vector3.png" class="card-img-top">
                        <div class="card-body" style="color:#6c757d; font-weight:bolder">
                            <h5 class="card-title">Seedlings</h5>
                            <p class="card-text">{{ plantsCounter.seedlings }}</p>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'userid',
            'username'
        ],
        data() {
            return {
                card: {
                    title: 'Welcome back, ' + this.username + '!',
                    subtitle: 'You have a total of: ',
                },
                plants: [],
                plantsCounter: {
                    all: 0,
                    bonsai: 0,
                    preBonsai: 0,
                    seedlings: 0
                },
                link: this.$store.state.baseUrl + '/plant',
            }
        },
        methods: {
            loadUserPlants() {
                let url = this.$store.state.apiurl + '/plant';

                axios.get(url)
                    .then(response => {
                        this.plants = response.data;
                        this.counterPlants();
                    })
                    .catch(errors => {
                        console.log(errors.response);
                    });
                
            },
            counterPlants() {
                this.plants.forEach(plant => {
                    this.plantsCounter.all++;

                    switch (plant.plant_classification_id) {
                        case 1:
                            this.plantsCounter.bonsai++;
                            break;
                        case 2:
                            this.plantsCounter.preBonsai++;
                            break;
                        case 3:
                            this.plantsCounter.seedlings++;
                            break;
                    }
                });
            }
        },
        mounted() {
            this.loadUserPlants();
        }
    }
</script>

<style>
    .form-layout {
        background-color: rgb(229, 235, 229);
        border-radius: 20px;
        margin: 10px auto;
        padding-top: 20px;
        padding-bottom: 50px;
        max-width: 80%;
    }
</style>