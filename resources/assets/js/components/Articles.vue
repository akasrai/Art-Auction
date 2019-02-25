<template>
	<div>
		<h2>Articles Posted</h2>

		<form @submit.prevent = "addArticle" class="mb-3">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Title" v-model="article.title">
			</div>

			<div class="form-group">
				<textarea type="text" class="form-control" placeholder="Body" v-model="article.body"></textarea>
			</div>
			<button type="submit" class="btn btn-light btn-block">Save</button>
		</form>
		<nav aria-lebel="hello">
			<ul class="pagination">
				<li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>

				<li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page}}</a> </li>

				<li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>


				
			</ul>
		</nav>
		<div class="well" v-for="article in articles" v-bind:key="article.id">
			
			<h3><a v-bind:href="'/admin/article/'+ article.id">{{ article.title}}</a></h3>
			<p>{{ article.body }} </p>
			<p>{{ article.created_at }} </p>
			<hr>
			<button class="btn btn-warning" @click="editArticle(article)">Edit</button>
			<button class="btn btn-danger" @click="deleteArticle(article.id)">Delete</button>
		
		</div>

	</div>
</template>

<script>
	export default{
		data() {
			return{
				articles : [],
				article: {
					id :'',
					title : '',
					body : ''
				},
				article_id: '',
				pagination : {},
				edit : false
			};
		},

		created() {
			this.fetchArticles();
		},

		methods: {
			fetchArticles(page_url) {
				let vm = this;
				page_url = page_url || 'http://127.0.0.1:8000/api/admin/articles';
				fetch(page_url)
					.then(res => res.json())
					.then(res => {
						
						this.articles = res.data;
						vm.makePagination(res.meta, res.links);
					})

					.catch(err => console.log(err));
			},
			makePagination(meta, links){

				let pagination = {
					current_page: meta.current_page,
					last_page: meta.last_page,
					next_page_url: links.next,
					prev_page_url: links.prev
				};

				this.pagination = pagination;
			},
			deleteArticle(id){
				if(confirm('Are you Sure?')){
					fetch(`http://127.0.0.1:8000/api/admin/article/${id}`, {
						method : 'delete'
					})
					.then(res => res.json())
					.then(data =>{
						alert('Article deleted successfully.');
						this.fetchArticles();
					})
					.catch(err => console.log(err));
				}
			},
			addArticle(){
				if(this.edit === false){
					//add
					fetch('http://127.0.0.1:8000/api/admin/article',{
						method: 'post',
						body: JSON.stringify(this.article),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(data => {
						this.article.title = '';
						this.article.body = '';
						alert('Article added.');
						this.fetchArticles();
					})
					.catch(err => console.log(err));
				}else{

					//edit
					fetch('http://127.0.0.1:8000/api/admin/article',{
						method: 'put',
						body: JSON.stringify(this.article),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(data => {
						this.article.title = '';
						this.article.body = '';
						alert('Article updated.');
						this.fetchArticles();
					})
					.catch(err => console.log(err));
					return this.edit = false;

				}
			},
			editArticle(article){
				this.edit = true;
				this.article.id = article.id;
				this.article.article_id = article.id;
				this.article.title = article.title;
				this.article.body = article.body;
			}
		}
	};
</script>