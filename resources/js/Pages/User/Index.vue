 <template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h4 class="card-title">All User List</h4>
            <inertia-link
              :href="$route('user.create')"
              class="btn btn-primary btn-sm"
            >
              Add New User
            </inertia-link>
          </div>

          <DataTable
            v-if="allUsers"
            :pagination="allUsers"
            :filter="filter"
            className="mt-4"
          >
            <thead>
              <tr>
                <th scope="col">Sl</th>
                <th scope="col">Action</th>
                <th scope="col">User Name</th>
                <th scope="col">User Email</th>
                <th scope="col">Role Name</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, index) in allUsers.data" :key="index">
                <td>{{ index + 1 }}</td>
                <td>
                  <div class="btn-group">
                    <inertia-link
                      class="btn btn-sm btn-info"
                      :href="$route('user.edit', user.id)"
                      ><i class="fa fa-edit"></i
                    ></inertia-link>
                    <button
                      class="btn btn-sm btn-danger"
                      @click="destroy(user.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                  {{
                    user.role_has_permission
                      ? user.role_has_permission.role.name
                      : ""
                  }}
                </td>
              </tr>
            </tbody>
          </DataTable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppLayout from "./../../AppLayout";
import DataTable from "./../../components/DataTable";
export default {
  layout: AppLayout,
  metaInfo() {
    return {
      titleTemplate: "%s | User Create",
    };
  },
  components: {
    DataTable,
  },
  props: {
    users: Object,
  },
  watch: {
    users: {
      immediate: true,
      handler(data) {
        this.allUsers = data;
      },
    },
  },
  data() {
    return {
      allUsers: {},
    };
  },
  methods: {
    destroy(id) {
      this.confirmDelete(() =>
        this.$inertia.delete(this.$route("user.destroy", id))
      );
    },
    filter(page = 1, search = "") {
      axios
        .get(
          this.$route("user.paginate") + "?page=" + page + "&search=" + search
        )
        .then((response) => {
          this.allUsers = response.data;
        });
    },
  },
};
</script>

<style></style>
