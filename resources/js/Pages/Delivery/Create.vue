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
              <form @submit.prevent="store">
                <div class="row form-group">
                  <div class="col-md-6 mt-3">
                    <label for="">Product</label>
                    <Select2
                      v-model="form.product_id"
                      :options="ajaxOptions"
                      :settings="setting"
                    />
                    <span v-show="errors.product_id" class="text-danger">{{
                      errors.product_id
                    }}</span>
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Delivery Section</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.section"
                      required
                    />
                    <span v-show="errors.section" class="text-danger">{{
                      errors.section
                    }}</span>
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="">Delivery Date</label>
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
                    <label for="">Quantity</label>
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
      titleTemplate: "%s | Add Delivery",
    };
  },
  props: {
    errors: Object,
  },
  data() {
    return {
      inputVal: "",
      myOptions: [
        { id: "key", text: "value" },
        { id: "dfasdf", text: "vdfdfalue" },
      ],
      ajaxOptions: [],
      setting: {
        ajax: {
          url: "/product/json",
          dataType: "json",
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
              page: params.page,
            };
          },
          processResults: function (data, params) {
            params.page = params.page || 1;

            return {
              results: data.items,
              pagination: {
                more: data.pagination.more,
              },
            };
          },
          cache: true,
        },
        placeholder: "Search Your Product",
        minimumInputLength: 0,
      },
      ajaxOptionsSelected: null,
      form: this.$inertia.form({
        product_id: "",
        section: "",
        date: "",
        quantity: "",
      }),
    };
  },
  methods: {
    store() {
      this.form.post(this.$route("delivery.store"));
    },
  },
};
</script>

<style></style>
