<template>
    <div class="page-not-found">
        <div class="content">
            <h1>Page Not Found</h1>
            <router-link to="/">
                <i class="fas fa-home fa-2x"></i>
                Home
            </router-link>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .page-not-found {
        height: 100vh;
        width: 100%;
        top: 0;
        left: 0;
        position: fixed;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;

        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            h1 {
                color: 343A40;
                border-bottom: 1px solid #343A40;
                padding-bottom: 8px;
            }

            a {
                color: darken(#fff, 20%);

                &:hover {
                    color: darken(#fff, 30%);
                }
            }
        }
    }
</style>

