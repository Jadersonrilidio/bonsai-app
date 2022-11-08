<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
    
                    <div class="card-header nav">
                            <div class="col-md-6">
                                <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" :class="navlinkIsActive(null)" @click.prevent="filterByPlantClassification(null)">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" :class="navlinkIsActive(1)" @click.prevent="filterByPlantClassification(1)">Bonsai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" :class="navlinkIsActive(2)" @click.prevent="filterByPlantClassification(2)">Pre-bonsai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" :class="navlinkIsActive(3)" @click.prevent="filterByPlantClassification(3)">Seedlings</a>
                                </li>
                            </ul>
                            </div>
                            <div class="col-md-6">
                                <li class="nav-item">
                                    <a class="btn btn-sm btn-primary" style="float:right" :href="plantCreateUrl">Create bonsai</a>
                                </li>
                            </div>
                    </div>

                    <div class="card-body">
                        <plant-card-component :plant="plant"></plant-card-component>
                        <plant-card-component :plant="plant"></plant-card-component>
                        <plant-card-component :plant="plant"></plant-card-component>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-sm btn-primary" style="float:right" :href="plantCreateUrl">Create bonsai</a>
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
                plantCreateUrl: this.$store.state.baseUrl + '/plant/create',
                plant: {
                    name: 'Junípero',
                    specimen: 'Juniperus Procumbens',
                    main_picture: 'oKGHIjJ8t4UsR8EFUtuDfQGIhpFxFahFH32E8caS.jpg',
                    type: 'Bonsai',
                    style: 'tree-over-rock',
                    age: '23',
                    height: '50',
                    description: 'Juniperus over rock is so cool and bla bla bla and much more text and words and nothing makes sense anymore and so and so'
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

                if (this.$store.state.plantClassificationId)
                    url = url + '?filter=plant_classification_id:=:' + this.$store.state.plantClassificationId;

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
            },
            filterByPlantClassification(id) {
                this.$store.state.plantClassificationId = id;
                this.loadUserPlants();
            },
            navlinkIsActive(value) {
                return (this.$store.state.plantClassificationId == value)
                    ? 'active'
                    : '';
            }
        },
        mounted() {
            this.loadUserPlants();
        }
    }
</script>
