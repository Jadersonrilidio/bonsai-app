<template>
    <div class="card mt-4 card-plant" @click="showPlant($event)">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid rounded img" src="/storage/images/oKGHIjJ8t4UsR8EFUtuDfQGIhpFxFahFH32E8caS.jpg">
            </div>

            <div class="col-md-8">

                <div class="plant-name">
                    Junípero
                    <span class="scientific-name">(Juniperus Procumbens)</span>
                </div>

                <table class="table table-sm table-borderless table-cels">
                    <tbody>
                        <tr>
                            <th scope="row">Type</th>
                            <td>Bonsai</td>
                        </tr>
                        <tr>
                            <th scope="row">Style</th>
                            <td>tree-over-rock</td>
                        </tr>
                        <tr>
                            <th scope="row">Age</th>
                            <td>23 years</td>
                        </tr>
                        <tr>
                            <th scope="row">Height</th>
                            <td>50 centimeters</td>
                        </tr>
                        <tr>
                            <th scope="row">Description</th>
                            <td>Juniperus over rock is so cool...</td>
                        </tr>
                    </tbody>
                </table>

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
        },
        methods: {
            showPlant(event) {
                alert('you clicked in a bonsai :)');
            }
        }
    }
</script>

<style>
    .card-plant {
        height: 150px;
        max-width: 74%;
        align-content: center;
        margin: 10px auto;
        cursor: pointer; 
    }

    .card-plant:hover{
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
    }

    .img {
        max-height: 150px;
    }

    .table-cels td, .table-cels th {
        font-size: 0.9em;
        margin-top: 0px;
        margin-bottom: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    .plant-name {
        margin-top: 5px;
        margin-bottom: 0px;
        font-size: 1.3em;
        font-weight: bold;
    }

    .scientific-name {
        font-style: italic;
        font-weight: lighter;
        color: gray;
    }
</style>