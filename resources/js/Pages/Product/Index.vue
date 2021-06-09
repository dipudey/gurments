 <template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h4 class="card-title">All Product List</h4>

            <div>
              <a
                :href="$route('product.create')"
                class="btn btn-primary btn-sm"
              >
                Add New Product
              </a>
              <button
                type="button"
                @click="importProduct"
                class="btn btn-success btn-sm"
              >
                Import Product
              </button>
            </div>
          </div>

          <DataTable
            v-if="allProducts"
            :pagination="allProducts"
            :filter="filter"
            className="mt-4"
          >
            <thead>
              <tr>
                <th scope="col">Sl</th>
                <th scope="col">Action</th>
                <th scope="col">Inhouse Date</th>
                <th scope="col">Style Ref</th>
                <th scope="col">Color</th>
                <th scope="col">Fabric Type</th>
                <th scope="col">Pantone Number</th>
                <th scope="col">Collection Ref</th>
                <th scope="col">Supplier</th>
                <th scope="col">GSM/weight</th>
                <th scope="col">Quantity Inhouse</th>
                <th scope="col">Unit</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(product, index) in allProducts.data" :key="index">
                <td scope="col">{{ paginatedSL(allProducts, index) }}</td>
                <td scope="col">
                  <div class="btn-group">
                    <inertia-link
                      class="btn btn-sm btn-info"
                      :href="$route('product.edit', product.id)"
                      ><i class="fa fa-edit"></i
                    ></inertia-link>
                    <button
                      class="btn btn-sm btn-danger"
                      @click="destroy(product.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </td>
                <td scope="col">{{ product.inhouse_date }}</td>
                <td scope="col">{{ product.style_ref }}</td>
                <td scope="col">{{ product.color }}</td>
                <td scope="col">{{ product.fabric_type }}</td>
                <td scope="col">{{ product.pantone_number }}</td>
                <td scope="col">{{ product.collection_ref }}</td>
                <td scope="col">{{ product.supplier }}</td>
                <td scope="col">{{ product.gsm_weight }}</td>
                <td scope="col">{{ product.quantity_inhouse }}</td>
                <td scope="col">{{ product.unit }}</td>
              </tr>
            </tbody>
          </DataTable>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="productModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Import Product Csv File `
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="store">
              <div class="form-group">
                <label for="">Csv File</label>
                <input
                  type="file"
                  class="form-control"
                  @change="file"
                  required
                />
                <span v-if="errors.csv">{{ errors.csv }}</span>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-info">Save</button>
              </div>
            </form>
          </div>
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
      titleTemplate: "%s | Product List",
    };
  },
  components: {
    DataTable,
  },
  props: {
    products: Object,
    errors: Object,
  },
  watch: {
    products: {
      immediate: true,
      handler(data) {
        this.allProducts = data;
      },
    },
  },
  data() {
    return {
      allProducts: {},
      form: this.$inertia.form({
        csv: "",
      }),
    };
  },
  methods: {
    store() {
      this.form.post(this.$route("product.import"), {
        onSuccess: this.close,
      });
    },
    close() {
      this.form.csv = "";
      $("#productModal").modal("hide");
    },
    destroy(id) {
      this.confirmDelete(() =>
        this.$inertia.delete(this.$route("product.destroy", id))
      );
    },
    filter(page = 1, search = "") {
      axios
        .get(
          this.$route("product.paginate") +
            "?page=" +
            page +
            "&search=" +
            search
        )
        .then((response) => {
          this.allProducts = response.data;
        });
    },
    importProduct() {
      $("#productModal").modal("show");
    },

    file(e) {
      this.form.csv = e.target.files[0];
    },
  },
};
</script>

<style></style>
