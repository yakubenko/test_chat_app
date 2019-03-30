<template>
    <div class="mb-2 border-bottom">
        {{ message.id }}
        <span class="badge badge-secondary">{{ message.user.login }}</span>
        {{ message.message }}

        <br>
        <span class="text-muted">{{ message.created_at }}</span>
    </div>
</template>


<script>
export default {
    name: 'MessageItem',
    props: {
        message: {
            type: Object,
            required: true
        }
    }
};
</script>
