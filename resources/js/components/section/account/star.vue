<template>
    <form v-on:submit.prevent class="ml-3">
        <div class="flex items-center">
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <small> {{ oneStar }}</small>
        </div>
        <div class="flex items-center">
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <small>{{ twoStar }}</small>
        </div>
        <div class="flex items-center">
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <small>{{ threeStar }}</small>
        </div>
        <div class="flex items-center">
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <small>{{ fourStar }}</small>
        </div>
        <div class="flex items-center">
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <svg class="w-6 h-4 fill-current text-yellow-500" viewBox="0 0 20 20">
                <path d="M10 1L12.39 6.42L18 7.24L13.75 11.66L15.17 17L10 14.75L4.83 17L6.25 11.66L2 7.24L7.61 6.42L10 1Z"/>
            </svg>
            <small>{{ fiveStar }}</small>
        </div>
    </form>
</template>
<script>
export default {
    props: [
        "oneStar",
        "twoStar",
        "threeStar",
        "fourStar",
        "fiveStar",
    ]
}
</script>
