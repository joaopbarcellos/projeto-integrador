const btn_excluir = document.querySelector(".excluir_evento");

if(btn_excluir){
    btn_excluir.addEventListener("click", () => {
        Swal.fire({
            icon: "warning",
            text: "Deseja mesmo excluir esse evento?",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Sim",
            cancelButtonColor: "#d33",
            showCancelButton: true,
            cancelButtonText: "Não",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.assign("conexaoBancoDados/excluir_evento.php?id_evento=" + btn_excluir.name);
                }
        });
    });
}