<template>
    <li><p class="sidebar-section">{{ sectionTitle }}</p></li>
</template>

<script>
export default {
    props: ['sectionTitle']
}
</script>

<style>
    .sidebar-section {
        font-weight: 600;
        padding: 6px 25px;
        padding-top: 25px;
        margin-bottom: 0;
        color: #a8a8a8;
        text-transform: uppercase;
    }
</style>
