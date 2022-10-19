<template>
    <div class="card">

        <img class="card-image-left" :src="imageUrl" alt="Card image left">

        <div class="card-header">
            Card header
        </div>

        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle">Card subtitle</h6>
            <p class="card-text">Card text lorem ipsun</p>
            <a class="card-link" href="#">Card link</a>
        </div>

        <div class="card-footer">
            Card footer
        </div>

    </div>
</template>

<script>
    export default {
        props: [
            'imageUrl'
        ]
    }
</script>
