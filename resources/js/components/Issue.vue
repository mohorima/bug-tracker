<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4 mb-5">
                <div
                    class="d-flex justify-content-between align-items-center mb-4"
                >
                    <h3>Issues</h3>

                    <button type="button" class="btn btn-new" @click="newModal">
                        <i class="fas fa-plus mr-1" aria-hidden="true"></i>
                        Add
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
                                    <th class="th-sm" scope="col">Due Date</th>
                                    <th class="th-sm" scope="col">Project</th>
                                    <th class="th-sm" scope="col">Assignee</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="issue in issues">
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
                                        <span
                                            class="badge bg-secondary text-white"
                                            >{{ issue.type }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            v-if="issue.severity === 'low'"
                                            class="badge bg-primary text-white"
                                            >LOW
                                        </span>
                                        <span
                                            v-else-if="
                                                issue.severity === 'medium'
                                            "
                                            class="badge bg-warning text-white"
                                            >HIGH
                                        </span>
                                        <span
                                            v-else-if="
                                                issue.severity === 'high'
                                            "
                                            class="badge bg-danger text-white"
                                            >HIGH
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge text-white"
                                            :class="{
                                                'bg-warning':
                                                    issue.status === 'Active',
                                                'bg-success':
                                                    issue.status != 'Active',
                                            }"
                                        >
                                            {{
                                                issue.status === "Active"
                                                    ? "ACTIVE"
                                                    : "Solved"
                                            }}
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
            <div class="modal-dialog modal-dialog-centered">
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
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- FORM START -->

                    <form
                        @submit.prevent="
                            editMode ? updateIssue() : createIssue()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="title"
                                    >Title
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
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
                                    class="col-md-4 col-form-label"
                                    for="description"
                                    >Description
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="description"
                                        v-model="form.description"
                                        type="text"
                                        name="description"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError
                                        :form="form"
                                        field="description"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="type"
                                    >Type
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="type"
                                        v-model="form.type"
                                        type="text"
                                        name="type"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="type" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="severity"
                                    >Severity
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="severity"
                                        v-model="form.severity"
                                        type="text"
                                        name="severity"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="severity" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="dueDate"
                                    >Due Date
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="dueDate"
                                        v-model="form.dueDate"
                                        type="date"
                                        name="dueDate"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="dueDate" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="status"
                                    >Status
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="status"
                                        v-model="form.status"
                                        type="text"
                                        name="status"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="status" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="project_id"
                                    >Project ID
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="project_id"
                                        v-model="form.project_id"
                                        type="text"
                                        name="project_id"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="project_id" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="assignee_id"
                                    >Assignee ID
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="assignee_id"
                                        v-model="form.assignee_id"
                                        type="text"
                                        name="assignee_id"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError
                                        :form="form"
                                        field="assignee_id"
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
        issues: {},
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

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(issue) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(issue);
        },

        loadIssues() {
            axios
                .get("/api/issue")
                .then(({ data }) => (this.issues = data.data));
        },

        createIssue() {
            this.form
                .post("/api/issue")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch(() => {});
        },

        deleteIssue(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/issue/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },

        updateIssue() {
            this.form
                .put("/api/issue/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => {
                    console.log(error);
                });
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
