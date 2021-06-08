<template>
  <div>
    <header id="page-topbar">
      <div class="navbar-header">
        <div class="d-flex">
          <!-- LOGO -->
          <div class="navbar-brand-box">
            <a href="/" class="logo logo-dark">
              <span class="logo-sm">
                <img
                  src="https://www.akaarit.com/images/icons/logo.png"
                  alt=""
                  height="22"
                />
              </span>
              <span class="logo-lg">
                <img
                  src="https://www.akaarit.com/images/icons/logo.png"
                  alt=""
                  height="17"
                />
              </span>
            </a>

            <a href="/" class="logo logo-light">
              <span class="logo-sm">
                <img
                  src="https://www.akaarit.com/images/icons/logo.png"
                  alt=""
                  height="22"
                />
              </span>
              <span class="logo-lg">
                <img
                  src="https://www.akaarit.com/images/icons/logo.png"
                  alt=""
                  height="19"
                />
              </span>
            </a>
          </div>

          <button
            type="button"
            class="btn btn-sm px-3 font-size-16 header-item waves-effect"
            id="vertical-menu-btn"
          >
            <i class="fa fa-fw fa-bars"></i>
          </button>

          <div class="px-3 font-size-16 header-item mt-3"></div>
        </div>

        <div class="d-flex">
          <div class="dropdown d-inline-block d-lg-none ml-2">
            <button
              type="button"
              class="btn header-item noti-icon waves-effect"
              id="page-header-search-dropdown"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="mdi mdi-magnify"></i>
            </button>
            <div
              class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
              aria-labelledby="page-header-search-dropdown"
            >
              <form class="p-3">
                <div class="form-group m-0">
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Search ..."
                      aria-label="Recipient's username"
                    />
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                        <i class="mdi mdi-magnify"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="dropdown d-none d-lg-inline-block ml-1">
            <button
              type="button"
              class="btn header-item noti-icon waves-effect"
              data-toggle="fullscreen"
            >
              <i class="bx bx-fullscreen"></i>
            </button>
          </div>

          <div class="dropdown d-inline-block">
            <button
              type="button"
              class="btn header-item waves-effect"
              id="page-header-user-dropdown"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <span class="d-none d-xl-inline-block ml-1" key="t-henry"
                >Admin</span
              >
              <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <a @click="logout" class="dropdown-item"
                ><i
                  class="
                    bx bx-power-off
                    font-size-16
                    align-middle
                    mr-1
                    text-danger
                  "
                ></i>
                <span key="t-logout">Logout</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      trackingId: null,
      trackingOrder: null,
    };
  },
  methods: {
    logout() {
      axios.post("/logout").then((response) => {
        window.location.href = "/";
      });
    },
  },
  computed: {
    name() {
      return this.$page.props.authUser.name;
    },
    logo() {
      return this.$page.props.setting
        ? "/" + this.$page.props.setting.logo
        : "/images/logo.png";
    },
  },
};
</script>

<style>
a.logo img {
  height: 48px;
  width: 120px;
}
.vertical-collpsed a.logo img {
  height: 24px;
  width: 36px;
}

body {
  margin-top: 20px;
}

.steps .step {
  display: block;
  width: 100%;
  margin-bottom: 35px;
  text-align: center;
}

.steps .step .step-icon-wrap {
  display: block;
  position: relative;
  width: 100%;
  height: 80px;
  text-align: center;
}

.steps .step .step-icon-wrap::before,
.steps .step .step-icon-wrap::after {
  display: block;
  position: absolute;
  top: 50%;
  width: 50%;
  height: 3px;
  margin-top: -1px;
  background-color: #e1e7ec;
  content: "";
  z-index: 1;
}

.steps .step .step-icon-wrap::before {
  left: 0;
}

.steps .step .step-icon-wrap::after {
  right: 0;
}

.steps .step .step-icon {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
  border: 1px solid #e1e7ec;
  border-radius: 50%;
  background-color: #f5f5f5;
  color: #374250;
  font-size: 38px;
  line-height: 81px;
  z-index: 5;
}

.steps .step .step-title {
  margin-top: 16px;
  margin-bottom: 0;
  color: #606975;
  font-size: 14px;
  font-weight: 500;
}

.steps .step:first-child .step-icon-wrap::before {
  display: none;
}

.steps .step:last-child .step-icon-wrap::after {
  display: none;
}

.steps .step.completed .step-icon-wrap::before,
.steps .step.completed .step-icon-wrap::after {
  background-color: #0da9ef;
}

.steps .step.completed .step-icon {
  border-color: #0da9ef;
  background-color: #0da9ef;
  color: #fff;
}

@media (max-width: 576px) {
  .flex-sm-nowrap .step .step-icon-wrap::before,
  .flex-sm-nowrap .step .step-icon-wrap::after {
    display: none;
  }
}

@media (max-width: 768px) {
  .flex-md-nowrap .step .step-icon-wrap::before,
  .flex-md-nowrap .step .step-icon-wrap::after {
    display: none;
  }
}

@media (max-width: 991px) {
  .flex-lg-nowrap .step .step-icon-wrap::before,
  .flex-lg-nowrap .step .step-icon-wrap::after {
    display: none;
  }
}

@media (max-width: 1200px) {
  .flex-xl-nowrap .step .step-icon-wrap::before,
  .flex-xl-nowrap .step .step-icon-wrap::after {
    display: none;
  }
}

.bg-faded,
.bg-secondary {
  background-color: #f5f5f5 !important;
}
</style>