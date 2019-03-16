const second = 1000,
   minute = second * 60,
   hour = minute * 60,
   day = hour * 24;

let countDown = new Date("Mar 13, 2019 01:30:00").getTime(),
   interval = setInterval(function() {
      let now = new Date().getTime(),
         distance = countDown - now;

      if (distance < 0) {
         clearInterval(interval);
         $("#auction-live").hide();
         $("#auction-expired").removeClass("hide");
         $("#auction-expired").html(
            "<i class='fa fa-clock-o' aria-hidden='true'></i> Auction time has ended."
         );
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
