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
                            New Issue
                        </div>
                    </button>
                </div>

                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm" scope="col">Actions</th>
                                    <th
                                        class="th-lg d-flex align-items-center"
                                        scope="col"
                                    >
                                        Title
                                        <div class="sort">
                                            <a
                                                href=""
                                                @click.prevent="
                                                    changeOrderAsc('title')
                                                "
                                            >
                                                <i
                                                    class="fas fa-sort-up table-fa"
                                                ></i>
                                            </a>
                                            <a
                                                href=""
                                                @click.prevent="
                                                    changeOrderDesc('title')
                                                "
                                            >
                                                <i
                                                    class="fas fa-sort-down table-fa"
                                                ></i>
                                            </a>
                                        </div>
                                    </th>
                                    <th class="th-sm" scope="col">Severity</th>
                                    <th class="th-sm" scope="col">Status</th>
                                    <th class="th-sm" scope="col">Type</th>
                                    <th class="th-sm" scope="col">Due Date</th>
                                    <th class="th-sm" scope="col">Project</th>
                                    <th class="th-sm" scope="col">Assignee</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="trow" v-for="issue in issues">
                                    <th scope="row">
                                        <a
                                            href=""
                                            @click.prevent="editModal(issue)"
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
                                                deleteIssue(issue.id)
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
                                    <td>
                                        {{ issue.title }}
                                        <div class="text-small">
                                            {{ issue.description }}
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            v-if="issue.severity === 'low'"
                                            class="badge bg-primary text-white"
                                            >LOW
                                        </span>
                                        <span
                                            v-else-if="
                                                issue.severity === 'high'
                                            "
                                            class="badge bg-warning text-dark"
                                            >HIGH
                                        </span>
                                        <span
                                            v-else-if="
                                                issue.severity === 'critical'
                                            "
                                            class="badge bg-danger text-white"
                                            >CRITICAL
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge text-white"
                                            :class="{
                                                'bg-danger':
                                                    issue.status === 'open',
                                                'bg-success':
                                                    issue.status != 'open',
                                            }"
                                        >
                                            {{
                                                issue.status === "open"
                                                    ? "OPEN"
                                                    : "CLOSED"
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-light text-dark to-uppercase"
                                        >
                                            {{ issue.type }}
                                        </span>
                                    </td>
                                    <td>{{ issue.dueDate }}</td>
                                    <td>{{ issue.project.title }}</td>
                                    <td>{{ issue.assignee.name }}</td>
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
                            Update the Issue
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add New Issue
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
                            editMode ? updateIssue() : createIssue()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="title"
                                    >Title
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="title" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="description"
                                    >Description
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

                            <hr class="mt-4" />

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="type"
                                        >Type
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="type"
                                        id="type"
                                        v-model="form.type"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Type
                                        </option>
                                        <option value="bug">
                                            Bug
                                        </option>
                                        <option value="frontend">
                                            Front-End
                                        </option>
                                        <option value="backend">
                                            Back-End
                                        </option>
                                        <option value="database">
                                            Database
                                        </option>
                                    </select>
                                    <HasError :form="form" field="type" />
                                </div>
                                <!--.form-group -->

                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="severity"
                                        >Severity
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="severity"
                                        id="severity"
                                        v-model="form.severity"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Severity
                                        </option>
                                        <option value="low">
                                            Low
                                        </option>
                                        <option value="high">
                                            High
                                        </option>
                                        <option value="critical">
                                            Critical
                                        </option>
                                    </select>
                                    <HasError :form="form" field="severity" />
                                </div>
                                <!--.form-group -->
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="status"
                                        >Status
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="status"
                                            id="status1"
                                            v-model="form.status"
                                            value="open"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="status1"
                                            >Open
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="status"
                                            id="status2"
                                            v-model="form.status"
                                            value="closed"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="status2"
                                            >Closed
                                        </label>
                                    </div>

                                    <HasError :form="form" field="status" />
                                </div>
                                <!--.form-group -->
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="dueDate"
                                        >Due Date
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <input
                                        id="dueDate"
                                        v-model="form.dueDate"
                                        type="date"
                                        name="dueDate"
                                        class="form-control"
                                    />
                                    <HasError :form="form" field="dueDate" />
                                </div>
                                <!--.form-group -->
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="project_id"
                                        >Project
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="project_id"
                                        id="project_id"
                                        v-model="form.project_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Project
                                        </option>
                                        <option
                                            v-for="project in projects"
                                            :value="project.id"
                                        >
                                            {{ project.title }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="project_id" />
                                </div>
                                <!--.form-group -->
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="assignee_id"
                                    >
                                        Assignee
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="assignee_id"
                                        id="assignee_id"
                                        v-model="form.assignee_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Assignee
                                        </option>
                                        <option
                                            v-for="user in users"
                                            :value="user.id"
                                        >
                                            {{ user.name }}
                                        </option>
                                    </select>

                                    <HasError
                                        :form="form"
                                        field="assignee_id"
                                    />
                                </div>
                                <!--.form-group -->
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
        issues: [],
        projects: [],
        users: [],
        keywords: null,
        orderTermAsc: null,
        orderTermDesc: null,
        form: new Form({
            id: "",
            title: "",
            description: "",
            type: "",
            severity: "",
            dueDate: "",
            status: "",
            project_id: "",
            assignee_id: "",
        }),
    }),

    watch: {
        keywords(after, before) {
            Fire.$emit("reloadRecords");
        },
    },

    methods: {
        changeOrderAsc(term) {
            this.orderTermDesc = null;
            this.orderTermAsc == null
                ? (this.orderTermAsc = term)
                : (this.orderTermAsc = null);

            Fire.$emit("reloadRecords");
        },

        changeOrderDesc(term) {
            this.orderTermAsc = null;
            this.orderTermDesc == null
                ? (this.orderTermDesc = term)
                : (this.orderTermDesc = null);

            Fire.$emit("reloadRecords");
        },

        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadProjects();
            this.loadUsers();
            $("#addRecord").modal("show");
        },

        editModal(issue) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadProjects();
            this.loadUsers();
            $("#addRecord").modal("show");
            this.form.fill(issue);
        },

        loadIssues() {
            axios
                .get("/api/issue", {
                    params: {
                        keywords: this.keywords,
                        orderTermAsc: this.orderTermAsc,
                        orderTermDesc: this.orderTermDesc,
                    },
                })
                .then(({ data }) => (this.issues = data.data))
                .catch((error) => console.log(error));
        },

        loadProjects() {
            axios
                .get("/api/project")
                .then(({ data }) => (this.projects = data.data))
                .catch((error) => console.log(error));
        },

        loadUsers() {
            axios
                .get("/api/assignee")
                .then(({ data }) => (this.users = data.data))
                .catch((error) => console.log(error));
        },

        createIssue() {
            this.form
                .post("/api/issue")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteIssue(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/issue/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateIssue() {
            this.form
                .put("/api/issue/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadIssues();
        Fire.$on("reloadRecords", () => {
            this.loadIssues();
        });
    },
};
</script>
