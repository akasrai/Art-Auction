import SingleArticle from './components/SingleArticle.vue';
import Articles from './components/Articles.vue';

export const routes = [
    { path: '/vue/admin/article/:id', component: SingleArticle, name: 'SingleArticle' },
    { path: '/vue/admin/articles', component: Articles, name: 'articles' },
    
];