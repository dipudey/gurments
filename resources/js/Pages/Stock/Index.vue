 <template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <h4 class="card-title">Stock</h4>
            <div class="btn-group">
              <a href="/product/stock/export/excel" class="btn btn-success">
                Download Excel
              </a>
              <a
                href="/product/stock/export/pdf"
                class="btn btn-primary active"
              >
                Download Pdf
              </a>
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
                <th scope="col">Inhouse Date</th>
                <th scope="col">Style Ref</th>
                <th scope="col">Color</th>
                <th scope="col">Fabric Type</th>
                <th scope="col">Pantone Number</th>
                <th scope="col">Collection Ref</th>
                <th scope="col">Supplier</th>
                <th scope="col">GSM/weight</th>
                <th scope="col">Unit</th>
                <th scope="col">Quantity Inhouse</th>
                <th scope="col">Reject Quantity</th>
                <th scope="col">Deliver Quantity</th>
                <th scope="col">Current Stock</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(product, index) in allProducts.data" :key="index">
                <td>{{ paginatedSL(allProducts, index) }}</td>
                <td>{{ product.inhouse_date }}</td>
                <td>{{ product.style_ref }}</td>
                <td>{{ product.color }}</td>
                <td>{{ product.fabric_type }}</td>
                <td>{{ product.pantone_number }}</td>
                <td>{{ product.collection_ref }}</td>
                <td>{{ product.supplier }}</td>
                <td>{{ product.gsm_weight }}</td>
                <td>{{ product.unit }}</td>
                <td>{{ product.quantity_inhouse }}</td>
                <td>{{ product.reject_total }}</td>
                <td>{{ product.deliver_total }}</td>
                <td>
                  {{
                    product.quantity_inhouse -
                    product.reject_total -
                    product.deliver_total
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
      titleTemplate: "%s | Stock List",
    };
  },
  components: {
    DataTable,
  },
  props: {
    products: Object,
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
    };
  },
  methods: {
    destroy(id) {
      this.confirmDelete(() =>
        this.$inertia.delete(this.$route("product.destroy", id))
      );
    },
    filter(page = 1, search = "") {
      axios
        .get(
          this.$route("stock.paginate") + "?page=" + page + "&search=" + search
        )
        .then((response) => {
          this.allProducts = response.data;
        });
    },
  },
};
</script>

<style></style>
