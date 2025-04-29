<?php 

  $col_width = 4;

  if(count($list_id_spv) >= 3) {
    $col_width  = 4;
  } elseif(count($list_id_spv) == 2) {
    $col_width  = 6;
  } elseif(count($list_id_spv) == 1) {
    $col_width  = 12;
  }

?>

<div class="row">
  <?php foreach ($list_id_spv as $key => $value) : ?>

    <div class="col-md-<?= $col_width ?>">
      <div id="spv_weekly_<?= $key ?>" style="width: 100%; height: 100%"></div>
    </div>
  <?php endforeach; ?>
</div>

<script>
   var colors = ["#66A5AD", "#F69454", "#912668"]

  <?php foreach ($list_id_spv as $key => $value) : ?>
    var output = <?= json_encode($output[$value]) ?>;
    var chart = new Highcharts.Chart({
      chart: {
        renderTo: 'spv_weekly_<?= $key ?>',
      },
      title: {
        text: ` Supervisor - <strong><?= $user[$value]['full_name'] ?></strong>`
      },

      xAxis: {
        
        categories: <?= $label_list ?>,
        labels: {
          rotation: 30
        }
      },
      yAxis: [{
        labels: {
          format: '{value}',
          style: {
            color: colors[0]
          }
        },
        title: {
          text: 'Total Foreman + Welder',
          style: {
            color: colors[0]
          }
        }
      }, {
        title: {
          text: 'Total Length',
          style: {
            color: colors[1]
          }

        },
        labels: {
          format: '{value}',
          style: {
            color: colors[1]
          }

        },
        opposite: true
      }, {
      title: {
        text: 'Total Manhours',
         style: {
          color: colors[2]
        }

      },
      labels: {
        format: '{value}',
         style: {
          color: colors[2]
        }

      },
      opposite: true
    }],
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
  <?php endforeach; ?>



  function add_zero(params) {
    if (params.toString().split('').length == 1) {

      return '0' + params

    }

    return params
  }
</script>