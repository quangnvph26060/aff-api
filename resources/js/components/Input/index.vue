<template>
    <div>
        <span>{{ title }}</span>

        <a-input
            :value="ansValue"
            :placeholder="placeholder"
            :disabled="disabled"
            :size="size"
            v-if="type === 'text'"
        />

        <a-input-number
            :value="ansValue"
            :placeholder="placeholder"
            :disabled="disabled"
            :size="size"
            :formatter="
                (value) => `đ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
            "
            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
            class="w-full"
            v-else-if="type === 'number'"
        />

        <a-textarea
            :value="ansValue"
            :placeholder="placeholder"
            :rows="rows"
            :size="size"
            :disabled="disabled"
            v-else-if="type === 'textarea'"
        />
    </div>
</template>

<script lang="ts" setup>
import { ref, computed } from 'vue'

type SizeType = 'small' | 'middle' | 'large'

const props = defineProps({
    value: {
        type: [String, Number],
        default: '',
    },
    placeholder: {
        type: String,
        default: '',
    },
    rows: {
        type: Number,
        default: 6,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    type: {
        type: String,
        default: 'text',
    },
    title: {
        type: String,
        default: '',
    },
    size: {
        type: String as () => SizeType,
        default: 'middle',
    },
})

const emit = defineEmits(['update:input'])

const ansValue = ref('')

// const updateValue = computed({
//     get: () => props.value,
//     set: (value: string | number) => emit('update:input', value),
// })
</script>
<style></style>
