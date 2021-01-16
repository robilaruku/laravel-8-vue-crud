<template>
    <div class="container">
        <h3>Table of Note</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Published</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="note in notes" :key="note.id">
                    <td><router-link :to="{ name: 'notes.show', params : { noteSlug: note.slug } }">{{ note.title }}</router-link></td>
                    <td>{{ note.subject }}</td>
                    <td>{{ note.published }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            notes : [],
        }
    },

    mounted() {
        this.getNotes()
    },

    methods: {
        async getNotes(){
            await axios.get(`/api/notes`).then(({ data }) => {
                this.notes = data.data;
            })
        }
    }
}
</script>

