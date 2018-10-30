<template>
    <div class="categories" v-if="!categories_loading">
         <div class="category" v-for="category in categories">
             <tree-menu-component :parent="category" :node="category.children"></tree-menu-component>
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
            bus.$on('category-created', event => {
                this.update();
            })
        },
        methods: {
            update: function () {
                this.$http.get(this.endpoint).then(function (response) {
                    this.categories_loading = false;
                    this.categories = response.data.data;
                })
            }
        }
    }
</script>

<style>
    .categories {
        padding-left: 15px;
    }
</style>