<template>
    <div v-if="loading" class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body text-center">
                    <p class="m-0">Loading data...</p>
                </div>
            </div>
        </div>
    </div>

    <div v-else class="row">
        <div class="col-12 mb-3 text-center">
            <button @click="addNew" class="btn btn-lg btn-secondary text-uppercase">Add new</button>
        </div>

        <note-component
            v-for="(note, index) in notes"
            :styles="styles"
            :note-index="index"
            :note-data="note"
            :key="note.id || note.tempId"
        ></note-component>
    </div>
</template>

<script>
    import NoteComponent from './NoteComponent.vue';

    export default {
        components: {
            'note-component': NoteComponent,
        },

        data: function () {
            return {
                defaultNote: {
                    content: '',
                    created_at: null,
                    id: null,
                    style: 'info',
                    title: null,
                    updated_at: null,
                },
                loading: true,
                notes: [],
                styles: [
                    'danger',
                    'info',
                    'success',
                    'warning',
                ],
                token: null,
            }
        },

        mounted() {
            this.getToken();

            this.listenDeleteNote();
        },

        methods: {
            addNew() {
                this.notes.unshift(Object.assign({}, this.defaultNote, {
                    style: this.styles[Math.floor(Math.random() * this.styles.length)],
                    tempId: Math.random().toString(36).substr(2, 9),
                }));
            },

            getNotes() {
                return axios.get('/api/notes')
                    .then(response => this.notes = response.data.notes);
            },

            getToken() {
                return axios.get('/api/token')
                    .then(response => this.token = response.data.token)
                    .then(() => this.getNotes())
                    .then(() => this.loading = false);
            },

            listenDeleteNote() {
                this.$on('delete-note', data => this.notes.splice(data.index, 1));
            },
        },
    }
</script>
