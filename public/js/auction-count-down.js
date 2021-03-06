window.auctionFinalDates = [];

const second = 1000,
   minute = second * 60,
   hour = minute * 60,
   day = hour * 24;

const auctionCountDown = finalDate => {
   let auctionFinalDate = new Date(finalDate).getTime();
   window.sliderInterval = setInterval(function() {
      let now = new Date().getTime(),
         distance = auctionFinalDate - now;

      if (distance < 0) {
         clearInterval(window.sliderInterval);
         $("#auction-live").hide();
         $("#auction-expired").removeClass("hide");
         $("#auction-expired").html(
            "<i class='fa fa-clock-o' aria-hidden='true'></i> Auction time has ended."
         );

         $(".featured-product-button-wrapper").empty();
      } else {
         $("#days").text(function(i, n) {
            return ((n = +Math.floor(distance / day)) < 10 ? "0" : "") + n;
         }),
            $("#hours").text(function(i, n) {
               return (
                  ((n = +Math.floor((distance % day) / hour)) < 10 ? "0" : "") +
                  n
               );
            }),
            $("#minutes").text(function(i, n) {
               return (
                  ((n = +Math.floor((distance % hour) / minute)) < 10
                     ? "0"
                     : "") + n
               );
            }),
            $("#seconds").text(function(i, n) {
               return (
                  ((n = +Math.floor((distance % minute) / second)) < 10
                     ? "0"
                     : "") + n
               );
            });
      }
   }, second);
};
