export function getMonthLabels(count: number): string[] {
    const date = new Date()
    const monthLabels: string[] = [] // Explicitly define the type of the array
    for (let i = 0; i < count; i++) {
        monthLabels.push(date.toLocaleString('default', { month: 'long' }))
        date.setMonth(date.getMonth() + 1)
    }
    return monthLabels
}
