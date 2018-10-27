window.Vue = require('vue');
/**
 * Global event bus
 */
export const bus = new Vue();

//Global events list

// event: 'choose-category', emit from 'TreeMenuComponent' and 'CategoriesComponent', subscribe in 'ItemsComponent'
// event: 'category-created', emit from 'CreateCategoryComponent', subscribe in 'CategoriesComponent'