<template>


	<div>
		<div class="well" >
			
			<h3>{{ article.title}}</h3>
			<p>{{ article.body }} </p>
			<p>{{ article.created_at_date }} </p>
			<p>{{ article.created_at_time }} </p>
			<hr>
			<button class="btn btn-warning" @click="editArticle(article)">Edit</button>
			<button class="btn btn-danger" @click="deleteArticle(article.id)">Delete</button>
		
		</div>

	</div>
</template>

<script>
	
	export default{
		
		props: {
		    articleid:'articleId',
		},
		data() {
			return{
					   
				articles : [],
				article: {
					id :'',
					title : '',
					body : '',
					date :''
				},
				article_id: ''
			};
		},

		created() {
			this.fetchArticles();
		},

		methods: {
			fetchArticles() {
				
				//var id = this.articleId;
				//console.log(id)
				var id = window.location.href.split('/').pop();
				var page_url = 'http://127.0.0.1:8000/api/admin/article/'+id;
				fetch(page_url)
					.then(res => res.json())
					.then(res => {
						
						this.article = res.data;
					
					})

					.catch(err => console.log(err));
			},

			deleteArticle(id){
				if(confirm('Are you Sure?')){
					fetch(`http://127.0.0.1:8000/api/admin/article/${id}`, {
						method : 'delete'
					})
					.then(res => res.json())
					.then(data =>{
						alert('Article deleted successfully.');
						window.location.href = '/admin';
					})
					.catch(err => console.log(err));
				}
			}
			
		}
	};
</script>