<template>
    <nav class="grid grid-cols-2 bg-gray-100 sticky top-0 w-full shadow-lg">
        <div class="min-h-12">
            <div class="grid grid-cols-2">
                <div class="py-4 px-4 flex justify-items-end">
                    <img :src="headerlogo" class=" h-20 w-20 rounded-full">
                    <b class="m-6 text-neutral-600 font-extrabold font-sans">Akosi Rico</b>
                </div>
                <div class="py-4 px-4 grid justify-items-center">
                    <div class="flex items-center w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input class="bg-gray-200 rounded-3xl text-center mr-3 py-1 px-2 h-1/2 w-full focus:outline-none"
                                type="text" placeholder="Search" aria-label="Full name">
                    </div>
                </div>
            </div>
        </div>
        <div class="grid justify-items-end items-center" @mouseover="viewOptionOpen()">
            <div class="grid grid-cols-2 relative">
                <div class="py-4 px-1 font-light grid justify-items-end">
                    <img :src="avatarlogo" class="h-14 w-14 rounded-full border-yellow-400 border">
                    <div class="mt-16 py-2 rounded-lg shadow-xl absolute w-48 bg-neutral-200" v-if="avatarOptionVisible"  @mouseleave="viewOptionClose()">
                        <a :href="homeurl" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Home</a>
                        <a :href="profileurl" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Profile</a>
                        <a @click="logout()" data-test="asdasdsa" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Sign Out</a>
                    </div>
                </div>
                <div class="grid items-center px-4">
                    {{ accountname }}
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    props: [
        "headerlogo",
        "avatarlogo",
        "logouturl",
        "profileurl",
        "homeurl",
        "accountname"
    ],
    data() {
        return {
            avatarOptionVisible: false,
        }
    },
    methods: {
        viewOptionOpen() {
            this.avatarOptionVisible = true;
        },
        viewOptionClose() {
            this.avatarOptionVisible = false;
        },
        logout() {
            let _this = this;
            axios.post(_this.logouturl)
            .then(response => {
                location.reload();
            })
            .catch(error => {
                console.error('Logout failed:', error);
            });
        },
    },
}
</script>