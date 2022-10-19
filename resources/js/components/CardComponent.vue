<template>
    <div class="card">

        <img class="card-image-top" :src="imageUrl" alt="Card image top">

        <div class="card-header"></div>

        <div class="card-body">

            <h5 class="card-title"></h5>

            <h6 class="card-subtitle"></h6>

            <p class="card-text"></p>

        </div>

        <div class="card-footer"></div>

        <img class="card-image-bottom" :src="imageUrl" alt="Card image bottom">


    </div>
</template>

<script>
    export default {
        props: [
            'imageUrl'
        ],
        data() {
            return {
                components: {
                    cards: {
                        home: {
                            class: 'text-center',
                            imageTop: {
                                has: false,
                                visible: false
                            },
                            header: {
                                has: false,
                                visible: false
                            },
                            body: {
                                has: false,
                                visible: false
                            },
                            text: {
                                has: false,
                                visible: false
                            },
                            title: {
                                has: false,
                                visible: false
                            },
                            subtitle: {
                                has: false,
                                visible: false
                            },
                            link: {
                                has: false,
                                visible: false
                            },
                            footer: {
                                has: false,
                                visible: false
                            },
                            imageBotton: {
                                has: false,
                                visible: false
                            },
                        }
                    }
                }
            }
        }
    }
</script>
