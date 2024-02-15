<template>
    <form v-on:submit.prevent>
        <div class="w-full m-2 flex justify-center">
            <div class="w-4/6 grid grid-cols-1 justify-items-center">
                <div class="card-post">
                    <div class="card-header">
                        <img :src="avatarlogo" class=" h-14 w-14 rounded-full border-yellow-400 border overflow-hidden">
                        <small class="px-2 py-4"><span>Rico M. Hachero Jr</span></small>
                    </div>
                    <div class="card-content">
                        <textarea class="w-full h-full bg-neutral-50 rounded-lg p-12" 
                         v-model="postRequest.message"
                        placeholder="What's on your mind?"></textarea>
                    </div>
                    <div class="flex justify-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-xl" @click="submitNewPost()">
                            Post
                        </button>
                    </div>
                </div>
                <select class="block appearance-none w-38
                    bg-white border border-gray-200
                     hover:border-neutral-100 px-4 py-2 pr-8 
                     rounded-xl shadow leading-tight 
                     focus:outline-none focus:shadow-outline text-center flex-nowrap" 
                     @change="canFilter()"
                     v-model="options.status">
                    <option value="#">Post Status</option>
                    <option value="1">Active</option>
                    <option value="0">Archived</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 " :key="refreshUI">
            <div class="flex justify-center" v-for="item in resultset['personalPost']">
                    <div class="w-1/2 flex justify-center">
                        <div class="card-post">
                            <div class="flex justify-between w-full">
                                <div class="flex justify-start">
                                    <img :src="avatarlogo" class=" h-14 w-14 rounded-full border-yellow-400 border overflow-hidden">
                                    <small class="px-2 py-4 m-0 p-0 "><span>Rico M. Hachero Jr</span></small>
                                    <small class="py-4 font-normal"><span>{{ item["postedDate"] ?? "Just now " }}</span></small>
                                    <small class="py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class=" h-4 w-3">
                                            <path strokeLinecap="round" strokeLinejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </small>
                                </div>
                                <div class="flex justify-end py-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 ml-6" @click="canArchive(item)">
                                        <path d="M3 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H3Z" />
                                        <path fillRule="evenodd" d="M3 6h10v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6Zm3 2.75A.75.75 0 0 1 6.75 8h2.5a.75.75 0 0 1 0 1.5h-2.5A.75.75 0 0 1 6 8.75Z" 
                                        clipRule="evenodd"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 ml-2" @click="deletePost(item)">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm2.78-4.22a.75.75 0 0 1-1.06 0L8 9.06l-1.72 1.72a.75.75 0 1 1-1.06-1.06L6.94 8 5.22 6.28a.75.75 0 0 1 1.06-1.06L8 6.94l1.72-1.72a.75.75 0 1 1 1.06 1.06L9.06 8l1.72 1.72a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="card-content">
                                <textarea class=" bg-neutral-50 w-full h-full rounded-lg p-12" v-model="item.message" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="flex justify-center gap-2">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-6 rounded-xl shadow-xl" :data-rico="item['id']" @click="updatePost(item)">
                                    Post
                                </button>
                            </div>
                            <star
                                :oneStar="item.oneStartCount"
                                :twoStar="item.twoStartCount"
                                :threeStar="item.threeStartCount"
                                :fourStar="item.fourStartCount"
                                :fiveStar="item.fiveStartCount">
                            </star>
                            <div class="flex items-center justify-between px-4 py-1 mt-3 cursor-pointer" @click="isOpen">
                                <h3 class="text-lg font-semibold">View comments</h3>
                            </div>
                            <comment 
                                :items="item.comments"
                                :avatarlogo="avatarlogo"
                                :postcommenturl="postcommenturl"
                                :deletecommenturl="deletecommenturl">
                            </comment>
                            <reply
                                :items="item"
                                :avatarlogo="avatarlogo"
                                :postcommenturl="postcommenturl">
                            </reply>
                        </div>
                    </div>
            </div>
        </div>
    </form>
</template>
<script>
import AWN from "awesome-notifications";
import star from  "./star.vue";
import comment from "./comment.vue";
import reply from "./reply.vue";
export default {
    props: [
        "avatarlogo",
        "newpostbaseurl",
        "resultset",
        "postcommenturl",
        "deletecommenturl",
        "canfilterposturl"
    ],
    components: {
        AWN,
        star,
        comment,
        reply,
    },
    data() {
        return {
            commentView: false,
            postRequest: {
                id: null,
                message: null,
                archive: false,
            },
            postMessage: {
                id: null,
                postId: null,
                message: null,
            },
            options: {
                status: "#"
            },
            refreshUI: 0,
            readOnly: true,
        }
    },
    methods: {
        isOpen() {
            if (this.commentView) {
                this.commentView = false;
            } else {
                this.commentView = true;
            }
        },
        submitNewPost() {
            let notifier = new AWN();
            let _this = this;
            let onOk = () => {
                axios({
                    method: 'POST',
                    url: _this.newpostbaseurl,
                    data: {
                        payload: _this.postRequest,
                    }
                })
                .then(function (response) {
                    if (response.data) {
                        let rico = response.data;
                        _this.resultset['personalPost'].push(rico);
                        let hachero = _this.resultset['personalPost'].slice().sort((a, b) => b.id - a.id);
                        _this.resultset['personalPost'] = hachero;
                        _this.refreshUI++;
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
        },
        editPost() {
            if (this.readOnly) {
                this.readOnly = false;
            } else {
                this.readOnly = true;
            }
        },
        updatePost(node) {
            let notifier = new AWN();
            let _this = this;
            let onOk = () => {
                axios({
                    method: 'PUT',
                    url: _this.newpostbaseurl+"/"+ node.id,
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
                'Are you sure?',
                onOk,
                onCancel, {
                    labels: {
                        confirm: 'WARNING!'
                    }
                }
            );
        },
        deletePost(node) {
            let notifier = new AWN();
            let _this = this;
            let onOk = () => {
                axios({
                    method: 'DELETE',
                    url: _this.newpostbaseurl+"/"+ node.id,
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
        canArchive(node) {
            let temp;
            node.archive = true;
            temp = node;
            let notifier = new AWN();
            let _this = this;
            let onOk = () => {
                axios({
                    method: 'PUT',
                    url: _this.newpostbaseurl+"/"+ node.id,
                    data: {
                        payload: temp
                    }
                })
                .then(function (response) {
                   if (response.data) {
                        notifier.info('Successfully Submit!');
                   }
                   _this.refreshUI++;
                });
            };
            let onCancel = () => {
                notifier.info('You pressed Cancel');
            };
            notifier.confirm(
                'Are you sure you want to archive?',
                onOk,
                onCancel, {
                    labels: {
                        confirm: 'WARNING!'
                    }
                }
            );
        },
        canFilter() {
            let _this = this;
            axios({
                method: 'POST',
                url: _this.canfilterposturl,
                data: {
                    status: _this.options.status,
                }
            })
            .then(function (response) {
                if (response.data) {
                    _this.resultset['personalPost'] = response.data;
                    let tempData = _this.resultset['personalPost'].slice().sort((a, b) => b.id - a.id);
                    _this.resultset['personalPost'] = tempData;
                    _this.refreshUI++;
                }
            });
        }
    },
}
</script>
