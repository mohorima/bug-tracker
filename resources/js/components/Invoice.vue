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
                            New Invoice
                        </div>
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
                                                deleteInvoice(invoice.id)
                                            "
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
                                        <span class="badge bg-light text-faded">
                                            BILL
                                        </span>
                                        {{ invoice.billDate }}<br />
                                        <span
                                            class="badge bg-light text-faded mt-1"
                                        >
                                            DUE
                                        </span>
                                        {{ invoice.dueDate }}
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
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            v-show="editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Update Invoice #{{ form.invoiceNum }}
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
                            <i
                                class="fas fa-times-circle"
                                aria-hidden="true"
                            ></i>
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
        invoices: [],
        projects: [],
        keywords: null,
        form: new Form({
            invoiceNum: "",
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

    watch: {
        keywords(after, before) {
            this.loadInvoices();
        },
    },

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
                .get("/api/invoice", { params: { keywords: this.keywords } })
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
