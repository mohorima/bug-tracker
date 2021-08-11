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
                                        // @if(project.estHours != null)
                                        // {{ project.estHours }} hours @endif
                                    </td>
                                    <td>
                                        {{ project.cost }}
                                    </td>
                                    // <td>
                                    //     @if(project.status === 'in-progress')
                                    //     <span
                                    //         class="badge bg-success text-white"
                                    //         >IN PROGRESS</span
                                    //     >
                                    //     @elseif(project.status ===
                                    //     'not-started')
                                    //     <span class="badge bg-dark text-white"
                                    //         >NOT STARTED</span
                                    //     >
                                    //     @elseif(project.status === 'on-hold')
                                    //     <span
                                    //         class="badge bg-warning text-white"
                                    //         >ON HOLD</span
                                    //     >
                                    //     @elseif(project.status ===
                                    //     'cancelled')
                                    //     <span class="badge bg-danger text-white"
                                    //         >CANCELLED</span
                                    //     >
                                    //     @elseif(project.status ===
                                    //     'completed')
                                    //     <span
                                    //         class="badge bg-secondary text-white"
                                    //         >COMPLETED</span
                                    //     >
                                    //     @endif
                                    // </td>
                                    // <td>
                                    //     <span class="badge bg-light text-faded">
                                    //         @switch(project.tag)
                                    //         @case("web-app") Web App @break
                                    //         @case("mobile-app") Mobile App
                                    //         @break @case("spa") SPA @break
                                    //         @case("illustration") Illustration
                                    //         @break @case("video") Video @break
                                    //         @case("branding") Branding @break
                                    //         @default @endswitch
                                    //     </span>
                                    // </td>
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
                                    for="user_id"
                                    >User ID
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="user_id"
                                        v-model="form.user_id"
                                        type="text"
                                        name="user_id"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="user_id" />
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

    methods: {
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
