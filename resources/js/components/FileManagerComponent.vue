<template>
    File manager:
    <file-manager v-bind:settings="settings"></file-manager>
</template>

<script>

export default {
    name: 'File Manager',
    mounted() {
            console.log('File manager component mounted.')
        }
}
</script>