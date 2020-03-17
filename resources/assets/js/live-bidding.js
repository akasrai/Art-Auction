Echo.join('chat')
    .here(users => {
        console.log('users',users);
    })
    .joining(user => {
        this.users.push(user);
    })
    .leaving(user => {
        this.users = this.users.filter(u => u.id !== user.id);
    })
    .listenForWhisper('typing', ({id, name}) => {
        this.users.forEach((user, index) => {
            if (user.id === id) {
                user.typing = true;
                this.$set(this.users, index, user);
            }
        });
    })
    .listen('MessageSent', (event) => {
        this.messages.push({
            message: event.message.message,
            user: event.user
        });

        this.users.forEach((user, index) => {
            if (user.id === event.user.id) {
                user.typing = false;
                this.$set(this.users, index, user);
            }
        });
    });
