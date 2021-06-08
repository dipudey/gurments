<template>
  <div :class="className">
    <input
      type="text"
      class="from-control col-sm-12 col-md-3 p-1 mb-1"
      v-debounce="onInput"
      placeholder="Search here..."
      style="border: 1px solid #ddd; border-radius: 5px"
    />
    <table
      id="datatable"
      class="table table-bordered dt-responsive nowrap mb-2"
      style="border-collapse: collapse; border-spacing: 0; width: 100%"
    >
      <slot></slot>
    </table>

    <pagination
      :data="pagination"
      :limit="4"
      align="right"
      @pagination-change-page="filter"
    ></pagination>

    <div class="row">
      <div class="col-md-12 mt-3 text-right">
        <a :href="excelUrl" v-if="excelUrl" class="btn btn-success">
          <i class="fas fa-file-excel"></i> Export
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import pagination from "laravel-vue-pagination";
export default {
  components: {
    pagination,
  },
  props: {
    pagination: Object,
    filter: Function,
    excelUrl: String,
    className: String,
  },
  data() {
    return {
      table: null,
    };
  },
  methods: {
    onInput(v) {
      this.filter(1, v);
    },
  },
  beforeUpdate() {
    if (this.table) this.table.destroy();
  },
  updated() {
    this.table = $("#datatable").DataTable({
      paging: false,
      searching: false,
    });
  },
};
</script>

<style></style>
