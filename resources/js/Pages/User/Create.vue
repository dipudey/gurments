<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h3>Add New User</h3>
            <inertia-link
              :href="$route('user.index')"
              class="btn btn-primary btn-sm"
              >All User</inertia-link
            >
          </div>

          <div class="row">
            <div class="col-md-12">
              <form @submit.prevent="store">
                <div class="row form-group">
                  <div class="col-md-12 mt-3">
                    <label for="">Name</label>
                    <input
                      type="text"
                      v-model="form.name"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-12 mt-3">
                    <label for="">Email</label>
                    <input
                      type="email"
                      v-model="form.email"
                      class="form-control"
                      required
                    />
                    <span v-if="errors.email" class="text-danger">{{
                      errors.email
                    }}</span>
                  </div>
                  <div class="col-md-12 mt-3">
                    <label for="">password</label>
                    <input
                      type="password"
                      v-model="form.password"
                      class="form-control"
                      required
                    />
                  </div>
                  <div class="col-md-12 mt-3">
                    <label for="">User Role</label>
                    <select v-model="form.role_id" id="" class="form-control">
                      <option value="">select</option>
                      <option
                        v-for="role in roles"
                        :key="role.id"
                        :value="role.id"
                      >
                        {{ role.name }}
                      </option>
                    </select>
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
      titleTemplate: "%s | Role Create",
    };
  },
  props: {
    errors: Object,
    roles: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        role_id: "",
      }),
    };
  },
  methods: {
    store() {
      this.form.post(this.$route("user.store"));
    },
  },
};
</script>

<style></style>
