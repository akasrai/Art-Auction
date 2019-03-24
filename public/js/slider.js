let slides = $(".featured-product");
let current = 0;

$(".featured-product-wrapper").empty();
$(".featured-product-wrapper").html(slides[current]);
auctionCountDown(window.auctionFinalDates[current]);

const displayAuctionFinalDate = () => {
   $("#auction-final-date").text(
      moment(new Date(window.auctionFinalDates[current])).format(
         "MMM Do YYYY, HH:mm a"
      )
   );
};

displayAuctionFinalDate(window.auctionFinalDates[current]);

const nextProduct = () => {
   if (window.sliderInterval) {
      clearInterval(window.sliderInterval);
   }
   if (current === slides.length - 1) current = 0;
   else current++;

   $(slides[current])
      .hide()
      .appendTo(".featured-product-wrapper")
      .fadeIn(1000);
   setTimeout(removeInactiveSlide, 1000);
   auctionCountDown(window.auctionFinalDates[current]);
   setTimeout(displayAuctionFinalDate, 1000);
};

const prevProduct = () => {
   if (window.sliderInterval) {
      clearInterval(window.sliderInterval);
   }
   if (current === slides.length - 1) current = 0;
   else if (current === 0) current = slides.length - 1;
   else current--;

   $(slides[current])
      .hide()
      .appendTo(".featured-product-wrapper")
      .fadeIn(1000);
   setTimeout(removeInactiveSlide, 1000);
   auctionCountDown(window.auctionFinalDates[current]);
   setTimeout(displayAuctionFinalDate, 1000);
};

const removeInactiveSlide = () => {
   $(".featured-product-wrapper")
      .find("div")
      .first()
      .remove();
};
