<template>
    <div class="container">

        <div v-if="transaction.status" :class="transaction.alert">
            <pre>
                status alert example
                {{ transaction.object }}
            </pre>
        </div>

        <div class="row form-layout justify-content-center">
            <div class="col-md-10">

                <form>

                    <div class="row mb-3">
                        <div class="form-group col-md-4">
                            <img class="img-fluid" src="/images/bonsai-profile-portrait-01.png">
                        </div>
                        <div class="form-group col-md-8">
                            <div class="h-30">
                                <h1 class="form-title">Create new bonsai</h1>
                            </div>
                            <div class="h-40"></div>
                            <div class="h-30">
                                <input class="form-control-file" type="file" required name="main_picture">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input class="form-control" type="text" required placeholder="Name" v-model="plant.name">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Scientific Name</label>
                            <input class="form-control" type="text" placeholder="Ex: Juniperus Procumbens" v-model="plant.specimen">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Style</label>
                            <select class="form-control" required v-model="plant.bonsai_style_id">
                                <option value="" class="default-option">-- Select bonsai style --</option>
                                <option
                                    v-for="style, key in bonsaiStyles"
                                    :key="key"
                                    :value="style.id"
                                >
                                {{ style.title }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-4">
                            <label>Age</label>
                            <input class="form-control" type="date" placeholder="Ex: (mm-dd-YYYY)" v-model="plant.age">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Height</label>
                            <input class="form-control" type="text" placeholder="Ex: 178 (centimeters)" v-model="plant.height">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Classification</label>
                            <select class="form-control" required v-model="plant.plant_classification_id">
                                <option value="" class="default-option">-- Select plant classification --</option>
                                <option
                                    v-for="classification, key in plantClassifications"
                                    :key="key"
                                    :value="classification.id"
                                >
                                {{ classification.title }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="2" v-model="plant.description"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3 justify-content-center ">
                        <div class="form-group col-md-8">
                            <button type="submit" class="btn btn-lg btn-success form-control" @click.prevent="createPlant()">
                                Create
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            
        ],
        data() {
            return {
                bonsaiStyles: [],
                plantClassifications: [],
                plant: {
                    main_picture: null,
                    name: null,
                    specimen: null,
                    bonsai_style_id: '',
                    plant_classification_id: '',
                    age: null,
                    height: null,
                    description: null
                },
                transaction: {
                    status: '',
                    message: '',
                    alert: '',
                    object: {},
                    errors: []
                }
            }
        },
        methods: {
            loadPlantClassification() {
                let url = this.$store.state.baseUrl + '/api/v1/plant-classification';

                axios.get(url)
                    .then(response => {
                        this.plantClassifications = response.data;
                    })
                    .catch(errors => {
                        console.log(errors.reponse);
                    })
            },
            loadBonsaiStyles() {
                let url = this.$store.state.baseUrl + '/api/v1/bonsai-style';

                axios.get(url)
                    .then(response => {
                        this.bonsaiStyles = response.data;
                    })
                    .catch(errors => {
                        console.log(errors.reponse);
                    })
            },
            createPlant() {
                let url = this.$store.state.baseUrl + '/api/v1/plant';
                let formData = new FormData();

                Object.keys(this.plant).forEach(attribute => {
                    if (this.plant[attribute])
                        formData.append(attribute, this.plant[attribute]);
                });

                axios.post(url, formData)
                    .then(response => {
                        this.transaction.status = 'success';
                        this.transaction.message = 'New bonsai created';
                        this.transaction.alert = 'success';
                        this.transaction.object = response.data;
                        console.log(response);
                    })
                    .catch(errors => {
                        this.transaction.status = 'error';
                        this.transaction.message = 'error';
                        this.transaction.alert = 'danger';
                        this.transaction.errors = errors.response.data.errors;
                        console.log(errors.response);
                    })
            }
        },
        mounted() {
            this.loadBonsaiStyles();
            this.loadPlantClassification();
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
    .form-title {
        text-align: center;
        padding-bottom: 20px;
        padding-top: 20px;
    }
    .h-30 {
        height: 30%;
    }
    .h-40 {
        height: 40%;
    }
    .default-option {
        color: gray;
        font-style: italic;
    }
    .success {
        background-color: greenyellow;
    }
    .danger {
        background-color: lightcoral;
    }
</style>