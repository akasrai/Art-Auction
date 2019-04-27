 <div class="col-md-12 col-sm-12 col-xs-12 no-padding search-bar">
    <form class="search-form" method="get" action="{{route('product.search')}}">
       <div class="col-md-12 col-sm-12 col-xs-12 no-padding input-group">
          <div class="col-md-4 col-sm-12 col-xs-12 no-padding custom-select">
             <select name="category" id="category" class="form-control custom-form-element">
                <option value="">ALL</option>
                <option value="all">ALL</option>
                @if(count($categories)>0)
                @foreach($categories as $category)
                @if($category->name!='Uncategorized')
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
                @endforeach
                @endif
             </select>
          </div>

          <div class="col-md-7 col-sm-12 col-xs-12 no-padding">
             <input type="text" name="product-name" id="product-name"
                class="form-control custom-form-element search-input" placeholder="Anything">
          </div>

          <div class="col-md-1 col-sm-12 col-xs-12 no-padding">
             <button class="form-control btn-search">
                <i class="glyphicon glyphicon-search"></i>
             </button>
          </div>
       </div>
    </form>
 </div>