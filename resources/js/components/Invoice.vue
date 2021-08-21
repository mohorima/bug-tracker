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
                                    <th class="th-sm" scope="col">Amount</th>
                                    <th class="th-sm" scope="col">Date</th>
                                    <th class="th-lg" scope="col">Project</th>
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
                                        <div class="text-small">
                                            {{ invoice.note }}
                                        </div>
                                        <span class="badge bg-light text-faded">
                                            {{
                                                invoice.recurring === "1"
                                                    ? "RECURRING"
                                                    : "SINGLE-TIME"
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>
                                            $
                                            {{
                                                (
                                                    +parseFloat(
                                                        invoice.amount
                                                    ).toFixed(2) +
                                                    +parseFloat(invoice.tax)
                                                ).toFixed(2)
                                            }}
                                        </strong>
                                        <div class="text-small">
                                            Gross - {{ "$ " + invoice.amount }}
                                            <br />
                                            Tax - {{ "$ " + invoice.tax }}
                                        </div>
                                        <span
                                            class="badge bg-light text-faded to-uppercase"
                                        >
                                            {{ invoice.paymentMode }}
                                        </span>
                                    </td>
                                    <td>
                                        Bill - {{ invoice.billDate }}<br />
                                        Due - {{ invoice.dueDate }}
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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content px-2">
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
                        class="input-form"
                        @submit.prevent="
                            editMode ? updateInvoice() : createInvoice()
                        "
                    >
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="col-form-label" for="amount"
                                        >Amount
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                $
                                            </div>
                                        </div>
                                        <input
                                            id="amount"
                                            v-model="form.amount"
                                            type="text"
                                            name="amount"
                                            class="form-control"
                                            placeholder="00000"
                                        />
                                    </div>
                                    <HasError :form="form" field="amount" />
                                </div>
                                <!--.form-group -->
                                <div class="form-group col-md-4">
                                    <label class="col-form-label" for="tax"
                                        >Tax
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                $
                                            </div>
                                        </div>
                                        <input
                                            id="tax"
                                            v-model="form.tax"
                                            type="text"
                                            name="tax"
                                            class="form-control"
                                            placeholder="0000"
                                        />
                                    </div>
                                    <HasError :form="form" field="tax" />
                                </div>
                                <!--.form-group -->
                                <div class="form-group col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="paymentMode"
                                        >Payment Mode
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <select
                                        class="custom-select form-control"
                                        name="paymentMode"
                                        id="paymentMode"
                                        v-model="form.paymentMode"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                            >Select Payment Mode
                                        </option>
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="paypal">Paypal</option>
                                        <option value="wire">
                                            Wire Transfer
                                        </option>
                                    </select>
                                    <HasError
                                        :form="form"
                                        field="paymentMode"
                                    />
                                </div>
                                <!--.form-group -->
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="billDate"
                                        >Bill Date
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="billDate"
                                        v-model="form.billDate"
                                        type="date"
                                        name="billDate"
                                        class="form-control"
                                    />
                                    <HasError :form="form" field="billDate" />
                                </div>
                                <!--.form-group -->
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="dueDate"
                                        >Due Date
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="dueDate"
                                        v-model="form.dueDate"
                                        type="date"
                                        name="dueDate"
                                        class="form-control"
                                    />
                                    <HasError :form="form" field="dueDate" />
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
                                        for="recurring"
                                    >
                                        Recurring
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="recurring"
                                            id="recurring1"
                                            v-model="form.recurring"
                                            value="1"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="recurring1"
                                            >Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="recurring"
                                            id="recurring2"
                                            v-model="form.recurring"
                                            value="0"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="recurring2"
                                            >No
                                        </label>
                                    </div>
                                    <HasError :form="form" field="recurring" />
                                </div>
                                <!--.form-group -->
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="note"
                                    >Note
                                </label>

                                <textarea
                                    id="note"
                                    class="form-control"
                                    name="note"
                                    rows="2"
                                    cols="50"
                                    v-model="form.note"
                                >
                                </textarea>
                                <HasError :form="form" field="note" />
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
        invoices: [],
        projects: [],
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
            this.loadProjects();
            $("#addRecord").modal("show");
        },

        editModal(invoice) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadProjects();
            $("#addRecord").modal("show");
            this.form.fill(invoice);
        },

        loadInvoices() {
            axios
                .get("/api/invoice")
                .then(({ data }) => (this.invoices = data.data))
                .catch((error) => console.log(error));
        },

        loadProjects() {
            axios
                .get("/api/project")
                .then(({ data }) => (this.projects = data.data))
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
