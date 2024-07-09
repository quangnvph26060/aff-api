<template>
    <div>
        <Bar :data="data" :options="options" />
    </div>
</template>

<script lang="ts" setup>
import { Bar } from 'vue-chartjs'
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
} from 'chart.js'
import { ref, onMounted } from 'vue'
import * as chartConfig from './chartConfig.js'

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)

const data = ref(chartConfig.data)
const options = ref(chartConfig.options)

onMounted(() => {})
</script>
