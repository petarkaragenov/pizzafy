<template>
    <div class="admin-panel">       
        <div class="row">
            <div class="col-sm-2" style="padding: 0 !important">
                <Sidebar>
                    <template v-slot:sidebarLinks>
                        <SidebarSection sectionTitle="Menage Profile" />
                        <SidebarLink to="/profile/orders" linkText="Orders" />
                        <SidebarLink to="/profile/update" linkText="Update Profile" />
                        <SidebarLink to="/profile/delete" linkText="Delete Profile" />
                        <li class="logout">
                            <router-link class="button button-order" to="/">
                                <i class="fas fa-home"></i>
                                Home
                            </router-link>
                        </li>
                        <li class="logout">
                            <a class="button button-logout" href="/logout" @click.prevent="handleOnSubmit">Logout</a>
                        </li>
                        <form ref="logout" action="logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" :value="csrf">
                        </form>
                    </template>
                </Sidebar>
            </div>
            <div class="col-sm-10 bg-table">
                <div class="pt-25">
                    <transition name="slide-fade">
                        <router-view></router-view>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from '../Sidebar.vue';
import SidebarSection from '../SidebarSection.vue';
import SidebarLink from '../SidebarLink.vue';

export default {
    data() {
        return {
            csrf: this.$store.csrf.getters.getCsrfToken()
        }
    },
    components: {
        Sidebar, SidebarSection, SidebarLink
    },
    methods: {
        handleOnSubmit() {
            this.$refs.logout.submit()
        }
    }
}
</script>


<style lang="scss" scoped>
    .slide-fade-enter-active {
        transition: all 0.4s ease-out;
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(100%);
        opacity: 0;
    }

    .pt-25 {
        padding-top: 25px;
    }

    col-sm-2 {
        padding: 0 !important;
    }

    .admin-panel {
        .bg-table {
            background-image: url('/storage/table-background.jpg');
            background-size: cover;
            background-position: fixed;
            min-height: 100%;
        }

        .logout {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 16px 0 0;

            .button {
                width: 80%;
            }
        }
    }
</style>
