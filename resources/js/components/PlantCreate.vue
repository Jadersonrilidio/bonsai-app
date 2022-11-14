<template>
    <div class="container">

        <div class="alert alert-success text-center" v-if="transaction.alert"> 
            {{ transaction.message }}
            <a class="btn" :href="plantViewLink">
                Click to view
            </a>
        </div>

        <div class="row form-layout justify-content-center">
            <div class="col-md-10">
                <form>

                    <div class="row mb-3">
                        <div class="form-group col-md-4">
                            <img class="img-fluid" :src="previewImg">
                        </div>

                        <div class="form-group col-md-8">
                            <div class="h-30">
                                <h1 class="form-title">Create new bonsai</h1>
                            </div>
                            <div class="h-40"></div>
                            <div class="h-30 form-group">
                                <input class="form-control-file" :class="invalidateUpload()" type="file" ref="fileInput" @input="pickFile">
                                <span class="invalid-feedback" role="alert">
                                    <i v-for="message, key in transaction.errors.main_picture" :key="key">
                                        {{ message }}
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input class="form-control" :class="invalidate('name')" type="text" required placeholder="Name" v-model="plant.name">
                            <span class="invalid-feedback" role="alert">
                                <i v-for="message, key in transaction.errors.name" :key="key">
                                    {{ message }}
                                </i>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Scientific Name</label>
                            <input class="form-control" :class="invalidate('specimen')" type="text" placeholder="Ex: Juniperus Procumbens" v-model="plant.specimen">
                            <span class="invalid-feedback" role="alert">
                                <i v-for="message, key in transaction.errors.specimen" :key="key">
                                    {{ message }}
                                </i>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Style</label>
                            <select class="form-control" :class="invalidate('bonsai_style_id')" required v-model="plant.bonsai_style_id">
                                <option value="" class="default-option">-- Select bonsai style --</option>
                                <option
                                    v-for="style, key in bonsaiStyles"
                                    :key="key"
                                    :value="style.id"
                                >
                                {{ style.title }}
                                </option>
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <i v-for="message, key in transaction.errors.bonsai_style_id" :key="key">
                                    {{ message }}
                                </i>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-4">
                            <label>Age</label>
                            <input class="form-control" :class="invalidate('age')" type="date" placeholder="Ex: (mm-dd-YYYY)" v-model="plant.age">
                            <span class="invalid-feedback" role="alert">
                                <i v-for="message, key in transaction.errors.age" :key="key">
                                    {{ message }}
                                </i>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Height</label>
                            <input class="form-control" :class="invalidate('height')" type="text" placeholder="Ex: 178 (centimeters)" v-model="plant.height">
                            <span class="invalid-feedback" role="alert">
                                <i v-for="message, key in transaction.errors.height" :key="key">
                                    {{ message }}
                                </i>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Classification</label>
                            <select class="form-control" :class="invalidate('plant_classification_id')" required v-model="plant.plant_classification_id">
                                <option value="" class="default-option">-- Select plant classification --</option>
                                <option
                                    v-for="classification, key in plantClassifications"
                                    :key="key"
                                    :value="classification.id"
                                >
                                {{ classification.title }}
                                </option>
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <i v-for="message, key in transaction.errors.plant_classification_id" :key="key">
                                    {{ message }}
                                </i>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" :class="invalidate('description')" rows="2" v-model="plant.description"></textarea>
                            <span class="invalid-feedback" role="alert">
                                <i v-for="message, key in transaction.errors.description" :key="key">
                                    {{ message }}
                                </i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="row mb-3 justify-content-center">
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
                pictureUrl: null,
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
                    alert: false,
                    message: '',
                    object: {},
                    errors: [],
                }
            }
        },
        methods: {
            loadPlantClassification() {
                let url = this.$store.state.apiurl + '/plant-classification';

                axios.get(url)
                    .then(response => {
                        this.plantClassifications = response.data;
                    })
                    .catch(errors => {
                        console.log(errors.reponse);
                    })
            },
            loadBonsaiStyles() {
                let url = this.$store.state.apiurl + '/bonsai-style';

                axios.get(url)
                    .then(response => {
                        this.bonsaiStyles = response.data;
                    })
                    .catch(errors => {
                        console.log(errors.reponse);
                    })
            },
            createPlant() {
                let url = this.$store.state.apiurl + '/plant';
                let formData = new FormData();

                Object.keys(this.plant).forEach(attribute => {
                    if (this.plant[attribute])
                        formData.append(attribute, this.plant[attribute]);
                });

                axios.post(url, formData)
                    .then(response => {
                        this.resetTransactionValues();
                        this.transactionSuccess(response);
                        this.resetFormInputValues();
                        console.log(response);
                    })
                    .catch(errors => {
                        this.resetTransactionValues();
                        this.transactionError(errors.response);
                        console.log(errors.response);
                    })
            },
            pickFile() {
                this.plant.main_picture = this.$refs.fileInput.files[0];

                let reader = new FileReader;
                reader.onload = e => {
                    this.pictureUrl = e.target.result;
                }
                reader.readAsDataURL(this.plant.main_picture);
            },
            invalidate(attribute) {
                return (this.transaction.errors[attribute])
                    ? 'is-invalid'
                    : '';
            },
            invalidateUpload() {
                return (this.transaction.errors.main_picture)
                    ? 'is-invalid is-invalid-img'
                    : '';
            },
            resetFormInputValues() {
                this.plant = {
                    main_picture: null,
                    name: null,
                    specimen: null,
                    bonsai_style_id: '',
                    plant_classification_id: '',
                    age: null,
                    height: null,
                    description: null
                }
            },
            resetTransactionValues() {
                this.transaction = {
                    alert: false,
                    message: '',
                    object: {},
                    errors: [],
                };
            },
            transactionSuccess(response) {
                this.transaction.alert = true;
                this.transaction.message = 'New bonsai item created with success!';
                this.transaction.object = response.data;
            },
            transactionError(response) {
                this.transaction.alert = false;
                this.transaction.errors = response.data.errors;
            }
        },
        computed: {
            plantViewLink() {
                return this.$store.state.url + '/plant/' + this.transaction.object.id;
            },
            previewImg() {
                return (this.pictureUrl)
                    ? this.pictureUrl
                    : '/images/bonsai-profile-portrait-01.png';
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
        text-align: center;
    }
    .success {
        background-color: greenyellow;
    }
    .danger {
        background-color: lightcoral;
    }
    .is-invalid-img {
        color: red;
    }
</style>