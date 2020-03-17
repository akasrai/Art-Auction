import Echo from 'laravel-echo';

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host:`${window.location.hostname}:${window.laravelEchoPort}`
});

window.users =[];

function updateUserList(){
    const list = jQuery('<ul class="list-group"></ul>');

    window.users.forEach(user => {
        list.append(`<li class="list-group-item">${user.name}</li>`);
    });

    jQuery('.user-list').html(list);
}


window.Echo.join('everywhere')
    .here(users => {
        window.users = users;
        updateUserList();
    }).joining(user => {
    // When another user joins this will fire with the user who logged in.
    window.users.push(user);
    updateUserList();

    jQuery('.card-body').prepend(`<div class="mt-2 alert alert-primary">${user.name} has joined</div>`);

    setTimeout(() => {
        jQuery('.alert-primary').remove();
    }, 2000);

    console.log(user);
}).leaving(user => {
    // When the users connection is lost, we get the object of the user who has left.
    window.users = window.users.filter(u => u.id !== user.id);
    updateUserList();

    jQuery('.card-body').prepend(`<div class="mt-2 alert alert-danger">${user.name} has left</div>`);

    setTimeout(() => {
        jQuery('.alert-danger').remove();
    }, 2000);

    console.log(user);
}).listen('UserRegisteredEvent', ({ name }) => {
    console.log(name);
    jQuery('.card-body').prepend(`<div class="mt-2 alert alert-info">${name} has just registered</div>`);

    setTimeout(() => {
        jQuery('.alert-info').remove();
    }, 2000);
});

window.Echo.private('chat.1')
    .listenForWhisper('helloooo', ({ name }) => {
        console.log(event);

        jQuery('.card-body').prepend(`<div class="mt-2 alert alert-info">${name} has just said HI!</div>`);

        setTimeout(() => {
            jQuery('.alert-info').remove();
        }, 2000);
    });

jQuery(function () {
    jQuery('#sayHi').click(() => {
        window.Echo.private('chat.1').whisper('helloooo', window.active_user);
    });
});
