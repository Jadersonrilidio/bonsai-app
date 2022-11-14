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
                        <input class="form-control" disabled value="Name">
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

                <div class="form-group row mb-3 justify-content-center">
                    <div class="form-group col-md-4">
                        <a class="btn btn-success form-control" :href="$store.state.url + '/plant/edit/2'">Edit</a>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="button" class="btn btn-danger form-control" data-bs-toggle="modal" data-bs-target="#deleteBonsai">Delete</button>
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
                
            }
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