<template>
	<div>
		<transition-group
			name="fade"
			tag="div"
			appear
			@before-enter="beforeEnter as any"
			@enter="enter as any"
			class="analytics-cards grid grid-cols-2 xl:grid-cols-4 gap-4"
		>
			<div
				v-for="(card, index) in cardStatistic"
				:key="index"
				:data-index="index"
				class="cardStatistic"
			>
				<CardStatistic
					:title="card.title"
					:money="card.money"
					:icon="card.icon"
					class="h-full"
				/>
			</div>
		</transition-group>
		<div class="grid grid-cols-10 gap-4 mt-8">
			<div class="col-span-10 xl:col-span-3">
				<CardProfile
					:isAdmin="true"
					:isVerified="true"
					referralCode="123456"
					:mainWallet="1000000000"
					:pendingWallet="1000000000"
					class="h-full"
				/>
			</div>
			<div class="col-span-10 xl:col-span-7">
				<CardGraph />
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import { gsap } from "gsap";
import CardStatistic from "../components/Card/Statistic.vue";
import CardProfile from "../components/Card/Profile/index.vue";
import CardGraph from "../components/Card/Graph.vue";

const cardStatistic = ref([
	{
		index: 1,
		title: "Chi tiêu cá nhân",
		money: 1000000000,
		icon: "Wallet",
	},
	{
		index: 2,
		title: "Số dư hiện tại",
		money: 1000000000,
		icon: "Odometer",
	},
	{
		index: 3,
		title: "Chờ thanh toán",
		money: 1000000000,
		icon: "SuitcaseLine",
	},
	{
		index: 4,
		title: "Năng động",
		money: 1000000000,
		icon: "Histogram",
	},
]);

const beforeEnter = (el: HTMLElement) => {
	el.style.opacity = "0";
	el.style.transform = "translateX(-100px)";
};

const enter = (el: HTMLElement, done: () => void) => {
	const delay = parseInt(el.dataset.index!) * 100;
	setTimeout(() => {
		gsap.to(el, {
			opacity: 1,
			x: 0,
			duration: 0.8,
			onComplete: done,
		});
	}, delay);
};

onMounted(() => {
	const elements = document.querySelectorAll(
		".analytics-cards .cardStatistic"
	);
	elements.forEach((el, index) => {
		gsap.fromTo(
			el,
			{ opacity: 0, y: 100 },
			{ opacity: 1, y: 0, duration: 0.8, delay: index * 0.1 }
		);
	});
});
</script>

<style scoped>
.analytics-cards {
	display: grid;
	gap: 1rem;
}
</style>
