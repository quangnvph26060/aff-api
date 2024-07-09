<script setup lang="ts">
import { ref } from "vue";
import { VueUiQuickChart } from "vue-data-ui";
import "vue-data-ui/style.css";

const dataset = ref([
	{
		name: "F1",
		value: 10,
	},
	{
		name: "F2",
		value: 20,
	},
	{
		name: "F3",
		value: 5,
	},
	{
		name: "F4",
		value: 2,
	},
	{
		name: "F5",
		value: 1,
	},
]);

const config = ref({
	backgroundColor: "#a1a1aa",
	barGap: 12,
	barStrokeWidth: 1,
	blurOnHover: true,
	chartIsBarUnderDatasetLength: 6,
	color: "#CCCCCC",
	dataLabelFontSize: 10,
	dataLabelRoundingPercentage: 1,
	dataLabelRoundingValue: 0,
	donutHideLabelUnderPercentage: 3,
	donutLabelMarkerStrokeWidth: 1,
	donutRadiusRatio: 0.4,
	donutShowTotal: true,
	donutStrokeWidth: 2,
	donutThicknessRatio: 0.18,
	donutTotalLabelFontSize: 18,
	donutTotalLabelOffsetY: 0,
	donutTotalLabelText: "Tổng",
	fontFamily: "inherit",
	height: 300,
	legendFontSize: 12,
	legendIcon: "circleFill",
	legendIconSize: 12,
	lineSmooth: true,
	lineStrokeWidth: 2,
	paletteStartIndex: 0,
	showDataLabels: true,
	showLegend: true,
	showTooltip: true,
	showUserOptions: true,
	title: "Thống kê",
	titleBold: true,
	titleFontSize: 12,
	titleTextAlign: "center",
	tooltipCustomFormat: null,
	useCustomLegend: false,
	valuePrefix: "",
	valueSuffix: "",
	width: 512,
	xyAxisStroke: "#4A4A4A",
	xyAxisStrokeWidth: 1,
	xyGridStroke: "#5A5A5A",
	xyGridStrokeWidth: 0.5,
	xyHighlighterColor: "#FFFFFF",
	xyHighlighterOpacity: 0.05,
	xyLabelsXFontSize: 8,
	xyLabelsYFontSize: 12,
	xyPaddingBottom: 48,
	xyPaddingLeft: 48,
	xyPaddingRight: 12,
	xyPaddingTop: 24,
	xyPeriods: [
		"JAN",
		"FEB",
		"MAR",
		"APR",
		"MAY",
		"JUN",
		"JUL",
		"AUG",
		"SEP",
		"OCT",
		"NOV",
		"DEC",
	],
	xyPeriodLabelsRotation: 0,
	xyScaleSegments: 10,
	xyShowAxis: true,
	xyShowGrid: true,
	xyShowScale: true,
	yAxisLabel: "Quantity",
	xAxisLabel: "Time",
	axisLabelsFontSize: 8,
});
</script>

<template>
	<div>
		<!-- biểu đồ  -->
		<!-- <VueUiQuickChart :dataset="dataset" :config="config" /> -->
	</div>
</template>
