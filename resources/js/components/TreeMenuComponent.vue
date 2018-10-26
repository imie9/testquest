<template>
    <div class="container">
        <a @click="choose(parent)">{{parent.name}}</a>
        <div class="category" v-for="category in node">
            <a @click="choose(category)">{{ category.name }}</a>
        </div>
    </div>
</template>

<script>
    import { bus } from '../bus';
    export default {
        props: {
            node: Object,
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