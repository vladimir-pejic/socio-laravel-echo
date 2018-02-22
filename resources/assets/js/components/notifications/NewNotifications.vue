<template lang="html">
    <div class="nav-link" :class="{'text-danger': notifications > 0}">
        <a href="#"><i class="fa fa-bell"></i><span class="badge">{{ notifications }}</span></a>
    </div>
</template>

<script>
    export default {
        props: ['notifications'],
        methods: {
            openNewNotifications() {

            },
            markSeen() {

            }
        }
    }
</script>