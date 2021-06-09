<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <div class="card mini-stats-wid">
          <div class="card-body">
            <div class="media">
              <div class="media-body">
                <p class="text-muted font-weight-medium">Total Products</p>
                <h4 class="mb-0">{{ total_products }}</h4>
              </div>

              <div
                class="
                  mini-stat-icon
                  avatar-sm
                  rounded-circle
                  bg-primary
                  align-self-center
                "
              >
                <span class="avatar-title">
                  <i class="bx bx-purchase-tag font-size-24"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mini-stats-wid">
          <div class="card-body">
            <div class="media">
              <div class="media-body">
                <p class="text-muted font-weight-medium">Total Reject</p>
                <h4 class="mb-0">{{ total_rejects }}</h4>
              </div>

              <div
                class="
                  mini-stat-icon
                  avatar-sm
                  rounded-circle
                  bg-primary
                  align-self-center
                "
              >
                <span class="avatar-title">
                  <i class="bx bx-purchase-tag font-size-24"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mini-stats-wid">
          <div class="card-body">
            <div class="media">
              <div class="media-body">
                <p class="text-muted font-weight-medium">
                  Total Delivery Product
                </p>
                <h4 class="mb-0">{{ total_deliver }}</h4>
              </div>

              <div
                class="
                  mini-stat-icon
                  avatar-sm
                  rounded-circle
                  bg-primary
                  align-self-center
                "
              >
                <span class="avatar-title">
                  <i class="bx bx-purchase-tag font-size-24"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="">
              <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title mb-3">
                  <b>Top 10 Delivery Product This Month</b>
                </h4>
                <canvas id="barChart" class="mt-3 mb-5"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppLayout from "./../../AppLayout";
export default {
  layout: AppLayout,
  metaInfo() {
    return {
      titleTemplate: "%s | Dashboard",
    };
  },
  props: {
    total_products: Number,
    total_rejects: Number,
    total_deliver: Number,
    best_sale_product: Array,
    best_sale_product_name: Array,
  },
  mounted() {
    let datas = this.best_sale_product;
    let products = this.best_sale_product_name;
    let barCanvas = $("#barChart");
    let barChart = new Chart(barCanvas, {
      type: "bar",
      data: {
        labels: products,
        datasets: [
          {
            label: "Top 10 Selling Product This Month",
            data: datas,
            backgroundColor: [
              "read",
              "orange",
              "yellow",
              "green",
              "blue",
              "indigo",
              "violet",
              "purple",
              "pink",
              "gray",
            ],
          },
        ],
        options: {
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
          },
        },
      },
    });
  },
};
</script>

<style></style>
