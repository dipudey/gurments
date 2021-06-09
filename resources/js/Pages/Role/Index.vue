 <template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h4 class="card-title">All Role List</h4>
            <inertia-link
              :href="$route('role.create')"
              class="btn btn-primary btn-sm"
            >
              Add New Role
            </inertia-link>
          </div>

          <DataTable
            v-if="allRoles"
            :pagination="allRoles"
            :filter="filter"
            className="mt-4"
          >
            <thead>
              <tr>
                <th scope="col">Sl</th>
                <th scope="col">Action</th>
                <th scope="col">Role Name</th>
                <th scope="col">Permission</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(role, index) in allRoles.data" :key="index">
                <td>{{ index + 1 }}</td>
                <td>
                  <div class="btn-group">
                    <inertia-link
                      class="btn btn-sm btn-info"
                      :href="$route('role.edit', role.id)"
                      ><i class="fa fa-edit"></i
                    ></inertia-link>
                    <button
                      class="btn btn-sm btn-danger"
                      @click="destroy(role.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </td>
                <td>{{ role.name }}</td>
                <td>
                  <span
                    class="badge badge-success mr-2"
                    v-for="(p, index) in JSON.parse(role.permission)"
                    :key="index"
                    >{{ p }}</span
                  >
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
      titleTemplate: "%s | Role",
    };
  },
  components: {
    DataTable,
  },
  props: {
    roles: Object,
  },
  watch: {
    roles: {
      immediate: true,
      handler(data) {
        this.allRoles = data;
      },
    },
  },
  data() {
    return {
      allRoles: {},
    };
  },
  methods: {
    destroy(id) {
      this.confirmDelete(() =>
        this.$inertia.delete(this.$route("role.destroy", id))
      );
    },
    filter(page = 1, search = "") {
      axios
        .get(
          this.$route("role.paginate") + "?page=" + page + "&search=" + search
        )
        .then((response) => {
          this.allRoles = response.data;
        });
    },
  },
};
</script>

<style></style>
