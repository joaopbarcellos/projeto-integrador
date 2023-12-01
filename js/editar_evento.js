const btn_excluir = document.querySelector("#excluir_evento");

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

document.getElementById('imgevento').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const image = new Image();
        image.src = URL.createObjectURL(file);
        image.onload = function() {
            const width = this.width;
            const height = this.height;
            const aspectRatio = width / height;
            if (Math.abs(aspectRatio - (16 / 9)) > 0.01) {
                Swal.fire({
                    title: "ERRO!",
                    icon: "error",
                    text: "Por favor, selecione uma imagem com proporção 16:9!",
                });
                // Limpar o input para evitar o envio da imagem incorreta
                document.getElementById('imgevento').value = '';
            }
        };
    }
});