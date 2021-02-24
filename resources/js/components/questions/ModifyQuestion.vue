<template>
    <b-modal
        v-model="showModal"
        ref="modal"
        :title="modalTitle"
        @show="showModalAction"
        @close="preventAction"
        @hide="preventHide"
        @cancel="preventAction"
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
            required: true
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
        submitAction(e) {
            if (this.question.id) {
                axios.patch('question/edit', this.question).then(response => {
                    this.preventAction(e);
                });
            } else {
                axios.post('question/new', this.question).then(response => {
                    this.preventAction(e);
                });
            }
            this.preventAction(e);
        },
        preventHide(e) {
            if (e.trigger === "backdrop") {
                this.preventAction(e);
            }
        },
        showModalAction() {
            this.questionCategoryOptions = this.fetchQuestionCategoriesOptions();
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
        },
        preventAction(e) {
            e.preventDefault();
            this.$root.$emit("modifyQuestionShowModalClosed");
        }
    }

}

</script>

<style scoped>
</style>
