<template>
    <div class="card text-left" style="margin: 10px 20px; border:1px solid">

        <div class="card-body" style="display:inline; background-color:lightgray">
            <div class="col-md-3" style="float:left; height:160px; width:160px">
                <img class="img-fluid" src="/storage/images/oKGHIjJ8t4UsR8EFUtuDfQGIhpFxFahFH32E8caS.jpg" alt="main_picture">
            </div>

            <div class="col-md-9" style="float:right;">
                <div class="col-md-12" style="line-height: 20px; float:right"><h5>Junípero <i style="color:gray">(Juniperus Procumbens)</i></h5></div>
                <div class="col-md-12" style="line-height: 20px; float:right"><b>Type:</b> &emsp; Bonsai</div>
                <div class="col-md-12" style="line-height: 20px; float:right"><b>Style:</b> &emsp; tree-over-rock</div>

                <div class="col-md-12" style="line-height: 20px; float:right"><b>Age:</b> &emsp; 23 years</div>
                <div class="col-md-12" style="line-height: 20px; float:right"><b>Height:</b> &emsp; 50 centimeters</div>
                
                <div class="col-md-12" style="line-height: 20px; float:right"><b>Description:</b> This is a beautiful Juniperus over rock... </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'imageUrl'
        ],
        data() {
            return {
              
            }
        }
    }
</script>
