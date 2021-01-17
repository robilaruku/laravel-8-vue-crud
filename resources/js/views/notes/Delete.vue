<template>
    <button ref="deleteNote" class="btn btn-sm btn-danger" @click="destroyNote"><i class="fa fa-trash"></i></button>
</template>

<script>
export default {
    props : ['endpoint'],
    methods : {
        async destroyNote() {
           let q = window.confirm('Are you sure ?');

           if (q == true) {
                await axios.delete(`/api/notes/${this.endpoint}/delete`).then((response) => {
                    this.$toasted.show(response.data.message,  {
                        theme: "bubble",
                        type : "success",
                        position: "top-right",
                        duration : 5000
                    });
                    this.$refs.deleteNote.parentNode.parentNode.parentNode.remove();
                }).catch((error) => {
                    console.log(error);
                })
           }
        }
    }
}
</script>

