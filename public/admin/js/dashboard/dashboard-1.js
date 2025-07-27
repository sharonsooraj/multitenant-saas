

(function($) {
    /* "use strict" */

 var dzChartlist = function(){

	var screenWidth = $(window).width();
	//let draw = Chart.controllers.line.__super__.draw; //draw shadow

	var NewExperience = function(){
		var options = {
		  series: [
			{
				name: 'Net Profit',
				data: [100,300, 200, 250, 200, 240, 180,230,200, 250, 300],
				/* radius: 30,	 */
			},
		],
			chart: {
			type: 'area',
			height: 40,
			//width: 400,
			toolbar: {
				show: false,
			},
			zoom: {
				enabled: false
			},
			sparkline: {
				enabled: true
			}

		},

		colors:['var(--primary)'],
		dataLabels: {
		  enabled: false,
		},

		legend: {
			show: false,
		},
		stroke: {
		  show: true,
		  width: 2,
		  curve:'straight',
		  colors:['var(--primary)'],
		},

		grid: {
			show:false,
			borderColor: '#eee',
			padding: {
				top: 0,
				right: 0,
				bottom: 0,
				left: -1

			}
		},
		states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
		xaxis: {
			categories: ['Jan', 'feb', 'Mar', 'Apr', 'May', 'June', 'July','August', 'Sept','Oct'],
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false
			},
			labels: {
				show: false,
				style: {
					fontSize: '12px',
				}
			},
			crosshairs: {
				show: false,
				position: 'front',
				stroke: {
					width: 1,
					dashArray: 3
				}
			},
			tooltip: {
				enabled: true,
				formatter: undefined,
				offsetY: 0,
				style: {
					fontSize: '12px',
				}
			}
		},
		yaxis: {
			show: false,
		},
		fill: {
		  opacity: 0.9,
		  colors:'var(--primary)',
		  type: 'gradient',
		  gradient: {
			colorStops:[

				{
				  offset: 0,
				  color: 'var(--primary)',
				  opacity: .5
				},
				{
				  offset: 0.6,
				  color: 'var(--primary)',
				  opacity: .5
				},
				{
				  offset: 100,
				  color: 'white',
				  opacity: 0
				}
			  ],

			}
		},
		tooltip: {
			enabled:false,
			style: {
				fontSize: '12px',
			},
			y: {
				formatter: function(val) {
					return "$" + val + " thousands"
				}
			}
		}
		};

		var chartBar1 = new ApexCharts(document.querySelector("#NewExperience"), options);
		chartBar1.render();

	}
	var AllProject = function(){
		var options = {
			series: [12, 30, 20],
         chart: {
			type: 'donut',
			width: 150,
		},
       plotOptions: {
			pie: {
			  donut: {
				size: '80%',
				labels: {
					show: true,
					name: {
						show: true,
						offsetY: 12,
					},
					value: {
						show: true,
						fontSize: '22px',
						fontFamily:'Arial',
						fontWeight:'500',
						offsetY: -17,
					},
					total: {
						show: true,
						fontSize: '11px',
						fontWeight:'500',
						fontFamily:'Arial',
						label: 'Compete',

						formatter: function (w) {
						  return w.globals.seriesTotals.reduce((a, b) => {
							return a + b
						  }, 0)
						}
					}
				}
			  }
			}
		},
		 legend: {
                show: false,
            },
		 colors: ['#3AC977', 'var(--primary)', 'var(--secondary)'],
			labels: ["Compete", "Pending", "Not Start"],
			dataLabels: {
				enabled: false,
			},
        };
		var chartBar1 = new ApexCharts(document.querySelector("#AllProject"), options);
		chartBar1.render();

	}

	// var options = {
    //     chart: {
    //         type: 'bar',
    //         height: 250
    //     },
    //     series: [{
    //         name: 'Tickets',
    //         data: [5, 12, 7, 8, 4, 15, 10] // Dynamic from backend
    //     }],
    //     xaxis: {
    //         categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
    //     }
    // };
    // var chart = new ApexCharts(document.querySelector("#ticketsChart"), options);
    // chart.render();

	var chartBar = function(){
		var options = {
			  series: [
				{
					name: 'Running',
					data: [50, 90, 90],
					//radius: 12,
				},
				{
				  name: 'Cycling',
				  data: [50, 60, 55]
				},

			],
				chart: {
				type: 'bar',
				height: 120,

				toolbar: {
					show: false,
				},

			},
			plotOptions: {
			  bar: {
				horizontal: false,
				columnWidth: '100%',
				endingShape: "rounded",
				borderRadius: 8,
			  },

			},
			states: {
			  hover: {
				filter: 'none',
			  }
			},
			colors:['#F8B940', '#FFFFFF'],
			dataLabels: {
			  enabled: false,
			  offsetY: -30
			},

			legend: {
				show: false,
				fontSize: '12px',
				labels: {
					colors: '#000000',

					},
				markers: {
				width: 18,
				height: 18,
				strokeWidth: 8,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,
				}
			},
			stroke: {
			  show: true,
			  width:14,
			  curve: 'smooth',
			  lineCap: 'round',
			  colors: ['transparent']
			},
			grid: {
				show: false,
				xaxis: {
					lines: {
						show: false,
					}
				},
				 yaxis: {
						lines: {
							show: false
						}
					},
			},
			xaxis: {
				categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY'],
				labels: {
					show: false,
					style: {
						colors: '#A5AAB4',
						fontSize: '14px',
						fontWeight: '500',
						fontFamily: 'poppins',
						cssClass: 'apexcharts-xaxis-label',
					},
				},
				crosshairs: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
				axisTicks: {
					show: false,
				},
			},
			yaxis: {
				labels: {
				show: false,
					offsetX:-16,
				   style: {
					  colors: '#000000',
					  fontSize: '13px',
					   fontFamily: 'poppins',
					  fontWeight: 100,
					  cssClass: 'apexcharts-xaxis-label',
				  },
			  },
			},
			};

			var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
			chartBar1.render();
	}

	var expensesChart = function(){
		var options = {
			  series: [
				{
					name: 'Running',
					data: [40, 80, 70],
					//radius: 12,
				},
				{
				  name: 'Cycling',
				  data: [60, 30, 70]
				},

			],
				chart: {
				type: 'bar',
				height: 120,

				toolbar: {
					show: false,
				},

			},
			plotOptions: {
			  bar: {
				horizontal: false,
				columnWidth: '100%',
				endingShape: "rounded",
				borderRadius: 8,
			  },

			},
			states: {
			  hover: {
				filter: 'none',
			  }
			},
			colors:['#FFFFFF', '#222B40'],
			dataLabels: {
			  enabled: false,
			  offsetY: -30
			},

			legend: {
				show: false,
				fontSize: '12px',
				labels: {
					colors: '#000000',

					},
				markers: {
				width: 18,
				height: 18,
				strokeWidth: 8,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,
				}
			},
			stroke: {
			  show: true,
			  width:14,
			  curve: 'smooth',
			  lineCap: 'round',
			  colors: ['transparent']
			},
			grid: {
				show: false,
				xaxis: {
					lines: {
						show: false,
					}
				},
				 yaxis: {
						lines: {
							show: false
						}
					},
			},
			xaxis: {
				categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY'],
				labels: {
					show: false,
					style: {
						colors: '#A5AAB4',
						fontSize: '14px',
						fontWeight: '500',
						fontFamily: 'poppins',
						cssClass: 'apexcharts-xaxis-label',
					},
				},
				crosshairs: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
				axisTicks: {
					show: false,
				},
			},
			yaxis: {
				labels: {
				show: false,
					offsetX:-16,
				   style: {
					  colors: '#000000',
					  fontSize: '13px',
					   fontFamily: 'poppins',
					  fontWeight: 100,
					  cssClass: 'apexcharts-xaxis-label',
				  },
			  },
			},
			};

			var chartBar1 = new ApexCharts(document.querySelector("#expensesChart"), options);
			chartBar1.render();
	}
	var redial = function(){
		var options = {
		series: [75],
		chart: {
		type: 'radialBar',
		offsetY: 0,
		height:160,
		sparkline: {
		  enabled: true
		}
	  },
	  plotOptions: {
		radialBar: {
		  startAngle: -180,
		  endAngle: 180,
		  track: {
			background: "#F1EAFF",
			strokeWidth: '100%',
			margin: 3,
		  },

		  hollow: {
			margin: 20,
			size: '60%',
			background: 'transparent',
			image: undefined,
			imageOffsetX: 0,
			imageOffsetY: 0,
			position: 'front',
		  },

		  dataLabels: {
			name: {
			  show: false
			},
			value: {
			  offsetY: 5,
			  fontSize: '24px',
			  color:'#000000',
			  fontWeight:600,
			}
		  }
		}
	  },
	  responsive: [{
		breakpoint: 1600,
		options: {
		 chart: {
			height:150
		  },
		}
	  }

	  ],
	  grid: {
		padding: {
		  top: -10
		}
	  },
	  /* stroke: {
		dashArray: 4,
		colors:'#6EC51E'
	  }, */
	  fill: {
		type: 'gradient',
		colors:'#7A849B',
		gradient: {
			shade: 'black',
			shadeIntensity: 0.15,
			inverseColors: false,
			opacityFrom: 1,
			opacityTo: 1,
			stops: [64, 43, 64, 0.5]
		},
	  },
	  labels: ['Average Results'],
	  };

	  var chart = new ApexCharts(document.querySelector("#redial"), options);
	  chart.render();


  }

  var swiperreview = function() {

	var swiper = new Swiper('.mySwiper', {
		speed: 1500,
		parallax: true,
		slidesPerView: 4,
		spaceBetween: 20,
		autoplay: {
			delay: 1000,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		breakpoints: {

		  300: {
			slidesPerView: 1,
			spaceBetween: 20,
		  },
		  416: {
			slidesPerView: 2,
			spaceBetween: 20,
		  },
		   768: {
			slidesPerView: 2,
			spaceBetween: 20,
		  },
		   1280: {
			slidesPerView: 3,
			spaceBetween: 20,
		  },
		  1788: {
			slidesPerView: 3,
			spaceBetween: 20,
		  },
		},
	});
	$('#container_layout').on('change',function(){
		if($('body').attr('data-container') == "boxed" || "wide-boxed"){
			swiper.params.slidesPerView = 3
		}else{
			swiper.params.slidesPerView = 4
		}
	})
}
















	/* Function ============ */
		return {
			init:function(){
			},


			load:function(){
				NewExperience();
				AllProject();
				overiewChart();
				chartBar();
				expensesChart();
				redial();
				swiperreview();

			},

			resize:function(){
			}
		}

	}();



	jQuery(window).on('load',function(){
		setTimeout(function(){
			dzChartlist.load();
		}, 1000);

	});



})(jQuery);
