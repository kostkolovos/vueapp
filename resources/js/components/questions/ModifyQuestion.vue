<template>
    <b-modal
        v-model="showModal"
        ref="modal"
        :title="modalTitle"
        @close="onClose"
        @hide="preventHide"
        @hidden="resetModal"
        ok-title="Submit"
        @ok="submitAction">
        <b-form @submit="submitAction">
            <b-form-group>
                <label>Title:</label>
                <b-form-input v-model="question.title" name="title"/>
            </b-form-group>
            <b-form-group>
                <label>Question:</label>
                <b-form-input v-model="question.question" name="question"/>
            </b-form-group>
            <b-form-group>
                <label>Question Category:</label>
                <b-form-select v-model="question.question_category.id" :options="questionCategoryOptions" name="question_category"></b-form-select>
            </b-form-group>
        </b-form>
    </b-modal>
</template>

<script>
export default {
    name: "AddQuestion",
    props: {
        question: {
            type: Object,
            required: false,
            default: questionModal
        },
        modalTitle: {
            type: String,
            required: true
        },
        showModal: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            questionCategoryOptions: {
                type: Array
            }
        }
    },
    methods: {
        submitAction: function () {
            if (this.question.id) {
                axios.patch('question/edit', this.question).then(response => {
                });
            } else {
                axios.post('question/new', this.question).then(response => {
                });
            }
        },
        resetModal() {
            this.question = questionModal;
        },
        preventHide(e) {
            if (e.trigger === "backdrop") {
                e.preventDefault();
                this.$root.$emit("modifyQuestionShowModalClosed");
            }
        },
        onClose(e) {
            e.preventDefault();
            this.$root.$emit("modifyQuestionShowModalClosed");
        },
        fetchQuestionCategoriesOptions() {
            let questionCategories = [];
            axios.get('question_category_fetch').then(response => {
                response.data.valueOf().forEach((value, index) => {
                    questionCategories.push({
                        'value': value.id,
                        'text': value.title
                    });
                })
            });
            return questionCategories;
        }
    }

}

export const questionModal = {
    title: '',
    id: '',
    question: '',
    question_category: ''
}

</script>

<style scoped>
</style>
