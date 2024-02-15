<template>
     <form v-on:submit.prevent>
        <div class="bg-neutral-100 p-3 mt-2 rounded-xl shadow-xl shadow-slate-300"  v-for="(comment, index) in items">
            <div class="flex justify-start mt-2 gap-2 p-4">
                <img :src="avatarlogo" class=" h-11 w-12 rounded-full border-yellow-400 border overflow-hidden">
                <textarea class=" bg-neutral-50 w-full h-12 rounded-3xl overflow-hidden p-2" v-model="comment.mainComment"  placeholder="Comment"></textarea>
            </div>
            <div class="flex mt-4 gap-2">
                <small @click="canUpdateComment(comment)">Edit</small>
                <small @click="deleteComment(comment)">Delete</small>
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
        "postcommenturl",
        "deletecommenturl"
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
            refreshUI: 0,
        }
    }, 
    methods: {
        deleteComment(node) {
            let notifier = new AWN();
            let _this = this;
            let onOk = () => {
                axios({
                    method: 'POST',
                    url: _this.deletecommenturl,
                    data: {
                        payload: node
                    }
                })
                .then(function (response) {
                   if (response.data) {
                        notifier.info('Successfully Submit!');
                   }
                   location.reload();
                });
            };
            let onCancel = () => {
                notifier.info('You pressed Cancel');
            };
            notifier.confirm(
                'Are you sure you want to remove?',
                onOk,
                onCancel, {
                    labels: {
                        confirm: 'WARNING!'
                    }
                }
            );
        },
        canUpdateComment(node) {
            if (node) {
                this.postMessage.id = node.id;
                this.postMessage.postId = node.post_id;
                this.postMessage.message = node.mainComment;
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
                    'Are you sure you want to update this comment?',
                    onOk,
                    onCancel, {
                        labels: {
                            confirm: 'Warning!'
                        }
                    }
                );
            }
        }
    }
}
</script>
