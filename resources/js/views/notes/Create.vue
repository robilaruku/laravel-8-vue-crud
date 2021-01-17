<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        New Note
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" @submit.prevent="store">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" v-model="form.title" id="title"  v-bind:class="{'form-control':true, 'is-invalid' : theErrors.title}">
                                <div v-if="theErrors.title" class="mt-2 text-danger">{{ theErrors.title[0] }}</div>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select v-model="form.subject" id="" v-bind:class="{'form-control':true, 'is-invalid' : theErrors.subject}">
                                    <option  v-for="subject in subjects" :key="subject.id" :value="subject.id">
                                        {{ subject.name }}
                                    </option>
                                </select>
                                <div v-if="theErrors.subject" class="mt-2 text-danger">{{ theErrors.subject[0] }}</div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="form.description" id="description" rows="5"  v-bind:class="{'form-control':true, 'is-invalid' : theErrors.description}"></textarea>
                                <div v-if="theErrors.description" class="mt-2 text-danger">{{ theErrors.description[0] }}</div>
                            </div>

                            <button type="submit" class="btn btn-outline-primary">Save</button>
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
            form : {
                title : '',
                description : '',
                subject : ''
            },
            subjects : [],
            theErrors : []
        }
     },

     mounted() {
         this.getSubjects();
     },

     methods: {
        async getSubjects() {
            let response = await axios.get(`/api/subjects`);
            if (response.status == 200) {
                this.subjects = response.data
            }
        },

        async store() {

            try {
                let response = await axios.post(`/api/notes/create-new-note`, this.form)

                if (response.status == 200) {
                    this.form.title = "",
                    this.form.description = "",
                    this.form.subject = "",
                    this.theErrors = [],

                    this.$toasted.show(response.data.message,  {
                        theme: "bubble",
                        type : "success",
                        position: "top-right",
                        duration : 5000
                    });
                }
            } catch(e) {
                this.$toasted.show('Something went wrong',  {
                    theme: "bubble",
                    type : "error",
                    position: "top-right",
                    duration : 5000
                });
                this.theErrors = e.response.data.errors;
            }
        }
    }
}
</script>

