<div>

    @include("livewire.articles.edit")

    @include("livewire.articles.add")

    @include("livewire.articles.list")


</div>

<script>
    window.addEventListener("showEditForm",function(e){

    })
</script>

<script>
    window.addEventListener("showSuccessMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title: event.detail.message || "Opération effectuée avec succès!",
                showConfirmButton: false,
                timer: 5000
                }
            )
    })
</script>

<script>
    window.addEventListener("showConfirmMessage", event=>{
       Swal.fire({
        title: event.detail.message.title,
        text: event.detail.message.text,
        icon: event.detail.message.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuer',
        cancelButtonText: 'Annuler'
        }).then((result) => {
        if (result.isConfirmed) {
            if(event.detail.message.data.type_article_id){

            }

            if(event.detail.message.data.propriete_id){

            }
        }
        })
    })

</script>

<script>
    window.addEventListener("showModal", event=>{
       $("#modalAdd").modal({
           "show": true,
           "backdrop": "static"
       })
    })
    window.addEventListener("closeModal", event=>{
       $("#modalAdd").modal("hide")
    })

    window.addEventListener("showEditModal", event=>{
       $("#editModalProp").modal({
           "show": true,
           "backdrop": "static"
       })
    })
    window.addEventListener("closeEditModal", event=>{
       $("#editModalProp").modal("hide")
    })

</script>
