<template>
<div class="container">
    <div class="row form-layout justify-content-center">
        <div class="col-md-10">
            <form>
                <div class="row mb-3">
                    <div class="form-group col-md-3">
                        <img src="/images/bonsai-profile-portrait-01.png" width="200px">
                    </div>
                    <div class="form-group col-md-9">
                        <div style="height:30%">
                            <h1 class="form-title">Create new bonsai</h1>
                        </div>
                        <div style="height:30%"></div>
                        <div style="height:40%">
                            <input class="form-control-file" type="file" required name="main_picture" id="form-main-picture">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="form-name">Name</label>
                        <input class="form-control" type="text" name="name" id="form-name" required placeholder="Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="form-specimen">Scientific Name</label>
                        <input class="form-control" type="text" name="specimen" id="form-specimen" required placeholder="Ex: Juniperus Procumbens">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="form-style">Style</label>
                        <select class="form-control" name="style" id="form-style">
                            <option style="color:gray" value=""> -- Select a bonsai style -- </option>
                            <option value="1">Shokkan</option>
                            <option value="2">Morigami</option>
                            <option value="3">Kabudachi</option>
                            <option value="3">Kengai</option>
                            <option value="3">Han-Kengai</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="plant_class">Classification</label>
                        <select class="form-control" name="plant_class">
                            <option style="color:gray" value=""> -- Select a plant classification -- </option>
                            <option value="1">Bonsay</option>
                            <option value="2">Pre-bonsai</option>
                            <option value="3">Seedling</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="age">Age</label>
                        <input class="form-control" type="text" name="age" required placeholder="ex: 23 (years)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="height">Height</label>
                        <input class="form-control" type="text" name="height" required placeholder="ex: 178 (centimeters)">
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="form-group">
                        <label for="form-description">Description</label>
                        <textarea class="form-control" name="form-description" id="form-description" rows="2"></textarea>
                    </div>
                </div>
                
                <div class="row mb-3 justify-content-center ">
                    <div class="form-group col-md-8">
                        <button type="submit" class="btn btn-success btn-lg form-control">Create</button>
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