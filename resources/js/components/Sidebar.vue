<template>
  <div class="vertical-menu">
    <div data-simplebar class="h-100">
      <!--- Sidemenu -->
      <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
          <li>
            <inertia-link
              :href="$route('home')"
              :class="
                activeMenuClassByArray([
                  'admin.dashboard',
                  'customer.dashboard',
                ])
              "
            >
              <i class="bx bx-home-circle"></i>
              <span key="t-dashboards">Dashboard</span>
            </inertia-link>
          </li>
          <li>
            <inertia-link
              href="#"
              class="has-arrow"
              :class="
                activeMenuClassByArray(['product.index', 'product.create'])
              "
            >
              <i class="bx bx-box"></i>
              <span key="t-layouts">Products</span>
            </inertia-link>
            <ul class="sub-menu" aria-expanded="false">
              <li>
                <inertia-link :href="$route('product.index')"
                  >Product List</inertia-link
                >
              </li>
              <li>
                <inertia-link :href="$route('product.create')"
                  >Add New Product</inertia-link
                >
              </li>
            </ul>
          </li>
          <li>
            <inertia-link
              href="#"
              class="has-arrow"
              :class="
                activeMenuClassByArray(['delivery.index', 'delivery.create'])
              "
            >
              <i class="bx bx-box"></i>
              <span key="t-layouts">Delivery</span>
            </inertia-link>
            <ul class="sub-menu" aria-expanded="false">
              <li>
                <inertia-link :href="$route('delivery.create')">
                  Add New Delivery</inertia-link
                >
              </li>
              <li>
                <inertia-link :href="$route('delivery.index')"
                  >Delivery List</inertia-link
                >
              </li>
            </ul>
          </li>
          <li>
            <inertia-link
              href="#"
              class="has-arrow"
              :class="activeMenuClassByArray(['reject.index', 'reject.create'])"
            >
              <i class="bx bx-box"></i>
              <span key="t-layouts">Reject</span>
            </inertia-link>
            <ul class="sub-menu" aria-expanded="false">
              <li>
                <inertia-link :href="$route('reject.create')">
                  Add New Reject Product</inertia-link
                >
              </li>
              <li>
                <inertia-link :href="$route('reject.index')"
                  >Reject Product List</inertia-link
                >
              </li>
            </ul>
          </li>
          <li>
            <inertia-link
              :href="$route('stock.index')"
              :class="activeMenuClassByArray(['stock.index'])"
            >
              <i class="bx bx-home-circle"></i>
              <span key="t-dashboards">Stock</span>
            </inertia-link>
          </li>
          <!-- <li>
            <inertia-link
              href="#"
              class="has-arrow"
              :class="activeMenuClassByArray(['reject.index', 'reject.create'])"
            >
              <i class="far fa-chart-bar"></i>
              <span key="t-layouts">Report</span>
            </inertia-link>
            <ul class="sub-menu" aria-expanded="false">
              <li>
                <inertia-link :href="$route('reject.create')">
                  Reject Product Report</inertia-link
                >
              </li>
              <li>
                <inertia-link :href="$route('reject.index')"
                  >Delivery Product Report</inertia-link
                >
              </li>
            </ul>
          </li> -->
        </ul>
      </div>
      <!-- Sidebar -->
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    activeMenuClass(route) {
      return this.$route().current(route)
        ? "waves-effect active"
        : "waves-effect";
    },
    activeSubMenuClass(route) {
      return this.$route().current(route) ? "mm-active" : "";
    },
    activeSubMenuClassByArray(routes) {
      let isActive = false;
      routes.forEach((item) => {
        if (this.$route().current(item)) {
          isActive = true;
        }
      });
      return isActive ? "mm-active" : "";
    },
    activeMenuClassByArray(routes) {
      let isActive = false;
      routes.forEach((item) => {
        if (this.$route().current(item)) {
          isActive = true;
        }
      });
      return isActive ? "waves-effect active" : "waves-effect";
    },
  },
};
</script>

<style></style>
