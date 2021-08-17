<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4 mb-5">
                <div
                    class="d-flex justify-content-between align-items-center mb-4"
                >
                    <h3>Invoices</h3>

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
                                    <th class="th-sm" scope="col">Invoice #</th>
                                    <th class="th-sm" scope="col">Date</th>
                                    <th class="th-sm" scope="col">Amount</th>
                                    <th class="th-sm" scope="col">Project</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="invoice in invoices">
                                    <th scope="row">
                                        <a
                                            href=""
                                            @click.prevent="editModal(invoice)"
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
                                                deleteInvoice(invoice.id)
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
                                            {{ invoice.invoiceNum }}
                                        </div>
                                        <span class="badge bg-light text-faded">
                                            {{
                                                invoice.recurring === "yes"
                                                    ? "RECURRING"
                                                    : "SINGLE-TIME"
                                            }}
                                        </span>
                                        <div class="text-small">
                                            {{ invoice.note }}
                                        </div>
                                    </td>
                                    <td>
                                        Bill - {{ invoice.billDate }}<br />
                                        Due - {{ invoice.dueDate }}
                                    </td>
                                    <td>
                                        <strong>
                                            {{
                                                "$ " +
                                                invoice.amount +
                                                invoice.tax
                                            }}
                                        </strong>
                                        <div class="text-small">
                                            Gross - {{ "$ " + invoice.amount }}
                                            <br />
                                            Tax - {{ "$ " + invoice.tax }}
                                        </div>
                                        <span class="badge bg-light text-faded">
                                            {{ invoice.paymentMode }}
                                        </span>
                                    </td>
                                    <td>{{ invoice.project.title }}</td>
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
                            Update the Invoice
                        </h5>
                        <h5
                            v-show="!editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add New Invoice
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
                            editMode ? updateInvoice() : createInvoice()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="amount"
                                    >Amount
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="amount"
                                        v-model="form.amount"
                                        type="text"
                                        name="amount"
                                        class="form-control"
                                        placeholder="Title"
                                    />
                                    <HasError :form="form" field="amount" />
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
        invoices: {},
        form: new Form({
            id: "",
            billDate: "",
            dueDate: "",
            amount: "",
            paymentMode: "",
            tax: "",
            recurring: "",
            note: "",
            project_id: "",
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

        editModal(invoice) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(invoice);
        },

        loadInvoices() {
            axios
                .get("/api/invoice")
                .then(({ data }) => (this.invoices = data.data))
                .catch((error) => console.log(error));
        },

        createInvoice() {
            this.form
                .post("/api/invoice")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteInvoice(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/invoice/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },

        updateInvoice() {
            this.form
                .put("/api/invoice/" + this.form.id)
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
        this.loadInvoices();
        Fire.$on("reloadRecords", () => {
            this.loadInvoices();
        });
    },
};
</script>
