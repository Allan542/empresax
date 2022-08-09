function expandeFoto(url){
    document.querySelector('.expandir').classList.toggle('mostrar')
    document.querySelector('img.expandir-foto').src=`${url}` 
}