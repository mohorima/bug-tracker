<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4 mb-5">
                <div
                    class="d-flex justify-content-between align-items-center mb-4"
                >
                    <h3>Tasks</h3>

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
                                    <th class="th-lg" scope="col">Subject</th>
                                    <th class="th-sm" scope="col">Priority</th>
                                    <th class="th-sm" scope="col">Status</th>
                                    <th class="th-sm" scope="col">Duration</th>
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
                                            <i
                                                class="fas fa-pen-nib mr-3 table-fa"
                                                aria-hidden="true"
                                            ></i>
                                        </a>
                                        <a
                                            href=""
                                            @click.prevent="deleteTask(task.id)"
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
                                            {{ task.subject }}
                                        </div>
                                        <div class="text-small">
                                            {{ task.description }}
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            v-if="task.priority === 'low'"
                                            class="badge bg-primary text-white"
                                            >LOW
                                        </span>
                                        <span
                                            v-else-if="
                                                task.priority === 'medium'
                                            "
                                            class="badge bg-warning text-white"
                                            >HIGH
                                        </span>
                                        <span
                                            v-else-if="task.priority === 'high'"
                                            class="badge bg-danger text-white"
                                            >HIGH
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge text-white"
                                            :class="{
                                                'bg-warning':
                                                    task.status === 'Active',
                                                'bg-success':
                                                    task.status != 'Active',
                                            }"
                                        >
                                            {{
                                                task.status === "Active"
                                                    ? "ACTIVE"
                                                    : "CLOSED"
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ task.startDate }} -
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
            <div class="modal-dialog modal-dialog-centered">
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
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- FORM START -->

                    <form
                        @submit.prevent="editMode ? updateTask() : createTask()"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="subject"
                                    >Subject
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="subject"
                                        v-model="form.subject"
                                        type="text"
                                        name="subject"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="subject" />
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
        tasks: {},
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

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(task) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(task);
        },

        loadTasks() {
            axios.get("/api/task").then(({ data }) => (this.tasks = data.data));
        },

        createTask() {
            this.form
                .post("/api/task")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch(() => {});
        },

        deleteTask(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/task/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },

        updateTask() {
            this.form
                .put("/api/task/" + this.form.id)
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
        this.loadTasks();
        Fire.$on("reloadRecords", () => {
            this.loadTasks();
        });
    },
};
</script>
