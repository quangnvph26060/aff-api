<script lang="ts" setup>
import { SmileOutlined } from "@ant-design/icons-vue";

const activities = [
	{
		content: "$2400, Design changes",
		timestamp: "2018-04-12 20:46",
		size: "large",
		type: "primary",
	},
	{
		content: "New order #4219423",
		timestamp: "2018-04-03 20:46",
		color: "#0bbd87",
	},
	{
		content: "Server Payments for April",
		timestamp: "2018-04-03 20:46",
		color: "orange",
	},
	{
		content: "New card added for order #3210145",
		timestamp: "2018-04-03 20:46",
		type: "primary",
		hollow: true,
		color: "blue",
	},
	{
		content: "Unlock packages for Development",
		timestamp: "2018-04-03 20:46",
	},
];
</script>

<template>
	<main>
		<a-timeline>
			<a-timeline-item color="green"
				>Create a services site 2015-09-01</a-timeline-item
			>
			<a-timeline-item color="green"
				>Create a services site 2015-09-01</a-timeline-item
			>
			<a-timeline-item color="red">
				<p>Solve initial network problems 1</p>
				<p>Solve initial network problems 3 2015-09-01</p>
			</a-timeline-item>
			<a-timeline-item>
				<p>Technical testing 1</p>
				<p>Technical testing 3 2015-09-01</p>
			</a-timeline-item>
			<a-timeline-item color="gray">
				<p>Technical testing 1</p>
				<p>Technical testing 3 2015-09-01</p>
			</a-timeline-item>
			<a-timeline-item color="gray">
				<p>Technical testing 1</p>
				<p>Technical testing 3 2015-09-01</p>
			</a-timeline-item>
			<a-timeline-item color="#00CCFF">
				<template #dot>
					<SmileOutlined />
				</template>
				<p>Custom color testing</p>
			</a-timeline-item>
		</a-timeline>
	</main>
</template>
