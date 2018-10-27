<template>
    <div class="container">
        <div class="columns">
            <div class="column is-one-third">
                <div class="subtitle is-3 categories-title" style="margin-bottom: 5px">
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
                <div class="subtitle is-3 categories-title" style="margin-bottom: 5px">
                    Create category
                </div>
                <create-category-component></create-category-component>
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

<style>
    .container {
        margin-left: 5%;
        margin-right: 5%;
    }
</style>
