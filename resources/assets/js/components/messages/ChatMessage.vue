<template lang="html">
    <div class="chat-message">
        <small>{{ message.user.first_name }} {{ message.user.last_name }}</small>
        <p>{{ message.message }}</p>
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>

<style lang="css">
    .chat-message {
        padding: 1rem;
    }
    .chat-message > p {
        margin-bottom: .5rem;
    }
</style>