<template>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-start">
            <div
                class="col-lg-4 profile-info d-flex justify-content-center align-items-center flex-lg-column mb-5"
            >
                <div class="profile-pic-section mr-2">
                    <div class="profile-pic"></div>
                    <div class="profile-pic-btn">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true"
                            role="img"
                            width="26"
                            height="26"
                            preserveAspectRatio="xMidYMid meet"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M19 13a1 1 0 0 0-1 1v.38l-1.48-1.48a2.79 2.79 0 0 0-3.93 0l-.7.7l-2.48-2.48a2.85 2.85 0 0 0-3.93 0L4 12.6V7a1 1 0 0 1 1-1h7a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-5a1 1 0 0 0-1-1zM5 20a1 1 0 0 1-1-1v-3.57l2.9-2.9a.79.79 0 0 1 1.09 0l3.17 3.17l4.3 4.3zm13-1a.89.89 0 0 1-.18.53L13.31 15l.7-.7a.77.77 0 0 1 1.1 0L18 17.21zm4.71-14.71l-3-3a1 1 0 0 0-.33-.21a1 1 0 0 0-.76 0a1 1 0 0 0-.33.21l-3 3a1 1 0 0 0 1.42 1.42L18 4.41V10a1 1 0 0 0 2 0V4.41l1.29 1.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42z"
                                fill="#fafaf8"
                            />
                        </svg>
                    </div>
                </div>
                <div class="text-center">
                    <h2>{{ this.form.name }}</h2>
                    <p>{{ this.form.email }}</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card tab-card">
                    <ul
                        class="nav nav-tabs tab-header"
                        id="myTab"
                        role="tablist"
                    >
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                id="home-tab"
                                data-toggle="tab"
                                href="#home"
                                role="tab"
                                aria-controls="home"
                                aria-selected="true"
                                >Activity</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="profile-tab"
                                data-toggle="tab"
                                href="#profile"
                                role="tab"
                                aria-controls="profile"
                                aria-selected="false"
                                >Profile</a
                            >
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div
                            class="tab-pane fade show active"
                            id="home"
                            role="tabpanel"
                            aria-labelledby="home-tab"
                        >
                            Activities
                        </div>
                        <div
                            class="tab-pane fade"
                            id="profile"
                            role="tabpanel"
                            aria-labelledby="profile-tab"
                        >
                            <form class="input-form">
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="name"
                                        >Name
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <div class="col-md-9">
                                        <input
                                            id="name"
                                            v-model="form.name"
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            placeholder="Name"
                                        />
                                        <HasError :form="form" field="name" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="email"
                                        >Email
                                        <strong class="text-danger"> *</strong>
                                    </label>

                                    <div class="col-md-9">
                                        <input
                                            id="email"
                                            v-model="form.email"
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Email"
                                        />
                                        <HasError :form="form" field="email" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="bio"
                                        >Biography
                                    </label>

                                    <div class="col-md-9">
                                        <textarea
                                            id="bio"
                                            class="form-control"
                                            name="bio"
                                            rows="3"
                                            cols="50"
                                            v-model="form.bio"
                                        >
                                        </textarea>
                                        <HasError :form="form" field="bio" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="photo"
                                        >Upload Photo
                                    </label>

                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                @change="updateProfile"
                                                class="custom-file-input"
                                                id="customFile"
                                                name="photo"
                                            />
                                            <label
                                                class="custom-file-label"
                                                for="customFile"
                                            >
                                                {{ filename }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="d-flex justify-content-center align-items-center"
                                >
                                    <button
                                        @click.prevent="updateInfo"
                                        type="submit"
                                        class="btn btn-submit mt-3"
                                    >
                                        <i class="fas fa-pen-nib mr-2"></i>
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
        filename: "Choose File",
        form: new Form({
            id: "",
            name: "",
            email: "",
            password: "",
            bio: "",
            photo: "",
        }),
    }),

    methods: {
        loadProfile() {
            axios.get("api/profile").then(({ data }) => this.form.fill(data));
        },
        updateInfo() {
            this.form
                .put("api/profile")
                .then(() => {})
                .catch((error) => console.log(error));
        },
        updateProfile(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            this.filename = file.name;
            //let limit = 1024 * 1024 * 2;
            // if (file["size"] > limit) {
            //     swal({
            //         type: "error",
            //         title: "Oops...",
            //         text: "You are uploading a large file",
            //     });
            //     return false;
            // }
            reader.onloadend = (file) => {
                this.form.photo = reader.result;
            };
            reader.readAsDataURL(file);
        },
    },

    created() {
        this.loadProfile();
    },
};
</script>
