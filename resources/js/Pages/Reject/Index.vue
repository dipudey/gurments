 <template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h4 class="card-title">All Delivery List</h4>
            <a :href="$route('delivery.create')" class="btn btn-primary btn-sm">
              Add New Delivery
            </a>
          </div>

          <DataTable
            v-if="allRejects"
            :pagination="allRejects"
            :filter="filter"
            className="mt-4"
          >
            <thead>
              <tr>
                <th scope="col">Sl</th>
                <th scope="col">Action</th>
                <th scope="col">Reject Date</th>
                <th scope="col">Fabric Type</th>
                <th scope="col">Style Ref</th>
                <th scope="col">Color</th>
                <th scope="col">GSM/weight</th>
                <th scope="col">Reject Quantity</th>
                <th scope="col">Unit</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(reject, index) in allRejects.data" :key="index">
                <td scope="col">{{ paginatedSL(allRejects, index) }}</td>
                <td scope="col">
                  <div class="btn-group">
                    <inertia-link
                      class="btn btn-sm btn-info"
                      :href="$route('reject.edit', reject.id)"
                      ><i class="fa fa-edit"></i
                    ></inertia-link>
                    <button
                      class="btn btn-sm btn-danger"
                      @click="destroy(reject.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </td>
                <td scope="col">{{ reject.date }}</td>
                <td scope="col">{{ reject.product.fabric_type }}</td>
                <td scope="col">{{ reject.product.style_ref }}</td>
                <td scope="col">{{ reject.product.color }}</td>
                <td scope="col">{{ reject.product.gsm_weight }}</td>
                <td scope="col">{{ reject.quantity }}</td>
                <td scope="col">{{ reject.product.unit }}</td>
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
      titleTemplate: "%s | Reject Product List",
    };
  },
  components: {
    DataTable,
  },
  props: {
    rejects: Object,
  },
  watch: {
    rejects: {
      immediate: true,
      handler(data) {
        this.allRejects = data;
      },
    },
  },
  data() {
    return {
      allRejects: {},
    };
  },
  methods: {
    destroy(id) {
      this.confirmDelete(() =>
        this.$inertia.delete(this.$route("reject.destroy", id))
      );
    },
    filter(page = 1, search = "") {
      axios
        .get(
          this.$route("reject.paginate") + "?page=" + page + "&search=" + search
        )
        .then((response) => {
          this.allRejects = response.data;
        });
    },
  },
};
</script>

<style></style>
