import Vue from "vue";

export default {
    data() {
        return {
            ShopStatus: Object.freeze({
                Pending: 1,
                OnProcessing: 2,
                OnDelivery: 3,
                Delivered: 4,
                Complete: 5,
                Cancelled: 6,
            })
        };
    },
    methods: {
        confirmDelete: fun =>
            Vue.swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    fun();
                }
            }),
        sweetConfirm: fun =>
            Vue.swal({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "No",
            }).then(result => {
                if (result.isConfirmed) {
                    fun();
                }
            }),
        hasPermission(permission) {
            return (
                this.permissions.hasOwnProperty(permission) &&
                this.permissions[permission]
            );
        },
        paginatedSL(pagination, index) {
            return (
                (pagination.current_page - 1) * pagination.per_page + index + 1
            );
        },
        alertSuccess(message) {
            this.$noty.success(message);
        },
        alertError(message) {
            this.$noty.error(message);
        },
        optional(obj, returnInsted = null) {
            if (obj == null) return returnInsted ? returnInsted : {};
            return obj;
        },
        hasIndexedError(errors, objName, propertyName, index) {
            return errors.hasOwnProperty(
                objName + '.' + index + '.' + propertyName
            );
        }
    },
    computed: {
        isAdmin() {
            return true;
            return this.$page.props.authUser.type == "Admin";
        },
        permissions() {
            return [];
            return JSON.parse(this.$page.props.authUser.permissions);
        }
    }
};
