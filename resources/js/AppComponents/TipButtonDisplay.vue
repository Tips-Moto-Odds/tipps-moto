<script setup>
const props = defineProps(['tip','tags'])
</script>
<template>
  <div class="rounded w-[108px]" :class="tags?.includes('yesterdays-tips') ? 'bg-green-600' : ' bg-primary_orange'">
    <p v-if="tip.predictions == 1 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">1/X</p>
    <p v-else-if="tip.predictions == 0 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">X/2</p>
    <p v-else-if="tip.predictions == -1 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">1/2</p>

    <p v-else-if="tip.predictions == 1 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Home</p>
    <p v-else-if="tip.predictions == 0 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Draw</p>
    <p v-else-if="tip.predictions == -1 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Away</p>

    <p v-else-if="tip.predictions == 1 && tip.prediction_type == 'GG-NG'" class="prediction-card-display">GG</p>
    <p v-else-if="tip.predictions == -1 && tip.prediction_type == 'GG-NG'" class="prediction-card-display">NG</p>

    <p v-else class="prediction-card-display">{{ tip.predictions }}</p>
  </div>
</template>

<style lang="scss" scoped>
.prediction-card-display {
  @apply rounded text-center py-1 text-white;
}

</style>
