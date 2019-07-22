/*------------------------------------------------------------------
    File Name: chart_custom_style1.js
    Template Name: Pluto - Responsive HTML5 Template
    Created By: html.design
    Envato Profile: https://themeforest.net/user/htmldotdesign
    Website: https://html.design
    Version: 1.0
-------------------------------------------------------------------*/
		var labels = [];
		var values = [];






		window.onload = function() {


            $.ajax({
                url: 'php/controller/pesquisar/chart.php',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $('#carregamento').css("display","block");
                },
                complete: function(){
                    $('#carregamento').css("display","none");
                },
                success: function (data) {

                    //alert(data);

                    var result = JSON.parse(data);

                    if (result.estado === 'sucesso') {

                        for(i in result.data){

                            labels.push(result.data[i].mes);
                            values.push(result.data[i].valor);

                        }




                        var color = Chart.helpers.color;
                        var barChartData = {
                            labels: labels,
                            datasets: [ {
                                type: 'line',
                                label: 'Compras',
                                backgroundColor: [
                                    'rgba(30, 208, 133, 0.3)',
                                ],
                                borderColor: [
                                    'rgba(30, 208, 133, 1)',
                                ],
                                data: values
                            }]
                        };

                        // Define a plugin to provide data labels
                        Chart.plugins.register({
                            afterDatasetsDraw: function(chart) {
                                var ctx = chart.ctx;

                                chart.data.datasets.forEach(function(dataset, i) {
                                    var meta = chart.getDatasetMeta(i);
                                    if (!meta.hidden) {
                                        meta.data.forEach(function(element, index) {
                                            // Draw the text in black, with the specified font
                                            ctx.fillStyle = 'rgb(0, 0, 0)';

                                            var fontSize = 0;
                                            var fontStyle = 'normal';
                                            var fontFamily = 'Helvetica Neue';
                                            ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                                            // Just naively convert to string for now
                                            var dataString = dataset.data[index].toString();

                                            // Make sure alignment settings are correct
                                            ctx.textAlign = 'center';
                                            ctx.textBaseline = 'middle';

                                            var padding = 5;
                                            var position = element.tooltipPosition();
                                            ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                                        });
                                    }
                                });
                            }
                        });


                        var ctx = document.getElementById('canvas').getContext('2d');
                        window.myBar = new Chart(ctx, {
                            type: 'bar',
                            data: barChartData,
                            options: {
                                responsive: true,
                                title: {
                                    display: false,
                                    text: 'Chart.js Combo Bar Line Chart'
                                },
                            }
                        });


                        document.getElementById('randomizeData').addEventListener('click', function() {
                            barChartData.datasets.forEach(function(dataset) {
                                dataset.data = dataset.data.map(function() {
                                    return randomScalingFactor();
                                });
                            });
                            window.myBar.update();
                        });



                    }

                },
                error: function (e) {
                    //                            $("#err").html(e).fadeIn();
                }
            });




		};


