<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4 profile-info d-flex justify-content-center align-items-center flex-lg-column mb-5">
                <div class="profile-pic-section mr-2">
                    <div class="profile-pic"></div>
                    <div class="profile-pic-btn">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h2>John Smith Kine</h2>
                    <span class="badge bg-light text-dark">
                        Admin
                    </span>
                    <p>johnsmith@gmail.com</p>
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
                            Profile
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
