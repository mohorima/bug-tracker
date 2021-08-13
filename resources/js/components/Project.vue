<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4 mb-5">
                <div
                    class="d-flex justify-content-between align-items-center mb-4"
                >
                    <h3>Projects</h3>

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
                                    <th class="th-sm" scope="col">Duration</th>
                                    <th class="th-sm" scope="col">Cost</th>
                                    <th class="th-sm" scope="col">Status</th>
                                    <th class="th-sm" scope="col">Tags</th>
                                    <th class="th-sm" scope="col">Client</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="project in projects">
                                    <th scope="row">
                                        <a
                                            href=""
                                            @click.prevent="editModal(project)"
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
                                                deleteProject(project.id)
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
                                            {{ project.title }}
                                        </div>
                                        <div class="text-small">
                                            {{ project.description }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ project.startDate }} to <br />
                                        {{ project.endDate }}
                                        <br />
                                        {{ estimatedHours(project.estHours) }}
                                    </td>
                                    <td>
                                        <strong>
                                            {{ "$ " + project.cost }}
                                        </strong>
                                    </td>
                                    <td>
                                        <span
                                            v-if="
                                                project.status === 'in-progress'
                                            "
                                            class="badge bg-success text-white"
                                            >IN PROGRESS</span
                                        >
                                        <span
                                            v-else-if="
                                                project.status === 'not-started'
                                            "
                                            class="badge bg-dark text-white"
                                            >NOT STARTED</span
                                        >
                                        <span
                                            v-else-if="
                                                project.status === 'on-hold'
                                            "
                                            class="badge bg-warning text-white"
                                            >ON HOLD</span
                                        >
                                        <span
                                            v-else-if="
                                                project.status === 'cancelled'
                                            "
                                            class="badge bg-danger text-white"
                                            >CANCELLED</span
                                        >
                                        <span
                                            v-else-if="
                                                project.status === 'completed'
                                            "
                                            class="badge bg-secondary text-white"
                                            >COMPLETED</span
                                        >
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-faded">
                                            {{ projectTags(project.tag) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ project.client.company }}
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
                            Update the Project
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add New Project
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
                            editMode ? updateProject() : createProject()
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
        projects: {},
        form: new Form({
            id: "",
            title: "",
            description: "",
            startDate: "",
            endDate: "",
            billingType: "",
            cost: "",
            estHours: "",
            tag: "",
            status: "",
            client_id: "",
        }),
    }),

    computed: {},

    methods: {
        estimatedHours(hour) {
            return hour != null ? `${hour} hours` : "";
        },

        projectTags(tag) {
            switch (tag) {
                case "web-app":
                    return "Web-App";
                    break;
                case "mobile-app":
                    return "Mobile App";
                    break;
                case "spa":
                    return "SPA";
                    break;
                case "illustration":
                    return "Illustration";
                    break;
                case "video":
                    return "Video";
                    break;
                case "branding":
                    return "Branding";
                    break;
                default:
                    console.log(`No tags`);
            }
        },

        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(project) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(project);
        },

        loadProjects() {
            axios
                .get("/api/project")
                .then(({ data }) => (this.projects = data.data));
        },

        createProject() {
            this.form
                .post("/api/project")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch(() => {});
        },

        deleteProject(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/project/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },

        updateProject() {
            this.form
                .put("/api/project/" + this.form.id)
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
        this.loadProjects();
        Fire.$on("reloadRecords", () => {
            this.loadProjects();
        });
    },
};
</script>
