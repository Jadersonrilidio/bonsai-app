<template>
<div class="container">
    <div class="row form-layout justify-content-center">
        <div class="col-md-10">
            <form>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <img src="/images/bonsai-profile-portrait-01.png" width="200px">
                    </div>
                    <div class="col-md-9">
                        <div style="height:100%; padding:80px 0 0 20px">
                            <h2>
                                Bonsai name <br>
                                <i style="color:gray; font-size:0.8em">
                                    (Bonsai Scientific name)
                                </i>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" :disabled="!inputName" value="Name" style="cursor:text" @select="allowToWrite()">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Scientific Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" disabled value="Juniperus Procumbens">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Style</label>
                    <div class="col-sm-10">
                        <input class="form-control" disabled value="Bonsai style">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Classification</label>
                    <div class="col-sm-10">
                        <input class="form-control" disabled value="Plant Classification">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Age</label>
                    <div class="col-sm-10">
                        <input class="form-control" disabled value="23 years old">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Height</label>
                    <div class="col-sm-10">
                        <input class="form-control" disabled value="50 centimeters">
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" disabled rows="2">This is a bonsai, awesome one, everyone loves it, because it is an awesome bonsai and so and much more text and testing to infinite and so and go on ...</textarea>
                    </div>
                </div>

                <div class="form-group row mb-5">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="form-group col-md-4">
                            <a class="btn btn-success form-control" :href="$store.state.url + '/plant/edit/2'">Save Changes</a>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-5">
                    <label class="col-sm-2 col-form-label">Interventions</label>
                    <div class="col-sm-10">
                        <div class="form-group col-md-4">
                            <button type="button" class="btn btn-secondary form-control" data-bs-toggle="modal" data-bs-target="#showInterventionList">Open intervention list</button>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group row col-md-6">
                        <label class="col-sm-2 col-form-label">Pictures</label>
                        <div class="col-sm-10">
                            <div id="carouselPicturesControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner text-center">
                                    <div class="carousel-item active">
                                        <img src="/images/bonsai-profile-portrait-01.png" class="w-50">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/images/bonsai-profile-portrait-01.png" class="w-50">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/images/bonsai-profile-portrait-01.png" class="w-50">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPicturesControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselPicturesControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label class="col-sm-2 col-form-label">Videos</label>
                        <div class="col-sm-10">
                            <div id="carouselVideosControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner text-center">
                                  <div class="carousel-item active">
                                    <img src="/images/bonsai-profile-portrait-01.png" class="w-50">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="/images/bonsai-profile-portrait-01.png" class="w-50">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="/images/bonsai-profile-portrait-01.png" class="w-50">
                                  </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselVideosControls" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselVideosControls" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="form-group row col-md-6">
                        <input class="form-control-file" type="file">
                    </div>
                    <div class="form-group row col-md-6">
                        <input class="form-control-file" type="file">
                    </div>
                </div>

                <div class="form-group row mb-3 justify-content-center">
                    <div class="form-group col-md-4">
                        <button type="button" class="btn btn-danger form-control" data-bs-toggle="modal" data-bs-target="#deleteBonsai">Delete</button>
                    </div>
                </div>

            </form>

            <!-- START ShowInterventions Modal -->
            <div class="modal fade" style="width:100%" tabindex="-1" id="showInterventionList" role="dialog" aria-labelledby="showInterventionListLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="showInterventionListLabel">Interventions</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Intervention</th>
                                    <th scope="col">Description</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody v-for="intervention, key in interventions" :key="key">
                                <tr>
                                    <th scope="row">{{ intervention.id }}</th>
                                    <td>{{ intervention.date }}</td>
                                    <td>{{ intervention.interventionClassification.title }}</td>
                                    <td>{{ intervention.description }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr v-for="observation, key in intervention.observations" :key="key" style="line-height:15px; font-size:0.9em; color:gray">
                                    <td colspan="1"></td>
                                    <td colspan="5">
                                        Obs {{ observation.id }}: &emsp;
                                        <i>{{ observation.observation }}</i>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add Intervention</button>
                    </div>
                  </div>
                </div>
              </div>
            <!-- END ShowInterventions Modal -->

            <!-- START deleteBonsai Modal -->
            <div class="modal fade" style="width:100%" tabindex="-1" id="deleteBonsai" role="dialog" aria-labelledby="deleteBonsaiLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteBonsaiLabel">Delete</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to delete this item?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                  </div>
                </div>
              </div>
            <!-- END deleteBonsai Modal -->

        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: [
            'plantid'
        ],
        data() {
            return {
                uri: '/plant/',
                params: {
                    filter: null,
                    attr: null,
                    user_attr: 'name',
                    class_attr: 'title',
                    style_attr: 'title',
                    int_attr: 'intervention_classification_id,date,description',
                    pics_attr: 'picture',
                    vids_attr: 'video'
                },
                plant: {},
                interventions: [
                    {
                        id: 1,
                        date: '10/09/1987',
                        intervention_classification_id: 1,
                        description: 'routine prunning for test interventions table',
                        interventionClassification: {
                            id: 1,
                            title: 'Prunning'
                        },
                        observations: [
                            {
                                id: 1,
                                intervention_id: 1,
                                observation: 'observation text here...'
                            },
                            {
                                id: 2,
                                intervention_id: 1,
                                observation: 'observation text here...'
                            }
                        ]
                    },
                    {
                        id: 2,
                        date: '10/09/1986',
                        intervention_classification_id: 2,
                        description: 'routine wiring for test interventions table',
                        interventionClassification: {
                            id: 2,
                            title: 'Wiring'
                        },
                        observations: [
                            {
                                id: 5,
                                intervention_id: 2,
                                observation: 'observation text here...'
                            },
                            {
                                id: 6,
                                intervention_id: 2,
                                observation: 'observation text here...'
                            }
                        ]
                    }
                ],
                inputName: false,
            }
        },
        methods: {
            loadPlant() {
                let url = this.$store.state.apiurl + this.uri + this.plantid + this.urlParam;

                axios.get(url)
                    .then(response => {
                        this.plant = response.data[0];
                        console.log(response.data[0]);
                    })
                    .catch(errors => {
                        console.log(errors.response);
                    })
            },
            allowToWrite() {
                this.inputName = true;
            },
        },
        computed: {
            urlParam() {
                let urlParam = '?';

                Object.keys(this.params).forEach(key => {
                    if (this.params[key] != null) {
                        if (urlParam != '?')
                            urlParam += '&';
                        urlParam += key + '=' + this.params[key];
                    }
                });

                return urlParam;
            }
        },
        mounted() {
            this.loadPlant();
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
</style>