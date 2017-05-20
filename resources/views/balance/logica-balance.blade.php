 @section('script-footer')
  <script >
    
    
    

// Create the chart
Highcharts.chart('containerFechas', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Gráfico de ganancias por fechas'
    },
    subtitle: {
        text: 'Clickee en el boton de la esquina superior derecha para exportar este gráfico a distintos formatos'
    },
    yAxis: {
        title: {
            text: 'Ganancias en la fecha'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
    },

    series: [{
        name: 'Fecha / Ganancia',
        colorByPoint: true,
        data: [
        @foreach ($balances['fechas'] as $key => $balancePorEstaFecha)
           {
              name: '{{$key}}',
              y: {{$balancePorEstaFecha}},
            }, 
        @endforeach
        ]
    }],
});

            Highcharts.chart('containerProductos', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Gráfico de productos'
                },
                subtitle: {
                    text: 'Clickee en el boton de la esquina superior derecha para exportar este gráfico a distintos formatos'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y} ',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Ventas',
                    colorByPoint: true,
                    data: [ @foreach ($balances['productos'] as $balancePorEstaFecha)
                              {
                              name: '{{$balancePorEstaFecha['nombre']}}',
                              y: {{$balancePorEstaFecha['sum(precio_total)']}}
                              },
                            @endforeach
                    ]
                }]
            });
      </script>
@endsection