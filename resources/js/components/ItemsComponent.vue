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
                        <time datetime="2016-1-1">{{item.created_at}}</time>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { bus } from "../bus";
    export default {
        data: function () {
            return {
                endpoint: '/category/items-list',
                current_category: null,
                items: null,
                load_items: false
            }
        },
        mounted() {
            bus.$on('choose-category', (category) => {
                this.current_category = category;
                this.getItems();
            });
        },
        methods: {
            getItems() {
                const body = {
                    id: this.current_category.id
                };
                this.load_items = true;
                this.$http.post(this.endpoint, body, {
                    emulateJSON: true,
                    emulateHTTP: true
                }).then(function (response) {
                    this.items = response.data.data;
                    this.load_items = false;
                })
            }
        }
    }
</script>

<style>
    .item {
        margin-bottom: 20px;
    }
</style>