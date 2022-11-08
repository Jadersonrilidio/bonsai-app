<template>
    <div class="card mt-4 card-plant" @click="showPlant($event)">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid rounded img" :src="'/storage/images/' + plant.main_picture">
            </div>

            <div class="col-md-8">

                <div class="plant-name">
                    {{ plant.name }}
                    <span class="scientific-name">{{ '(' + plant.specimen + ')' }}</span>
                </div>

                <table class="table table-sm table-borderless table-cels">
                    <tbody>
                        <tr>
                            <th scope="row">Type</th>
                            <td>{{ plant.type }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Style</th>
                            <td>{{ plant.style }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Age</th>
                            <td>{{ plant.age + ' years old'}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Height</th>
                            <td>{{ plant.height + ' centimeters' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Description</th>
                            <td>{{ plant.description.substring(0, 30) + ' ...' }}</td>
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
            'plant'
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
        cursor: pointer !important;
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
