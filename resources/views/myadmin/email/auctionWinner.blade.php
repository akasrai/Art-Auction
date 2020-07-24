<div>
   <h1>Congratulations {{$winner->user->fname}} {{$winner->user->mname}} {{$winner->user->lname}}</h1>
   <p>
      You have won the auction hosted by <strong>Bid N Buy</strong>
   </p>

   <h4>Product Details</h4>
   <span>Name: {{$winner->product->name}}</span><br />
   <span>Quality: {{$winner->product->quality}}</span><br />
   <span>Your Final Bid: ${{$winner->bid_price}}</span><br />
   <div class="col-md-12">
      @foreach($winner->product->images as $image)
      <div class="col-md-4 product-image">
         <img
            src="<?php echo url('storage/'.$image->image_url)?>"
            alt="product image" />
      </div>
      @endforeach
   </div>

</div>