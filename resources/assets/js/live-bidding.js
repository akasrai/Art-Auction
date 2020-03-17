Echo.channel('chat').listen('BidEvent', ({message}) => {
       console.log(message);
    });
