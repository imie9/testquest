<template>
    <div class="items">
        <div class="loading" v-if=load_items>
            ...
        </div>
        <div class="item" v-if="!load_items" v-for="item in items">
            <div class="card">
                <div class="card-image">
                    <figure class="image is-120x120">
                        <img :src="item.image_url" alt="Placeholder image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4">{{item.name}}</p>
                        </div>
                    </div>

                    <div class="content">
                        {{item.description}}
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                items_list_endpoint: '/category/items-list',
                current_category: null,
                items: null,
                load_items: false
            }
        },
        mounted() {
            this.$bus.$on('choose-category', (category) => {
                this.current_category = category;
                this.getItems();
            });
            this.$bus.$on('item-created', (event) => {
                if (event.category_id === this.current_category.id) {
                    this.getItems();
                }
            })
        },
        methods: {
            getItems() {
                const body = {
                    id: this.current_category.id
                };
                this.load_items = true;
                this.$http.post(this.items_list_endpoint, body, {
                    emulateJSON: true,
                    emulateHTTP: true
                }).then(function (response) {
                    this.items = response.data.data;
                    if (this.items.length === 0) {
                        this.$toast('There is no items for this category.')
                    }
                    this.load_items = false;
                })
            }
        }
    }
</script>

<style>
    .item {
        margin: 5px;
        width: 48%;
        float: left;
    }
    .card {
        min-height: 500px;
    }
    .items {
        padding: 5px;
    }
</style>