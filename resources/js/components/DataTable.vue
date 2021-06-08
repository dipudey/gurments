<template>
  <div class="ndt" :class="className">
    <div class="row mb-2">
      <div class="col-md-4">
        <input
          type="text"
          class="from-control ndt-search"
          v-debounce="onInput"
          placeholder="Search here..."
          style="border: 1px solid #ddd; border-radius: 5px"
        />
      </div>
      <div class="col-md-8">
        <slot name="filters"></slot>
      </div>
    </div>

    <table
      id="datatable"
      class="table table-bordered dt-responsive nowrap ndt-table mb-2"
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

<style>
.ndt .vfc-single-input,
.ndt .vfc-multiple-input input {
  border: 1px solid #3a8f56 !important;
  border-radius: 0px !important;
  color: #3a8f56 !important;
}
.ndt .vfc-multiple-input {
  display: flex;
  justify-content: flex-end;
}
.ndt .vfc-single-input,
.ndt .vfc-multiple-input input::placeholder {
  color: #3a8f56 !important;
}
.ndt .vs__dropdown-toggle {
  border-radius: 0px !important;
  height: 35px !important;
  border: 1px solid #3a8f56 !important;
}
.ndt .vs__selected-options input::placeholder {
  color: #3a8f56 !important;
}
.ndt .vs__open-indicator {
  fill: #057d2a !important;
}
.ndt input.ndt-search {
  border: 1px solid #3a8f56 !important;
  height: 35px !important;
  border-radius: 0px !important;
  padding: 8px;
  color: #3a8f56 !important;
}
.ndt input.ndt-search::placeholder {
  color: #3a8f56 !important;
}
.ndt-table thead th {
  vertical-align: bottom;
  border-bottom: 1px solid #057d2a;
}
.ndt-table td,
.ndt-table th {
  border: 1px solid #e9ecef !important;
}
.ndt-table thead {
  background: #057d2a !important;
  color: white !important;
}
</style>
