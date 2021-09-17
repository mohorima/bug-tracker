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
                                <i class="fas fa-search" aria-hidden="true"></i>
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
                                    {{ $route.params.projectTitle }}
                                </span>
                            </h5>
                            
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
        loadUsers() {
            axios
                .get("/api/project-member", {
                    params: { keywords: this.keywords },
                })
                .then(({ data }) => (this.users = data.data))
                .catch((error) => console.log(error));
        },
        createProjectMember() {
            this.form.id = this.$route.params.projectId;
            //set form id property to route projectId parameter

            this.form
                .post("/api/project-member")
                .then(() => {
                    Fire.$emit("reloadRecords");
                    //redirect to projects
                    this.$router.push("/project");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadUsers();
        Fire.$on("reloadRecords", () => {
            this.loadUsers();
        });
    },
};
</script>
