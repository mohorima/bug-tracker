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
                            New Task
                        </div>
                    </button>
                </div>

                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm" scope="col">Actions</th>
                                    <th class="th-lg" scope="col">Subject</th>
                                    <th class="th-sm" scope="col">Priority</th>
                                    <th class="th-sm" scope="col">Status</th>
                                    <th class="th-sm" scope="col">Deadline</th>
                                    <th class="th-sm" scope="col">Project</th>
                                    <th class="th-sm" scope="col">Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in tasks">
                                    <th scope="row">
                                        <a
                                            href=""
                                            @click.prevent="editModal(task)"
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
                                            @click.prevent="deleteTask(task.id)"
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
                                        {{ task.subject }}
                                        <div class="text-small">
                                            {{ task.description }}
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge to-uppercase"
                                            :class="{
                                                'bg-primary text-white':
                                                    task.priority === 'low',
                                                'bg-warning text-dark':
                                                    task.priority === 'medium',
                                                'bg-danger text-white':
                                                    task.priority === 'high',
                                            }"
                                        >
                                            {{ task.priority }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge text-white to-uppercase"
                                            :class="{
                                                'bg-success':
                                                    task.status === 'active',
                                                'bg-secondary':
                                                    task.status != 'active',
                                            }"
                                        >
                                            {{ task.status }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ task.endDate }}
                                    </td>
                                    <td>{{ task.project.title }}</td>
                                    <td>
                                        {{ task.collaborator.name }} +
                                        {{ task.user.name }}
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
                            Update the Task
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add New Task
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
                        @submit.prevent="editMode ? updateTask() : createTask()"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="subject"
                                    >Subject
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="subject"
                                        v-model="form.subject"
                                        type="text"
                                        name="subject"
                                        class="form-control"
                                        placeholder="Subject"
                                    />
                                    <HasError :form="form" field="subject" />
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
                                            >Select Status
                                        </option>
                                        <option value="active">Active</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                    <HasError :form="form" field="status" />
                                </div>
                                <!--.form-group -->

                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="priority"
                                        >Priority
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="priority"
                                        id="priority"
                                        v-model="form.priority"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                            >Select Priority
                                        </option>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>

                                    <HasError :form="form" field="priority" />
                                </div>
                                <!--.form-group -->
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="startDate"
                                        >Start Date
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="startDate"
                                        v-model="form.startDate"
                                        type="date"
                                        name="startDate"
                                        class="form-control"
                                    />
                                    <HasError :form="form" field="startDate" />
                                </div>
                                <!--.form-group -->
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="endDate"
                                        >End Date
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="endDate"
                                        v-model="form.endDate"
                                        type="date"
                                        name="endDate"
                                        class="form-control"
                                    />
                                    <HasError :form="form" field="endDate" />
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
                                        for="collaborator_id"
                                    >
                                        Collaborator
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="collaborator_id"
                                        id="collaborator_id"
                                        v-model="form.collaborator_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Collaborator
                                        </option>
                                        <option
                                            v-for="collaborator in collaborators"
                                            :value="collaborator.id"
                                        >
                                            {{ collaborator.name }}
                                        </option>
                                    </select>
                                    <HasError
                                        :form="form"
                                        field="collaborator_id"
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
        tasks: [],
        projects: [],
        collaborators: [],
        keywords: null,
        form: new Form({
            id: "",
            subject: "",
            description: "",
            priority: "",
            status: "",
            startDate: "",
            endDate: "",
            project_id: "",
            collaborator_id: "",
        }),
    }),

    watch: {
        keywords(after, before) {
            this.loadTasks();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadProjects();
            this.loadCollaborators();
            $("#addRecord").modal("show");
        },

        editModal(task) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadProjects();
            this.loadCollaborators();
            $("#addRecord").modal("show");
            this.form.fill(task);
        },

        loadTasks() {
            axios
                .get("/api/task", { params: { keywords: this.keywords } })
                .then(({ data }) => (this.tasks = data.data))
                .catch((error) => console.log(error));
        },

        loadProjects() {
            axios
                .get("/api/project")
                .then(({ data }) => (this.projects = data.data))
                .catch((error) => console.log(error));
        },

        loadCollaborators() {
            axios
                .get("/api/assignee")
                .then(({ data }) => (this.collaborators = data))
                .catch((error) => console.log(error));
        },

        createTask() {
            this.form
                .post("/api/task")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteTask(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/task/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateTask() {
            this.form
                .put("/api/task/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadTasks();
        Fire.$on("reloadRecords", () => {
            this.loadTasks();
        });
    },
};
</script>
