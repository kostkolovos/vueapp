<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row center-block text-center ">
                    <div class="col-md-10">
                        <h1>User List ({{ userPropertyComputed.length }})</h1>
                    </div>

                    <div class="col-md-2">
                        <button data-toggle="modal" v-on:click="populateForm()" data-target="#formModal" class="btn btn-success float-right">Add</button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ modalTitle }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="modalForm"  v-on:submit.prevent="submitAction()">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Your name" v-model="user.name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Your name" v-model="user.email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Your name" v-model="user.password">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" data-dismiss="modal" class="btn btn-primary" v-on:click="submitAction()">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

                <!-- Card -->
                <div class="card" v-for="user in userPropertyComputed" v-bind:id="user.id">
                    <div class="card-header text-center"><strong>{{ user.name }}</strong></div>
                    <div class="card-body">
                        Email: {{ user.email }} <br>
                        Created At: {{ user.created_at }}<br>
                        Updated At: {{ user.updated_at }}<br>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-primary" v-on:click="populateForm(user)">Edit</button>
                        <button class="btn btn-danger float-right" v-on:click="deleteAction(user.id)">Delete</button>
                    </div>
                </div>
                <!-- Card -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        users: {
            type: Array,
            required: true
        },
    },
    data: function () {
        return {
            userProperty: this.users,
            user: userModal,
            modalTitle: 'Add User'
        }
    },
    computed: {
        userPropertyComputed: {
            get() {
                return this.userProperty;
            },
            set(user) {
                this.userProperty = user;
            }
        }
    },
    methods: {
        deleteAction: function (id) {
            axios.delete('user/' + id).then(response => {
                return this.fetchUsers();
            });
        },
        submitAction: function () {
            if (this.user.id) {
                axios.patch('user/edit', this.user).then(response => {
                    return this.fetchUsers();
                });
            } else {
                axios.post('user/new', this.user).then(response => {
                    return this.fetchUsers();
                });
            }
            $('#formModal').modal('toggle');
        },
        fetchUsers: function () {
            return axios.get('usersfetch').then(response => {
                this.userPropertyComputed = response.data.valueOf();
            });
        },
        populateForm: function (user = null) {
            if (user) {
                this.user = user;
                this.modalTitle = 'Edit User'
            } else {
                this.user = userModal;
                this.modalTitle = 'Add User'
            }
            $('#formModal').modal('toggle');
        }
    }
}

export const userModal = {
    name: '',
    email: '',
    password: '',
    id: ''
};

</script>

<style scoped>
.card {
    margin-bottom: 15px;
}
</style>
