<template>
    <div class="container">
        <div class="columns">
            <div class="column is-one-third">
                <div class="subtitle is-3 categories-title" style="margin-bottom: 5px">
                    Categories
                </div>
                <categories-component></categories-component>
            </div>
            <div class="column is-three-fifths">
                <div class="subtitle is-3" style="margin-left: 15px">
                    Items
                </div>
                <items-component></items-component>
            </div>
            <div class="column">
                <!--<div class="subtitle is-3 categories-title" style="margin-bottom: 5px">-->
                    <!--Create category-->
                <!--</div>-->
                <div class="tabs">
                    <ul>
                        <li :class="{'is-active': is_category_active}" @click="setActiveTab(1)"><a>Category</a></li>
                        <li :class="{'is-active': is_item_active}" @click="setActiveTab(2)"><a>Item</a></li>
                    </ul>
                </div>
                <create-category-component v-if="is_category_active"></create-category-component>
                <create-item-component v-if="is_item_active"></create-item-component>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                is_category_active: true,
                is_item_active: false,
            }
        },
        mounted() {

        },
        methods: {
            setActiveTab(state) {
                if (state === 1) {
                    this.is_category_active = true;
                    this.is_item_active = false;
                } else {
                    this.is_item_active = true;
                    this.is_category_active = false;
                }
            }
        }
    }
</script>

<style>
    .container {
        margin-left: 5%;
        margin-right: 5%;
    }
</style>
