<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4 mb-5">
                <div
                    class="d-flex justify-content-between align-items-center mb-4"
                >
                    <h3>Clients</h3>

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
                                    <th class="th-lg" scope="col">Company</th>
                                    <th class="th-sm" scope="col">Address</th>
                                    <th class="th-lg" scope="col">Contact</th>
                                    <th class="th-sm" scope="col">Website</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="client in clients">
                                    <th scope="row">
                                        <a
                                            href=""
                                            @click.prevent="editModal(client)"
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
                                                deleteClient(client.id)
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
                                            {{ client.company }}
                                        </div>
                                        <div class="text-small">
                                            {{ client.owner }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ client.address }}<br />
                                        {{ client.country }}
                                    </td>
                                    <td>
                                        <strong>
                                            {{ client.contactPerson }}
                                        </strong>
                                        <br />{{ client.email }} <br />
                                        {{ client.phone }}
                                    </td>
                                    <td>{{ client.website }}</td>
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
                <div class="modal-content px-2">
                    <div class="modal-header">
                        <h5
                            v-show="editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Update the Client
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add New Client
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
                        class="input-form"
                        @submit.prevent="
                            editMode ? updateClient() : createClient()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="company"
                                    >Company Name
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="company"
                                        v-model="form.company"
                                        type="text"
                                        name="company"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="company" />
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
        clients: {},
        form: new Form({
            id: "",
            company: "",
            owner: "",
            address: "",
            country: "",
            contactPerson: "",
            email: "",
            phone: "",
            website: "",
        }),
    }),

    computed: {},

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(client) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(client);
        },

        loadClients() {
            axios
                .get("/api/client")
                .then(({ data }) => (this.clients = data.data))
                .catch((error) => console.log(error));
        },

        createClient() {
            this.form
                .post("/api/client")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteClient(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/client/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateClient() {
            this.form
                .put("/api/client/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadClients();
        Fire.$on("reloadRecords", () => {
            this.loadClients();
        });
    },
};
</script>
