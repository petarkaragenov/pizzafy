<template>
    <div class="pizza-holder">
        <div class="pizza-header">
            <slot name="header"></slot>
        </div>
        <div class="pizza-container row">
            <slot name="card"></slot>
        </div>

    </div>
</template>

<script>
export default {
    
}
</script>


<style lang="scss" scoped>
.pizza-holder {
    width: 100%;
    
    .pizza-container {
        width: 100%;
        justify-content: space-between;
    }

    .pizza-header {
        background: lighten(#000, 8%);
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;

        .pizza-heading {
            color: white;
            font-size: 20px;
            margin-bottom: 0;
        }
    }
}
</style>
