<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h3>Add New Delivery</h3>
            <inertia-link
              :href="$route('delivery.index')"
              class="btn btn-primary btn-sm"
              >All Delivery</inertia-link
            >
          </div>

          <div class="row">
            <div class="col-md-12">
              <form @submit.prevent="update">
                <div class="row form-group">
                  <div class="col-md-6 mt-3">
                    <label for="">Product</label>
                    <v-select
                      v-model="selectedProduct"
                      :options="products"
                    ></v-select>
                    <span v-show="errors.product_id" class="text-danger">{{
                      errors.product_id
                    }}</span>
                  </div>

                  <div class="col-md-6 mt-3">
                    <label for="">Reject Date</label>
                    <input
                      type="date"
                      class="form-control"
                      v-model="form.date"
                      required
                    />
                    <span v-show="errors.date" class="text-danger">{{
                      errors.date
                    }}</span>
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Reject Quantity</label>
                    <input
                      type="number"
                      class="form-control"
                      v-model="form.quantity"
                      required
                    />
                    <span v-show="errors.quantity" class="text-danger">{{
                      errors.quantity
                    }}</span>
                  </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                  <button type="submit" class="btn btn-success">
                    Save & Change
                  </button>
                </div>
              </form>
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
      titleTemplate: "%s | Edit Reject Product",
    };
  },
  props: {
    rejectProduct: Object,
    errors: Object,
    products: Array,
  },
  watch: {
    rejectProduct: {
      immediate: true,
      handler(data) {
        this.form.id = data.id;
        this.form.product_id = data.product_id;
        this.form.date = data.date;
        this.form.quantity = data.quantity;
        this.selectedProduct = {
          label: data.product.fabric_type,
          value: data.product_id,
        };
      },
    },
  },
  data() {
    return {
      inputVal: "",
      selectedProduct: "0",
      form: this.$inertia.form({
        id: "",
        product_id: "",
        date: "",
        quantity: "",
      }),
    };
  },
  methods: {
    update() {
      this.form.product_id = this.selectedProduct.value;
      this.form.put(this.$route("reject.update", this.rejectProduct.id));
    },
  },
};
</script>

<style></style>
