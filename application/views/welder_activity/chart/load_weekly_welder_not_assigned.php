<div id="welder_not_assigned_weekly" style="width: 100%; height: 100%"></div>

<script>
  var output = <?= $output ?>;
  var colors = ["#66A5AD", "#F69454"]

  var chart = new Highcharts.Chart({
    chart: {
      renderTo: 'welder_not_assigned_weekly',
    },
    title: {
      text: " Welder Not Assignment"
    },

    xAxis: {
      categories: <?= $label_list ?>,
      labels: {
        rotation: 30
      }
    },
  
    plotOptions: {
      series: {
        label: {
          connectorAllowed: true
        },
        dataLabels: {
          enabled: true,
          formatter: function() {
            return this.y > 0 ? this.y : ''
          },
          inside: false,
        },
        pointPadding: 0.1,
        groupPadding: 0.1,
        cursor: 'pointer',
      }
    },

    credits: {
      enabled: false
    },

    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0"><strong>{series.name}</strong>&nbsp;</td>' +
        '<td style="padding:1"> : <b>{point.y}</b></td></tr>',
      footerFormat: '</table>',
      useHTML: true,
      shared: true,
      xDateFormat: '%Y'
    },

    // legend: false,
    colors: colors,
    series: output
  })

  function add_zero(params) {
    if (params.toString().split('').length == 1) {

      return '0' + params

    }

    return params
  }
</script>