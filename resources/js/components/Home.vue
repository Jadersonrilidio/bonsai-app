<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card text-center">
    
                    <div class="card-body">
                        
                        <h5 class="card-title">
                            {{ card.title }}
                        </h5>
                        
                        <h6 class="card-subtitle">
                            {{ card.subtitle }}
                        </h6>

                        <p class="card-text">Plants: {{ plantsCounter.all }}</p>
                        <p class="card-text">Bonsai: {{ plantsCounter.bonsai }}</p>
                        <p class="card-text">Pre-bonsai: {{ plantsCounter.preBonsai }}</p>
                        <p class="card-text">Seedlings: {{ plantsCounter.seedlings }}</p>

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
                let url = this.$store.state.baseUrl + '/api/v1/plant';

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
