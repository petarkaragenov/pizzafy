<template>
    <aside class="sidebar">
        <ul>
            <slot name="sidebarLinks"></slot>
        </ul>
    </aside>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>
    .sidebar {
        height: 100%;
        background: lighten(#000, 8%);

        ul {
            margin: 0;
            padding: 0;
            width: 100%;

            li {
                list-style-type: none;
            }
        }
    }
</style>
