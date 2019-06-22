<template>
    <div class="admin-panel">       
        <div class="row">
            <div class="col-sm-2" style="padding: 0 !important">
                <Sidebar>
                    <template v-slot:sidebarLinks>
                        <SidebarSection sectionTitle="Menage Pizzas" />
                        <SidebarLink to="/admin" linkText="Pizza Dashboard" />
                        <SidebarLink to="/admin/create" linkText="Add New" />
                        <SidebarSection sectionTitle="Menage Orders" />
                        <SidebarLink to="/admin/orders" linkText="Orders Dashboard" />
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
    components: {
        Sidebar, SidebarSection, SidebarLink
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
    }
</style>
