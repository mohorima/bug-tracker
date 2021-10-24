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
                </div>

                <div class="card card-table">
                    <form @submit.prevent="createProjectMember()">
                        <div
                            class="d-flex justify-content-between align-items-center"
                        >
                            <h5>
                                Add Members to Project
                                <span class="text-dark">
                                    {{ project.title }}
                                </span>
                            </h5>
                            <a href="" @click.prevent="showMember()">open</a>

                            <button type="submit" class="btn btn-submit mt-3">
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Create
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="th-sm" scope="row">
                                            <input
                                                type="checkbox"
                                                name="toggle-button"
                                                id="toggle-button"
                                                class="toggle-button mr-2"
                                            />
                                            All
                                        </th>
                                        <th class="th-lg" scope="col">Name</th>
                                        <th class="th-lg" scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users">
                                        <th scope="row">
                                            <input
                                                type="checkbox"
                                                name="project_user"
                                                v-model="form.project_user"
                                                :value="user.id"
                                            />
                                        </th>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
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
        users: [],
        keywords: null,
        project: [],
        form: new Form({
            id: "",
            project_user: [],
        }),
    }),

    watch: {
        keywords(after, before) {
            this.loadUsers();
        },
    },

    methods: {
        loadAssignedMember() {
            axios
                .get(
                    "/api/project/assigned-member/" +
                        this.$route.params.projectId
                )
                .then(({ data }) => (this.project = data))
                .then(() =>
                    this.project.users.forEach((value) => {
                        this.form.project_user.push(value.id);
                    })
                )
                .catch((error) => console.log(error));
        },

        loadUsers() {
            axios
                .get("/api/project/member", {
                    params: { keywords: this.keywords },
                })
                .then(({ data }) => (this.users = data.data))
                .catch((error) => console.log(error));
        },

        createProjectMember() {
            this.form.id = this.$route.params.projectId;
            //set form id property to route projectId parameter

            this.form
                .post("/api/project/member")
                .then(() => {
                    //redirect to projects
                    this.$router.push("/project");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadAssignedMember();
        this.loadUsers();
    },
};
</script>
