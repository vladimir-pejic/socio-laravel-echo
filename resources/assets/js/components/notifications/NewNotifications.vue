<template lang="html">
    <div>
        <div class="nav-link">
            <a href="#" :class="(unread_notifications.length > 0) ? 'text-danger': ''" @click='toggleNotifications()'>
                <i class="fa fa-bell"></i><span class="badge text-danger" v-if="unread_notifications.length > 0">{{ unread_notifications.length }}</span>
            </a>
        </div>

        <div id="show-notifications" v-if="show_notifications" style="position: absolute; top: 40px; width: 400px; height: 500px; background-color: white; border: 1px solid darkgrey;">
            <div v-for="(notification, key) in all_notifications">
                {{ notification }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['unread_notifications', 'all_notifications'],
        data() {
            return {
                show_notifications: false,
            }
        },
        methods: {
            toggleNotifications() {
                if(this.show_notifications === false)
                    this.show_notifications = true;
                else
                    this.show_notifications = false;
            },
            openNewNotifications() {

            },
            markSeen() {

            }
        }
    }
</script>