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
                            New Project
                        </div>
                    </button>
                </div>

                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm th-3-btn" scope="col">
                                        Actions
                                    </th>
                                    <th class="th-lg" scope="col">Title</th>
                                    <th class="th-sm" scope="col">Status</th>
                                    <th class="th-sm" scope="col">Duration</th>
                                    <th class="th-sm" scope="col">Cost</th>
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
                                                deleteProject(project.id)
                                            "
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
                                        <router-link
                                            :to="{
                                                name: 'project/member',
                                                params: {
                                                    projectId: project.id,
                                                },
                                            }"
                                        >
                                            <img
                                                src="/images/add-member.svg"
                                                width="25px"
                                                title="add member"
                                            />
                                        </router-link>
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
                                        <span class="badge bg-white text-faded">
                                            START
                                        </span>
                                        {{ project.startDate }}<br />
                                        <span
                                            class="badge bg-white text-faded mt-1"
                                        >
                                            END
                                        </span>
                                        {{ project.endDate }}
                                        <br />
                                        {{ estimatedHours(project.estHours) }}
                                    </td>
                                    <td>
                                        <strong> $ {{ project.cost }} </strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-white text-dark">
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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            v-show="editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Update Project
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            New Project
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- FORM START -->

                    <form
                        class="input-form"
                        @submit.prevent="
                            editMode ? updateProject() : createProject()
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
                                        <option value="not-started"
                                            >Not Started
                                        </option>
                                        <option value="in-progress"
                                            >In Progress
                                        </option>
                                        <option value="on-hold">On Hold</option>
                                        <option value="cancelled"
                                            >Cancelled
                                        </option>
                                        <option value="completed"
                                            >Completed
                                        </option>
                                    </select>
                                    <HasError :form="form" field="status" />
                                </div>
                                <!--.form-group -->

                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="tag"
                                        >Tag
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="tag"
                                        id="tag"
                                        v-model="form.tag"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                            >Select Tag</option
                                        >
                                        <option value="web-app"
                                            >Web Application
                                        </option>
                                        <option value="mobile-app"
                                            >Mobile App
                                        </option>
                                        <option value="spa">SPA</option>
                                        <option value="illustration"
                                            >Illustration
                                        </option>
                                        <option value="video">Video</option>
                                        <option value="branding"
                                            >Branding
                                        </option>
                                    </select>

                                    <HasError :form="form" field="tag" />
                                </div>
                                <!--.form-group -->
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="billingType"
                                        >Billing Type
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="billingType"
                                        id="billingType"
                                        v-model="form.billingType"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                            >Select Billing Type
                                        </option>
                                        <option value="fixed-rate"
                                            >Fixed Rate
                                        </option>
                                        <option value="project-hours"
                                            >Project Hours
                                        </option>
                                        <option value="task-hours"
                                            >Task Hours
                                        </option>
                                        <!--.for-each billingType -->
                                    </select>
                                    <HasError
                                        :form="form"
                                        field="billingType"
                                    />
                                </div>

                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="client_id"
                                        >Client
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="client_id"
                                        id="client_id"
                                        v-model="form.client_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                            >Select Client
                                        </option>
                                        <option
                                            v-for="client in clients"
                                            :value="client.id"
                                            >{{ client.company }}
                                        </option>
                                        <!--.for-each billingType -->
                                    </select>
                                    <HasError :form="form" field="client_id" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="cost"
                                        >Cost
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                $
                                            </div>
                                        </div>
                                        <input
                                            id="cost"
                                            v-model="form.cost"
                                            type="text"
                                            name="cost"
                                            class="form-control"
                                            placeholder=""
                                        />
                                    </div>
                                    <HasError :form="form" field="cost" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="estHours"
                                        >Estimated Hours
                                    </label>
                                    <input
                                        id="estHours"
                                        v-model="form.estHours"
                                        type="text"
                                        name="estHours"
                                        class="form-control"
                                        placeholder="Estimated Hours"
                                    />
                                    <HasError :form="form" field="estHours" />
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
                                <svg
                                    class="mr-2"
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true"
                                    role="img"
                                    width="22"
                                    height="22"
                                    preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 32 32"
                                >
                                    <path
                                        d="M27.71 9.29l-5-5A1 1 0 0 0 22 4H6a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V10a1 1 0 0 0-.29-.71zM12 6h8v4h-8zm8 20h-8v-8h8zm2 0v-8a2 2 0 0 0-2-2h-8a2 2 0 0 0-2 2v8H6V6h4v4a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6.41l4 4V26z"
                                        fill="#f8f8f8"
                                    />
                                </svg>
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
import Axios from "axios";
import { HasError, AlertError } from "vform/src/components/bootstrap4";

export default {
    components: {
        HasError,
        AlertError,
    },

    data: () => ({
        editMode: false,
        projects: [],
        clients: [],
        keywords: null,
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

    watch: {
        keywords(after, before) {
            this.loadProjects();
        },
    },

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
            this.loadClients();
            $("#addRecord").modal("show");
        },

        editModal(project) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadClients();
            $("#addRecord").modal("show");
            this.form.fill(project);
        },

        loadProjects() {
            axios
                .get("/api/project", { params: { keywords: this.keywords } })
                .then(({ data }) => (this.projects = data.data))
                .catch((error) => console.log(error));
        },

        loadClients() {
            axios
                .get("/api/client")
                .then(({ data }) => (this.clients = data.data))
                .catch((error) => console.log(error));
        },

        createProject() {
            this.form
                .post("/api/project")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteProject(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/project/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateProject() {
            this.form
                .put("/api/project/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
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
