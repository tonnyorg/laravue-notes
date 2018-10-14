<template>
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <form :class="['card-body border-top', 'border-' + note.style]">
                <div class="form-group">
                    <label>Style</label>
                    <select v-model="note.style" class="form-control form-control-sm">
                        <option v-for="style in styles" :value="style">{{ style | capitalize }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input v-model="note.title" type="text" class="form-control" aria-label="Title">
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea v-model="note.content" required="required" class="form-control" aria-label="Content"></textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button
                            @click="storeOrUpdateNote"
                            type="button"
                            :disabled="loading"
                            class="btn btn-sm btn-outline-success"
                        >{{ note.id ? 'Update' : 'Save' }}</button>

                        <button
                            @click="deleteNote"
                            type="button"
                            :disabled="!note.id || loading"
                            :class="['btn btn-sm', {'btn-outline-danger': note.id, 'btn-outline-secondary': !note.id}]"
                        >Delete</button>
                    </div>

                    <small class="text-muted text-uppercase">{{ note.id ? 'Id: ' + note.id : 'New' }}</small>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                note: null,
                loading: false,
            }
        },

        props: {
            noteData: Object,
            noteIndex: Number,
            styles: Array,
        },

        filters: {
            capitalize: function (value) {
                if (!value) {
                    return '';
                }

                value = value.toString();

                return value.charAt(0).toUpperCase() + value.slice(1)
            },
        },

        created() {
            this.note = this.noteData;
        },

        methods: {
            catchErrors(error) {
                let errors = [];
                errors.push(error.response.data.message + "\n");

                if (typeof error.response.data.errors === 'object') {
                    Object.keys(error.response.data.errors).forEach(key => {
                        errors = errors.concat(error.response.data.errors[key]);
                    });
                }

                alert(errors.join("\n").replace(/^\s+|\s+$/g, ''));

                this.loading = false;
            },

            deleteNote() {
                this.loading = true;

                return axios.delete('/api/notes/' + this.note.id, this.note)
                    .then(response => this.emitDeleteNote())
                    .catch(error => this.catchErrors(error));
            },

            emitDeleteNote() {
                this.$parent.$emit('delete-note', {index: this.noteIndex});
            },

            storeNote() {
                return axios.post('/api/notes', this.note)
                    .then(response => this.note = response.data.note)
                    .then(() => this.loading = false)
                    .catch(error => this.catchErrors(error));
            },

            storeOrUpdateNote() {
                this.loading = true;

                if (!this.note.id) {
                    return this.storeNote();
                }

                return this.updateNote();
            },

            updateNote() {
                return axios.put('/api/notes/' + this.note.id, this.note)
                    .then(response => this.note = response.data.note)
                    .then(() => this.loading = false)
                    .catch(error => this.catchErrors(error));
            },
        },
    }
</script>
