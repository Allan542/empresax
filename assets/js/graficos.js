function graficoBandas(dadosBandas, nomeBandas) {
    bar = new RGraph.Bar({
        id: 'cvs',
        data: dadosBandas,
        options: {
            
            // Add some X-axis labels - you can use a newline character (\n) to make
            // the label span multiple lines
            colors: ['#00CED1'],
            title: 'Bandas Cadastradas',
            titleSize: 14,
            titleBold: true,
            xaxis: true,
            yaxis: true,
            marginLeft: 0,
            marginRight: 0,
            marginTop: 50,
            tooltips: '%{property:myNames[%{index}]} %{property:xaxisLabels[%{dataset}]} tem %{value} discos.',
            tooltipsCss: {
                fontSize: '10pt',
                backgroundColor: '#f9fac1',
                color: 'black'
            },
            tooltipsEvent: 'mousemove',
            backgroundBarsColor1: 'white',
            backgroundBarsColor2: 'white',
            textFont: 'Georgia',
            shadow: true,
            shadowBlur: 5,
            shadowOffsetY: -3,
            grouping: 'stacked',
            // xaxisLabelsAngle: 45,
            xaxisLabelsOffsety: 2,
            yaxisTitle: 'Número de discos cadastrados',
            yaxisTitleBold: true
        }
    }).draw().responsive([
        {maxWidth:null,width:700,height:350,options: {textSize:12,xaxisLabels: nomeBandas, marginInner: 5}, parentCss: {textAlign: 'center'}},
        {maxWidth:900,width:984,height:400, options: {textSize:12,xaxisLabels: nomeBandas, marginInner: 5}, parentCss: {textAlign: 'center'}}
    ])
}

function graficoUsuarios(dadosIdades, dadosNomes) {
    bar = new RGraph.Bar({
        id: 'cvs',
        data: dadosIdades,
        options: {
            
            // Add some X-axis labels - you can use a newline character (\n) to make
            // the label span multiple lines
            colors: ['#00CED1'],
            title: 'Idade dos usuários cadastrados',
            titleSize: 14,
            titleBold: true,
            xaxis: true,
            yaxis: true,
            marginLeft: 0,
            marginRight: 0,
            marginTop: 50,
            tooltips: '%{property:myNames[%{index}]} %{property:xaxisLabels[%{dataset}]} tem %{value} anos.',
            tooltipsCss: {
                fontSize: '10pt',
                backgroundColor: '#f9fac1',
                color: 'black'
            },
            tooltipsEvent: 'mousemove',
            backgroundBarsColor1: 'white',
            backgroundBarsColor2: 'white',
            textFont: 'Georgia',
            shadow: true,
            shadowBlur: 5,
            shadowOffsetY: -3,
            grouping: 'stacked',
            xaxisLabelsAngle: 45,
            xaxisLabelsOffsety: 2,
            yaxisTitle: 'Idade',
            yaxisTitleBold: true
        }
    }).draw().responsive([
        {maxWidth:null,width:700,height:350,options: {textSize:12,xaxisLabels: dadosNomes, marginInner: 5}, parentCss: {textAlign: 'center'}},
        {maxWidth:900,width:984,height:400, options: {textSize:12,xaxisLabels: dadosNomes, marginInner: 5}, parentCss: {textAlign: 'center'}}
    ])
}