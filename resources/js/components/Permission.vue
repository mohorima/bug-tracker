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
                                    <i
                                        class="fas fa-search"
                                        aria-hidden="true"
                                    ></i>
                                </div>
                            </div>
                            <input
                                type="text"
                                placeholder="Search"
                                class="form-control search-box"
                                v-model="keywords"
                            />
                        </div>

                        <button
                            type="button"
                            class="btn btn-new"
                            @click="newModal"
                        >
                            <i class="fas fa-plus mr-2" aria-hidden="true"></i>
                            New Permission
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
                                            <i
                                                class="fas fa-pen-nib mr-3 table-fa"
                                                aria-hidden="true"
                                            ></i>
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
                                            <i
                                                class="fas fa-trash table-fa"
                                                aria-hidden="true"
                                            ></i>
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
                                    >Description
                                    <strong class="text-danger"> *</strong>
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
            this.form
                .post("/api/permission")
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
