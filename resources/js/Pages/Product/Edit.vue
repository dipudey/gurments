<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h3>Edit Product</h3>
            <inertia-link
              :href="$route('product.index')"
              class="btn btn-primary btn-sm"
              >All Product</inertia-link
            >
          </div>

          <div class="row">
            <div class="col-md-12">
              <form @submit.prevent="update">
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
      titleTemplate: "%s | Add Product",
    };
  },
  props: {
    product: Object,
  },
  watch: {
    product: {
      immediate: true,
      handler(data) {
        this.form.id = data.id;
        this.form.inhouse_date = data.inhouse_date;
        this.form.style_ref = data.style_ref;
        this.form.color = data.color;
        this.form.fabric_type = data.fabric_type;
        this.form.pantone_number = data.pantone_number;
        this.form.collection_ref = data.collection_ref;
        this.form.supplier = data.supplier;
        this.form.gsm_weight = data.gsm_weight;
        this.form.quantity_inhouse = data.quantity_inhouse;
        this.form.unit = data.unit;
      },
    },
  },
  data() {
    return {
      form: this.$inertia.form({
        id: "",
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
    update() {
      this.form.put(this.$route("product.update", this.product.id));
    },
  },
};
</script>

<style></style>
