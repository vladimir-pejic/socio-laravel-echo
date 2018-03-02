
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('chat-message', require('./components/messages/ChatMessage.vue'));
Vue.component('chat-log', require('./components/messages/ChatLog.vue'));
Vue.component('chat-box', require('./components/messages/ChatBox.vue'));

Vue.component('new-notifications', require('./components/notifications/NewNotifications.vue'));

const app = new Vue({
    el: '#app',
    data: {
        logged_user: '',
        messages: [],
        usersInRoom: []
    },
    methods: {
        addMessage(message) {
            // Add to existing messages to top
            this.messages.unshift(message);

            // Persist to the database etc
            axios.post('/chat/all', message).then(response => {
                // Do whatever;
            })
        }
    },
    created() {

        axios.get('/logged_user').then(response => {
            this.logged_user = response.data;
            console.log(this.logged_user.id);
        });

        axios.get('/chat/all').then(response => {
            this.messages = response.data;
        });

        Echo.join('chatroom')
            .here((users) => {
                this.usersInRoom = users;
            })
            .joining((user) => {
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user)
            })
            .listen('ChatMessagePosted', (e) => {
                this.messages.unshift({
                    message: e.message.message,
                    user: e.user
                });
            });

        Echo.private('App.User.'+ this.logged_user.id)
            .notification((notification) => {
                console.log(notification.type);
            });
    }
});
