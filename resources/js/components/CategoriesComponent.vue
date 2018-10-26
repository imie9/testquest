<template>
    <div class="container">
        <div class="categories" v-if="!categories_loading">
            <div class="category" v-for="category in categories">
                <a @click="choose(category)">{{ category.name }}</a>
                <div class="sub" v-for="child in category.children" v-if="category.children.length !== 0">
                    <tree-menu-component :parent="child" :node="child.children"></tree-menu-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { bus } from '../bus';
    export default {
        data: function () {
          return {
              endpoint: '/category/full-list',
              categories: [],
              categories_loading: true
            }
        },
        mounted() {
            this.update()
        },
        methods: {
            update: function () {
                this.$http.get(this.endpoint).then(function (response) {
                    this.categories_loading = false;
                    this.categories = response.data.data;
                })
            },
            choose(data) {
                bus.$emit('choose-category', data);
            }
        }
    }
</script>

<style>
    .container {
        padding-left: 10px;
    }
</style>