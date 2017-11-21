var width = $(window).width() * 0.33;
var height = width;
var radius = width / 2 - 10;
var innerRadius = radius * 0.6;

var ajaxResponse = "";
var focus = false;
var pendingRequest = false;
var currentRequest = "";

$("document").ready(function() {
	setupVariableCSS("loader");
	
	//Initialrequest to get data
	pendingRequest = true;
	$.getJSON("php/moduleGroups.php", function(data) {
		ajaxResponse = data;
		
		//Create donut
		buildcake();
		if ($(window).width() < 1100) {
			setupVariableCSS("donut");
			setupVariableCSS("description");
		}
		var storedColor = "";
		
		if (width < 300) {
			$(".tooltip h3").css("font-size", "14px");
			$(".tooltip p").css("font-size", "12px");
			$("text").attr("font-size", "18px");
		}
		
		//Dataless mouseevents for segments
		$("path").mouseenter(function() {
			$(this).attr("stroke-width", "4px")
				.attr("stroke", "#44F");
			$(this).siblings().show();
		}).mouseleave(function() {
			$(this).attr("stroke-width", "1px")
				.attr("stroke", "#444");
			if (!$(this).is(":focus")) {
				$(this).siblings().hide();
			};
		}).focus(function() {
			$(this).css({fill: "#009"});
			$(this).siblings().css({fill: "#AAF"});
			storedColor = $(this).attr("fill");
			focus = true;
		}).blur(function() {
			$(this).css({fill: storedColor})
			$(this).siblings().hide()
				.css({fill: "#000"});
			focus = false;
			updateToolTip();
		});
	}).done(function() {
		pendingRequest = false;
		$("#donutgif").hide();
	}).fail(function() {
		pendingRequest = false;
		alert("Failed to complete Ajax request")
	});
});

function setupVariableCSS(element) {
	if (element == "loader") {
		$("#donutgif").css("margin-left", width / 2 - 16)
			.css("margin-top", height / 2 - 16);
		$("#donutgif").show();
		$("#descriptiongif").css("margin-left", $(".description").width() / 2 - 16)
			.css("margin-top", height / 2 - 16);
		$(".tooltip").css("top", height * 0.5)
			.css("left", width * 0.25)
			.css("width", width * 0.5);
		$("#alertPopup").css("left", -$("#descriptiongif").position().left - 59)
			.css("top", -$("#descriptiongif").position().top + 40);
	} else if (element == "donut") {
		var donutLeft = $(window).width() / 2 - $(".donut").width() / 2;
		$(".donut").css("left", "+=" + donutLeft);
		$(".tooltip").css("left", "+=" + donutLeft);
	} else if (element == "description") {
		$(".description").css("margin-left", $(window).width() / 2 - $(".description").width() / 2);
	};
};

function buildcake() {
	var colorScale = d3.scale.category10();
	var arc = d3.svg.arc().outerRadius(radius).innerRadius(innerRadius);
	var layout = d3.layout.pie().value(function(d) { return (d.maxECTS + d.minECTS) / 2; }).sort(null);

	var svg = d3.select(".donut")
		.append("svg")
		.attr("width", width)
		.attr("height", height);
		
	var pie = svg.append("g")
		.attr("transform", "translate(" + width / 2 + ", " + height / 2 + ")")
		.selectAll("g")
		.data(layout(ajaxResponse.groups))
		.enter()
			.append("g")
			.attr("class", "segment")
				.append("path")
				.attr("d", arc)
				.attr("stroke", "#444")
				.attr("stroke-width", "1px")
				.attr("fill", function(d) { return d3.rgb(colorScale(d.value)).brighter(1.25); })
				.on("mouseenter", function(d) { if (!focus) updateToolTip(d.data); })
				.on("mouseleave", function() { if (!focus) updateToolTip(); })
				.on("click", function(d) { if (!pendingRequest) {
						getDetailedDescription(d.data); 
						updateToolTip(d.data);
					} else {
						alertPopup(d.data);
					}; 
				});

	//Add text
	var fontSize = 30;
	
	d3.selectAll(".segment")
		.append("text")
		.attr("transform", function(d) { 
			arc.innerRadius(innerRadius - fontSize * 0.6);
			return "translate(" + arc.centroid(d) + ")rotate(" + angle(d) + ")"; })
		.attr("text-anchor", "middle")
		.attr("display", "none")
		.attr("font-size", fontSize)
		.attr("pointer-events", "none")
		.text(function(d) { return d.data.id; });
};

function angle(d) {
	var a = ((d.startAngle + d.endAngle) / 2) * (360 / (Math.PI * 2));
	return a;
};

//Tooltip inside donut
function updateToolTip(moduleGroup) {
	if (moduleGroup != undefined) {
		var text = " ECTS-Punkte]";
		var ects = "";
		
		$("#tipTitel").html("<b>" + moduleGroup.id + "</b>");
		$("#tipUntertitel").text(moduleGroup.name);
		
		if (moduleGroup.minECTS < moduleGroup.maxECTS) {
			ects += "[" + moduleGroup.minECTS + " - " + moduleGroup.maxECTS;
		} else {
			ects += "[" + moduleGroup.maxECTS;
		}
		$("#tipText").text(ects + text);
	} else {
		$("#tipTitel").html("");
		$("#tipUntertitel").text("");
		$("#tipText").text("");
	}
};

//Request with parameter to build table
function getDetailedDescription(moduleGroup) {
	if ($(".description h2").text().indexOf(moduleGroup.id) === 0) {
		return;
	};
	
	$("#descriptiongif").show();
	
	pendingRequest = true;
	currentRequest = moduleGroup;
	$.getJSON("php/moduleGroups.php?module_details=" + moduleGroup.id , function(data) {
		var text = " ECTS-Punkte]";
		var ects = "";
		var tableID = "";
		
		$("#untertitel").html("<b>" + data.details.id + "</b> ");
		$("#untertitel").append(data.details.name);
		
		if (data.details.minECTS < data.details.maxECTS) {
			ects += "[" + data.details.minECTS + " - " + data.details.maxECTS;
		} else {
			ects += "[" + data.details.maxECTS;
		}
		$("#untertitel").append("<span id='untertitelSpan'>" + ects + text + "</span>");
		$("#descriptionText").text(data.details.description);
		
		if ($.grep(data.details.courses, function(course) { return course.mandatory }).length > 0) {
			$("#pflichtDiv").html("<h3 class='tableTitle'>Pflichtmodule</h3><table id='pflichtTable'><tr><th>Kürzel</th><th>Bezeichnung</th><th>Semester</th><th>ECTS</th></tr></table>");
			$("pflichtTable").css("border-collapse", "collapse");
		} else {
			$("#pflichtDiv").html("");
		};
		
		if ($.grep(data.details.courses, function(course) { return !course.mandatory }).length > 0) {
			$("#wahlDiv").html("<h3 class='tableTitle'>Wahlmodule</h3><table id='wahlTable'><tr><th>Kürzel</th><th>Bezeichnung</th><th>Semester</th><th>ECTS</th></tr></table>");
		} else {
			$("#wahlDiv").html("");
		};
		
		$.each(data.details.courses, function(index, value) {
			if (value.mandatory) {
				tableID = "#pflichtTable";
			} else {
				tableID = "#wahlTable";
			}
			$(tableID).append("<tr><td>" + value.short_name + "</td><td>" + value.full_name + "</td><td>" + value.semester + "</td><td>" + value.ects + "</td></tr>");
		});
		
		$(".modulTabelle table td:nth-child(2)").css("width", $(".description").width() * 0.6);
		$(".modulTabelle table td:nth-child(1)").css("width", $(".description").width() * 0.15);
		$("table").css("border-collapse", "collapse");
	}).done(function() {
		pendingRequest = false;
		currentRequest = "";
		$("#descriptiongif").hide();
	}).fail(function() {
		pendingRequest = false;
		currentRequest = "";
		alert("Failed to complete Ajax request")
	});
};

function alertPopup(course) {
	var alertText = "";
	
	if (currentRequest.id === course.id) {
		alertText = course.id + " already requested, please wait a moment";
	} else {
		alertText = "waiting for " + currentRequest.id + " request to finish";
	}
	
	$("#alertPopup").text(alertText)
		.css("opacity", "1")
		.show()
		.stop()
		.animate({opacity:0}, 3000);
};