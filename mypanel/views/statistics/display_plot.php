<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.Submit_BTN{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Rotate{
-webkit-transform: rotate(-90deg); 
-moz-transform: rotate(-90deg);
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
</style>
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
   
<link class="include" rel="stylesheet" type="text/css" hrf="<?php echo __SCRIPT_PATH;?>css/jquery.jqplot.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>syntaxhighlighter/styles/shCoreDefault.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>syntaxhighlighter/styles/shThemejqPlot.min.css" />
	
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>plugins/jqplot.pointLabels.min.js"></script>
<script class="code" type="text/javascript">
	$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
        var s1 = <?php echo $s1;?>;
        var ticks = <?php echo $ticks;?>;
       
        plot1 = $.jqplot('chart1', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            },
            highlighter: { show: false }
        });
    
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });</script>
    
  <script class="code" type="text/javascript">$(document).ready(function(){
        var s1 = [2, 6, 7, 10];
        var s2 = [7, 5, 3, 2];
        var ticks = ['a', 'b', 'c', 'd'];
        
        plot2 = $.jqplot('chart2', [s1, s2], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            }
        });
    
        $('#chart2').bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
            
        $('#chart2').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2').html('Nothing');
            }
        );
    });</script>
    
  <script class="code" type="text/javascript">$(document).ready(function(){
        plot2b = $.jqplot('chart2b', [[[2,1], [4,2], [6,3], [3,4]], [[5,1], [1,2], [3,3], [4,4]], [[4,1], [7,2], [1,3], [2,4]]], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true, location: 'e', edgeTolerance: -15 },
                shadowAngle: 135,
                rendererOptions: {
                    barDirection: 'horizontal'
                }
            },
            axes: {
                yaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer
                }
            }
        });
    
        $('#chart2b').bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2b').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data+ ', pageX: '+ev.pageX+', pageY: '+ev.pageY);
            }
        );    
        $('#chart2b').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2c').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data+ ', pageX: '+ev.pageX+', pageY: '+ev.pageY);
            }
        );
            
        $('#chart2b').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2b').html('Nothing');
            }
        );
    });</script>
    
  <script class="code" type="text/javascript">$(document).ready(function(){
        var s1 = [2, 6, 7, 10];
        var s2 = [7, 5, 3, 2];
        var s3 = [14, 9, 3, 8];
        plot3 = $.jqplot('chart3', [s1, s2, s3], {
            stackSeries: true,
            captureRightClick: true,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {
                    highlightMouseDown: true    
                },
                pointLabels: {show: true}
            },
            legend: {
                show: true,
                location: 'e',
                placement: 'outside'
            }      
        });
    
        $('#chart3').bind('jqplotDataRightClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info3').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        ); 
    });</script>
    
  <script class="code" type="text/javascript">$(document).ready(function(){
        plot4 = $.jqplot('chart4', [[[2,1], [6,2], [7,3], [10,4]], [[7,1], [5,2],[3,3],[2,4]], [[14,1], [9,2], [9,3], [8,4]]], {
            stackSeries: true,
            captureRightClick: true,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                shadowAngle: 135,
                rendererOptions: {
                    barDirection: 'horizontal',
                    highlightMouseDown: true    
                },
                pointLabels: {show: true, formatString: '%d'}
            },
            legend: {
                show: true,
                location: 'e',
                placement: 'outside'
            },
            axes: {
                yaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer
                }
            }
        });
    });</script>
    
  <script class="code" type="text/javascript">$(document).ready(function(){
        plot5 = $.jqplot('chart5', [[[2,1], [null,2], [7,3], [10,4]]], {
            captureRightClick: true,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                shadowAngle: 135,
                rendererOptions: {
                    barDirection: 'horizontal',
                    highlightMouseDown: true    
                },
                pointLabels: {show: true, formatString: '%d'}
            },
            legend: {
                show: true,
                location: 'e',
                placement: 'outside'
            },
            axes: {
                yaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer
                }
            }
        });
    });</script>

  <script class="code" type="text/javascript">$(document).ready(function(){
        plot6 = $.jqplot('chart6', [[1,2,3,4]], {seriesDefaults:{renderer:$.jqplot.PieRenderer}});
    });</script> 

    <script class="code" type="text/javascript">$(document).ready(function(){
        var s1 = [2, -6, 7, -5];
        var ticks = ['a', 'b', 'c', 'd'];

        plot7 = $.jqplot('chart7', [s1], {
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: { fillToZero: true },
                    pointLabels: { show: true }
            },
            axes: {
                // yaxis: { autoscale: true },
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            }
        });
    });</script> 
<div id="charts">
<div class="charts-title">المجموع الكلي للرسائل المفتوحة <strong><?php echo $MSG_Counter;?></strong></div>
<div id="chart1" style="height:386px" class="charts-text"></div>
<div class="charts-end"></div>
</div>