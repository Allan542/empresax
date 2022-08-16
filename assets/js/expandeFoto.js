function expandeFoto(url, tela = '', titulo = ''){
    document.querySelector('.expandir').classList.toggle('mostrar')
    const ImgExpandirFoto = document.querySelector('img.expandir-foto')
    ImgExpandirFoto.src=`${url}`

    if(tela == 'perfil') {
        ImgExpandirFoto.title = "Foto de Perfil"
    }
    else if (tela == 'bandas') {
        ImgExpandirFoto.title = titulo
    }
}