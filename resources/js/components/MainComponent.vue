<template>
    <div class="container">
        <div class="columns">
            <div class="column is-one-third">
                <div class="subtitle is-3" style="margin-left: 15px">
                    Categories
                </div>
                <categories-component></categories-component>
            </div>
            <div class="column">
                <div class="subtitle is-3" style="margin-left: 15px">
                    Items
                </div>
                <items-component></items-component>
            </div>
            <div class="column">
                Fourth column
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {

            }
        },
        mounted() {

        },
        methods: {

        }
    }
</script>
