<template>
	<div>
		<div>
			<div class="wrapper font-bold text-2xl text-start" ref="container">
				<h1>
					WEB89<span class="animated-text color-secondary"></span>
				</h1>
			</div>
		</div>

		<!-- <div>
            <section class="container hero" ref="heroRef">
                <div class="hero__inner">
                    <div class="hero__images">
                        <img
                            class="hero__image"
                            src="https://images.unsplash.com/photo-1508781197106-d8c535dcf276?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1200&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ"
                            alt="Neat Image"
                            ref="heroImageRef"
                        />
                    </div>
                    <div class="hero__content">
                        <div class="hero__headline color-secondary">
                            <span>AFFILIATE WEB89</span>
                        </div>
                    </div>
                </div>
            </section>
        </div> -->
		<div ref="container2" class="container2 final mb-20">
			<div class="letter F">WEB</div>
			<div class="letter l">8</div>
			<div class="letter i">9</div>
			<div class="letter p">!</div>

			<div class="for">for</div>
			<div class="gsap">AFFILIATE</div>
		</div>
	</div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { Flip } from "gsap/Flip";
import { TextPlugin } from "gsap/TextPlugin";

gsap.registerPlugin(ScrollTrigger, Flip, TextPlugin);
gsap.defaults({ ease: "none" });

// References for DOM elements
const heroRef = ref(null);
const heroImageRef = ref(null);

const container2 = ref(null);
const layouts = ["final", "plain", "columns", "grid"];
let curLayout = 0;

const animate = () => {
	const tl = gsap.timeline({ repeat: -1, repeatDelay: 1, yoyo: true });

	tl.to(".animated-text", {
		duration: 4,
		text: " cung cấp các giải pháp website tổng thể .",
	});
};

function nextState() {
	if (!container2.value) return; // Ensure container2 is defined

	const state = Flip.getState(".letter, .for, .gsap", {
		props: "color,backgroundColor",
		simple: true,
	});

	container2.value.classList.remove(layouts[curLayout]);
	curLayout = (curLayout + 1) % layouts.length;
	container2.value.classList.add(layouts[curLayout]);

	Flip.from(state, {
		absolute: true,
		stagger: 0.07,
		duration: 0.7,
		ease: "power2.inOut",
		spin: curLayout === 0,
		simple: true,
		onEnter: (elements, animation) =>
			gsap.fromTo(
				elements,
				{ opacity: 0 },
				{ opacity: 1, delay: animation.duration() - 0.1 }
			),
		onLeave: (elements) => gsap.to(elements, { opacity: 0 }),
	});

	gsap.delayedCall(curLayout === 0 ? 3.5 : 1.5, nextState);
}

onMounted(() => {
	if (container2.value) {
		gsap.delayedCall(1, nextState);
	}

	animate();

	// GSAP Animation for the Hero Section
	// gsap.to(heroRef.value, {
	//     scrollTrigger: {
	//         trigger: heroRef.value,
	//         scrub: true,
	//         pin: true,
	//         start: 'center center',
	//         end: 'bottom -100%',
	//         toggleClass: 'active',
	//         ease: 'power2',
	//     },
	// })

	// GSAP Animation for the Hero Image
	// gsap.to(heroImageRef.value, {
	//     scrollTrigger: {
	//         trigger: heroRef.value,
	//         scrub: 0.5,
	//         start: 'top bottom',
	//         end: 'bottom -300%',
	//         ease: 'power2',
	//     },
	//     y: '-30%',
	// })
});
</script>
<style scoped>
::-webkit-scrollbar {
	display: none;
}

.box {
	width: 300px;
}

.container {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 100%;
	height: 100vh;
	color: black;
	text-align: center;
}

.container__headline {
	font-size: 5vmin;
}

.hero__inner {
	display: flex;
	position: relative;
	width: 100vw;
	max-height: 100vh;
	overflow: hidden;
}

.hero__inner::before {
	content: "";
	display: block;
	padding-bottom: calc(100% / (16 / 9));
}

.hero__image {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 160%;
	object-fit: cover;
}

.hero__content {
	display: flex;
	position: absolute;
	right: 0;
	align-items: center;
	justify-content: center;
	width: 100%;
	height: 100%;
}

.hero__headline {
	--padding: 1.5vmin;
	--duration: 400ms;
	--delay: calc(var(--duration) / 2);
	--ease: cubic-bezier(0.25, 1, 0.5, 1);
	position: relative;
	display: inline-block;
	font-size: 10vmin;
	overflow: hidden;
	margin-top: calc(var(--padding) * -1);
	padding: var(--padding);
	z-index: 9999999;
}

.hero__headline::after {
	content: "";
	position: absolute;
	top: calc(100% - var(--padding));
	left: 0;
	background-color: white;
	width: 100%;
	height: 1.5vmin;
	transform: scaleX(0);
	transition: transform var(--duration) var(--delay) var(--ease);
}

.hero__headline span {
	display: block;
	transform: translateY(110%);
	transition: transform var(--duration) var(--ease);
}

.active .hero__headline::after {
	transform: scaleX(1);
	transition-delay: 0s;
}

.active .hero__headline span {
	transform: translateY(0);
	transition-delay: var(--delay);
}

.container2 {
	display: flex;
	height: 200px;
	width: 100%;
	justify-content: center;
	align-items: center;
	overflow: hidden;
}

.container2.grid,
.container2.columns {
	align-content: stretch;
	align-items: stretch;
	flex-wrap: wrap;
}

.letter {
	text-align: center;
	color: white;
	font-size: 40px;
	font-weight: 400;
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 2px 6px;
}

.container2.grid .letter {
	flex-basis: 50%;
}

.container2.columns .letter {
	flex-basis: 20%;
}

.for,
.gsap {
	font-size: 20px;
	color: red;
}

.for {
	padding: 2px 1.6vmax;
	font-weight: 300;
	display: none;
}

.gsap {
	padding: 2px 0;
	font-weight: 600;
	display: none;
}

.container2.final .for,
.container2.final .gsap {
	display: block;
}

.F {
	background: #10b981;
}

.l {
	background: #14b8a6;
}

.i {
	background: #06b6d4;
}

.p {
	background: #6366f1;
}

.container2.plain .letter {
	background: transparent;
	color: red;
	font-weight: 500;
	padding: 0;
}
</style>
