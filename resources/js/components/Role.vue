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
                            New Role
                        </div>
                    </button>
                </div>

                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm" scope="col">Actions</th>
                                    <th class="th-sm" scope="col">Name</th>
                                    <th class="th-lg" scope="col">
                                        Permissions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="role in roles">
                                    <th scope="row">
                                        <a
                                            href=""
                                            @click.prevent="editModal(role)"
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
                                            @click.prevent="deleteRole(role.id)"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Delete"
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
                                                    d="M13.648 9.93334V16.3333M7.19999 7.80001H16.8V18.4667H7.19999V7.80001ZM4.53333 7.80001H19.4667H4.53333ZM9.18826 4.60001H14.5216V7.80001H9.18826V4.60001ZM10.448 9.93334V16.3333V9.93334Z"
                                                    stroke="white"
                                                    stroke-width="1.33333"
                                                />
                                            </svg>
                                        </a>
                                        <a
                                            href=""
                                            @click.prevent="
                                                newPermissionModal(role)
                                            "
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="add permission"
                                        >
                                            <svg
                                                width="25"
                                                height="25"
                                                viewBox="0 0 42 42"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <circle
                                                    cx="21"
                                                    cy="21"
                                                    r="20"
                                                    stroke="#8C8C8C"
                                                    stroke-dasharray="2 2"
                                                />
                                                <path
                                                    d="M25.8721 24.8203C26.5811 24.4395 27.3926 24.2227 28.2568 24.2227H28.2598C28.3477 24.2227 28.3887 24.1172 28.3242 24.0586C27.4254 23.252 26.3987 22.6005 25.2861 22.1309C25.2744 22.125 25.2627 22.1221 25.251 22.1162C27.0703 20.7949 28.2539 18.6475 28.2539 16.2246C28.2539 12.2109 25.0078 8.95898 21.0029 8.95898C16.998 8.95898 13.7549 12.2109 13.7549 16.2246C13.7549 18.6475 14.9385 20.7949 16.7607 22.1162C16.749 22.1221 16.7373 22.125 16.7256 22.1309C15.416 22.6846 14.2412 23.4785 13.2305 24.4922C12.2256 25.4953 11.4255 26.6844 10.875 27.9932C10.3333 29.2748 10.041 30.6479 10.0137 32.0391C10.0129 32.0703 10.0184 32.1014 10.0298 32.1306C10.0412 32.1597 10.0584 32.1862 10.0802 32.2086C10.1021 32.231 10.1282 32.2488 10.157 32.2609C10.1858 32.2731 10.2168 32.2793 10.248 32.2793H12.0029C12.1289 32.2793 12.2344 32.1768 12.2373 32.0508C12.2959 29.7891 13.2012 27.6709 14.8037 26.0654C16.459 24.4043 18.6621 23.4902 21.0059 23.4902C22.667 23.4902 24.2607 23.9502 25.6348 24.8115C25.6701 24.8337 25.7106 24.8462 25.7522 24.8477C25.7939 24.8493 25.8352 24.8398 25.8721 24.8203ZM21.0059 21.2637C19.6641 21.2637 18.4014 20.7393 17.4492 19.7871C16.9807 19.3199 16.6094 18.7645 16.3564 18.1531C16.1035 17.5417 15.9741 16.8863 15.9756 16.2246C15.9756 14.8799 16.5 13.6143 17.4492 12.6621C18.3984 11.71 19.6611 11.1855 21.0059 11.1855C22.3506 11.1855 23.6103 11.71 24.5625 12.6621C25.031 13.1294 25.4024 13.6847 25.6553 14.2961C25.9082 14.9075 26.0376 15.5629 26.0361 16.2246C26.0361 17.5693 25.5117 18.835 24.5625 19.7871C23.6103 20.7393 22.3477 21.2637 21.0059 21.2637ZM31.7812 28.2363H29.3203V25.7754C29.3203 25.6465 29.2148 25.541 29.0859 25.541H27.4453C27.3164 25.541 27.2109 25.6465 27.2109 25.7754V28.2363H24.75C24.6211 28.2363 24.5156 28.3418 24.5156 28.4707V30.1113C24.5156 30.2402 24.6211 30.3457 24.75 30.3457H27.2109V32.8066C27.2109 32.9355 27.3164 33.041 27.4453 33.041H29.0859C29.2148 33.041 29.3203 32.9355 29.3203 32.8066V30.3457H31.7812C31.9102 30.3457 32.0156 30.2402 32.0156 30.1113V28.4707C32.0156 28.3418 31.9102 28.2363 31.7812 28.2363Z"
                                                    fill="#62BA0A"
                                                />
                                            </svg>
                                        </a>
                                    </th>
                                    <td>
                                        {{ role.name }}
                                        <div class="text-small">
                                            {{ role.description }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badges">
                                            <span
                                                class="badge badge-lg"
                                                v-for="permission in role.permissions"
                                            >
                                                {{ permission.slug }}
                                            </span>
                                        </div>
                                    </td>
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
                            Update the Role
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add New Role
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
                        @submit.prevent="editMode ? updateRole() : createRole()"
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

        <!-- Modal for adding Permissions -->
        <div
            class="modal fade"
            id="addPermission"
            tabindex="-1"
            aria-labelledby="addPermissionLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPermissionLabel">
                            <span class="green">{{ formPermission.name }}</span>
                            Permissions
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
                        @submit.prevent="createRolePermission()"
                    >
                        <div class="modal-body">
                            <div
                                class="form-group form-check"
                                v-for="permission in permissions"
                            >
                                <div class="d-flex align-items-center">
                                    <input
                                        class="mr-3"
                                        type="checkbox"
                                        name="permission_id"
                                        v-model="formPermission.permission_id"
                                        :value="permission.id"
                                    />

                                    <span>{{ permission.slug }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-submit">
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update
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
        roles: [],
        permissions: [],
        keywords: null,
        form: new Form({
            id: "",
            name: "",
            description: "",
        }),
        formPermission: new Form({
            id: "",
            name: "",
            permission_id: [],
        }),
    }),

    watch: {
        keywords(after, before) {
            this.loadRoles();
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

        editModal(role) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadRoles();
            $("#addRecord").modal("show");
            this.form.fill(role);
        },

        loadRoles() {
            axios
                .get("/api/role", { params: { keywords: this.keywords } })
                .then(({ data }) => (this.roles = data))
                .catch((error) => console.log(error));
        },

        createRole() {
            this.form
                .post("/api/role")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteRole(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/role/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateRole() {
            this.form
                .put("/api/role/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        //Assign Permissions to Roles
        //modal for adding permissions

        newPermissionModal(role) {
            this.formPermission.clear();
            this.formPermission.reset();
            this.loadRoles();
            this.loadPermissions();
            $("#addPermission").modal("show");
            this.formPermission.id = role.id;
            this.formPermission.name = role.name;
            role.permissions.forEach((value) => {
                this.formPermission.permission_id.push(value.id);
            });
        },

        loadPermissions() {
            axios
                .get("/api/permission")
                .then(({ data }) => (this.permissions = data))
                .catch((error) => console.log(error));
        },

        createRolePermission() {
            this.formPermission
                .post("/api/role/permission")
                .then(() => {
                    $("#addPermission").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadRoles();
        Fire.$on("reloadRecords", () => {
            this.loadRoles();
        });
    },
};
</script>
