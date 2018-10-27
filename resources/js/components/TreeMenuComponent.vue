<template>
    <div class="category">
        <a @click="choose(parent)">{{parent.name}}</a>
        <div class="category" v-for="category in node">
            <a @click="choose(category)" v-if="category.children.length === 0">{{ category.name }}</a>
            <tree-menu-component v-if="category.children.length !== 0" :parent="category" :node="category.children"></tree-menu-component>
        </div>
    </div>
</template>

<script>
    import { bus } from '../bus';
    export default {
        props: {
            node: null,
            parent: Object
        },
        data: function() {
            return {
                open: false
            }
        },
        name: "tree-menu-component",
        mounted() {
        },
        methods: {
            choose(data) {
                bus.$emit('choose-category', data);
            }
        }
    }
</script>

<style scoped>
    .category {
        padding-left: 10px;
    }
</style>