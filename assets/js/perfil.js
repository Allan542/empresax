function mostraAtualizarDados(form) {
    document.querySelector(form).classList.toggle('mostrar')
}

function mostraMudarFotoPerfil() {
    document.querySelector('.box-troca-img').classList.toggle('mostrar')
}

function mostraPerguntaSecreta(perguntasecreta) {
    let CheckPergunta = document.querySelector('input[name=chk-att-pergunta]')
    let BoxPerguntaSecreta = document.querySelector('.box-pergunta-secreta')
    
    if(perguntasecreta == '') {
        alert('Pergunta secreta é obrigatório porque você não cadastrou uma pergunta com resposta ainda!')
        CheckPergunta.checked = true
    }

    if(CheckPergunta.checked) { // quando checkbox da pergunta secreta no perfil marcado, mostra e ativa os campos
        BoxPerguntaSecreta.classList.add('mostrar')
        document.querySelector('select.select-box').disabled = false
        document.querySelector('input.txtResposta').disabled = false
    } else {
        BoxPerguntaSecreta.classList.remove('mostrar')
        document.querySelector('select.select-box').disabled = true
        document.querySelector('input.txtResposta').disabled = true
    }
}

function perguntaExcluirFoto() {
    let pergunta = confirm('Deseja mesmo excluir a sua foto de perfil?')
    if(pergunta) document.querySelector("a.link-exclui-foto").href = 'excluirImagem.php'
}

window.onload = () => {
    mostraPerguntaSecreta('sem pergunta')
}