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
                                    <td>
                                        <a :href="'https://' + client.website">
                                            {{ client.website }}
                                        </a>
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
                                        placeholder="Company Name"
                                    />
                                    <HasError :form="form" field="company" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="owner"
                                    >Owner
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="owner"
                                        v-model="form.owner"
                                        type="text"
                                        name="owner"
                                        class="form-control"
                                        placeholder="Owner"
                                    />
                                    <HasError :form="form" field="owner" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="address"
                                    >Address
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <textarea
                                        id="address"
                                        class="form-control"
                                        name="address"
                                        rows="3"
                                        cols="50"
                                        v-model="form.address"
                                    >
                                    </textarea>
                                    <HasError :form="form" field="address" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="country"
                                    >Country
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <select
                                        class="custom-select form-control"
                                        name="country"
                                        id="country"
                                        v-model="form.country"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                            >Select Country
                                        </option>
                                        <option value="--"
                                            >Not Specified</option
                                        >
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS"
                                            >American Samoa</option
                                        >
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG"
                                            >Antigua and Barbuda</option
                                        >
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA"
                                            >Bosnia and Herzegowina</option
                                        >
                                        <option value="BW">Botswana</option>
                                        <option value="BV"
                                            >Bouvet Island</option
                                        >
                                        <option value="BR">Brazil</option>
                                        <option value="IO"
                                            >British Indian Ocean
                                            Territory</option
                                        >
                                        <option value="BN"
                                            >Brunei Darussalam</option
                                        >
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY"
                                            >Cayman Islands</option
                                        >
                                        <option value="CF"
                                            >Central African Republic</option
                                        >
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX"
                                            >Christmas Island</option
                                        >
                                        <option value="CC"
                                            >Cocos (Keeling) Islands</option
                                        >
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD"
                                            >Congo, the Democratic Republic of
                                            the</option
                                        >
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI"
                                            >Cote d'Ivoire</option
                                        >
                                        <option value="HR"
                                            >Croatia (Hrvatska)</option
                                        >
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ"
                                            >Czech Republic</option
                                        >
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO"
                                            >Dominican Republic</option
                                        >
                                        <option value="TP">East Timor</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ"
                                            >Equatorial Guinea</option
                                        >
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK"
                                            >Falkland Islands (Malvinas)</option
                                        >
                                        <option value="FO"
                                            >Faroe Islands</option
                                        >
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="FX"
                                            >France, Metropolitan</option
                                        >
                                        <option value="GF"
                                            >French Guiana</option
                                        >
                                        <option value="PF"
                                            >French Polynesia</option
                                        >
                                        <option value="TF"
                                            >French Southern Territories</option
                                        >
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW"
                                            >Guinea-Bissau</option
                                        >
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM"
                                            >Heard and Mc Donald Islands</option
                                        >
                                        <option value="VA"
                                            >Holy See (Vatican City
                                            State)</option
                                        >
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR"
                                            >Iran (Islamic Republic of)</option
                                        >
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP"
                                            >Korea, Democratic People's Republic
                                            of</option
                                        >
                                        <option value="KR"
                                            >Korea, Republic of</option
                                        >
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA"
                                            >Lao People's Democratic
                                            Republic</option
                                        >
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY"
                                            >Libyan Arab Jamahiriya</option
                                        >
                                        <option value="LI"
                                            >Liechtenstein</option
                                        >
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK"
                                            >Macedonia, The Former Yugoslav
                                            Republic of</option
                                        >
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH"
                                            >Marshall Islands</option
                                        >
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM"
                                            >Micronesia, Federated States
                                            of</option
                                        >
                                        <option value="MD"
                                            >Moldova, Republic of</option
                                        >
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN"
                                            >Netherlands Antilles</option
                                        >
                                        <option value="NC"
                                            >New Caledonia</option
                                        >
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF"
                                            >Norfolk Island</option
                                        >
                                        <option value="MP"
                                            >Northern Mariana Islands</option
                                        >
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG"
                                            >Papua New Guinea</option
                                        >
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU"
                                            >Russian Federation</option
                                        >
                                        <option value="RW">Rwanda</option>
                                        <option value="KN"
                                            >Saint Kitts and Nevis</option
                                        >
                                        <option value="LC">Saint LUCIA</option>
                                        <option value="VC"
                                            >Saint Vincent and the
                                            Grenadines</option
                                        >
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST"
                                            >Sao Tome and Principe</option
                                        >
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK"
                                            >Slovakia (Slovak Republic)</option
                                        >
                                        <option value="SI">Slovenia</option>
                                        <option value="SB"
                                            >Solomon Islands</option
                                        >
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS"
                                            >South Georgia and the South
                                            Sandwich Islands</option
                                        >
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="PM"
                                            >St. Pierre and Miquelon</option
                                        >
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ"
                                            >Svalbard and Jan Mayen
                                            Islands</option
                                        >
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY"
                                            >Syrian Arab Republic</option
                                        >
                                        <option value="TW"
                                            >Taiwan, Province of China</option
                                        >
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ"
                                            >Tanzania, United Republic
                                            of</option
                                        >
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT"
                                            >Trinidad and Tobago</option
                                        >
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC"
                                            >Turks and Caicos Islands</option
                                        >
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE"
                                            >United Arab Emirates</option
                                        >
                                        <option value="GB"
                                            >United Kingdom</option
                                        >
                                        <option value="US"
                                            >United States</option
                                        >
                                        <option value="UM"
                                            >United States Minor Outlying
                                            Islands</option
                                        >
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG"
                                            >Virgin Islands (British)</option
                                        >
                                        <option value="VI"
                                            >Virgin Islands (U.S.)</option
                                        >
                                        <option value="WF"
                                            >Wallis and Futuna Islands</option
                                        >
                                        <option value="EH"
                                            >Western Sahara</option
                                        >
                                        <option value="YE">Yemen</option>
                                        <option value="YU">Yugoslavia</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                    <HasError :form="form" field="country" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="contactPerson"
                                    >Contact Person
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="contactPerson"
                                        v-model="form.contactPerson"
                                        type="text"
                                        name="contactPerson"
                                        class="form-control"
                                        placeholder="Full Name"
                                    />
                                    <HasError
                                        :form="form"
                                        field="contactPerson"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="email"
                                    >Email
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="email@domain.com"
                                    />
                                    <HasError :form="form" field="email" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="phone"
                                    >Phone
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="phone"
                                        v-model="form.phone"
                                        type="number"
                                        name="phone"
                                        class="form-control"
                                        placeholder="Phone"
                                    />
                                    <HasError :form="form" field="phone" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label"
                                    for="website"
                                    >Website
                                </label>

                                <div class="col-md-8">
                                    <input
                                        id="website"
                                        v-model="form.website"
                                        type="text"
                                        name="website"
                                        class="form-control"
                                        placeholder="www.website.com"
                                    />
                                    <HasError :form="form" field="website" />
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
