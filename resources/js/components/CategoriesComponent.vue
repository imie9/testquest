<template>
    <div class="categories" v-if="!categories_loading">
         <div class="category" v-for="category in categories">
             <tree-menu-component :parent="category" :node="category.children"></tree-menu-component>
         </div>
    </div>
</template>

<script>
    export default {
        data: function () {
          return {
              list_endpoint: '/category/tree',
              categories: [],
              categories_loading: true
            }
        },
        mounted() {
            this.update();
            this.$bus.$on(this.$events.CATEGORY_CREATED, event => {
                this.update();
            })
        },
        methods: {
            update: function () {
                this.$http.get(this.list_endpoint).then(function (response) {
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