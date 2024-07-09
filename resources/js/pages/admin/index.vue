<script lang="ts" setup></script>

<template>
	<div class="grid grid-cols-4 gap-6">
		<!-- begin::All Wallet -->
		<CardWallet
			title="Ví chính"
			:money="100000000"
			class="col-span-4 md:col-span-2 xl:col-span-1"
		/>
		<CardWallet
			title="Ví chính"
			:money="100000000"
			class="col-span-4 md:col-span-2 xl:col-span-1"
		/>
		<CardWallet
			title="Ví chính"
			:money="100000000"
			class="col-span-4 md:col-span-2 xl:col-span-1"
		/>
		<CardWallet
			title="Ví chính"
			:money="100000000"
			class="col-span-4 md:col-span-2 xl:col-span-1"
		/>
		<!-- end::All Wallet -->

		<!-- begin::Statistic Chart-->
		<Card :title="'Thống kê đội nhóm'" class="col-span-4 lg:col-span-2">
			<template #content>
				<ChartBar class="h-[360px]" />
			</template>
		</Card>

		<Card :title="'Thống kê dòng tiền'" class="col-span-4 lg:col-span-2">
			<template #content>
				<ChartStackedBar class="h-[360px]" />
			</template>
		</Card>
		<!-- end::Statistic Chart-->

		<!-- begin::Order Table -->
		<TableOrderAdmin class="col-span-4" />
		<!-- end::Order Table -->
	</div>
</template>
