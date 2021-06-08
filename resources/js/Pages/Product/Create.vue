<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h3>Add New Product</h3>
            <inertia-link
              :href="$route('product.index')"
              class="btn btn-primary btn-sm"
              >All Product</inertia-link
            >
          </div>

          <div class="row">
            <div class="col-md-12">
              <form @submit.prevent="store">
                <div class="row form-group">
                  <div class="col-md-6 mt-3">
                    <label for="">Inhouse Date</label>
                    <input
                      type="date"
                      v-model="form.inhouse_date"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Style No</label>
                    <input
                      type="text"
                      v-model="form.style_ref"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Color</label>
                    <input
                      type="text"
                      v-model="form.color"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Fabric Type</label>
                    <input
                      type="text"
                      v-model="form.fabric_type"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Pantone Number</label>
                    <input
                      type="text"
                      v-model="form.pantone_number"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Collection Ref</label>
                    <input
                      type="text"
                      v-model="form.collection_ref"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Supplier</label>
                    <input
                      type="text"
                      v-model="form.supplier"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">GSM Weight</label>
                    <input
                      type="text"
                      v-model="form.gsm_weight"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Quantity Inhouse</label>
                    <input
                      type="text"
                      v-model="form.quantity_inhouse"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Unit</label>
                    <input
                      type="text"
                      v-model="form.unit"
                      class="form-control"
                      required
                    />
                  </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                  <button type="submit" class="btn btn-success">Save</button>
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
      titleTemplate: "%s | Add Product",
    };
  },
  data() {
    return {
      form: this.$inertia.form({
        inhouse_date: "",
        style_ref: "",
        color: "",
        fabric_type: "",
        pantone_number: "",
        collection_ref: "",
        supplier: "",
        gsm_weight: "",
        quantity_inhouse: "",
        unit: "",
      }),
    };
  },
  methods: {
    store() {
      this.form.post(this.$route("product.store"));
    },
  },
};
</script>

<style></style>
