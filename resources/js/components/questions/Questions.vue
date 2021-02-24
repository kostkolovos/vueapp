<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row center-block text-center ">
                    <div class="col-md-10">
                        <h1>Question List ({{ questionComputed.length }})</h1>
                    </div>

                    <div class="col-md-2">
                        <button v-on:click="populateModal()" class="btn btn-success float-right">Add</button>
                    </div>
                </div>

                <modify-question :showModal="showModal" :question="question" :modalTitle="modalTitle"></modify-question>

                <!-- Card -->
                <div class="card" v-for="question in questionComputed" v-bind:id="question.id">
                    <div class="card-header text-center"><strong>{{ question.title }}</strong></div>
                    <div class="card-body">
                        <div class="text-center"> {{ question.question_category.title }}</div>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-primary" v-on:click="populateModal(question)">Edit</button>
                        <button class="btn btn-danger float-right" v-on:click="deleteAction(question.id)">Delete</button>
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
        questions: {
            type: Array,
            required: true
        }
    },
    data: function () {
        return {
            questionProperty: this.questions,
            question: undefined,
            modalTitle: 'Add Question',
            showModal: false
        }
    },
    computed: {
        questionComputed: {
            get() {
                return this.questionProperty;
            },
            set(question) {
                this.questionProperty = question;
            }
        }
    },
    mounted() {
        this.$root.$on("modifyQuestionShowModalClosed", data => {
            this.showModal = false;
            this.fetchQuestion();
        })
    },
    methods: {
        deleteAction: function (id) {
            axios.delete('question/' + id).then(response => {
                return this.fetchQuestion();
            });
        },
        fetchQuestion: function () {
            return axios.get('question_fetch').then(response => {
                this.questionComputed = response.data.valueOf();
            });
        },
        populateModal: function (question = null) {
            if (question) {
                this.question = question;
                this.modalTitle = 'Edit Question'
            } else {
                this.question = undefined;
                this.modalTitle = 'Add Question'
            }
            this.showModal = true
        }
    }
}

</script>

<style scoped>
.card {
    margin-bottom: 15px;
}
</style>
