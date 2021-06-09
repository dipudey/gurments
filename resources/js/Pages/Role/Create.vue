<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h3>Add New Role</h3>
            <inertia-link
              :href="$route('role.index')"
              class="btn btn-primary btn-sm"
              >All Role</inertia-link
            >
          </div>

          <div class="row">
            <div class="col-md-12">
              <form @submit.prevent="store">
                <div class="row form-group">
                  <div class="col-md-12 mt-3">
                    <label for="">Role Name</label>
                    <input
                      type="text"
                      v-model="form.name"
                      class="form-control"
                      required
                    />
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <label for="">Permission</label>
                  </div>
                </div>
                <div class="row mt-4">
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="productlist"
                        type="checkbox"
                        v-model="form.permission.productlist"
                      />
                      <label for="productlist">Product List List </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="productadd"
                        type="checkbox"
                        v-model="form.permission.productadd"
                      />
                      <label for="productadd"> Product Add </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="deliveryadd"
                        type="checkbox"
                        v-model="form.permission.deliveryadd"
                      />
                      <label for="deliveryadd"> Delivery Add </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="deliverylist"
                        type="checkbox"
                        v-model="form.permission.deliverylist"
                      />
                      <label for="deliverylist"> Delivery List </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="rejectadd"
                        type="checkbox"
                        v-model="form.permission.rejectadd"
                      />
                      <label for="rejectadd"> Reject Add </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="rejectlist"
                        type="checkbox"
                        v-model="form.permission.rejectlist"
                      />
                      <label for="rejectlist"> Reject List </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="stock"
                        type="checkbox"
                        v-model="form.permission.stock"
                      />
                      <label for="stock"> Stock </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="role"
                        type="checkbox"
                        v-model="form.permission.role"
                      />
                      <label for="role"> Role </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="usercreate"
                        type="checkbox"
                        v-model="form.permission.usercreate"
                      />
                      <label for="usercreate"> User Create </label>
                    </div>
                  </label>
                  <label class="col-md-3 custom-control custom-checkbox">
                    <div class="checkbox checkbox-pink">
                      <input
                        id="userlist"
                        type="checkbox"
                        v-model="form.permission.userlist"
                      />
                      <label for="userlist"> User List </label>
                    </div>
                  </label>
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
      titleTemplate: "%s | Role Create",
    };
  },
  data() {
    return {
      form: this.$inertia.form({
        name: "",
        permission: {
          productlist: false,
          productadd: false,
          deliveryadd: false,
          deliverylist: false,
          rejectlist: false,
          rejectadd: false,
          stock: false,
          role: false,
          usercreate: false,
          userlist: false,
        },
      }),
    };
  },
  methods: {
    store() {
      this.form.post(this.$route("role.store"));
    },

    permissionCheck(value) {
      this.permission.push(value);
      console.log(permission);
    },
  },
};
</script>

<style></style>
