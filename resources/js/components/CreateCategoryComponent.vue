<template>
    <div class="form" v-if="!categories_loading">
        <div class="field">
            <label class="label">Category name</label>
            <div class="control">
                <input class="input" v-model="request.name" type="text" placeholder="Category name">
            </div>
        </div>
        <div class="field">
            <label class="label">Choose parent category (optional)</label>
            <div class="control">
                <div class="select">
                    <select v-model="request.parent_id">
                        <option :value="category.id" v-for="category in categories">{{category.name}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="control">
            <button :disabled="!request.name" @click="create()" class="button is-link">Submit</button>
        </div>
    </div>
</template>

<script>
    import { bus } from '../bus';
    export default {
        name: 'create-category-component',
        data: function () {
            return {
                request: {
                    name: null,
                    parent_id: null,
                },
                list_endpoint: '/category/full-list-not-tree',
                creation_endpoint: '/category/create',
                categories: [],
                categories_loading: true
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                this.$http.get(this.list_endpoint).then(function (response) {
                    this.categories_loading = false;
                    this.categories = response.data.data;
                })
            },
            create() {
                this.$http.post(this.creation_endpoint, this.request, {
                    emulateJSON: true,
                    emulateHTTP: true
                }).then(function (response) {
                    if (response.data.success) {
                        bus.$emit('category-created', {});
                        this.$toast('Created');
                        this.request.name = null;
                        this.request.parent_id = null;
                        this.update();
                    } else {
                        this.$toast('Failed, sorry...');
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>