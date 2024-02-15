<template>
    <form v-on:submit.prevent>
        <div class="bg-neutral-100 p-4 mt-2 mb-3 h-1/2 rounded-2xl shadow-2xl block shadow-slate-300 ">
            <div class="flex justify-between mt-2 gap-2 p-4">
                <img :src="avatarlogo" class=" h-13 w-14 rounded-full border-yellow-300 border overflow-hidden">
                <textarea class=" bg-neutral-50 w-full h-12 rounded-3xl overflow-hidden p-2" v-model="postMessage.message"  placeholder="Write a reply..."></textarea>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-3" @click="postComment(items)">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" class="bg-red-300"/>
                </svg>
            </div>
        </div>
    </form>
</template>
<script>
import AWN from "awesome-notifications";
export default {
    props: [
        "items",
        "avatarlogo",
        "postcommenturl"
    ],
    components: {
        AWN
    },
    data() {
        return {
            postMessage: {
                id: null,
                postId: null,
                message: null,
            },
        }
    },
    methods: {
        postComment(node) {
            if (node) {
                this.postMessage.postId = node.id;
                let notifier = new AWN();
                let _this = this;
                let onOk = () => {
                    axios({
                        method: 'POST',
                        url: _this.postcommenturl,
                        data: {
                            payload: _this.postMessage,
                        }
                    })
                    .then(function (response) {
                        if (response.data) {
                            location.reload();
                            notifier.info('Successfully Submit!');
                        }
                    });
                };
                let onCancel = () => {
                    notifier.info('You pressed Cancel');
                };
                notifier.confirm(
                    'Are you sure you want to post?',
                    onOk,
                    onCancel, {
                        labels: {
                            confirm: 'WARNING!'
                        }
                    }
                );
            }
        },
    }
}
</script>
