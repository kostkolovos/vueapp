<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row center-block text-center ">
                    <div class="col-md-10">
                        <h1>Category List ({{ questionCategoryComputed.length }})</h1>
                    </div>

                    <div class="col-md-2">
                        <button data-toggle="modal" v-on:click="populateForm()" data-target="#formModal" class="btn btn-success float-right">Add</button>
                    </div>
                </div>

                <modify-question :showModal="showModal" :question="question" :modalTitle="modalTitle"></modify-question>


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
                                <form id="modalForm" v-on:submit.prevent="submitAction()">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="Category Title" v-model="questionCategory.title">
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
                <div class="card" v-for="questionCategory in questionCategoryComputed" v-bind:id="questionCategory.id">
                    <div class="card-header text-center"><strong>{{ questionCategory.title }}</strong></div>
                    <div class="card-body">
                        <div class="text-center" v-for="question in questionCategory.questions">
                            {{ question.title }}
                        </div>
                    </div>
                    <div class="card-footer container text-muted">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-primary" v-on:click="populateForm(questionCategory)">Edit</button>

                            </div>
                            <div class="col-md-4 d-flex justify-content-center">
                                <button class="btn btn-success" v-on:click="populateModal(questionCategory)">Add Question</button>

                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger float-right" v-on:click="deleteAction(questionCategory.id)">Delete</button>
                            </div>

                        </div>
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
        question_categories: {
            type: Array,
            required: true
        }
    },
    data: function () {
        return {
            questionCategoryProperty: this.question_categories,
            questionCategory: questionCategoryModal,
            modalTitle: 'Add Category',
            modalQuestionTitle: 'Add Question',
            showModal: false,
            question: undefined
        }
    },
    computed: {
        questionCategoryComputed: {
            get() {
                return this.questionCategoryProperty;
            },
            set(questionCategory) {
                this.questionCategoryProperty = questionCategory;
            }
        }
    },
    mounted() {
        this.$root.$on("modifyQuestionShowModalClosed", data => {
            this.showModal = false;
            this.fetchQuestionCategories();
        })
    },
    methods: {
        deleteAction: function (id) {
            axios.delete('question_category/' + id).then(response => {
                return this.fetchQuestionCategories();
            });
        },
        submitAction: function () {
            if (this.questionCategory.id) {
                axios.patch('question_category/edit', this.questionCategory).then(response => {
                    return this.fetchQuestionCategories();
                });
            } else {
                axios.post('question_category/new', this.questionCategory).then(response => {
                    return this.fetchQuestionCategories();
                });
            }
            $('#formModal').modal('toggle');
        },
        fetchQuestionCategories: function () {
            return axios.get('question_category_fetch').then(response => {
                this.questionCategoryComputed = response.data.valueOf();
            });
        },
        populateForm: function (questionCategory = null) {
            if (questionCategory) {
                this.questionCategory = questionCategory;
                this.modalTitle = 'Edit Category'
            } else {
                this.questionCategory = questionCategoryModal;
                this.modalTitle = 'Add Category'
            }
            $('#formModal').modal('toggle');
        },
        populateModal: function (questionCategory) {
            this.question = {
                title: '',
                id: '',
                question: '',
                question_category: questionCategory
            };
            this.showModal = true
        }
    }
}

export const questionCategoryModal = {
    title: '',
    id: ''
}

</script>

<style scoped>
.card {
    margin-bottom: 15px;
}
</style>
