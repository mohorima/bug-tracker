<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-3 mb-5">
                <div
                    class="d-flex justify-content-between align-items-center mb-4"
                >
                    <div class="input-group input-group-search">
                        <div class="input-group-prepend">
                            <div
                                class="input-group-text input-group-prepend-search"
                            >
                                <svg
                                    width="19"
                                    height="19"
                                    viewBox="0 0 19 19"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <circle
                                        cx="8.02778"
                                        cy="8.02778"
                                        r="7.02778"
                                        stroke="#596152"
                                        stroke-width="2"
                                    />
                                    <line
                                        x1="17.4747"
                                        y1="17"
                                        x2="14.1667"
                                        y2="13.692"
                                        stroke="#596152"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                    />
                                </svg>
                            </div>
                        </div>
                        <input
                            type="text"
                            placeholder="Search"
                            class="form-control search-box"
                            v-model="keywords"
                        />
                    </div>

                    <button type="button" class="btn btn-new" @click="newModal">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        <div class="hide ml-3">
                            New Permission
                        </div>
                    </button>
                </div>

                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm" scope="col">Actions</th>
                                    <th class="th-lg" scope="col">Slug</th>
                                    <th class="th-lg" scope="col">
                                        Description
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="permission in permissions">
                                    <th scope="row">
                                        <a
                                            href=""
                                            @click.prevent="
                                                editModal(permission)
                                            "
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Edit"
                                        >
                                            <svg
                                                class="mr-2"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <rect
                                                    width="24"
                                                    height="24"
                                                    rx="7"
                                                    fill="#4FC03C"
                                                />
                                                <path
                                                    d="M11.4949 6.85894L15.9245 11.2897L11.4949 6.85894V6.85894ZM18.5123 6.17494C18.6308 6.29242 18.7248 6.4323 18.7888 6.58644C18.8528 6.74058 18.8855 6.9059 18.8851 7.0728C18.8846 7.2397 18.8509 7.40483 18.7861 7.55861C18.7212 7.71239 18.6264 7.85173 18.5072 7.96854L9.06926 17.4065L3.89999 18.8847L5.37693 13.7167L14.8149 4.27747C14.9318 4.15864 15.0712 4.06415 15.2249 3.99947C15.3786 3.93478 15.5436 3.90117 15.7103 3.90058C15.8771 3.89999 16.0423 3.93244 16.1965 3.99604C16.3506 4.05964 16.4906 4.15314 16.6085 4.27114L18.5135 6.1762L18.5123 6.17494Z"
                                                    stroke="white"
                                                    stroke-width="1.33333"
                                                />
                                            </svg>
                                        </a>
                                        <a
                                            href=""
                                            @click.prevent="
                                                deletePermission(permission.id)
                                            "
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Delete"
                                        >
                                            <svg
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <rect
                                                    width="24"
                                                    height="24"
                                                    rx="7"
                                                    fill="#4FC03C"
                                                />
                                                <path
                                                    d="M13.648 9.93334V16.3333M7.19999 7.80001H16.8V18.4667H7.19999V7.80001ZM4.53333 7.80001H19.4667H4.53333ZM9.18826 4.60001H14.5216V7.80001H9.18826V4.60001ZM10.448 9.93334V16.3333V9.93334Z"
                                                    stroke="white"
                                                    stroke-width="1.33333"
                                                />
                                            </svg>
                                        </a>
                                    </th>
                                    <td>{{ permission.slug }}</td>
                                    <td>{{ permission.description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="addRecord"
            tabindex="-1"
            aria-labelledby="addRecordLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            v-show="editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Update the Permission
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add New Permission
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle"
                                aria-hidden="true"
                            ></i>
                        </button>
                    </div>

                    <!-- FORM START -->

                    <form
                        class="input-form"
                        @submit.prevent="
                            editMode ? updatePermission() : createPermission()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="slug"
                                    >Slug
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="slug"
                                        v-model="form.slug"
                                        type="text"
                                        name="slug"
                                        class="form-control"
                                        placeholder="Name"
                                    />
                                    <HasError :form="form" field="slug" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="description"
                                >
                                    Description
                                </label>

                                <div class="col-md-9">
                                    <textarea
                                        id="description"
                                        class="form-control"
                                        name="description"
                                        rows="3"
                                        cols="50"
                                        v-model="form.description"
                                    >
                                    </textarea>
                                    <HasError
                                        :form="form"
                                        field="description"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button
                                v-show="editMode"
                                type="submit"
                                class="btn btn-submit"
                            >
                                <i
                                    class="fas fa-pen-nib mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update
                            </button>
                            <button
                                v-show="!editMode"
                                type="submit"
                                class="btn btn-submit"
                            >
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Create
                            </button>
                        </div>
                    </form>

                    <!-- FORM END -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import { HasError, AlertError } from "vform/src/components/bootstrap4";

export default {
    components: {
        HasError,
        AlertError,
    },

    data: () => ({
        editMode: false,
        permissions: [],
        keywords: null,
        form: new Form({
            id: "",
            slug: "",
            description: "",
        }),
    }),

    watch: {
        keywords(after, before) {
            this.loadPermissions();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadPermissions();
            $("#addRecord").modal("show");
        },

        editModal(permission) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadPermissions();
            $("#addRecord").modal("show");
            this.form.fill(permission);
        },

        loadPermissions() {
            axios
                .get("/api/permission", { params: { keywords: this.keywords } })
                .then(({ data }) => (this.permissions = data.data))
                .catch((error) => console.log(error));
        },

        createPermission() {
            axios
                .post("/api/permission", this.form)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deletePermission(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/permission/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updatePermission() {
            this.form
                .put("/api/permission/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadPermissions();
        Fire.$on("reloadRecords", () => {
            this.loadPermissions();
        });
    },
};
</script>
