<script>
export default {
    props: ["comment-data"],

    data() {
        return {
            editing: false,
            newText: "",
            oldText: ""
        };
    },

    mounted() {
        this.newText = this.commentData.text;
    },

    methods: {
        startEditing() {
            this.editing = true;
            this.selectText();
        },

        resetText() {
            this.editing = false;
            this.$refs.input.innerText = this.oldText;
        },

        textChanged() {
            this.oldText = this.newText = this.$refs.input.innerText;
        },

        updateComment() {
            this.editing = false;

            axios.patch("/comments/" + this.commentData.id, {
                text: this.newText
            });
            this.$root.$emit("flash", "comment updated");
            this.oldText = this.newText;
        },

        deleteComment() {
            if (
                window.confirm("Are you sure you want to delete this comment?")
            ) {
                axios.delete("/comments/" + this.commentData.id);
                this.$root.$emit("flash", "comment deleted");
                this.$el.remove();
            }
        },

        selectText() {
            setTimeout(() => {
                let p = this.$refs.input,
                    s = window.getSelection(),
                    r = document.createRange();
                r.setStart(p, 0);
                r.setEnd(p, 1);
                s.removeAllRanges();
                s.addRange(r);
                p.focus();
            }, 0);
        }
    }
};
</script>

<style lang="scss" scoped>
[contenteditable="true"] {
    border: 1px solid red;
    padding: 2px;
}
</style>
