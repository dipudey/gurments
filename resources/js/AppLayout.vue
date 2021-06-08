<template>
  <div id="layout-wrapper">
    <topbar></topbar>
    <sidebar></sidebar>

    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <slot></slot>
            </div>
          </div>
        </div>
        <!-- container-fluid -->
      </div>
      <!-- End Page-content -->

      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">© Akaar IT.</div>
            <div class="col-sm-6">
              <div class="text-sm-right d-none d-sm-block">
                Design & Develop by Akaar IT
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- end main content-->
  </div>
</template>

<script>
import Sidebar from "./components/Sidebar.vue";
import Topbar from "./components/Topbar.vue";
import "vuejs-noty/dist/vuejs-noty.css";
import "sweetalert2/dist/sweetalert2.min.css";
import "vue-select/dist/vue-select.css";

export default {
  metaInfo() {
    return {
      title: "Gurments",
    };
  },
  components: {
    Sidebar,
    Topbar,
  },
  updated() {
    if (this.$page.props.success != null) {
      this.$noty.success(this.$page.props.success);
    } else if (this.$page.props.error != null) {
      this.$noty.error(this.$page.props.error);
    }
  },
};
</script>

<style>
.invalid-feedback {
  display: block !important;
  width: 100%;
  margin-top: 0.25rem;
  font-size: 85%;
  color: #f46a6a;
}
body {
  background-color: #eee;
}
body[data-sidebar="dark"] .navbar-brand-box,
body[data-sidebar="dark"] .vertical-menu {
  background: #0373d6;
}
body[data-sidebar="dark"] #sidebar-menu ul li a,
body[data-sidebar="dark"] #sidebar-menu ul li a i,
body[data-sidebar="dark"] .menu-title {
  color: rgba(255, 255, 255, 0.8);
}
.btn-primary {
  background-color: rgb(40, 40, 161);
  border-color: rgb(40, 40, 161);
}
.btn-info {
  background-color: #0087ff;
  border-color: #0087ff;
}
.btn-success {
  background-color: #057d2a;
  border-color: #057d2a;
}
.btn-warning {
  background-color: orange;
  border-color: orange;
}
.btn-danger {
  background-color: orangered;
  border-color: orangered;
}
.waves-effect.active {
  font-weight: bold;
}
body[data-sidebar="dark"] #sidebar-menu ul li ul.sub-menu li a {
  color: #ddd;
}
body[data-sidebar="dark"] li.mm-active {
  color: #fff !important;
  background-color: #28529e94;
}
body[data-sidebar="dark"] .sub-menu li.mm-active {
  background-color: #63a4f5a8;
}
input.form-control:disabled {
  background: #eee;
  cursor: not-allowed;
}
li.nav-item {
  cursor: pointer !important;
}
input.vs__search {
  min-height: 26px !important;
}
</style>
