<template>
    <li><router-link :to="to">{{ linkText }}</router-link></li>
</template>

<script>
export default {
    props: ['to', 'linkText']
}
</script>

<style lang="scss" scoped>
    a {
        display: block;
        padding: 6px 25px;
        text-indent: 15px;
        text-decoration: none;
        color: white;

        &:hover {
            background: black;
        }
    }
</style>

