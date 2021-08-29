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
                            New Issue
                        </button>
                </div>

                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm" scope="col">Actions</th>
                                    <th class="th-lg" scope="col">Title</th>
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
                                            <i
                                                class="fas fa-pen-nib mr-3 table-fa"
                                                aria-hidden="true"
                                            ></i>
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
                                            <i
                                                class="fas fa-trash table-fa"
                                                aria-hidden="true"
                                            ></i>
                                        </a>
                                    </th>
                                    <td>
                                        <div class="text-title">
                                            {{ issue.title }}
                                        </div>
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
                                            class="badge bg-warning text-white"
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
                                                'bg-warning':
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
                                            class="badge bg-light text-faded to-uppercase"
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
                                        <option value="database">
                                            Database
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

                                    <select
                                        class="custom-select form-control"
                                        name="status"
                                        id="status"
                                        v-model="form.status"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Status
                                        </option>
                                        <option value="open">
                                            Open
                                        </option>
                                        <option value="closed">
                                            Closed
                                        </option>
                                    </select>
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
                                        Assignee ID
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <input
                                        id="assignee_id"
                                        v-model="form.assignee_id"
                                        type="text"
                                        name="assignee_id"
                                        class="form-control"
                                    />
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
        projects: [],
        issues: [],
        keywords: null,
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
            this.loadIssues();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadProjects();
            $("#addRecord").modal("show");
        },

        editModal(issue) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadProjects();
            $("#addRecord").modal("show");
            this.form.fill(issue);
        },

        loadIssues() {
            axios
                .get("/api/issue", { params: { keywords: this.keywords } })
                .then(({ data }) => (this.issues = data.data))
                .catch((error) => console.log(error));
        },

        loadProjects() {
            axios
                .get("/api/project")
                .then(({ data }) => (this.projects = data.data))
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
