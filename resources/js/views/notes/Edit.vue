<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        New Note
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" @submit.prevent="update">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" v-model="form.title" id="title"  v-bind:class="{'form-control':true, 'is-invalid' : theErrors.title}">
                                <div v-if="theErrors.title" class="mt-2 text-danger">{{ theErrors.title[0] }}</div>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select @change="selectedSubject" id="" v-bind:class="{'form-control':true, 'is-invalid' : theErrors.subject}">
                                    <option :value="form.subjectId" v-text="form.subject"></option>
                                    <template v-for="subject in subjects">
                                        <option v-if="form.subjectId !== subject.id" :key="subject.id" :value="subject.id">
                                            {{ subject.name }}
                                        </option>
                                    </template>
                                </select>
                                <div v-if="theErrors.subject" class="mt-2 text-danger">{{ theErrors.subject[0] }}</div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="form.description" id="description" rows="5"  v-bind:class="{'form-control':true, 'is-invalid' : theErrors.description}"></textarea>
                                <div v-if="theErrors.description" class="mt-2 text-danger">{{ theErrors.description[0] }}</div>
                            </div>

                            <button type="submit" class="btn btn-outline-info">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return  {
            form : [],
            subjects : [],
            theErrors : [],
            selected : ''
        }
     },

     mounted() {
         this.getSubjects();
         this.getNote();
     },

     methods: {
        async getSubjects() {
            let response = await axios.get(`/api/subjects`);
            if (response.status == 200) {
                this.subjects = response.data
            }
        },

        async getNote() {
            await axios.get(`/api/notes/${this.$route.params.noteSlug}`).then((response) => {
                this.form = response.data.data
            }).catch((e) => {
                console.log(e);
            });
        },

        selectedSubject(e) {
            this.selected = e.target.value
        },

        async update() {
            this.form['subject'] = this.selected || this.form.subjectId;
            await axios.patch(`/api/notes/${this.$route.params.noteSlug}/edit`, this.form).then((response) => {
                this.$toasted.show(response.data.message,  {
                    theme: "bubble",
                    type : "success",
                    position: "top-right",
                    duration : 5000
                });
                this.$router.push(`/notes/table`);
            }).catch((e) => {
                console.log(e);
            });
        }
    }
}
</script>

