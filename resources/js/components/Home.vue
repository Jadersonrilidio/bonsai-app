<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        {{ card.header.text }}
                    </div>
    
                    <div class="card-body">
                        <p> {{ card.body.text }} </p>
                        <hr>
                        
                        <p> You have a total of: </p>
                        <br>
                        <p> Items: {{ plantsCounter.all }} </p>
                        <br>
                        <p> Bonsai: {{ plantsCounter.bonsai }} </p>
                        <br>
                        <p> Pre-bonsai: {{ plantsCounter.preBonsai }} </p>
                        <br>
                        <p> Seedlings: {{ plantsCounter.seedlings }} </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'user'
        ],
        data() {
            return {
                card: {
                    header: {
                        text: 'Welcome back, ' + this.user.name + '!'
                    },
                    body: {
                        text: 'you are logged in'
                    }
                },
                plants: [],
                plantsCounter: {
                    all: 0,
                    bonsai: 0,
                    preBonsai: 0,
                    seedlings: 0
                }
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
