<script setup>
</script>
<template>
<div class="space-y-4">
  <div v-if="$page.props.flash.status === 'danger'" class="rounded-md bg-red-50 p-4 text-sm text-red-500">
  {{ $page.props.flash.message }}
  </div>

</div>
</template> 