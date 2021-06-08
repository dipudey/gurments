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
            v-if="alldeliveries"
            :pagination="alldeliveries"
            :filter="filter"
            className="mt-4"
          >
            <thead>
              <tr>
                <th scope="col">Sl</th>
                <th scope="col">Action</th>
                <th scope="col">Delivery Date</th>
                <th scope="col">Deliver Section</th>
                <th scope="col">Fabric Type</th>
                <th scope="col">Style Ref</th>
                <th scope="col">Color</th>
                <th scope="col">GSM/weight</th>
                <th scope="col">Deliver Quantity</th>
                <th scope="col">Unit</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(delivery, index) in alldeliveries.data" :key="index">
                <td scope="col">{{ paginatedSL(alldeliveries, index) }}</td>
                <td scope="col">
                  <div class="btn-group">
                    <inertia-link
                      class="btn btn-sm btn-info"
                      :href="$route('delivery.edit', delivery.id)"
                      ><i class="fa fa-edit"></i
                    ></inertia-link>
                    <button
                      class="btn btn-sm btn-danger"
                      @click="destroy(delivery.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </td>
                <td scope="col">{{ delivery.date }}</td>
                <td scope="col">{{ delivery.section }}</td>
                <td scope="col">{{ delivery.product.fabric_type }}</td>
                <td scope="col">{{ delivery.product.style_ref }}</td>
                <td scope="col">{{ delivery.product.color }}</td>
                <td scope="col">{{ delivery.product.gsm_weight }}</td>
                <td scope="col">{{ delivery.quantity }}</td>
                <td scope="col">{{ delivery.product.unit }}</td>
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
      titleTemplate: "%s | Deliverie List",
    };
  },
  components: {
    DataTable,
  },
  props: {
    deliveries: Object,
  },
  watch: {
    deliveries: {
      immediate: true,
      handler(data) {
        this.alldeliveries = data;
      },
    },
  },
  data() {
    return {
      alldeliveries: {},
    };
  },
  methods: {
    destroy(id) {
      this.confirmDelete(() =>
        this.$inertia.delete(this.$route("delivery.destroy", id))
      );
    },
    filter(page = 1, search = "") {
      axios
        .get(
          this.$route("delivery.paginate") +
            "?page=" +
            page +
            "&search=" +
            search
        )
        .then((response) => {
          this.alldeliveries = response.data;
        });
    },
  },
};
</script>

<style></style>
