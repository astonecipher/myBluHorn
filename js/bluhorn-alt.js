
	  function updateSummary() {

	   if ($("#autoCalc").is(":checked")) {

			summarySpots = sumColumnAssocIfNot(data,"week","daypart",null);
			$('#totalSpots').html(summarySpots);
			$('#totalSpend').html("$" + sumColumnAssocIfNotByRowWithMultiplier(data,"week","daypart",null,'rate', 'lineSpendTotal').toFixed(2));
			summaryGRPs = sumColumnAssocIfNotByRowWithMultiplier(data,"week","daypart",null,'aqh', 'lineAQHTotal');
			$('#totalGRPs').html(summaryGRPs.toFixed(1));
			if (summarySpots > 0) {
//				$('#overallCPP').html("$" +(sumColumnAssocIfNotByRowWithMultiplier(data,"week","daypart",null,'cpp', 'lineCPPTotal') / summarySpots + .001).toFixed(2));
				$('#overallCPP').html("$" + (sumColumnAssocIfNotByRowWithMultiplier(data,"week","daypart",null,'rate', 'lineSpendTotal')/summaryGRPs + .001).toFixed(2));
				if (isFinite(sumColumnAssocIfNotByRowWithMultiplier(data,"week","daypart",null,'cpm', 'lineCPMTotal'))) {
					$('#totalCPM').html("$" +(sumColumnAssocIfNotByRowWithMultiplier(data,"week","daypart",null,'cpm', 'lineCPMTotal') / summarySpots + .001).toFixed(2));
				}
				var summaryReach = ((1 - Math.pow( 1 - (summaryGRPs / summarySpots / 100),summarySpots)) * .85 * 100);
				$('#totalReach').html(summaryReach.toFixed(2) + "%");
				$('#totalFreq').html((summaryGRPs / summaryReach).toFixed(2));
			}
		
		   
			updateDaypartSummary();
			//		updateStationSummary();
			updateWorksheetSummary();
			updateStations();
		}
/*
//		$('#dataTable-container').width("100%");

		console.log("container: " + $('#dataTable-container').width());

		$('#dataTable').width($('#dataTable-container').width());

			var dataTable = $('#dataTable').handsontable('getInstance');

			dataTable.updateSettings( { stretchH: 'all' } );
			

			dataTable.render();
*/

		


	  }

	  function updateSummaryOutdoor() {

	   if ($("#autoCalc").is(":checked")) {

			summarySpots = countColumn(data,"insertDate")-1;
			$('#totalLocations').html(summarySpots);
			$('#totalBoards').html(sumColumn(data,"qty"));
			$('#totalProductionCost').html("$" + sumColumn(data,"productionCost").toFixed(2));
			$('#totalBoardCost').html("$" + sumColumn(data,"boardCost").toFixed(2));
			$('#totalCost').html("$" + sumColumn(data,"totalCost").toFixed(2));
			$('#totalNetCost').html("$" + sumColumn(data,"netTotal").toFixed(2));
				
		   
			//updateSummaryByDate();
			updateVendors();
		}
/*
//		$('#dataTable-container').width("100%");

		console.log("container: " + $('#dataTable-container').width());

		$('#dataTable').width($('#dataTable-container').width());

			var dataTable = $('#dataTable').handsontable('getInstance');

			dataTable.updateSettings( { stretchH: 'all' } );
			

			dataTable.render();
*/

		


	  }

	  function updateSummaryPrnt() {

	   if ($("#autoCalc").is(":checked")) {

			summarySpots = countColumn(data,"insertDate")-1;
			$('#totalSpots').html(summarySpots);
			$('#totalGrossSpend').html("$" + sumColumn(data,"grossTotal").toFixed(2));
			$('#totalNetSpend').html("$" + sumColumn(data,"netTotal").toFixed(2));
				
		   
			//updateSummaryByDate();
			updateVendors();
		}
/*
//		$('#dataTable-container').width("100%");

		console.log("container: " + $('#dataTable-container').width());

		$('#dataTable').width($('#dataTable-container').width());

			var dataTable = $('#dataTable').handsontable('getInstance');

			dataTable.updateSettings( { stretchH: 'all' } );
			

			dataTable.render();
*/

		


	  }
	  

	  function sumColumn(array, col) {
	
		var sum = 0;

		$.each(array, function(i,v){
			if (array[i][col] != null || array[i][col] != "") {
				if (!isNaN(parseFloat(array[i][col]))) {
					sum	+= parseFloat(array[i][col]);		
				}
			}
		});
		
		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}		
	  }

	  function countColumn(array, col) {
	
		var count = 0;

		$.each(array, function(i,v){
			if (array[i]["dayPart"] != null || array[i]["dayPart"] != "")  {
//				alert(array[i]["dayPart"]);
				count++;	
			}
		});

		return count;
	  }

	  function sumColumnIf(array, sumColumn, ifCol, ifVal) {
	
		var sum = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] == ifVal) {
				if (parseFloat(array[i][sumColumn]) > 0) {
					sum	+= parseFloat(array[i][sumColumn]);
				}
			}
		});
		
		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function sumColumnsIf(array, sumCols, ifCol, ifVal) {
	
		var sum = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] == ifVal) {
				for (var n=0; n < array[i][sumCols].length; n++) {
					if (parseFloat(array[i][sumCols][n]) > 0) {
						sum	+= parseFloat(array[i][sumCols][n]);	
					}
				}		
			}
		});
		
		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function sumColumnsIfNotNull(array, sumCols, ifCol, ifVal) {
	
		var sum = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] != null || array[i][ifCol] != "") {
				for (var n=0; n < array[i][sumCols].length; n++) {
					if (parseFloat(array[i][sumCols][n]) > 0) {
						sum	+= parseFloat(array[i][sumCols][n]);	
					}
				}		
			}
		});
		
		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function sumColumnsIfNot(array, sumCols, ifCol, ifVal) {
	
		var sum = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] != ifVal) {
//				console.log("Array[" + i + "] Length: " + array[i]['week'].length);
//				console.log("Array[" + i + "][0]: " + array[i][sumCols]['1']);
				for (var n=0; n < array[i][sumCols].length; n++) {
					if (array[i][sumCols][n] != null || array[i][sumCols][n] != "") {
						if (parseFloat(array[i][sumCols][n])) {
							sum	+= parseFloat(array[i][sumCols][n]);
						}
					}
//					console.log("Iterating: " + i + " - " + n);
				}		
			}
		});
		
		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function sumColumnAssocIfNot(array, sumCols, ifCol, ifVal) {
	
		var sum = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] != ifVal) {
				for (var key in array[i][sumCols]) {
					if (array[i][sumCols][key] != null || array[i][sumCols][key] != "") {
						if (parseFloat(array[i][sumCols][key])) {
							sum	+= parseFloat(array[i][sumCols][key]);
						}
					}
				}		
			}
		});
		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function sumColumnAssocIf(array, sumCols, ifCol, ifVal) {
	
		var sum = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] == ifVal) {
				for (var key in array[i][sumCols]) {
					if (array[i][sumCols][key] != null || array[i][sumCols][key] != "") {
						if (parseFloat(array[i][sumCols][key])) {
							sum	+= parseFloat(array[i][sumCols][key]);
						}
					}
				}		
			}
		});
		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }


	  function sumSingleColumnAssocIfNot(array, sumCol, sumKey, ifCol, ifVal) {
	
		var sum = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] != ifVal) {
				if (array[i][sumCol][sumKey] != null || array[i][sumCol][sumKey] != "") {
					if (parseFloat(array[i][sumCol][sumKey])) {
						sum	+= parseFloat(array[i][sumCol][sumKey]);
					}
				}
			}
		});
		if (sum > 0) {
			return sum;
		}
		
		else {
			return 0;
		}
	  }

	  function sumColumnAssocIfNotByRowWithMultiplier(array, sumCols, ifCol, ifVal, multiplierCol, rowTotal) {
	
		var sum = 0;
		var rowSum = 0;
		var multiplier = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] != ifVal) {
				if (array[i][multiplierCol] != null || array[i][multiplierCol] != "" || array[i][multiplierCol] > 0) {
					if (parseFloat(array[i][multiplierCol])>0) {
						multiplier = parseFloat(array[i][multiplierCol]); // chng
					}
					else {
						multiplier = 0;
					}
				}
				else {
					multiplier = 0;
				}

				rowSum=0;

				for (var key in array[i][sumCols]) {
					if (array[i][sumCols][key] != null || array[i][sumCols][key] != "") {
						if (parseFloat(array[i][sumCols][key])>0) {
							rowSum	+= parseFloat(array[i][sumCols][key]);
						}
					}
				}	
				
				if (isNaN(multiplier)) {
					multiplier = 0;
				}
								
				sum += rowSum * multiplier;	

				if (rowTotal != null) {
					array[i][rowTotal] = parseFloat(rowSum * multiplier); //chng
				}
			}
		});
		
		if (sum > 0) {		
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function sumColumnAssocIfByRowWithMultiplier(array, sumCols, ifCol, ifVal, multiplierCol, rowTotal) {
	
		var sum = 0;
		var rowSum = 0;
		var multiplier = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] == ifVal) {
				if (array[i][multiplierCol] != null || array[i][mulitplierCol] != "" || array[i][multiplierCol] > 0) {
					multiplier = parseFloat(array[i][multiplierCol]); //chng
				}
				else {
					multiplier = 0;
				}

				rowSum=0;

				for (var key in array[i][sumCols]) {
					if (array[i][sumCols][key] != null || array[i][sumCols][key] != "") {
						if (!isNaN(parseFloat(array[i][sumCols][key]))) {
							rowSum	+= parseFloat(array[i][sumCols][key]);
						}
					}
				}	

				
				if (isNaN(multiplier)) {
					multiplier = 0;
				}
								
				sum += rowSum * multiplier;	

				if (rowTotal != null) {
					array[i][rowTotal] = parseFloat(rowSum * multiplier); //chng
				}
			}
		});
		

		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function sumSingleColumnAssocIfNotWithMultiplier(array, sumCol, sumKey, ifCol, ifVal, multiplierCol, rowTotal) {
	
		var sum = 0;
		var rowSum = 0;
		var multiplier = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] != ifVal) {
				if (array[i][multiplierCol] != null || array[i][multiplierCol] != "") {
					multiplier = parseFloat(array[i][multiplierCol]); //change
				}
				else {
					multiplier = 0;
				}

				rowSum=0;

				if (array[i][sumCol][sumKey] != null || array[i][sumCol][sumKey] != "") {
					rowSum	+= parseFloat(array[i][sumCol][sumKey]);
				}
				
				if (isNaN(multiplier)) {
					multiplier = 0;
				}
				
				sum += rowSum * multiplier;	

				if (rowTotal != null) {
					array[i][rowTotal] = parseFloat(rowSum * multiplier); //chng
				}
			}
		});
		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function sumSingleColumnAssocIfWithMultiplier(array, sumCol, sumKey, ifCol, ifVal, multiplierCol, rowTotal) {
	
		var sum = 0;
		var rowSum = 0;
		var multiplier = 0;

		$.each(array, function(i,v){
			if (array[i][ifCol] == ifVal) {
				if (array[i][multiplierCol] != null || array[i][multiplerCol] != "") {
					multiplier = parseFloat(array[i][multiplierCol]); //chng
				}
				else {
					multiplier = 0;
				}

				rowSum=0;

				if (array[i][sumCol][sumKey] != null || array[i][sumCol][sumKey] != "") {
					rowSum	+= parseFloat(array[i][sumCol][sumKey]);
				}
				
				if (isNaN(multiplier)) {
					multiplier = 0;
				}

				sum += rowSum * multiplier;	

				if (rowTotal != null) {
					array[i][rowTotal] = parseFloat(rowSum * multiplier); //chng
				}
			}
		});

		if (sum > 0) {
			return sum;
		}
		else {
			return 0;
		}
	  }

	  function nielsen_time_format(val) {

		val = val.toUpperCase();
		val = val.replace(/\s+/g,"");


		if (/^[0-9][A|P|Z]-[0-9][A|P|Z]/.test(val)) {
			val = val.replace(/([0-9])([A|P|Z])-([0-9])([A|P|Z])/,"0"+"$1"+"00"+"$2"+"-0"+"$3"+"00"+"$4");
		}
		else if (/^[0-9][0-9][A|P|Z]-[0-9][A|P|Z]/.test(val)) {
			val = val.replace(/([0-9][0-9])([A|P|Z])-([0-9])([A|P|Z])/,"$1"+"00"+"$2"+"-0"+"$3"+"00"+"$4");
		}
		else if (/^[0-9][0-9][A|P|Z]-[0-9][0-9][A|P|Z]/.test(val)) {
			val = val.replace(/([0-9][0-9])([A|P|Z])-([0-9][0-9])([A|P|Z])/,"$1"+"00"+"$2"+"-"+"$3"+"00"+"$4");
		}
		else if (/^[0-9][A|P|Z]-[0-9][0-9][A|P|Z]/.test(val)) {
			val = val.replace(/([0-9])([A|P|Z])-([0-9][0-9])([A|P|Z])/,"0"+"$1"+"00"+"$2"+"-"+"$3"+"00"+"$4");
		}		
		else if (/^[0-9][A|P|Z]-[0-9][0-9][0-9][0-9][A|P|Z]/.test(val)) {
			val = val.replace(/([0-9])([A|P|Z])-([0-9][0-9][0-9][0-9])([A|P|Z])/,"0"+"$1"+"00"+"$2"+"-"+"$3"+"$4");
		}
		else if (/^[0-9]{4}[A|P|Z]-[0-9][A|P|Z]/.test(val)) {
			val = val.replace(/([0-9][0-9][0-9][0-9])([A|P|Z])-([0-9])([A|P|Z])/,"$1"+"$2"+"-"+"0"+"$3"+"00"+"$4");
		}
		else if (/^[0-9][0-9][0-9][0-9][A|P|Z]-[0-9][0-9][0-9][0-9][A|P|Z]/.test(val)) {
			// do nothing
		}
		else {
		//	val="";
		}
	
		return val;
	  }

	  function summarySwitch() {
	
		if ($('#summary-switch-daypart').is(':checked')) {
			updateDaypartSummary();
			$('.daypart-summary-widget').show();
		} 
		else {
			$('.daypart-summary-widget').hide();			
		}		
		if ($('#summary-switch-station').is(':checked')) {
			updateStationSummary();
			$('.station-summary-widget').show();
		}
		else {
			$('.station-summary-widget').hide();			
		}
		if ($('#summary-switch-full').is(':checked')) {
			$('.daypart-summary-widget').show();
			$('.station-summary-widget').show();
			$('.summary-full').show();
		}
		else {
			$('.summary-full').hide();			
		}
	  }

	  function updateWorksheetSummary() {


			for (var week in weeks) {

				summary[0]["week"+week]=sumSingleColumnAssocIfNot(data,"week",week,"daypart",null);
				summary[1]["week"+week]=sumSingleColumnAssocIfNotWithMultiplier(data,"week",week,"daypart",null,'rate', null).toFixed(2);
				summary[2]["week"+week]=sumSingleColumnAssocIfNotWithMultiplier(data,"week",week,"daypart",null,'aqh', null).toFixed(1);
				if (summary[0]["week"+week]>0) {
//					summary[3]["week"+week]=((sumSingleColumnAssocIfNotWithMultiplier(data,"week",week,"daypart",null,'cpp', null) / summary[0]["week"+week] )+.001).toFixed(2);
					summary[3]["week"+week]=((sumSingleColumnAssocIfNotWithMultiplier(data,"week",week,"daypart",null,'rate', null) / summary[2]["week"+week] )+.001).toFixed(2);
					if (isFinite(sumSingleColumnAssocIfNotWithMultiplier(data,"week",week,"daypart",null,'cpm', null) / summary[0]["week"+week])) {
						summary[4]["week"+week]=((sumSingleColumnAssocIfNotWithMultiplier(data,"week",week,"daypart",null,'cpm', null) / summary[0]["week"+week] )+.001).toFixed(2);
					}
				}
				if (summary[2]["week"+week] / summary[0]["week"+week] > 0) {
//					summary[5]["week"+week]=(summary[2]["week"+week] / summary[0]["week"+week]).toFixed(2) + "%";
					summary[5]["week"+week]= ((1 - Math.pow( 1 - (summary[2]["week"+week] / summary[0]["week"+week] / 100),summary[0]["week"+week])) * .85 * 100).toFixed(2) + "%";
					summary[6]["week"+week]=(summary[2]["week"+week] / parseFloat(summary[5]["week"+week])).toFixed(2);
				}
				else {
					summary[5]["week"+week] = 0;
					summary[6]["week"+week] = 0;
				}
			}
			
			updateMonthSummary();

			var summaryTable = $('#summaryTable').handsontable('getInstance');

			summaryTable.render();

	  }
	  
	  function updateMonthSummary() {			
	    
//	    console.log(months);
	    
		  for (var month in months) {

		  	  summary[0]["month"+months[month]["month"]] = 0;
			  summary[1]["month"+months[month]["month"]] = 0;
			  summary[2]["month"+months[month]["month"]] = 0;
	
			  for (var week in months[month]["weeks"]) {
				  	  summary[0]["month"+months[month]["month"]] += summary[0]["week"+week];
				  	  if (parseFloat(summary[1]["month"+months[month]["month"]]) + parseFloat(summary[1]["week"+week]) > 0) {
					  	  summary[1]["month"+months[month]["month"]] = (parseFloat(summary[1]["month"+months[month]["month"]]) + parseFloat(summary[1]["week"+week])).toFixed(2);
					  }
					  if (parseFloat(summary[2]["month"+months[month]["month"]]) + parseFloat(summary[2]["week"+week]) > 0) {
					  	  summary[2]["month"+months[month]["month"]] = (parseFloat(summary[2]["month"+months[month]["month"]]) + parseFloat(summary[2]["week"+week])).toFixed(1);
					  }

			  }

		  }

		  for (var month in months) {

			  summary[3]["month"+months[month]["month"]] = 0;
			  summary[4]["month"+months[month]["month"]] = 0;
	
			  for (var week in months[month]["weeks"]) {

				  	  var factor = parseFloat(summary[0]["week"+week]) / parseFloat(summary[0]["month"+months[month]["month"]]);
				  	  if (factor>0) {
					  	  summary[3]["month"+months[month]["month"]] = ((parseFloat(summary[3]["month"+months[month]["month"]]) + parseFloat(summary[3]["week"+week])*factor)).toFixed(2);
					  	  summary[4]["month"+months[month]["month"]] = ((parseFloat(summary[4]["month"+months[month]["month"]]) + parseFloat(summary[4]["week"+week])*factor)-.001).toFixed(2);
					  }

			  }
			  if (summary[2]["month"+months[month]["month"]] / summary[0]["month"+months[month]["month"]] > 0 ) {
				  summary[3]["month"+months[month]["month"]]= (summary[1]["month"+months[month]["month"]] / summary[2]["month"+months[month]["month"]]).toFixed(2);

//	  			  summary[5]["month"+months[month]["month"]]=(summary[2]["month"+months[month]["month"]] / summary[0]["month"+months[month]["month"]]).toFixed(2) + "%";
				  summary[5]["month"+months[month]["month"]]= ((1 - Math.pow( 1 - (summary[2]["month"+months[month]["month"]] / summary[0]["month"+months[month]["month"]] / 100),summary[0]["month"+months[month]["month"]])) * .85 * 100).toFixed(2) + "%";
				  summary[6]["month"+months[month]["month"]]=(summary[2]["month"+months[month]["month"]] / parseFloat(summary[5]["month"+months[month]["month"]])).toFixed(2);
	  		  }
	  		  else {
		  		  summary[5]["month"+months[month]["month"]] = 0;
		  		  summary[6]["month"+months[month]["month"]] = 0;
	  		  }
		  }
	  }
	  
	  function updateStations() {
	  
	  	  var content = "";
	  	  var stationArray = [];
	  	  var stationName = "";
	  	  
	  	  $("#station-summary-widget").html(null);
		  
		  stations = getValuesFromColumnAssoc(data,"station",true);
		  
		  for (var station in stations) {
			  

			  stationName = stations[station];
			  stationName = stationName.replace(/[^a-zA-Z0-9]+|\s+/gmi, " ");
			  stationName = stationName.replace(/\s/gmi, "-");
			  		
			  console.log(stationName);	  
/*
			  $.get("https://bluhorn.filelogix.com/campaigns/template/summary/station/"+stations[station], 
			  		function(data,status){
			  				if ($("#summary-station-"+stations[station]).length>0) {
					  			$("#summary-station-"+stations[station]).html(data);	
			  				}
			  				else {
				  				$("#station-summary-widget").append(data);
			  				}
			  				
			  				updateStationSummary();
				  	});
*/
//			  console.log("Updating " + stationName + " - " + $.inArray(stationName, stationArray));

				if ($.inArray(stationName, stationArray) < 0) {
					
					stationArray.push(stationName);
//					console.log(stationArray);
					if ($("#summary-station-"+stationName).length>0) {
			  			$("#summary-station-"+stationName).html(getStationHTML(stationName, stations[station]));	
	  				}
	  				else {
		  				$("#station-summary-widget").append(getStationHTML(stationName, stations[station]));
	  				}
	  				
	  				updateStationSummary();
	  			}	

		  }
		  		 		  
	
	  }

	  function updateStationSummary() {

		if ($('#summary-switch-station').is(':checked') || $('#summary-switch-full').is(':checked')) {
	  
		  for (var station in stations) {

//			console.log(stations[station]);

		 	stationName = stations[station];
			stationName = stationName.replace(/[^a-z0-9]+|\s+/gmi, " ");
			 stationName = stationName.replace(/\s/gmi, "-");

			var totalSpend = sumTotalSpendByStation(stations[station]);
			var totalSpots = sumTotalSpotsByStation(stations[station]);
			var totalGRPs = sumTotalGRPsByStation(stations[station]);
			var overallCPP = 0;
			var totalCPM = 0;
			var percentOfTotalGRP = 0.0;

			if (summaryGRPs > 0) {
				var percentOfTotalGRP = (totalGRPs / summaryGRPs) * 100;
			}

			if (totalSpots > 0) {
				$('#station-totalSpots-'+stationName).html(totalSpots.toFixed(0));
				$('#summary-station-'+stationName).show();
//				overallCPP = sumTotalCPPByStation(stations[station]) / totalSpots;
				overallCPP = totalSpend / totalGRPs;
				
				totalCPM = sumTotalCPMByStation(stations[station]) / totalSpots;			}
			else {
				$('#station-totalSpots-'+stationName).html(totalSpots.toFixed(0));
				$('#summary-station-'+stationName).hide();
			}

			if (totalSpend > 0) {
				$('#station-totalSpend-'+stationName).html("$" + totalSpend.toFixed(2));
			}
			else {
				$('#station-totalSpend-'+stationName).html("$" + totalSpend.toFixed(2));
			}

			if (totalGRPs > 0) {
				$('#station-totalGRPs-'+stationName).html(totalGRPs.toFixed(1));
				$('#station-percentOfTotalGRP-'+stationName).html(percentOfTotalGRP.toFixed(1) + '%');

				var totalReach = ((1 - Math.pow( 1 - (totalGRPs / totalSpots / 100),totalSpots)) * .85 * 100);
				$('#station-reach-'+stationName).html(totalReach.toFixed(2) + "%");
				$('#station-freq-'+stationName).html((totalGRPs / totalReach).toFixed(2));
			}
			else {
				$('#station-totalGRPs-'+stationName).html(totalGRPs.toFixed(1));
				$('#station-percentOfTotalGRP-'+stationName).html(percentOfTotalGRP.toFixed(1) + '%');
			}
			if (overallCPP > 0) {
				$('#station-overallCPP-'+stationName).html("$" + overallCPP.toFixed(2));
			}
			else {
				$('#station-overallCPP-'+stationName).html("$" + overallCPP.toFixed(2));
			}

			if (isFinite(totalCPM)) {
				$('#station-totalCPM-'+stationName).html("$" + totalCPM.toFixed(2));
			}
			else {
				$('#station-totalCPM-'+stationName).html("$" + totalCPM.toFixed(2));
			}	
		  }
	    }
	  }

	  function updateVendors() {
	  
	  	  var content = "";
	  	  var vendorArray = [];
	  	  var vendorName = "";
	  	  
	  	  $("#vendor-summary-widget").html(null);
		  
		  vendors = getValuesFromColumnAssoc(data,"vendorID",true);
		  
		  for (var vendor in vendors) {
			  

			  vendorName = vendors[vendor];			  

//			  console.log("Updating " + stationName + " - " + $.inArray(stationName, stationArray));

				if ($.inArray(vendorName, vendorArray) < 0) {
					
					vendorArray.push(vendorName);
//					console.log(stationArray);
					if ($("#summary-vendor-"+vendorName).length>0) {
			  			$("#summary-vendor-"+vendorName).html(getStationHTML(vendorName));	
	  				}
	  				else {
		  				$("#vendor-summary-widget").append(getStationHTML(vendorName));
	  				}
	  				
	  				updateVendorSummary();
	  			}	

		  }
		  		 		  
	
	  }

	  function updateVendorSummary() {

		if ($('#summary-switch-vendor').is(':checked') || $('#summary-switch-full').is(':checked')) {
	  
		  for (var vendor in vendors) {

//			console.log(stations[station]);

			var totalGrossSpend = sumTotalGrossSpendByVendor(vendors[vendor]);
			var totalSpots = sumTotalSpotsByVendor(vendors[vendor]);
			var totalNetSpend = sumTotalNetSpendByStation(vendors[vendor]);
			var percentOfTotalSpend = 0.0;

			if (summaryGrossSpend > 0) {
				var percentOfTotalSpend= (totalGrossSpend / summaryGrossSpend) * 100;
			}

			if (totalSpots > 0) {
				$('#vendor-totalSpots-'+vendors[vendor]).html(totalSpots.toFixed(0));
				$('#summary-vendor-'+vendors[vendor]).show();
			}
			else {
				$('#vendor-totalSpots-'+vendors[vendor]).html(totalSpots.toFixed(0));
				$('#summary-vendor-'+vendors[vendor]).hide();
			}

			if (totalGrossSpend > 0) {
				$('#vendor-totalGrossSpend-'+vendors[vendor]).html("$" + totalGrossSpend.toFixed(2));
			}
			else {
				$('#vendor-totalGrossSpend-'+vendors[vendor]).html("$" + totalGrossSpend.toFixed(2));
			}

			if (totalNetSpend > 0) {
				$('#vendor-totalNetSpend-'+vendors[vendor]).html("$" + totalNetSpend.toFixed(2));
			}
			else {
				$('#vendor-totalNetSpend-'+vendors[vendor]).html("$" + totalNetSpend.toFixed(2));
			}
	
		  }
	    }
	  }	  

	  function sumTotalGrossSpendByVendor(vendor) {

		return sumColumnIf(data, "grossTotal", "vendorID", vendor);

	  }	

	  function sumTotalNetSpendByVendor(vendor) {

		return sumColumnIf(data, "netTotal", "vendorID", vendor);

	  }	

	  function sumTotalSpendByDaypart(daypart) {

		return sumColumnIf(data, "lineSpendTotal", "daypart", daypart);

	  }	

	  function sumTotalSpotsByDaypart(daypart) {

		return sumColumnAssocIf(data,"week","daypart",daypart);

	  }

	  function sumTotalSpotsByVendor(vendor) {

		return sumColumnAssocIf(data,"insertDate","vendorID",vendor);

	  }

	  function sumTotalGRPsByDaypart(daypart) {
		return sumColumnAssocIfByRowWithMultiplier(data,"week","daypart",daypart,'aqh', null);

	  }

	  function sumTotalCPPByDaypart(daypart) {

		return sumColumnAssocIfByRowWithMultiplier(data,"week","daypart",daypart,'cpp', null);

	  }

	  function sumTotalCPMByDaypart(daypart) {

		return sumColumnAssocIfByRowWithMultiplier(data,"week","daypart",daypart,'cpm', null);

	  }
	  

	  function sumTotalSpendByStation(station) {

		return sumColumnIf(data, "lineSpendTotal", "station", station);

	  }	

	  function sumTotalSpotsByStation(station) {

		return sumColumnAssocIf(data,"week","station",station);

	  }

	  function sumTotalGRPsByStation(station) {
		return sumColumnAssocIfByRowWithMultiplier(data,"week","station",station,'aqh', null);

	  }

	  function sumTotalCPPByStation(station) {

		return sumColumnAssocIfByRowWithMultiplier(data,"week","station",station,'cpp', null);

	  }

	  function sumTotalCPMByStation(station) {

		return sumColumnAssocIfByRowWithMultiplier(data,"week","station",station,'cpm', null);

	  }	  
	  
	  
	  function getValuesFromColumnAssoc(array, col, distinct) {
		  
		var results = [];

		$.each(array, function(i,v){
			if (array[i][col] != null) {
				if (distinct) {
					if (results.indexOf(array[i][col]) < 0) {
						results.push(array[i][col])	;
					}
					else {
					}
				}
				else {
					results.push(array[i][col])	;
				}
			}
		});
		

		return results;
		  
	  }
	  
	  function getStationHTML(station, stationName) {
		  
//		 return stationHTML.replace("{$station}", station);

	  var stationHTML = '<div class="summary-station" id="summary-station-' + station + '">\
			<center><h5 id="summary-station-title-' + station + '"></h5>' + stationName + '</center>\
			<table style="border: 0px; margin: 0 auto; ">\
				<tr><td style="width: 60%;"><strong>Total Spots: </strong></td><td style="text-align: right;"><div id="station-totalSpots-' + station + '">0</div></td></tr>\
				<tr><td style="width: 60%;"><strong>Total $$: </strong></td><td style="width: 50%; text-align: right;"><div id="station-totalSpend-' + station + '">$0.00</div></td></tr>\
				<tr><td style="width: 60%;"><strong>Total GRPs: </strong></td><td style="text-align: right;"><div id="station-totalGRPs-' + station + '">0.0</div></td></tr>\
				<tr><td style="width: 60%;"><strong>CPP: </strong></td><td style="text-align: right;"><div id="station-overallCPP-' + station + '">$0.00</div></td></tr>\
				<tr><td style="width: 60%;"><strong>CPM: </strong></td><td style="text-align: right;"><div id="station-totalCPM-' + station + '">$0.00</div></td></tr>\
				<tr><td style="width: 60%;"><strong>% of GRP: </strong></td><td style="text-align: right;"><div id="station-percentOfTotalGRP-' + station + '">0.0</div></td></tr>\
				<tr><td style="width: 60%;"><strong>Reach: </strong></td><td style="text-align: right;"><div id="station-reach-' + station + '">0.00%</div></td></tr>\
				<tr><td style="width: 60%;"><strong>Freq: </strong></td><td style="text-align: right;"><div id="station-freq-' + station + '">0.00</div></td></tr>\
			</table>\
		</div>';
		
		 return stationHTML;
	
	  }
	  

