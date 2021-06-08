<template>
  <div class="modal" :id="id" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form @submit.prevent="onPrimary">
          <div class="modal-header">
            <h5 class="modal-title" v-if="title">{{ title }}</h5>
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
            <slot></slot>
          </div>
          <div class="modal-footer" v-if="onPrimary || onClose">
            <button
              v-if="onPrimary"
              @click="onPrimary"
              type="button"
              class="btn btn-primary"
            >
              {{ primaryText && primaryText.length ? primaryText : "Ok" }}
            </button>
            <button
              v-if="onClose"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              {{ closeText && closeText.length ? closeText : "Close" }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: String,
    title: String,
    primaryText: String,
    closeText: String,
    onPrimary: Function,
    onClose: Function,
  },
  data() {
    return {
      isClosed: false,
    };
  },
  mounted() {
    $(`#${this.id}`).modal("show");
    const $this = this;
    $(`#${this.id}`).on("hidden.bs.modal", function (e) {
      if ($this.onClose != null && !$this.isClosed) {
        $this.onClose();
        $(`#${this.id}`).modal("hide");
      }
    });
  },
  beforeDestroy() {
    $(".modal-backdrop.show").remove();
  },
};
</script>

<style>
</style>