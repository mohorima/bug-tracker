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
                            New User
                        </button>
                </div>

                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm" scope="col">Actions</th>
                                    <th class="th-lg" scope="col">Name</th>
                                    <th class="th-lg" scope="col">Email</th>
                                    <th class="th-sm" scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users">
                                    <th scope="row">
                                        <a
                                            href=""
                                            @click.prevent="editModal(user)"
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
                                            @click.prevent="deleteUser(user.id)"
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
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.role.name }}</td>
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
                            Update the User
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add New User
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
                        @submit.prevent="editMode ? updateUser() : createUser()"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Name
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        placeholder="Name"
                                    />
                                    <HasError :form="form" field="name" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="email"
                                    >Email
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Email"
                                    />
                                    <HasError :form="form" field="email" />
                                </div>
                            </div>
                            <div v-show="!editMode" class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="password"
                                    >Password
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        name="password"
                                        class="form-control"
                                    />
                                    <HasError :form="form" field="password" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="role_id"
                                    >Role
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="custom-select form-control"
                                        name="role_id"
                                        id="role_id"
                                        v-model="form.role_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Role
                                        </option>
                                        <option
                                            v-for="role in roles"
                                            :value="role.id"
                                        >
                                            {{ role.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="role_id" />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button
                                v-show="editMode"
                                type="submit"
                                class="btn btn-submit"
                            >
                                Update
                            </button>
                            <button
                                v-show="!editMode"
                                type="submit"
                                class="btn btn-submit"
                            >
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
        users: [],
        roles: [],
        keywords: null,
        form: new Form({
            id: "",
            name: "",
            email: "",
            password: "",
            role_id: "",
        }),
    }),

    watch: {
        keywords(after, before) {
            this.loadUsers();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadRoles();
            $("#addRecord").modal("show");
        },

        editModal(user) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadRoles();
            $("#addRecord").modal("show");
            this.form.fill(user);
        },

        loadUsers() {
            axios
                .get("/api/user", { params: { keywords: this.keywords } })
                .then(({ data }) => (this.users = data.data))
                .catch((error) => console.log(error));
        },

        loadRoles() {
            axios
                .get("/api/role")
                .then(({ data }) => (this.roles = data.data))
                .catch((error) => console.log(error));
        },

        createUser() {
            this.form
                .post("/api/user")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteUser(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/user/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateUser() {
            this.form
                .put("/api/user/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadUsers();
        Fire.$on("reloadRecords", () => {
            this.loadUsers();
        });
    },
};
</script>
