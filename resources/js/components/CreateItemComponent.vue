<template>
    <form @submit="createItem($event)" v-if="!categories_loading">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input v-model="item.name" class="input" type="text" placeholder="Text input">
            </div>
        </div>
        <div class="field">
            <label class="label">Category</label>
            <div class="control">
                <div class="select">
                    <select v-model="item.category_id">
                        <option :value="category.id" v-for="category in categories">{{category.name}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                <textarea v-model="item.description" class="textarea" placeholder="Textarea"></textarea>
            </div>
        </div>
        <div class="file">
            <label class="file-label">
                <input @change="onFileLoad($event)" class="file-input" type="file" name="resume">
                <span class="file-cta">
                    <span class="file-icon">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                        Choose a file…
                    </span>
                </span>
            </label>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button :disabled="!isFormInvalid()" class="button is-link">Create</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "create-item-component",
        data: function () {
            return {
                item_create_endpoint: '/item/create',
                category_list_endpoint: '/category/list',
                item: {
                    name: null,
                    description: null,
                    category_id: null,
                    image: null
                },
                categories: null,
                categories_loading: false
            }
        },
        mounted() {
            this.categoriesList();
        },
        methods: {
            categoriesList() {
                this.$http.get(this.category_list_endpoint).then(function (response) {
                    this.categories_loading = false;
                    this.categories = response.data.data;
                })
            },
            onFileLoad(event) {
                this.item.image = event.target.files[0];
            },
            createItem(event) {
                event.preventDefault();
                const form = new FormData();
                form.append('name', this.item.name);
                form.append('description', this.item.description);
                form.append('category_id', this.item.category_id);
                form.append('image', this.item.image);

                this.$http.post(this.item_create_endpoint, form, {
                    emulateJSON: true,
                    emulateHTTP: true
                }).then(function (response) {
                    if (response.data && !response.data.error) {
                        this.$toast('Created');
                        const eventData = {
                            category_id: this.item.category_id
                        };
                        this.$bus.$emit('item-created', eventData);
                    } else {
                        this.$toast(response.data.error);
                    }
                })
            },
            isFormInvalid() {
                return !!this.item.name
                    && !!this.item.description
                    && !!this.item.category_id
                    && !!this.item.image;
            }
        }
    }
</script>

<style scoped>

</style>